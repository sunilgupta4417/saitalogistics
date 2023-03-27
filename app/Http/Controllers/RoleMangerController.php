<?php

namespace App\Http\Controllers;

use App\Models\RoleManger;
use Illuminate\Http\Request;

class RoleMangerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = RoleManger::get();
        return view('role.index',compact('data'));
    }

    
    public function store(Request $request)
    {
        $data = [
            'name'=> isset($request->name) ? $request->name : NULL,
        ];

        if($request->id > 0){
            $result = RoleManger::where('id',$request->id)->update($data);
            $msg = 'Recorded updated successfully!';
        }else{
            $result = RoleManger::create($data);
            $msg = 'Recorded added successfully!';
        }
        
        if($result){
            return redirect()->back()->with('success',$msg);
        }else{
            return redirect()->back()->with('error','Something went wrong please try again!');
        }
    }

    public function delete($id)
    {
        RoleManger::where('id',$id)->delete();
        $msg = 'Recorded deleted successfully!';
        return redirect('role-manager')->with('success',$msg);
    }

    public function rolePermission($id){
        $detail =  RoleManger::where('id',$id)->first();
        $permission = \DB::table('role_permission')->where('role_id',$id)->get();

        $permissionData = [];
        if(count($permission) > 0){
            foreach($permission as $newData){
                $permissionData[$newData->module_route] = [
                    'view' => $newData->view_permission,
                    'add' => $newData->add_permission,
                    'edit' => $newData->edit_permission,
                    'search' => $newData->search_permission,
                    'import' => $newData->import_permission,
                    'delete' => $newData->delete_permission,
                ];    
            }
        }
        return view('role.role_permission',compact('detail','permissionData'));
    }

    public function saveRolePermission(Request $request){
        $module = $request->module;
        
        if(count($module) > 0){
            foreach($module as $moduleName){
                \DB::table('role_permission')->updateOrInsert(
                    ['role_id' => $moduleName['user_id'], 'module_route' => $moduleName['name']],
                    [
                        'view_permission' => isset($moduleName['view'])?$moduleName['view']:1,
                        'add_permission' => isset($moduleName['add'])?$moduleName['add']:1,
                        'edit_permission' => isset($moduleName['edit'])?$moduleName['edit']:1,
                        'search_permission' => isset($moduleName['search'])?$moduleName['search']:1,
                        'import_permission' => isset($moduleName['import'])?$moduleName['import']:1,
                        'delete_permission' => isset($moduleName['delete'])?$moduleName['delete']:1,
                        'created_at' => date("Y-m-d h:i:s"),
                        'updated_at' => date("Y-m-d h:i:s"),
                    ]
                );
            }
        }
        return redirect()->back();
    }
}
