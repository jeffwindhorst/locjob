<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\City;
use Auth;
use Session;

class CityController extends Controller
{
    
    public function __construct()
    {
         $this->middleware(['auth', 'clearance'])->except('index', 'show');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cities = City::orderby('id', 'name')->paginate(25); //show only 5 items at a time in descending order
        $returnVars = compact('cities');
        $returnVars['totalCities'] = City::count();
        
        return view('admin.city.index', $returnVars);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('city.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title'=>'required|max:100',
            'body' =>'required',
            ]);

        $title = $request['title'];
        $body = $request['body'];

        $city = City::create($request->only('title', 'body'));

    //Display a successful message upon save
        return redirect()->route('city.index')
            ->with('flash_message', 'City,
             '. $city->name.' created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $city = City::findOrFail($id);
        
        return view ('admin.city.show', compact('city'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $city = City::findOrFail($id);
        
        return view('cities.edit', compact('city'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'population' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'state' => 'required',
        ]);
        
        $city = City:: findOrFail($id);
        $city->name = $request->input('name');
        $city->population = $request->input('population');
        $city->latitude = $request->input('latitude');
        $city->longitude = $request->input('longitude');
        $city->state = $request->input('state');
        $city->save();
        
        return redirect()->route('cities.show',
                $city->id)->with('flash_message',
                'City, '. $city->name. ' updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $city = City::findOrFail($id);
        $cityName = $city->name;
        $city->delete();
        
        return redirect()->route('city.index')
                ->with('flash_message',
                        $cityName . ' successfully deleted.');
    }
}
