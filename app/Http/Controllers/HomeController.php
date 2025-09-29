<?php

namespace App\Http\Controllers;

use App\Models\Visit;
use Illuminate\Http\Request;

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
        $openVisits = Visit::whereNull('out_time');
        $openVisitsCount = $openVisits->count();
        $totalVisitsCountMonth = Visit::whereMonth('created_at','=',date('m'))->whereYear('created_at','=',date('Y'))->count();
        return view('home',['openVisitsCount'=>$openVisitsCount,'totalVisitsCountMonth'=>$totalVisitsCountMonth]);
    }
}
