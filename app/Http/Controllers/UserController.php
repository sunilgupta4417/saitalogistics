<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\RoleManger;
use Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    public function manageUser(Request $request)
    {
        $role = RoleManger::get()->pluck('name', 'id')->toArray();
        $user_id = $request->query('id', 0);
        $user = null;
        if ($user_id != 0) {
            $user = User::select('id', 'name', 'mobile_no', 'email', 'doj', 'role_id', 'status')->where('id', $user_id)->first();
        }
        $users = User::select('id', 'name', 'mobile_no', 'email', 'doj', 'status', 'role_id')->where('role_id', '!=', 0)->get();
        $userstatus = 1;
        return view('user.manage_user', compact('users', 'user', 'role', 'userstatus'));
    }
    public function manageFrontEndUser(Request $request)
    {
        $role = RoleManger::get()->pluck('name', 'id')->toArray();
        $user_id = $request->query('id', 0);
        $user = null;
        if ($user_id != 0) {
            $user = User::select('id', 'name', 'mobile_no', 'email', 'doj', 'role_id', 'status')->where('id', $user_id)->first();
        }
        $users = User::select('id', 'name', 'mobile_no', 'email', 'doj', 'status', 'role_id')->where('role_id', 0)->get();
        $userstatus = 0;
        return view('user.manage_user', compact('users', 'user', 'role', 'userstatus'));
    }

    public function manageFilterUser(Request $request)
    {
        $role = RoleManger::get()->pluck('name', 'id')->toArray();
        $user_id = $request->query('id', 0);
        $user = null;
        if ($user_id != 0) {
            $user = User::select('id', 'name', 'mobile_no', 'email', 'doj', 'role_id', 'status')->where('id', $user_id)->first();
        }
        $users = User::select('id', 'name', 'mobile_no', 'email', 'doj', 'status', 'role_id');
        if ($request->filter_role == 0) {
            $users = $users->where('role_id', 0);
        } else {
            $users = $users->where('role_id', '!=', 0);
        }
        if(isset($request->filter_status)  && $request->filter_status!= ''){
            if($request->filter_status == 1){
                $condition  = '=';
            }else{
                $condition  = 'LIKE';
            }
        }
        if(isset($request->filter_name)  && $request->filter_name!= ''){
            $users = $users->where($request->filter_name, $condition, $request->search);
        }
        $users = $users->get();
        $userstatus = $request->filter_role;
        return view('user.manage_user', compact('users', 'user', 'role', 'userstatus'));
    }
    public function userMasterSave(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'mobile_no' => 'required:min:10',
            'password' => 'required',
            'role_id' => 'required',
            'doj' => 'required',
            'email' => 'required|email|unique:users',
        ]);

        $user = new User;
        $user->name = isset($request->name) ? $request->name : NULL;
        $user->role_id = isset($request->role_id) ? $request->role_id : NULL;
        $user->email  = isset($request->email) ? $request->email : NULL;
        $user->mobile_no = isset($request->mobile_no) ? $request->mobile_no : NULL;
        $user->doj = isset($request->doj) ? $request->doj : NULL;
        $user->password = isset($request->password) ? Hash::make($request->password) : NULL;
        $user->status = isset($request->status) ? $request->status : 0;
        $result = $user->save();
        if ($result) {
            $user->user_code = sprintf("%05d", $user->id);
            $user->save();
            return redirect()->back()->with('success', 'User created successfully!');
        } else {
            return redirect()->back()->with('error', 'Something went wrong please try again!');
        }
    }
    public function userMasterUpdate(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'mobile_no' => 'required:min:10',
            'role_id' => 'required',
            'doj' => 'required',
        ]);

        $user = User::find($request->id);
        $user->name = isset($request->name) ? $request->name : NULL;
        $user->role_id = isset($request->role_id) ? $request->role_id : NULL;
        $user->mobile_no = isset($request->mobile_no) ? $request->mobile_no : NULL;
        $user->doj = isset($request->doj) ? $request->doj : NULL;
        if (isset($request->password)) {
            $user->password = isset($request->password) ? Hash::make($request->password) : NULL;
        }
        $user->status = isset($request->status) ? $request->status : 0;
        $result = $user->save();
        if ($result) {
            return redirect()->back()->with('success', 'User updated successfully!');
        } else {
            return redirect()->back()->with('error', 'Something went wrong please try again!');
        }
    }
    public function userMasterDelete($id)
    {
        $result = User::where('id', $id)->delete();
        if ($result) {
            return redirect()->back()->with('success', 'User deleted successfully!');
        } else {
            return redirect()->back()->with('error', 'Something went wrong please try again!');
        }
    }
    public function changePassword(Request $request)
    {
        return view('user.change_password');
    }

    public function changePasswordSave(Request $request)
    {
        $request->validate([
            'new_password' => [
                'required',
                // 'confirmed',
                Password::min(6)

                    ->mixedCase()
                    ->letters()
                    ->numbers()
                    ->symbols()
                    ->uncompromised(),
            ],
            'conf_password' => 'required|same:new_password',
            'old_password' => 'required',
        ]);
        $user = Auth::user();
        if (!\Hash::check($request->old_password, $user->password)) {
            return redirect()->back()->with('error', 'Your current password does not matches with the password you provided. Please try again.');
        }
        $new_password = isset($request->new_password) ? Hash::make($request->new_password) : NULL;
        $user->password = $new_password;
        $user->save();
        return redirect()->back()->with("success", "Password changed successfully !");
    }

    public function paymentHistory(Request $request)
    {
        return view('user.payment_history');
    }

    public function userProfile(Request $request)
    {
        $user = Auth::user();
        return view('user.user_profile', compact('user'));
    }
    public function userProfileUpdate(Request $request)
    {
        $user = Auth::user();
        $id = $user->id;
        $updateData =  [
            'address' => isset($request->address) ? $request->address : NULL,
        ];
        if ($file = $request->hasFile('profile_pic')) {
            $destinationPath = 'logistics/user/';
            $profile_pic = public_path($destinationPath . $user->profile_pic);
            if (file_exists($profile_pic)) {
                @unlink($profile_pic);
            }
            // $myimage = $request->profile_pic->getClientOriginalName();
            $image_name = 'user_' . time() . '.';
            $myimage = $image_name . $request->profile_pic->getClientOriginalExtension();
            $request->profile_pic->move(public_path($destinationPath), $myimage);
            $updateData['profile_pic'] = $myimage;
        }
        $result = User::where('id', $id)->update($updateData);
        if ($result) {
            return redirect()->back()->with('success', 'Profile updated successfully!');
        } else {
            return redirect()->back()->with('error', 'Something went wrong please try again!');
        }
    }

    public function userPermission($id)
    {
        $detail = user::select('*')->where('id', $id)->first();

        $permission = \DB::table('user_permission')->where('user_id', $detail->id)->get();
        if (count($permission) == 0) {
            $permission = \DB::table('role_permission')->where('role_id', $detail->role_id)->get();
        }

        $permissionData = [];
        if (count($permission) > 0) {
            foreach ($permission as $newData) {
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

        return view('user.user_permission', compact('detail', 'permissionData'));
    }

    public function saveUserPermission(Request $request)
    {
        $module = $request->module;

        if (count($module) > 0) {
            foreach ($module as $moduleName) {
                \DB::table('user_permission')->updateOrInsert(
                    ['user_id' => $moduleName['user_id'], 'module_route' => $moduleName['name']],
                    [
                        'view_permission' => isset($moduleName['view']) ? $moduleName['view'] : 1,
                        'add_permission' => isset($moduleName['add']) ? $moduleName['add'] : 1,
                        'edit_permission' => isset($moduleName['edit']) ? $moduleName['edit'] : 1,
                        'search_permission' => isset($moduleName['search']) ? $moduleName['search'] : 1,
                        'import_permission' => isset($moduleName['import']) ? $moduleName['import'] : 1,
                        'delete_permission' => isset($moduleName['delete']) ? $moduleName['delete'] : 1,
                        'created_at' => date("Y-m-d h:i:s"),
                        'updated_at' => date("Y-m-d h:i:s"),
                    ]
                );
            }
        }
        return redirect()->back();
    }

    public function ExportUsers($userstatus)
    {
        if ($userstatus == 0) {
            $users = User::where('role_id', 0)->get();
        } else {
            $users = User::where('role_id', '!=', 0)->get();
        }
        // dd($index);

        $headers = array(
            'Content-Type' => 'text/csv'
        );
        if (!\File::exists(public_path() . "/files")) {
            \File::makeDirectory(public_path() . "/files");
        }
        $filename =  public_path("files/download.csv");
        $handle = fopen($filename, 'w');
        fputcsv($handle, [
            "Name",
            "Email",
            "Phone Code",
            "Mobile Number",
            "DOJ",
        ]);
        foreach ($users as $value) {
            fputcsv($handle, [
                $value->name,
                $value->email,
                $value->phn_code,
                $value->mobile_no,
                $value->doj,
            ]);
        }
        fclose($handle);
        return \Response::download($filename, "download.csv", $headers);
    }
}
