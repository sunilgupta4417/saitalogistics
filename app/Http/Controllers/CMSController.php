<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\RoleManger;
use App\Models\CMS;
use Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use App\Http\Helpers\Common;
class CMSController extends Controller
{
    protected $helper;

    public function __construct()
    {
        $this->helper       = new Common();
    }
    public function get_page($name)
    {
        $data['page_content'] = CMS::where('page_name' , $name)->first();
        return view('cms.cms_page', $data);
    }

    public function update_page(Request $request){
        $page = CMS::find($request->id);

// Make sure you've got the Page model
if($page) {
    $page->page_content = $request->content;
    $page->save();
}
        $this->helper->one_time_message('success', __('Page content updated successfully!'));
        return redirect('admin/cms/page/'.$request->page_name); 
    }
    
}
