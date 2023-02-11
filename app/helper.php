<?php

if(!function_exists('mainMenu')) {
    function mainMenu(){
        $permission = \DB::table('user_permission')->select('module_route')->where('view_permission',0)->where('user_id',Auth::user()->id)->get();
        if(count($permission)==0){
            $permission = \DB::table('role_permission')->select('module_route')->where('role_id',Auth::user()->role_id)->where('view_permission',0)->get();
        }
        return $permission->pluck('module_route')->toArray();
    }
}

if(!function_exists('checkAccess')) {
    function checkAccess($module,$accessPermission){
        $access = false;
        $permission = \DB::table('user_permission')->select('id')->where('module_route',$module)->where('user_id',Auth::user()->id)->first();
        if(!isset($permission->id)){
            $permission = \DB::table('role_permission')->select('id')->where('module_route',$module)->where($accessPermission,0)->where('role_id',Auth::user()->role_id)->first();
            if(isset($permission->id)){
                $access = true;
            }
        }else{
            $permission = \DB::table('user_permission')->select('id')->where($accessPermission,0)->where('module_route',$module)->where('user_id',Auth::user()->id)->first();
            if(isset($permission->id)){
                $access = true;
            }
        }
        return $access;
    }
}