<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use Auth;

class week extends Model
{
    protected $table = 'week';

    public static function week_add($code_week, $date_start, $date_end, $date_request, $employee_code, $employee_code_created)
    {
        DB::insert("INSERT INTO week (code_week,date_start,date_end,date_request,employee_code,employee_code_created,created_at,updated_at)
                            VALUES
                            (?,?,?,?,?,?,NOW(),NOW())"
                            ,[$code_week, $date_start, $date_end, $date_request, $employee_code, $employee_code_created]);
    }

    public static function delete_by_id($id)
    {
        DB::delete("DELETE FROM week WHERE code_week = '$id'", []);
    }
}
