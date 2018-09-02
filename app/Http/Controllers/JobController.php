<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\JobSkill as JobSkill;
use App\City;
use Session;

class JobController extends Controller
{
    public function search(Request $request) {

        
        $skills = $request->input('skills');
        $jobsByCity = DB::select(DB::raw("SELECT "
                . "cities.id as cityId, "
                . "cities.name, "
                . "cities.state, "
                . "cities.growth_from_2000_to_2013 AS growth, "
                . "FORMAT(population,0) AS population, "
                . "cities.latitude, "
                . "cities.longitude, "
                . "SUM(jobs.id) as job_total "
                . "FROM `cities` "
                . "JOIN jobs ON cities.id = jobs.city_id "
                . "JOIN job_skills ON jobs.id = job_skills.job_id "
                . "WHERE job_skills.skill = '" .$skills . "' "
                . "GROUP BY jobs.id "));    

        return view('search_results', ['skills' => $skills, 'jcities' => $jobsByCity]);
    }
}
