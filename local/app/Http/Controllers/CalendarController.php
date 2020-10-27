<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Calendar;
use App\events;
use Illuminate\Support\Facades\Redirect;
use Validator;
use App\employee;
use App\users;
use App\team;
use App\team_member;
use Auth;
use DB;
use Carbon\Carbon;
use Illuminate\Support\Str;
use App\project;
use App\project_member;
use App\subject;
use App\customer;
use App\files;
use App\event_file;

class CalendarController extends Controller
{
    public function index_team_all()
    {
        if(Auth::user()->type_id == 1){
            $team = DB::table('team_member')->groupBy('code_team')->get();
            $team_all = DB::table('team')->get();
            $employee = employee::where('employee_code', Auth::user()->employee_code)->get();
            $users = users::where('employee_code', Auth::user()->employee_code)->get();
            $file = DB::table('files')
                ->select("files.file","event_files.event_id")
                ->leftjoin("event_files", "files.id", "=", "event_files.file_id")
                ->leftjoin("events", "events.id", "=", "event_files.event_id")
                ->leftJoin('project', 'project.code_project', '=', 'events.project')
                ->leftJoin('subject', 'subject.code_subject', '=', 'events.subject')
                ->leftJoin('customer', 'customer.code_customer', '=', 'events.code_customer')
                ->where('employee_code', $employee_code)
                ->get();

            $team_count = DB::table('team_member')
                    ->select('code_team', DB::raw('count(*) as team_member'))
                    ->groupBy('code_team')
                    ->get();
            return view('calendar_team_all', compact('team','team_all','employee','users','team_count', 'file'));
        }
        else{
            $team = team_member::where('employee_code', Auth::user()->employee_code)->where('type_id', '1')->get();

            if(!$team->isempty()){
                $team_all = DB::table('team')->get();
                $employee = employee::where('employee_code', Auth::user()->employee_code)->get();
                $users = users::where('employee_code', Auth::user()->employee_code)->get();
                $file = DB::table('files')
                ->select("files.file","event_files.event_id")
                ->leftjoin("event_files", "files.id", "=", "event_files.file_id")
                ->leftjoin("events", "events.id", "=", "event_files.event_id")
                ->leftJoin('project', 'project.code_project', '=', 'events.project')
                ->leftJoin('subject', 'subject.code_subject', '=', 'events.subject')
                ->leftJoin('customer', 'customer.code_customer', '=', 'events.code_customer')
                ->where('employee_code', $employee_code)
                ->get();

                $team_count = DB::table('team_member')
                        ->select('code_team', DB::raw('count(*) as team_member'))
                        ->groupBy('code_team')
                        ->get();
                return view('calendar_team_all', compact('team','team_all','employee','users','team_count', 'file'));
            }
            else{
                return Redirect::to('calendar/'.Auth::user()->employee_code.'/all');
            }
        }

    }

    public function index_team($code_team)
    {
        $team = team::where('code_team', $code_team)->get();
        $team_member = team_member::where('code_team', $code_team)->get();

        $employee = DB::table('employee')->get();
        $users = DB::table('users')->get();

        return view('calendar_team', compact('employee','users','team','team_member','code_team'));
    }

    public function index_employee($employee_code)
    {
        $employee = employee::where('employee_code', $employee_code)->get();
        $users = users::where('employee_code', $employee_code)->get();
        $events = events::select('events.event_name','events.start_date', 'events.end_date', 'events.contact_person',
        'events.address', 'events.note', 'events.code_customer', 'events.subject', 'events.project', 'events.id', 'subject.color_code')
        ->where('employee_code', $employee_code)
        ->leftjoin('subject','subject.code_subject', '=', 'events.subject')
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

        $customer = customer::leftjoin("customer_users", "customer_users.customer_code", "=", "customer.code_customer")
        ->where('employee_code', $employee_code)
        ->get();

        // $project = project_member::leftJoin('project', 'project.code_project', '=', 'project_member.code_project')
        // ->where('project_member.employee_code', $employee_code)
        // ->get();

        $project = DB::table('project_member')
        ->select('project_member.id','project_member.code_project','project_member.code_team','project_member.code_team','project.name_project','team.name_team','project_member.status')
        ->leftJoin('project', 'project.code_project', '=', 'project_member.code_project')
        ->leftJoin('team', 'team.code_team', '=', 'project_member.code_team')
        ->where('project_member.code_team', Auth::user()->code_team_register)->get();


        $subject = subject::get();

        $events_today = events::leftjoin('subject','events.subject', '=', 'subject.code_subject')->where('employee_code', '=', $employee_code)->where('start_date', 'LIKE', date("Y-m-d") . '%')->get();

        return view('calendar', compact('events','employee','users', 'customer', 'project', 'subject', 'employee_code','events_today', 'file'));
    }

    public function index_employee_add(Request $request , $employee_code)
    {
        $date = explode("-",str_replace(' ', '', $request['date_add']));
        $date = str_replace('/', '-', $date);
        $old_start_date = strtotime($date[0]);
        $old_end_date = strtotime($date[1]);
        $new_start_date = date('Y-m-d',$old_start_date);
        $new_end_date = date('Y-m-d',$old_end_date);

        $start_date = $new_start_date . ' ' . $request['time_start_add'] . ':00';
        $end_date = $new_end_date . ' ' . $request['time_stop_add'] . ':00';
        $event = new events;
        $event->project = $request['project_add'];
        $event->project_name = $request['project_add'];
        $event->subject = $request['subject_add'];
        $event->code_customer = $request['customer_add'];
        $event->event_name = $request['title_add'];
        $event->start_date = $start_date;
        $event->end_date = $end_date;
        $event->address = $request['address_add'];
        $event->contact_person = $request['contact_person_add'];
        $event->note = $request['note_cal'];
        $event->employee_code = $employee_code;
        $event->employee_code_created = Auth::user()->employee_code;
        $event->save();

        if($request->hasFile('file')) {
            foreach($request->file as $item){
                $file_name = $item->getClientOriginalName();
                $original_file_name = pathinfo($file_name, PATHINFO_FILENAME);
                $filename = $original_file_name . '-' . Carbon::now()->toDateString() . '_' . Str::random(8) . '.' . $item->getClientOriginalExtension();
                $item->move(public_path('/file'), $filename);

                $files = new files;
                $files->file = $filename;
                $files->save();

                $event_file = new event_file;
                $event_file->event_id = $event->id;
                $event_file->file_id = $files->id;
                $event_file->save();
            }
        }

        return Redirect::to('calendar/'.$employee_code.'/all');
    }

    public function index_employee_edit(Request $request, $employee_code)
    {
        $date = explode("-",$request['date_cal']);

        $date[0] = trim($date[0]," ");
        $date[0] = str_replace("/", "-", $date[0]);
        $date[1] = trim($date[1]," ");
        $date[1] = str_replace("/", "-", $date[1]);
        $new_start_date = date('Y-m-d',strtotime($date[0]));
        $new_end_date = date('Y-m-d',strtotime($date[1]));

        $start_date = $new_start_date . ' ' . $request['time_start_cal'];
        $end_date = $new_end_date . ' ' . $request['time_stop_cal'];

        $event = events::find($request['id_cal']);
        $event->project = $request['project_cal'];
        $event->project_name = $request['project_cal'];
        $event->subject = $request['subject_cal'];
        $event->code_customer = $request['customer_cal'];
        $event->event_name = $request['title_cal'];
        $event->start_date = $start_date;
        $event->end_date = $end_date;
        $event->address = $request['address_cal'];
        $event->contact_person = $request['contact_person_cal'];
        $event->note = $request['note_cal'];
        $event->employee_code = $employee_code;
        $event->employee_code_created = Auth::user()->employee_code;
        $event->save();
        // return $event;

        if($request->hasFile('file')) {
            $event = event_file::where("event_id",$request['id_cal'])->delete();
            foreach($request->file as $item){
                $file_name = $item->getClientOriginalName();
                $original_file_name = pathinfo($file_name, PATHINFO_FILENAME);
                $filename = $original_file_name.'-'.Carbon::now()->toDateString().'_'.Str::random(8).'.'.$item->getClientOriginalExtension();
                $item->move(public_path('/file'), $filename);

                $files = new files;
                $files->file = $filename;
                $files->save();

                $event_file = new event_file;
                $event_file->event_id = $request['id_cal'];
                $event_file->file_id = $files->id;
                $event_file->save();
            }
        }

        return Redirect::to('calendar/'.$employee_code.'/all');
    }

    public function index_delete_save(Request $request, $employee_code)
    {
        events::delete_by_id($request->id_cal);
        $event = event_file::where("event_id", $request->id_cal)->get();
        foreach($event as $item){
            $file = files::where("id", $item->file_id)->delete();
        }
        event_file::where("event_id", $request->id_cal)->delete();
        return redirect('calendar/'.$employee_code.'/all');
    }
}
