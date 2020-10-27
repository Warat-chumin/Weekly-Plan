<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\events;
use App\team_member;
use App\employee;
use Auth;
use View;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::withoutDoubleEncoding();
        Schema::defaultStringLength(191); //

        view()->composer('*', function ($view)
        {
            if(\Auth::check()){
                $events_view = events::where('employee_code', '=', Auth::user()->employee_code)->where('start_date', 'LIKE', date("Y-m-d") . '%')->get();
                $events_count = events::where('employee_code', '=', Auth::user()->employee_code)->where('start_date', 'LIKE', date("Y-m-d") . '%')->count();

                $events_employee = employee::where('employee_code', '=', Auth::user()->employee_code)->get();

                if(Auth::user()->type_id == 1){
                    $events_check_team = 1;
                }
                else{
                    $team = team_member::where('employee_code', Auth::user()->employee_code)->where('type_id', '1')->get();
                    if(!$team->isempty()){
                        $events_check_team = 1;
                    }
                    else{
                        $events_check_team = 0;
                    }
                }
                $view->with('events_count', $events_count )->with('events_view', $events_view )->with('events_check_team', $events_check_team )->with('events_employee', $events_employee );
            }
        });
    }
}
