<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
        return view('frontend.landing.index');
    }

    public function about()
    {
        return view('frontend.about.index');
    }

    public function services()
    {
        return view('frontend.services.index');
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
        return view('frontend.support.index');
    }

    public function faq()
    {
        return view('frontend.faq.index');
    }

    public function terms_conditions()
    {
        return view('frontend.terms.index');
    }

    public function privacy_policy()
    {
        return view('frontend.privacy.index');
    }

    
}
