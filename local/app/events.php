<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use Auth;

class events extends Model
{
    protected $table = 'events';

    public static function delete_by_id($id)
    {
        DB::delete("DELETE FROM events WHERE id = '$id'", []);
    }
}
