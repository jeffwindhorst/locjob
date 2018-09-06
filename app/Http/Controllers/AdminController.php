<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the admin dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $totalUsers = \App\User::count();
        $totalCities = \App\City::count();
        $totalJobs = \App\Job::count();
        $totalRoles = \App\Role::count();
        
        return view('admin/dashboard', ['totalUsers' => $totalUsers, 'totalCities' => $totalCities, 'totalJobs' => $totalJobs, 'totalRoles' => $totalRoles]);
    }
}
