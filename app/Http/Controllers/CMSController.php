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




    public function get_about()
    {
        if(isset($_GET['id']))
        {
            $data['content'] = CMS::where('id' , $_GET['id'])->first();
        }
        $data['page_content'] = CMS::where('page_name' , 'about')->orderby('id' , 'Desc')->get();
        return view('cms.cms_about', $data);
    }
    public function delete_about($id)
    {
        $content=CMS::find($id);
        $content->delete();
        $this->helper->one_time_message('success', __('Section Deleted successfully!'));
        return redirect('admin/cms/about');
    }
    public function store_about(Request $request)
    {
        $content = new CMS();
        $imageName = '';
        if ($request->hasFile('page_image')) {
        $image = $request->file('page_image');
                 $imageName = time().'.'.$image->extension();     
                $ext      = strtolower($image->extension());

                if ($ext == 'png' || $ext == 'jpg' || $ext == 'jpeg' || $ext == 'gif' || $ext == 'bmp' || $ext == 'svg')
                {
                    $image->move(public_path('/assets/images/cms/'), $imageName);
                }
                else
                {
                       $this->helper->one_time_message('error', 'Invalid Image Format!');
                        return back();
                }
            }
        $content->page_name = 'about';
        $content->page_title = $request->page_title;
        $content->page_content = $request->page_content;
        $content->page_image = $imageName;
        $content->page_status = $request->status;
        $content->save();
        $this->helper->one_time_message('success', __('Section added successfully!'));
        return redirect('admin/cms/about');  
    }

    public function update_about(Request $request)
    {
        $content = CMS::find($request->id);
        $imageName = '';
        if ($request->hasFile('page_image')) {
        $image = $request->file('page_image');
                 $imageName = time().'.'.$image->extension();      
                $ext      = strtolower($image->extension());
                if ($ext == 'png' || $ext == 'jpg' || $ext == 'jpeg' || $ext == 'gif' || $ext == 'bmp' || $ext == 'svg')
                {
                    $image->move(public_path('/assets/images/cms/'), $imageName);
                    $content->page_image = $imageName;
                }
                else
                {
                       $this->helper->one_time_message('error', 'Invalid Image Format!');
                        return back();
                }
            }
        $content->page_title = $request->page_title;
        $content->page_content = $request->page_content;

        $content->page_status = $request->status;
        $content->save();
        $this->helper->one_time_message('success', __('Section updated successfully!'));
        return redirect('admin/cms/about');  
    }




    public function get_service()
    {
        if(isset($_GET['id']))
        {
            $data['content'] = CMS::where('id' , $_GET['id'])->first();
        }
        $data['page_content'] = CMS::where('page_name' , 'service')->orderby('id' , 'Desc')->get();
        return view('cms.cms_service', $data);
    }
    public function delete_service($id)
    {
        $content=CMS::find($id);
        $content->delete();
        $this->helper->one_time_message('success', __('Section Deleted successfully!'));
        return redirect('admin/cms/service');
    }
    public function store_service(Request $request)
    {
        $content = new CMS();
        $imageName = '';
        if ($request->hasFile('page_image')) {
        $image = $request->file('page_image');
                 $imageName = time().'.'.$image->extension();     
                $ext      = strtolower($image->extension());

                if ($ext == 'png' || $ext == 'jpg' || $ext == 'jpeg' || $ext == 'gif' || $ext == 'bmp' || $ext == 'svg')
                {
                    $image->move(public_path('/assets/images/cms/'), $imageName);
                }
                else
                {
                       $this->helper->one_time_message('error', 'Invalid Image Format!');
                        return back();
                }
            }
        $content->page_name = 'service';
        $content->page_title = $request->page_title;
        $content->page_content = $request->page_content;
        $content->page_image = $imageName;
        $content->page_status = $request->status;
        $content->page_link = $request->page_link;
        $content->save();
        $this->helper->one_time_message('success', __('Section added successfully!'));
        return redirect('admin/cms/service');  
    }

    public function update_service(Request $request)
    {
        $content = CMS::find($request->id);
        $imageName = '';
        if ($request->hasFile('page_image')) {
        $image = $request->file('page_image');
                 $imageName = time().'.'.$image->extension();      
                $ext      = strtolower($image->extension());
                if ($ext == 'png' || $ext == 'jpg' || $ext == 'jpeg' || $ext == 'gif' || $ext == 'bmp' || $ext == 'svg')
                {
                    $image->move(public_path('/assets/images/cms/'), $imageName);
                    $content->page_image = $imageName;
                }
                else
                {
                       $this->helper->one_time_message('error', 'Invalid Image Format!');
                        return back();
                }
            }
        $content->page_title = $request->page_title;
        $content->page_content = $request->page_content;
        $content->page_status = $request->status;
        $content->page_link = $request->page_link;
        $content->save();
        $this->helper->one_time_message('success', __('Section updated successfully!'));
        return redirect('admin/cms/service');  
    }


    public function get_faq()
    {
        if(isset($_GET['id']))
        {
            $data['content'] = CMS::where('id' , $_GET['id'])->first();
        }
        $data['page_content'] = CMS::where('page_name' , 'faq')->orderby('id' , 'Desc')->get();
        return view('cms.cms_faq', $data);
    }
    public function delete_faq($id)
    {
        $content=CMS::find($id);
        $content->delete();
        $this->helper->one_time_message('success', __('Section Deleted successfully!'));
        return redirect('admin/cms/faq');
    }
    public function store_faq(Request $request)
    {
        $content = new CMS();
        $imageName = $request->category;
        $content->page_name = 'faq';
        $content->page_title = $request->page_title;
        $content->page_content = $request->page_content;
        $content->page_image = $imageName;
        $content->page_status = $request->status;
        $content->save();
        $this->helper->one_time_message('success', __('FAQ added successfully!'));
        return redirect('admin/cms/faq');  
    }

    public function update_faq(Request $request)
    {
        $content = CMS::find($request->id);
        $imageName = $request->category;
        $content->page_title = $request->page_title;
        $content->page_content = $request->page_content;
        $content->page_image = $imageName;
        $content->page_status = $request->status;
        $content->save();
        $this->helper->one_time_message('success', __('FAQ updated successfully!'));
        return redirect('admin/cms/faq');  
    }


    public function get_setting()
    {
        if(isset($_GET['id']))
        {
            $data['content'] = CMS::where('id' , $_GET['id'])->first();
        }
        $data['page_content'] = CMS::where('page_name' , 'faq')->orderby('id' , 'Desc')->get();
        return view('cms.cms_faq', $data);
    }

    public function update_setting(Request $request)
    {
        $content = CMS::find($request->id);
        $imageName = $request->category;
        $content->page_title = $request->page_title;
        $content->page_content = $request->page_content;
        $content->page_image = $imageName;
        $content->page_status = $request->status;
        $content->save();
        $this->helper->one_time_message('success', __('FAQ updated successfully!'));
        return redirect('admin/cms/faq');  
    }


    public function get_home()
    {
        $data['page_content'] = CMS::where('page_name' , 'home-top')->first();
        $data['page_content']->page_link = json_decode($data['page_content']->page_link);
        $data['page_content1'] = CMS::where('page_name' , 'home-work')->get();
        $data['page_content2'] = CMS::where('page_name' , 'home-bottom')->first();
        $data['home_about'] = CMS::where('page_name' , 'home-about')->get();
        $data['wcs'] = CMS::where('page_name' , 'home-about')->get();
        return view('cms.cms_home', $data);
    }

    public function update_home(Request $request)
    {
        // dd($request->all());
        $content = CMS::find($request->id);
        if ($request->hasFile('page_image')) {
            $image = $request->file('page_image');
                     $imageName = rand(1111 , 9999).time().'.'.$image->extension();      
                    $ext      = strtolower($image->extension());
                    if ($ext == 'png' || $ext == 'jpg' || $ext == 'jpeg' || $ext == 'gif' || $ext == 'bmp' || $ext == 'svg')
                    {
                        $image->move(public_path('/assets/images/cms/'), $imageName);
                        $content->page_image = $imageName;
                    }
                    else
                    {
                           $this->helper->one_time_message('error', 'Invalid Image Format!');
                            return back();
                    }
            }
        $content->page_title = $request->page_title;
        $content->page_content = $request->page_content;
        $content->page_image = $imageName;
        $content->page_link = json_encode($request->page_link);
        $content->save();
        // dd($content);
        $this->helper->one_time_message('success', __('Home Section updated successfully!'));
        return redirect('admin/cms/home');  
    }
    public function update_home1(Request $request)
    {
        $content = CMS::find($request->id1);
        $imageName = '';
        if ($request->hasFile('page_image1')) {
        $image = $request->file('page_image1');
                 $imageName = rand(1111 , 9999).time().'.'.$image->extension();      
                $ext      = strtolower($image->extension());
                if ($ext == 'png' || $ext == 'jpg' || $ext == 'jpeg' || $ext == 'gif' || $ext == 'bmp' || $ext == 'svg')
                {
                    $image->move(public_path('/assets/images/cms/'), $imageName);
                    $content->page_image = $imageName;
                }
                else
                {
                       $this->helper->one_time_message('error', 'Invalid Image Format!');
                        return back();
                }
        }
        $content->page_title = $request->page_title1;
        $content->page_content = $request->page_content1;
        // $content->page_image = $imageName;
        $content->save();

        $content = CMS::find($request->id2);
        $imageName = '';
        if ($request->hasFile('page_image2')) {
        $image = $request->file('page_image2');
                 $imageName = rand(1111 , 9999).time().'.'.$image->extension();      
                $ext      = strtolower($image->extension());
                if ($ext == 'png' || $ext == 'jpg' || $ext == 'jpeg' || $ext == 'gif' || $ext == 'bmp' || $ext == 'svg')
                {
                    $image->move(public_path('/assets/images/cms/'), $imageName);
                    $content->page_image = $imageName;
                }
                else
                {
                       $this->helper->one_time_message('error', 'Invalid Image Format!');
                        return back();
                }
        }
        $content->page_title = $request->page_title2;
        $content->page_content = $request->page_content2;
        // $content->page_image = $imageName;
        $content->save();

        $content = CMS::find($request->id3);
        $imageName = '';
        if ($request->hasFile('page_image3')) {
        $image = $request->file('page_image3');
                 $imageName = rand(1111 , 9999).time().'.'.$image->extension();      
                $ext      = strtolower($image->extension());
                if ($ext == 'png' || $ext == 'jpg' || $ext == 'jpeg' || $ext == 'gif' || $ext == 'bmp' || $ext == 'svg')
                {
                    $image->move(public_path('/assets/images/cms/'), $imageName);
                    $content->page_image = $imageName;
                }
                else
                {
                       $this->helper->one_time_message('error', 'Invalid Image Format!');
                        return back();
                }
        }
        $content->page_title = $request->page_title3;
        $content->page_content = $request->page_content3;
        // $content->page_image = $imageName;
        $content->save();

        $content = CMS::find($request->id4);
        $imageName = '';
        if ($request->hasFile('page_image4')) {
        $image = $request->file('page_image4');
                 $imageName = rand(1111 , 9999).time().'.'.$image->extension();      
                $ext      = strtolower($image->extension());
                if ($ext == 'png' || $ext == 'jpg' || $ext == 'jpeg' || $ext == 'gif' || $ext == 'bmp' || $ext == 'svg')
                {
                    $image->move(public_path('/assets/images/cms/'), $imageName);
                    $content->page_image = $imageName;
                }
                else
                {
                       $this->helper->one_time_message('error', 'Invalid Image Format!');
                        return back();
                }
        }
        $content->page_title = $request->page_title4;
        $content->page_content = $request->page_content4;
        // $content->page_image = $imageName;
        $content->save();
        $this->helper->one_time_message('success', __('Home Section updated successfully!'));
        return redirect('admin/cms/home');  
    }
    public function update_home2(Request $request)
    {
        $content = CMS::find($request->page_id);
        // dd($request->all());
        $imageName = '';
        if ($request->hasFile('page_image')) {
        $image = $request->file('page_image');
                 $imageName = time().'.'.$image->extension();      
                $ext      = strtolower($image->extension());
                if ($ext == 'png' || $ext == 'jpg' || $ext == 'jpeg' || $ext == 'gif' || $ext == 'bmp' || $ext == 'svg')
                {
                    $image->move(public_path('/assets/images/cms/'), $imageName);
                    // dd($image);
                    // $content->page_image = $imageName;
                }
                else
                {
                       $this->helper->one_time_message('error', 'Invalid Image Format!');
                        return back();
                }
        }
        
        $content->page_title = $request->page_title;
        $content->page_content = $request->page_content;
        $content->page_image = $imageName;
        $content->page_link = $request->page_link;
        // $content->page_status = $request->status;
        $content->save();
        $this->helper->one_time_message('success', __('Home Section updated successfully!'));
        return redirect('admin/cms/home');  
    }
    public function updareWordClassServices(Request $request)
    {
        // dd($request->all());
        $content = CMS::find($request->id1);
        $imageName = '';
        if ($request->hasFile('page_image1')) {
        $image = $request->file('page_image1');
                 $imageName = rand(1111 , 9999).time().'.'.$image->extension();      
                $ext      = strtolower($image->extension());
                if ($ext == 'png' || $ext == 'jpg' || $ext == 'jpeg' || $ext == 'gif' || $ext == 'bmp' || $ext == 'svg')
                {
                    $image->move(public_path('/assets/images/cms/'), $imageName);
                    $content->page_image = $imageName;
                }
                else
                {
                       $this->helper->one_time_message('error', 'Invalid Image Format!');
                        return back();
                }
        }
        $content->page_title = $request->page_title1;
        $content->page_content = $request->page_content1;
        $content->page_link = $request->page_link1;
        $content->save();

        $content = CMS::find($request->id2);
        $imageName = '';
        if ($request->hasFile('page_image2')) {
        $image = $request->file('page_image2');
                 $imageName = rand(1111 , 9999).time().'.'.$image->extension();      
                $ext      = strtolower($image->extension());
                if ($ext == 'png' || $ext == 'jpg' || $ext == 'jpeg' || $ext == 'gif' || $ext == 'bmp' || $ext == 'svg')
                {
                    $image->move(public_path('/assets/images/cms/'), $imageName);
                    $content->page_image = $imageName;
                }
                else
                {
                       $this->helper->one_time_message('error', 'Invalid Image Format!');
                        return back();
                }
        }
        $content->page_title = $request->page_title2;
        $content->page_content = $request->page_content2;
        $content->page_link = $request->page_link2;
        $content->save();

        $content = CMS::find($request->id3);
        $imageName = '';
        if ($request->hasFile('page_image3')) {
        $image = $request->file('page_image3');
                 $imageName = rand(1111 , 9999).time().'.'.$image->extension();      
                $ext      = strtolower($image->extension());
                if ($ext == 'png' || $ext == 'jpg' || $ext == 'jpeg' || $ext == 'gif' || $ext == 'bmp' || $ext == 'svg')
                {
                    $image->move(public_path('/assets/images/cms/'), $imageName);
                    $content->page_image = $imageName;
                }
                else
                {
                       $this->helper->one_time_message('error', 'Invalid Image Format!');
                        return back();
                }
        }
        $content->page_title = $request->page_title3;
        $content->page_content = $request->page_content3;
        $content->page_link = $request->page_link3;
        $content->save();

        $this->helper->one_time_message('success', __('Home Section updated successfully!'));
        return redirect('admin/cms/home');
    }
    public function get_home_about()
    {
        if(isset($_GET['id']))
        {
            $data['content'] = CMS::where('id' , $_GET['id'])->first();
        }
        $data['page_content'] = CMS::where('page_name' , 'home-about')->orderby('id' , 'Desc')->get();
        return view('cms.cms_home_about', $data);
    }
    public function store_home_about(Request $request)
    {
        $content = new CMS();
        $imageName = '';
        if ($request->hasFile('page_image')) {
        $image = $request->file('page_image');
                 $imageName = time().'.'.$image->extension();     
                $ext      = strtolower($image->extension());

                if ($ext == 'png' || $ext == 'jpg' || $ext == 'jpeg' || $ext == 'gif' || $ext == 'bmp' || $ext == 'svg')
                {
                    $image->move(public_path('/assets/images/cms/'), $imageName);
                }
                else
                {
                       $this->helper->one_time_message('error', 'Invalid Image Format!');
                        return back();
                }
            }
        $content->page_name = 'about';
        $content->page_title = $request->page_title;
        $content->page_content = $request->page_content;
        $content->page_image = $imageName;
        $content->page_status = $request->status;
        $content->save();
        $this->helper->one_time_message('success', __('Section added successfully!'));
        return redirect('admin/cms/home');  
    }

    public function update_home_about(Request $request)
    {
        $content = CMS::find($request->id);
        $imageName = '';
        if ($request->hasFile('page_image')) {
        $image = $request->file('page_image');
                 $imageName = time().'.'.$image->extension();      
                $ext      = strtolower($image->extension());
                if ($ext == 'png' || $ext == 'jpg' || $ext == 'jpeg' || $ext == 'gif' || $ext == 'bmp' || $ext == 'svg')
                {
                    $image->move(public_path('/assets/images/cms/'), $imageName);
                    $content->page_image = $imageName;
                }
                else
                {
                       $this->helper->one_time_message('error', 'Invalid Image Format!');
                        return back();
                }
            }
        $content->page_title = $request->page_title;
        $content->page_content = $request->page_content;

        $content->page_status = $request->status;
        $content->save();
        $this->helper->one_time_message('success', __('Section updated successfully!'));
        return redirect('admin/cms/home');  
    }
}
