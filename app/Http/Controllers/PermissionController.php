<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Session;

class PermissionController extends Controller
{
    public function __construct() {
        $this->middleware(['auth', 'isAdmin']);
    }
    
    public function index() {
        $permissions = Permission::all();
        
        return view('admin.permission.index')->with('permissions', $permissions);
    }
    
    public function create() {
        $roles = Role::get();
        
        return view('admin.permission.create')->with('roles', $roles);
    }
    
    public function store(Request $request) {
        $this->validate($request, [
            'name' => 'required|max:40',
        ]);
        
        $name = $request['name'];
        $permission = new Permission();
        $permission->name = $name;
        
        $roles = $request['roles'];
        $permission->save();
        
        if(!empty($request['roles'])) {
            foreach($roles as $role) {
                $r = Role::where('id', '=', $role)->firstOrFail();
                
                $permission = Permission::where('name', '=', $name)->first();
                $r->givePermissionTo($permission);
            }
        }
        return redirect()->route('admin.permission.index')
                ->with('flash_message',
                    'Permission '. $permission->name.' added!');
    }
    
    public function show($id) {
        return redirect('admin.permission');
    }
    
    public function edit($id) {
        $permission = Permission::findOrFail($id);
        
        return view('admin.permission.edit', compact('permission'));
    }
    
    public function update(Request $request, $id) {
        $permission = Permission::findOrFail($id);
        $this->validate($request, [
            'name' => 'required|max:40',
        ]);
        $input = $request->all();
        $permission->fill($input)->save();
        
        return redirect()->route('admin.permission.index')
                ->with('flash_message',
                        'Permission '.$permission->name. ' updated!');
    }
    
    public function destroy($id) {
        $permission = Permission::findOrFail($id);
        
        if($permission->name == 'Administer roles & permissions') {
            return redirect()->route('admin.permission.index')
                    ->with('flash_message',
                            'Cannot delete this Permission.');
        }
        $permission->delete();
        
        return redirect()->route('permission.index')
                ->with('flash_message',
                        'Permission deleted!');
    }
}
