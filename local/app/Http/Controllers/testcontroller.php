<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\events;

class testcontroller extends Controller
{
    public function table()
    {
        $events = DB::table('team_member')
                            ->select('events.id','events.project','events.subject','events.event_name','events.code_customer','events.start_date','events.project_name','events.subject_name','events.customer_name'
                            ,'events.end_date','events.address','events.contact_person','events.note','events.employee_code','events.employee_code_created'
                            ,'events.created_at','events.updated_at','project.name_project','subject.name_subject','customer.name_customer','users.profile_pic','users.username')
                            ->leftJoin('events', 'events.employee_code', '=', 'team_member.employee_code')
                            ->leftJoin('users', 'users.employee_code', '=', 'events.employee_code')
                            ->leftJoin('project', 'project.code_project', '=', 'events.project')
                            ->leftJoin('subject', 'subject.code_subject', '=', 'events.subject')
                            ->leftJoin('customer', 'customer.code_customer', '=', 'events.code_customer')
                            ->where('team_member.code_team', 'tELqX2EQv3fiRlMG')
                            ->whereNotNull('events.id')
                            ->orderBy('events.start_date')
                            ->get();

        return view('test.table', compact('events'));
    }

    public function calendar()
    {
        $events = events::where('employee_code', '6201804750')->get();

        return view('test.calendar', compact('events'));
    }
}
