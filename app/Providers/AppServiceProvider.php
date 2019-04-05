<?php

namespace GoFunCrm\Providers;

use GoFunCrm\SetDateFlag;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

//    	$set_date_flag = SetDateFlag::first();
//
//        $overdue_visitations = DB::select("
//            SELECT DATEDIFF(CURRENT_DATE ,v.date_visited ) AS date_visited , sites.name AS site_name , sites.id AS site_id
//			FROM visitations v
//			INNER JOIN sites
//			ON sites.id = v.site_id
//			WHERE v.date_visited =
//			(SELECT MAX(visitations.date_visited) FROM visitations WHERE v.site_id = visitations.site_id )
//			AND DATEDIFF(CURRENT_DATE ,v.date_visited )  > $set_date_flag->date_flag
//			LIMIT 15
//        ");
//
//	    $overdue_count = DB::select("
//	                    SELECT COUNT(v.id) AS overdue_count
//						FROM visitations v
//						INNER JOIN sites
//						ON sites.id = v.site_id
//						WHERE v.date_visited =
//						(SELECT MAX(visitations.date_visited) FROM visitations WHERE v.site_id = visitations.site_id )
//						AND DATEDIFF(CURRENT_DATE ,v.date_visited )  > $set_date_flag->date_flag
//	    ");
//
//        View::share('overdue_visitations' , $overdue_visitations);
//        View::share('overdue_count' , $overdue_count);

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
