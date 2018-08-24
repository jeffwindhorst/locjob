<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\JobSkill as JobSkill;
use Session;

class JobController extends Controller
{
    public function search(Request $request) {
        
        $skills[] = $request->input('skills');
        $jobs = JobSkill::where('skill', $skills)->get();
        
        foreach($jobs as $job)
        {
//            echo '<Pre>';
//            print_r($job->job->city->get());
//            echo '</pre>';
//            exit;
        }
        
        return view('search_results', ['skills' => $skills, 'jobs' => $jobs]);
    }
}
