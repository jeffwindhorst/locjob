<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Session;

class RoleController extends Controller
{
    public function __construct() {
        $this->middleware(['auth', 'isAdmin']);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::all();
        
        return view('admin.role.index')->with('roles', $roles);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = Permission::all();
        
        return view('admin.role.create', ['permissions' => $permissions]);
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
            'name' => 'required|unique:roles|max:10',
            'permissions' => 'required',
        ]);
        
        $name = $request['name'];
        $role = new Role();
        $role->name = $name;
        
        $permissions = $request['permissions'];
        $role->save();
        
        echo '<pre>';
        print_r($permissions);
        echo '</pre>';
        exit;
        foreach($permissions as $permission) {
            $p = $permission::where('id', '=', $permission)->firstOrSail();
            $role = Role::where('name', '=', $name)->first();
            $role->givePermissionTo($p);
        }
        
        return redirect()->route('admin.role.index')
                ->with('flash_message',
                        'Role '. $role->name. ' added.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return redirect('roles');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = Role::findOrFail($id);
        $permissions = Permission::all();
        
        return view('admin.role.edit', compact('role', 'permissins'));
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
        $role = Role::findOrFail($id);
        
        $this->validate($request, [
            'name' => 'required|max:10|unique:roles,name,'.$id,
            'permissions' => 'required',
        ]);
        
        $input = $request->except(['permissions']);
        $permissions = $request['permissions'];
        $role->fill($input)->save();
        
        $p_all = Permission::all();
        
        foreach($p_all as $p) {
            $p = Permission::where('id', '=', $permission)->firstOrFail();
            $role->givePermissionTo($p);
        }
        
        return redirect()->route('admin.role.index')
                ->with('flash_message',
                        'Role '. $role->name. ' updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        $role->delete();
        
        return redirect()->route('admin.role.index')
                ->with('flash_message',
                        'Role deleted!');
    }
}
