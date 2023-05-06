<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PacketBooking;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $booking = PacketBooking::get();
        $shipping = PacketBooking::select(\DB::raw("COUNT(*) as count"), \DB::raw("MONTHNAME(created_at) as month_name"))
                    ->whereYear('created_at', date('Y'))
                    ->groupBy(\DB::raw("month_name"))
                    ->orderBy('id','ASC')
                    ->pluck('count', 'month_name');
 
        $chart2labels = $shipping->keys();
        $chart2data = $shipping->values();

        $shipping1 = PacketBooking::select(\DB::raw("COUNT(*) as count"), 'csr_country_id')
                    ->groupBy('csr_country_id')
                    ->orderBy('id','ASC')
                    ->pluck('count', 'csr_country_id');
 
        $chart1labels = $shipping1->keys();
        $chart1data = $shipping1->values();
        return view('home',compact('booking','chart2labels', 'chart2data','chart1labels','chart1data'));
    }
}
