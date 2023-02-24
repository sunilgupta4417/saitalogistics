<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CMS;

class WebController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data['cms'] = CMS::where('page_name' , 'home')->first();
        return view('frontend.landing.index' , $data);
    }

    public function about()
    {
        $data['cms'] = CMS::where('page_name' , 'about')->first();
        return view('frontend.about.index', $data);
    }

    public function services()
    {
        $data['cms'] = CMS::where('page_name' , 'service')->first();
        return view('frontend.services.index', $data);
    }

    public function shipping()
    {
        return view('frontend.landing.index');
    }

    public function tracking()
    {
        return view('frontend.tracking.index');
    }

    public function support()
    {
        $data['cms'] = CMS::where('page_name' , 'support')->first();
        return view('frontend.support.index', $data);
    }

    public function faq()
    {
        $data['cms'] = CMS::where('page_name' , 'faq')->first();
        return view('frontend.faq.index', $data);
    }

    public function terms_conditions()
    {
        $data['cms'] = CMS::where('page_name' , 'terms')->first();
        return view('frontend.terms.index', $data);
    }

    public function privacy_policy()
    {
        $data['cms'] = CMS::where('page_name' , 'privacy')->first();
        return view('frontend.privacy.index', $data);
    }

    
}
