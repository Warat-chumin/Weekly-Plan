<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\employee;
use App\users;
use App\team;
use App\team_member;
use App\users_approved;
use App\type_users;
use Illuminate\Support\Str;
use DB;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;
use App\project;
use App\project_member;
use App\customer;
use App\customer_users_approved;
use App\customer_users;
use App\type_customers;
use App\subject;
use App\events;
use App\project_member_approved;
use App\User;
use Hash;

class SettingController extends Controller
{
    public function index_users_approve()
    {
        $employee_all = DB::table('employee')->get();

        $users_wait = users::select('users.id', 'users.username', 'users.employee_code', 'users.email', 'users.type_id', 'users.users_status', 'type_users.name_type_users','team.name_team','users.code_team_register')
                    ->leftJoin('type_users', 'type_users.id', '=', 'users.type_id')
                    ->leftJoin('team', 'team.code_team', '=', 'users.code_team_register')
                    ->where('users_status', '0')->get();

        $users_approve = users::select('users.id', 'users.username', 'users.employee_code', 'users.email', 'users.type_id', 'users.users_status', 'type_users.name_type_users','team.name_team','users.code_team_register')
                    ->leftJoin('type_users', 'type_users.id', '=', 'users.type_id')
                    ->leftJoin('team', 'team.code_team', '=', 'users.code_team_register')
                    ->where('users_status', '1')->get();

        $users_not_approve = users::select('users.id', 'users.username', 'users.employee_code', 'users.email', 'users.type_id', 'users.users_status', 'type_users.name_type_users','team.name_team','users.code_team_register','users.note')
                    ->leftJoin('type_users', 'type_users.id', '=', 'users.type_id')
                    ->leftJoin('team', 'team.code_team', '=', 'users.code_team_register')
                    ->where('users_status', '2')->get();

        $users_all = users::select('users.id', 'users.username', 'users.employee_code', 'users.email', 'users.type_id', 'users.users_status', 'type_users.name_type_users','team.name_team','users.code_team_register','users.note','users.updated_at')
                    ->leftJoin('type_users', 'type_users.id', '=', 'users.type_id')
                    ->leftJoin('team', 'team.code_team', '=', 'users.code_team_register')->get();

        return view('setting.setting_users_approve', compact('employee_all','users_wait','users_not_approve','users_approve','users_all'));
    }

    public function index_users_approve_accept(Request $request)
    {
        DB::table('users')
            ->where('username', $request['username'])
            ->update(['users_status' => "1",'note' => "อนุมัติ",'employee_code' => $request['employee_code']]);

        DB::table('employee')
            ->where('username', $request['username'])
            ->update(['employee_code' => $request['employee_code']]);

        $users_approved = new users_approved();
        $users_approved->username = $request['username'];
        $users_approved->users_status = '1';
        $users_approved->username_approved = Auth::user()->username;
        $users_approved->save();

        $team_member = new team_member();
        $team_member->code_team = $request['code_team'];
        $team_member->employee_code = $request['employee_code'];
        $team_member->type_id = $request['type_id'];
        $team_member->save();

        return Redirect::to('setting/approve');
    }

    public function index_users_approve_cancel(Request $request)
    {
        DB::table('users')
            ->where('username', $request['username'])
            ->update(['users_status' => "2",'note' => $request['note']]);

        $users_approved = new users_approved();
        $users_approved->username = $request['username'];
        $users_approved->users_status = '2';
        $users_approved->username_approved = Auth::user()->username;
        $users_approved->note = $request['note'];
        $users_approved->save();

        return Redirect::to('setting/approve');
    }

    public function index_project()
    {   
        $project_member = DB::table('project_member')
        ->select('project_member.id','project_member.code_project','project_member.code_team','project_member.code_team','project.name_project','team.name_team','project_member.status')
        ->leftJoin('project', 'project.code_project', '=', 'project_member.code_project')
        ->leftJoin('team', 'team.code_team', '=', 'project_member.code_team')
        ->where('project_member.code_team', Auth::user()->code_team_register)->get();

        $team = DB::table('team_member')
        ->select('team.code_team','team.name_team')
        ->leftJoin('team', 'team.code_team', '=','team_member.code_team')
        ->where('team_member.employee_code', Auth::user()->employee_code)->get();

        return view('setting.setting_project', compact('project_member','team'));
    }

    public function index_project_add(Request $request)
    {
        $code = Str::random();

        $project = new project();
        $project->code_project = $code;
        $project->name_project = $request['name_project'];
        $project->code_team = $request['code_team'];
        $project->status = '0';
        $project->save();

        $project_member = new project_member();
        $project_member->code_project = $code;
        $project_member->code_team = $request['code_team'];
        $project_member->employee_code = Auth::user()->employee_code;
        $project_member->status = '0';
        $project_member->save();

        $project_member_approved = new project_member_approved();
        $project_member_approved->code_project = $code;
        $project_member_approved->code_team = $request['code_team'];
        $project_member_approved->employee_code = Auth::user()->employee_code;
        $project_member_approved->status = '0';
        $project_member_approved->save();

        return Redirect::to('setting/project');
    }

    public function index_project_approve()
    {
        $project = DB::table('project')
        ->select('project.name_project','project.status','project.code_project','team.name_team')
        ->leftJoin('team', 'team.code_team', '=', 'project.code_team')->get();

        $project_member_wait = DB::table('project_member')
        ->select('project_member.id','project_member.code_project','project_member.code_team','project_member.code_team','project.name_project','team.name_team','project_member.status','employee.first_name','employee.last_name','employee.position','project_member.updated_at','project_member.employee_code')
        ->leftJoin('project', 'project.code_project', '=', 'project_member.code_project')
        ->leftJoin('team', 'team.code_team', '=', 'project_member.code_team')
        ->leftJoin('employee', 'employee.employee_code', '=', 'project_member.employee_code')
        ->where('project_member.status', '0')->get();

        $project_member_approve = DB::table('project_member')
        ->select('project_member.id','project_member.code_project','project_member.code_team','project_member.code_team','project.name_project','team.name_team','project_member.status','employee.first_name','employee.last_name','employee.position','project_member.updated_at','project_member.employee_code')
        ->leftJoin('project', 'project.code_project', '=', 'project_member.code_project')
        ->leftJoin('team', 'team.code_team', '=', 'project_member.code_team')
        ->leftJoin('employee', 'employee.employee_code', '=', 'project_member.employee_code')
        ->where('project_member.status', '1')->get();

        $project_member_not_approve = DB::table('project_member')
        ->select('project_member.id','project_member.code_project','project_member.code_team','project_member.code_team','project.name_project','team.name_team','project_member.status','employee.first_name','employee.last_name','employee.position','project_member.updated_at','project_member.employee_code')
        ->leftJoin('project', 'project.code_project', '=', 'project_member.code_project')
        ->leftJoin('team', 'team.code_team', '=', 'project_member.code_team')
        ->leftJoin('employee', 'employee.employee_code', '=', 'project_member.employee_code')
        ->where('project_member.status', '2')->get();

        $team = DB::table('team')->get();

        return view('setting.setting_project_approve', compact('project','project_member_wait','project_member_approve','project_member_not_approve','team'));
    }

    public function index_project_approve_accept(Request $request)
    {
        // return $request;
        DB::table('project')
            ->where('code_project', $request['code_project'])
            ->update(['status' => "1"]);

        DB::table('project_member')
            ->where('id', $request['id'])
            ->update(['status' => "1",'note' => NULL]);

        $project_member_approved = new project_member_approved();
        $project_member_approved->code_project = $request['code_project'];
        $project_member_approved->code_team = $request['code_team'];
        $project_member_approved->employee_code = $request['employee_code'];
        $project_member_approved->status = '1';
        $project_member_approved->save();

        return Redirect::to('setting/project_approve');
    }

    public function index_project_approve_cancel(Request $request)
    {
        DB::table('project')
            ->where('code_project', $request['code_project'])
            ->update(['status' => "2"]);

        DB::table('project_member')
            ->where('id', $request['id'])
            ->update(['status' => "2",'note' => $request['note']]);

        $project_member_approved = new project_member_approved();
        $project_member_approved->code_project = $request['code_project'];
        $project_member_approved->code_team = $request['code_team'];
        $project_member_approved->employee_code = $request['employee_code'];
        $project_member_approved->status = '2';
        $project_member_approved->note = $request['note'];
        $project_member_approved->save();

        return Redirect::to('setting/project_approve');
    }

    public function index_project_approve_add(Request $request)
    {
        $code = Str::random();

        $project = new project();
        $project->code_project = $code;
        $project->name_project = $request['name_project'];
        $project->code_team = $request['code_team'];
        $project->status = '1';
        $project->save();

        $project_member = new project_member();
        $project_member->code_project = $code;
        $project_member->code_team = $request['code_team'];
        $project_member->employee_code = Auth::user()->employee_code;
        $project_member->status = '1';
        $project_member->save();

        $project_member_approved = new project_member_approved();
        $project_member_approved->code_project = $code;
        $project_member_approved->code_team = $request['code_team'];
        $project_member_approved->employee_code = Auth::user()->employee_code;
        $project_member_approved->status = '1';
        $project_member_approved->save();

        return Redirect::to('setting/project_approve');
    }


    public function index_customer()
    {
        $customer = DB::table('customer')->where('status', '1')->get();

        $customer_users = DB::table('customer_users')
        ->select('customer.name_customer','customer_users.status','type_customers.type_customer_name')
        ->leftJoin('customer', 'customer.code_customer', '=', 'customer_users.customer_code')
        ->leftJoin('type_customers', 'type_customers.id', '=', 'customer.type_customer_id')
        ->where('employee_code', Auth::user()->employee_code)->get();

        $type_customers = DB::table('type_customers')->get();

        return view('setting.setting_customer', compact('customer','type_customers','customer_users'));
    }

    public function index_customer_approve()
    {
        $customer_users = DB::table('customer')
        ->select('customer.name_customer','customer.status','type_customers.type_customer_name')
        ->leftJoin('type_customers', 'type_customers.id', '=', 'customer.type_customer_id')->get();

        $customer_users_wait = DB::table('customer_users')
        ->select('customer.name_customer','customer_users.status','type_customers.type_customer_name','employee.first_name','employee.last_name','employee.position','customer.status AS customer_status','customer_users.id','customer_users.updated_at','customer.code_customer','customer_users.employee_code')
        ->leftJoin('customer', 'customer.code_customer', '=', 'customer_users.customer_code')
        ->leftJoin('type_customers', 'type_customers.id', '=', 'customer.type_customer_id')
        ->leftJoin('employee', 'employee.employee_code', '=', 'customer_users.employee_code')
        ->where('customer_users.status', '0')->get();

        $customer_users_approve = DB::table('customer_users')
        ->select('customer.name_customer','customer_users.status','type_customers.type_customer_name','employee.first_name','employee.last_name','employee.position','customer.status AS customer_status','customer_users.id','customer_users.updated_at','customer.code_customer','customer_users.employee_code')
        ->leftJoin('customer', 'customer.code_customer', '=', 'customer_users.customer_code')
        ->leftJoin('type_customers', 'type_customers.id', '=', 'customer.type_customer_id')
        ->leftJoin('employee', 'employee.employee_code', '=', 'customer_users.employee_code')
        ->where('customer_users.status', '1')->get();

        $customer_users_not_approve = DB::table('customer_users')
        ->select('customer.name_customer','customer_users.status','type_customers.type_customer_name','employee.first_name','employee.last_name','employee.position','customer.status AS customer_status','customer_users.id','customer_users.updated_at','customer.code_customer','customer_users.employee_code')
        ->leftJoin('customer', 'customer.code_customer', '=', 'customer_users.customer_code')
        ->leftJoin('type_customers', 'type_customers.id', '=', 'customer.type_customer_id')
        ->leftJoin('employee', 'employee.employee_code', '=', 'customer_users.employee_code')
        ->where('customer_users.status', '2')->get();

        $type_customers = DB::table('type_customers')->get();

        return view('setting.setting_customer_approve', compact('customer_users','customer_users_wait','customer_users_approve','customer_users_not_approve','type_customers'));
    }

    public function index_customer_approve_add(Request $request)
    {
        $code = Str::random();

        $customer = new customer();
        $customer->code_customer = $code;
        $customer->name_customer = $request['name_customer'];
        $customer->type_customer_id = $request['type_customer'];
        $customer->status = '1';
        $customer->save();

        return Redirect::to('setting/customer_approve');
    }

    public function index_customer_add(Request $request)
    {
        $code = Str::random();

        $customer = new customer();
        $customer->code_customer = $code;
        $customer->name_customer = $request['name_customer'];
        $customer->type_customer_id = $request['type_customer'];
        $customer->status = '1';
        $customer->save();

        $customer_users = new customer_users();
        $customer_users->customer_code = $code;
        $customer_users->employee_code = Auth::user()->employee_code;
        $customer_users->status = '1';
        $customer_users->save();

        $customer_users_approved = new customer_users_approved();
        $customer_users_approved->customer_code = $code;
        $customer_users_approved->employee_code = Auth::user()->employee_code;
        $customer_users_approved->status = '0';
        $customer_users_approved->save();

        $customer_users_approved = new customer_users_approved();
        $customer_users_approved->customer_code = $code;
        $customer_users_approved->employee_code = Auth::user()->employee_code;
        $customer_users_approved->status = '1';
        $customer_users_approved->save();

        return Redirect::to('setting/customer');
    }

    public function index_customer_select(Request $request)
    {
        $customer_users = new customer_users();
        $customer_users->customer_code = $request['name_customer'];
        $customer_users->employee_code = Auth::user()->employee_code;
        $customer_users->status = '1';
        $customer_users->save();

        $customer_users_approved = new customer_users_approved();
        $customer_users_approved->customer_code = $request['name_customer'];
        $customer_users_approved->employee_code = Auth::user()->employee_code;
        $customer_users_approved->status = '0';
        $customer_users_approved->save();

        $customer_users_approved = new customer_users_approved();
        $customer_users_approved->customer_code = $request['name_customer'];
        $customer_users_approved->employee_code = Auth::user()->employee_code;
        $customer_users_approved->status = '1';
        $customer_users_approved->save();

        return Redirect::to('setting/customer');
    }

    public function index_customer_approve_accept(Request $request)
    {
        DB::table('customer')
            ->where('code_customer', $request['code_customer'])
            ->update(['status' => "1"]);

        DB::table('customer_users')
            ->where('id', $request['id'])
            ->update(['status' => "1",'note' => NULL]);

        $customer_users_approved = new customer_users_approved();
        $customer_users_approved->customer_code = $request['code_customer'];
        $customer_users_approved->employee_code = $request['employee_code'];
        $customer_users_approved->status = '1';

        
        $customer_users_approved->save();

        return Redirect::to('setting/customer_approve');
    }

    public function index_customer_approve_cancel(Request $request)
    {
        DB::table('customer')
            ->where('code_customer', $request['code_customer'])
            ->update(['status' => "2"]);

        DB::table('customer_users')
            ->where('id', $request['id'])
            ->update(['status' => "2",'note' => $request['note']]);

        $customer_users_approved = new customer_users_approved();
        $customer_users_approved->customer_code = $request['code_customer'];
        $customer_users_approved->employee_code = $request['employee_code'];
        $customer_users_approved->status = '2';
        $customer_users_approved->note = $request['note'];
        $customer_users_approved->save();

        return Redirect::to('setting/customer_approve');
    }

    public function index_subject()
    {
        $subject = DB::table('subject')->get();
        return view('setting.setting_subject', compact('subject'));
    }

    public function index_subject_add(Request $request)
    {
        $subject = new subject();
        $subject->code_subject = Str::random();
        $subject->name_subject = $request['name_subject'];
        $subject->color_code = $request['color_code'];
        $subject->save();

        return Redirect::to('setting/subject');
    }

    public function index_subject_edit(Request $request,$id)
    {
        $subject = subject::find($id);
        $subject->name_subject = $request['name_subject'];
        $subject->color_code = $request['color_code'];
        $subject->save();

        return Redirect::to('setting/subject');
    }

    public function index_subject_delete(Request $request,$id)
    {
        $subject = subject::find($id);
        $subject->delete();

        return Redirect::to('setting/subject');
    }

    public function index_profile_edit_save(Request $request)
    {
        $employee = employee::find($request['id_employee']);
        $employee->first_name = $request['first_name'];
        $employee->last_name = $request['last_name'];
        $employee->nick_name = $request['nick_name'];
        $employee->position = $request['position'];
        $employee->tel = $request['tel'];
        $employee->line = $request['line'];
        $employee->etc = $request['etc'];
        $employee->description = $request['description'];
        $employee->save();

        $users = users::find($request['id_users']);
        $users->email = $request['email'];
        $users->save();

        return Redirect::to('profile/');
    }

    public function index_profile_edit_password(Request $request)
    {
        $validate = \Validator::make($request->all(), [
            'old_password'          => 'required',
            'password'              => 'required|min:4',
            'password_confirmation' => 'required|same:password'
        ], [
            'old_password.required'                 =>  'รหัสผ่านเก่าต้องไม่ว่าง',
            'password.required'                     =>  'รหัสผ่านใหม่ต้องไม่ว่าง',
            'password_confirmation.required'        =>  'ยืนยันรหัสผ่านใหม่ต้องไม่ว่าง',
            'password.min'                          =>  'รหัสผ่านใหม่ต้องไม่น้อยกว่า 4 ตัว',
            'password_confirmation.same'            =>  'รหัสผ่านใหม่ต้องตรงกับยืนยันรหัสผ่าน',
        ]);

        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate->errors())->withInput($request->all());
        }

        $data_users = new users();
        $data_users = users::find(Auth::user()->id);

        if (Hash::check($request->old_password, $data_users->password)) {
            $data_users->password = bcrypt($request->password);
            $data_users->save();
            return redirect('/profile');
           }

        return redirect()->back()->withErrors("รหัสผ่านไม่ถูกต้อง");
    }

    public function index_profile_edit_avatar(Request $request)
    {
        $filename = "";
        $filename2 = "";

        $users_old = users::where('employee_code', Auth::user()->employee_code)->first();

        if ($request->hasFile('profile_pic')){
            $filename = Carbon::now()->toDateString() .'_' . Str::random() . '.' . $request->file('profile_pic')->getClientOriginalExtension();
            $request->file('profile_pic')->move('assets/profile', $filename);
         }
        else{
            $filename = $users_old->profile_pic;
        }

        if ($request->hasFile('title_pic')){
            $filename2 = Carbon::now()->toDateString() .'_' . Str::random() . '.' . $request->file('title_pic')->getClientOriginalExtension();
            $request->file('title_pic')->move('assets/profile', $filename2);
         }
        else{
            $filename2 = $users_old->title_pic;
        }

        $users = users::find($request['id_users']);
        $users->profile_pic = $filename;
        $users->title_pic = $filename2;
        $users->save();

        return Redirect::to('profile/');
    }

    public function index_profile_edit()
    {
        $employee = employee::where('employee_code', Auth::user()->employee_code)->get();
        $users = users::where('employee_code', Auth::user()->employee_code)->get();

        return view('profile_edit', compact('employee','users'));
    }

    public function index_profile()
    {
        $employee = employee::where('employee.employee_code', Auth::user()->employee_code)
                    ->leftJoin('users', 'users.employee_code', '=', 'employee.employee_code')
                    ->get();
        $users = users::where('employee_code', Auth::user()->employee_code)->get();

        $employee_all = DB::table('employee')->get();
        $users_all = DB::table('users')->get();

        $events_today = events::where('employee_code', '=', Auth::user()->employee_code)->where('start_date', 'LIKE', date("Y-m-d") . '%')->get();
        $events_con = events::where('employee_code', '=', Auth::user()->employee_code)->whereDate('events.start_date', '>=', date("Y-m-d"))->orderBy('events.start_date')->get();

        $team_member_code = team_member::where('employee_code', Auth::user()->employee_code)->first();

        $team_member = team_member::where('code_team', $team_member_code->code_team)
        ->leftJoin('employee', 'employee.employee_code', '=', 'team_member.employee_code')
        ->leftJoin('users', 'users.employee_code', '=', 'team_member.employee_code')
        ->get();

        $customer_users = customer_users::where('employee_code', '=', Auth::user()->employee_code)
        ->leftJoin('customer', 'customer.code_customer', '=', 'customer_users.customer_code')
        ->leftJoin('type_customers', 'customer.type_customer_id', '=', 'type_customers.id')
        ->get();

        return view('profile', compact('employee','employee_all','users_all','users','events_today','events_con','team_member','customer_users'));
    }

    public function index_profile_detail($id)
    {
        $employee = employee::where('employee.employee_code', $id)
                    ->leftJoin('users', 'users.employee_code', '=', 'employee.employee_code')
                    ->get();
        $users = users::where('employee_code', $id)->get();

        $employee_all = DB::table('employee')->get();
        $users_all = DB::table('users')->get();

        $events_today = events::where('employee_code', '=', $id)->where('start_date', 'LIKE', date("Y-m-d") . '%')->get();
        $events_con = events::where('employee_code', '=', $id)->whereDate('events.start_date', '>=', date("Y-m-d"))->orderBy('events.start_date')->get();

        $team_member_code = team_member::where('employee_code', $id)->first();

        $team_member = team_member::where('code_team', $team_member_code->code_team)
        ->leftJoin('employee', 'employee.employee_code', '=', 'team_member.employee_code')
        ->leftJoin('users', 'users.employee_code', '=', 'team_member.employee_code')
        ->get();

        $customer_users = customer_users::where('employee_code', '=', $id)
        ->leftJoin('customer', 'customer.code_customer', '=', 'customer_users.customer_code')
        ->leftJoin('type_customers', 'customer.type_customer_id', '=', 'type_customers.id')
        ->get();

        return view('profile_detail', compact('employee','employee_all','users_all','users','events_today','events_con','team_member','customer_users'));
    }

    public function index_register_wait(Request $request)
    {
        // $position = type_users::where('id',$request['position'])->first();
        $position = type_users::where('id','2')->first();

        DB::table('employee')
            ->where('employee.username', $request['name'])
            ->orWhere('employee.employee_code', $request['employee_code'])
            ->update(['username' => $request['name'],'employee_code' => $request['employee_code'],'first_name' => $request['name'],'last_name' => $request['surname'],'position' => $position['name_type_users']]);

        $users = users::find($request['users_id']);
        $users->username = $request['name'].'   '.$request['surname'];
        $users->employee_code = $request['employee_code'];
        $users->email = $request['email'];
        $users->type_id = '2';
        $users->code_team_register = $request['code_team'];
        $users->users_status = 0;
        $users->save();

        $users_approved = new users_approved();
        $users_approved->username = $request['name'].'   '.$request['surname'];
        $users_approved->users_status = 0;
        $users_approved->save();

        return Redirect::to('/');
    }
}
