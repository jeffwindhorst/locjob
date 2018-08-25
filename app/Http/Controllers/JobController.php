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
        
        $skills[] = $request->input('skills');
        $jobsByCity = DB::select(DB::raw("SELECT cities.name, cities.state, cities.growth_from_2000_to_2013, cities.latitude, cities.longitude, SUM(jobs.id) as job_total "
                . "FROM `cities` "
                . "JOIN jobs ON cities.id = jobs.city_id "
                . "JOIN job_skills ON jobs.id = job_skills.job_id "
                . "GROUP BY jobs.id "));    

        echo '<pre>';
        print_r($jobsByCity);
        echo '</pre>';
        exit;
        $cities = City::with('skill', function($q) use($jobId) {
            $q->where('id', $jobId);
        })->get();
       
        
        foreach($jobs as $job)
        {
            echo '<Pre>';
            $cities = $job->job->city->get();
            print_r($job->job->city->count());
//            print_r($cities);
            foreach($cities as $city) {
                echo $city->name . ', ' .$city->state . ', ' . $city->population . ', ' . $city->longitude . ', ' . $city->latitude . '<br>';
                exit;
            }
            echo '</pre>';
            exit;
        }
        
        return view('search_results', ['skills' => $skills, 'jobs' => $jobs]);
    }
}
