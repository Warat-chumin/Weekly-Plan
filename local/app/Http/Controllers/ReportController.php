<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\team;
use App\team_member;
use App\events;
use App\checkin;
use App\employee;
use Auth;
use DB;
use PDF;
use DataTables;

class ReportController extends Controller
{
    public function index() {

        $events = DB::table('events')
                    ->select('events.id','events.project','events.subject','events.event_name','events.code_customer','events.start_date'
                    ,'events.end_date','events.address','events.contact_person','events.note','events.employee_code','events.employee_code_created'
                    ,'events.created_at','events.updated_at','project.name_project','subject.name_subject','customer.name_customer'
                    ,'events.project_name', 'events.customer_name', 'events.subject_name')
                    ->leftJoin('project', 'project.code_project', '=', 'events.project')
                    ->leftJoin('subject', 'subject.code_subject', '=', 'events.subject')
                    ->leftJoin('customer', 'customer.code_customer', '=', 'events.code_customer')
                    ->where('employee_code', Auth::user()->employee_code)
                    ->orderBy('events.start_date', 'desc')
                    ->get();

        return view('report', compact('events'));
    }

    public function index_employee_export(Request $request, $employee_code)
    {
        $events = events::leftjoin('customer','customer.code_customer','events.code_customer')->leftjoin('subject','subject.code_subject','events.subject')->where('employee_code', '=', $employee_code)->whereDate('start_date', '>=', $request['date_start'])->whereDate('end_date', '<=', $request['date_end'])->get();
        $employee = employee::where('employee_code', $employee_code)->get();
        $pdf = PDF::loadView('export_work',['events' => $events,'employee' => $employee]);
        $pdf->setPaper('a4','portrait');

        return @$pdf->stream();
    }
    
    public function event(Request $request){
        $events = events::select("events.id as id", "start_date", "end_date", "event_name", "contact_person", "customer_name")
        ->leftjoin("customer","customer.code_customer","events.code_customer")
        ->where("events.employee_code",Auth::user()->employee_code)
        // ->where("events.id","95")
        ->get();

        // return $events;
        return DataTables::of($events)->addIndexColumn()->make(true);
    }

    public function eventByDate(Request $request) {
        $events = events::select("events.id as id", "start_date", "end_date", "event_name", "contact_person", "customer_name")
        ->leftjoin("customer","customer.code_customer","events.code_customer")
        ->where("events.employee_code",Auth::user()->employee_code)
        ->where("start_date", ">=", $request->start_date)
        ->where("end_date", "<=", $request->end_date . "+1 days")
        ->get();

        return Datatables::of($events)->addIndexColumn()->make(true);
    }
}
