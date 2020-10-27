<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\events;
use App\type_users;
use App\users;
use Auth;
use App\team;
use Illuminate\Support\Facades\Redirect;

class DashboardController extends Controller
{
    public function index()
    {
        $users_check = users::where('id', Auth::user()->id)->limit(1)->first();

        if($users_check->users_status == '1'){
            // if(Auth::user()->type_id == '1'){
            //     $employee_count = DB::table('employee')->count();
            //     $team_count = DB::table('team')->count();
            //     $events_count_current = DB::table('events')->count();
            //     $type_users_count = DB::table('type_users')->count();

            //     $employee_new = DB::table('employee')->orderBy('employee.id', 'desc')->skip(0)->take(3)->get();
            //     $users = DB::table('users')->get();
            //     $events_today = DB::table('events')
            //                     ->select('events.id','events.project','events.subject','events.event_name','events.code_customer','events.start_date','events.project_name','events.subject_name','events.customer_name'
            //                     ,'events.end_date','events.address','events.contact_person','events.note','events.employee_code','events.employee_code_created'
            //                     ,'events.created_at','events.updated_at','project.name_project','subject.name_subject','customer.name_customer','users.profile_pic','users.username')
            //                     ->where('start_date', 'LIKE', date("Y-m-d") . '%')
            //                     ->leftJoin('users', 'users.employee_code', '=', 'events.employee_code')
            //                     ->leftJoin('project', 'project.code_project', '=', 'events.project')
            //                     ->leftJoin('subject', 'subject.code_subject', '=', 'events.subject')
            //                     ->leftJoin('customer', 'customer.code_customer', '=', 'events.code_customer')
            //                     ->get();

            //     return view('dashboard', compact('employee_count','team_count','events_count_current','employee_new','events_today','type_users_count','users'));
            // }
            // else{
            //     return Redirect::to('calendar/'.Auth::user()->employee_code.'/all');
            // }
            return Redirect::to('calendar/team_all');
        }
        else {
            $type_users = type_users::all();
            $team = team::all();
            $users = users::select('users.id', 'users.username', 'users.employee_code', 'users.email', 'users.type_id', 'users.users_status', 'type_users.name_type_users','team.name_team','users.code_team_register','employee.last_name','employee.first_name')
                    ->leftJoin('type_users', 'type_users.id', '=', 'users.type_id')
                    ->leftJoin('team', 'team.code_team', '=', 'users.code_team_register')
                    ->leftJoin('employee', 'employee.employee_code', '=', 'users.employee_code')
                    ->where('users.employee_code', Auth::user()->employee_code)->limit(1)->get();
            $users_approved = DB::table('users_approved')->where('username', Auth::user()->username)->orderby('id', 'desc')->first();
            return view('auth.register-wait', compact('type_users','users','users_approved','team'));
        }
    }
}
