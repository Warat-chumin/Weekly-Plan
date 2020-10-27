<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use Auth;

class work_detail extends Model
{
    protected $table = 'work_detail';

    public static function work_detail_add($code_week, $date, $month, $topic, $address, $contact_person, $code_customer, $note, $time_period ,$employee_code ,$employee_code_created)
    {
        DB::insert("INSERT INTO work_detail (code_week,date,month,topic,address,contact_person,code_customer,note,time_period,employee_code,employee_code_created,created_at,updated_at)
                            VALUES
                            (?,?,?,?,?,?,?,?,?,?,?,NOW(),NOW())"
                            ,[$code_week, $date, $month, $topic, $address, $contact_person, $code_customer, $note, $time_period, $employee_code ,$employee_code_created]);
    }

    public static function delete_by_id($id)
    {
        DB::delete("DELETE FROM work_detail WHERE code_week = '$id'", []);
    }
}
