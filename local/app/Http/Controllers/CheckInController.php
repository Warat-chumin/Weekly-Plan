<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\users;
use App\employee;
use App\checkin;
use Carbon\Carbon;
use Geocoder;
use Auth;
use DB;


class CheckInController extends Controller
{
    function index() {
        $checkin = checkin::where('employee_code', Auth::user()->employee_code)->orderBy('id', 'desc')->get();
        return view('checkin',compact('checkin'));
    }

    function index_history() {

        $employee = DB::table('employee')
                    ->select('employee.first_name','employee.last_name','employee.position','employee.employee_code','users.profile_pic')
                    ->leftJoin('users', 'users.employee_code', '=', 'employee.employee_code')
                    ->get();

        $checkin = DB::select("SELECT
                        checkin.id,
                        checkin.employee_code,
                        checkin.`status`,
                        checkin.`timestamp`,
                        checkin.latitude,
                        checkin.longitude,
                        checkin.address,
                        checkin.created_at,
                        checkin.updated_at
                        FROM
                        checkin
                        WHERE
                        DATE(checkin.`timestamp`) = ?
                        ORDER BY
                        checkin.id ASC
                    ", [date("Y-m-d")]);

        return view('checkin_history',compact('employee', 'checkin'));
    }

    function add_in(Request $request) {
        if( ($request->latitude != null && !empty($request->latitude)) && ($request->longitude != null && !empty($request->longitude)) ) {
            $address = Geocoder::getAddressForCoordinates($request->latitude, $request->longitude);
        } else {
            $address['formatted_address'] = null;
        }
        $checkin = new checkin;
        $checkin->employee_code = Auth::user()->employee_code;
        $checkin->status = $request->check;
        $checkin->timestamp = date('Y-m-d H:i:s');
        $checkin->latitude = $request->latitude;
        $checkin->longitude = $request->longitude;
        $checkin->address = $address['formatted_address'];
        $checkin->save();

        return Redirect::to('/check_in');
    }

    function add_out(Request $request) {

        if( ($request->latitude != null && !empty($request->latitude)) && ($request->longitude != null && !empty($request->longitude)) ) {
            $address = Geocoder::getAddressForCoordinates($request->latitude, $request->longitude);
        } else {
            $address['formatted_address'] = null;
        }
        $checkin = new checkin;
        $checkin->employee_code = Auth::user()->employee_code;
        $checkin->status = $request->check;
        $checkin->timestamp = date('Y-m-d H:i:s');
        $checkin->latitude = $request->latitude;
        $checkin->longitude = $request->longitude;
        $checkin->address = $address['formatted_address'];
        $checkin->save();

        return Redirect::to('/check_in');
    }

}
