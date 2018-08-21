<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\JobSkill as JobSkill;
use Session;

class JobController extends Controller
{
    public function search(Request $request) {
        
        $skill = $request->input('skills');
        $jobSkills = JobSkill::where('skill', $skill)->get();
        echo '<pre>';
        echo 'COUNT: ' . count($jobSkills) . '<br>';
        foreach($jobSkills as $skill) {
            print_r($skill->job->get());
        }
        echo '</pre>';
        
        exit;
    }
}
