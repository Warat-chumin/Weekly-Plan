<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\work_detail;
use App\employee;
use App\week;
use App\events;
use App\users;
use App\team_member;
use App\project;
use App\project_member;
use App\subject;
use App\customer;
use App\team;
use App\event_file;
use App\files;
use Carbon\Carbon;
use File;
use DB;
use Illuminate\Support\Facades\Redirect;
use PDF;

class WeeklyPlanController extends Controller
{
    public function index($employee_code)
    {
        $employee = employee::where('employee_code', $employee_code)->get();
        $users = users::where('employee_code', $employee_code)->get();

        $events = DB::table('events')
                    ->select('events.id','events.project','events.subject','events.event_name','events.code_customer','events.start_date'
                    ,'events.end_date','events.address','events.contact_person','events.note','events.employee_code','events.employee_code_created'
                    ,'events.created_at','events.updated_at','project.name_project','subject.name_subject','customer.name_customer'
                    ,'events.project_name', 'events.customer_name', 'events.subject_name')
                    ->leftJoin('project', 'project.code_project', '=', 'events.project')
                    ->leftJoin('subject', 'subject.code_subject', '=', 'events.subject')
                    ->leftJoin('customer', 'customer.code_customer', '=', 'events.code_customer')
                    ->where('employee_code', $employee_code)
                    ->get();


        $file = DB::table('files')
                ->select("files.file","event_files.event_id")
                ->leftjoin("event_files", "files.id", "=", "event_files.file_id")
                ->leftjoin("events", "events.id", "=", "event_files.event_id")
                ->leftJoin('project', 'project.code_project', '=', 'events.project')
                ->leftJoin('subject', 'subject.code_subject', '=', 'events.subject')
                ->leftJoin('customer', 'customer.code_customer', '=', 'events.code_customer')
                ->where('employee_code', $employee_code)
                ->get();

        $project = project_member::leftJoin('project', 'project.code_project', '=', 'project_member.code_project')
                    ->where('project_member.employee_code', $employee_code)
                    ->get();

        $subject = subject::get();
        $customer = customer::get();

        return view('weekly_plan.weekly_plan', compact('events','employee_code','employee','users','project','subject','customer','file'));
    }

    public function index_team()
    {
        if(Auth::user()->type_id == 1){
            $team = DB::table('team_member')->groupBy('code_team')->get();
            $team_all = DB::table('team')->get();
            $employee = employee::where('employee_code', Auth::user()->employee_code)->get();
            $users = users::where('employee_code', Auth::user()->employee_code)->get();
            $team_count = DB::table('team_member')
                    ->select('code_team', DB::raw('count(*) as team_member'))
                    ->groupBy('code_team')
                    ->get();
            return view('weekly_plan.weekly_plan_team_all', compact('team','team_all','team_count'));
        }
        else{
            $team = team_member::where('employee_code', Auth::user()->employee_code)->where('type_id', '1')->get();

            $team_all = DB::table('team')->get();
            $employee = employee::where('employee_code', Auth::user()->employee_code)->get();
            $users = users::where('employee_code', Auth::user()->employee_code)->get();
            $team_count = DB::table('team_member')
                    ->select('code_team', DB::raw('count(*) as team_member'))
                    ->groupBy('code_team')
                    ->get();
            return view('weekly_plan.weekly_plan_team_all', compact('team','team_all','team_count'));
        }

    }

    public function index_team_detail($id, Request $request)
    {
        $team = team::where('code_team', $id)->get();
        $events = DB::table('team_member')
                            ->select('events.id','events.project','events.subject','events.event_name','events.code_customer','events.start_date','events.project_name','events.subject_name','events.customer_name'
                            ,'events.end_date','events.address','events.contact_person','events.note','events.employee_code','events.employee_code_created'
                            ,'events.created_at','events.updated_at','project.name_project','subject.name_subject','customer.name_customer','users.profile_pic','users.username')
                            ->leftJoin('events', 'events.employee_code', '=', 'team_member.employee_code')
                            ->leftJoin('users', 'users.employee_code', '=', 'events.employee_code')
                            ->leftJoin('project', 'project.code_project', '=', 'events.project')
                            ->leftJoin('subject', 'subject.code_subject', '=', 'events.subject')
                            ->leftJoin('customer', 'customer.code_customer', '=', 'events.code_customer')
                            ->where('team_member.code_team', $id)
                            ->whereNotNull('events.id')
                            ->orderBy('events.start_date', 'desc')
                            ->get();

        return view('weekly_plan.weekly_plan_team_detail', compact('events','id','team'));
    }
}
