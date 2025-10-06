<?php

namespace App\Http\Controllers;

use App\Models\Visit;
use Carbon\Carbon;
use DateInterval;
use DatePeriod;
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
        $todayVisitsCount = Visit::whereDate('visit_date',date('Y-m-d'))->count();
        $totalVisitsCountMonth = Visit::whereMonth('created_at','=',date('m'))->whereYear('created_at','=',date('Y'))->count();
        $visits=Visit::all()->groupBy('visit_date');
        // $visits = Visit::selectRaw('DATE(visit_date) as date, COUNT(*) as count')
        //     ->groupBy('date')
        //     ->orderBy('date', 'ASC')
        //     ->get()
        //     ->map(function ($item) {
        //         return [
        //             'date' => $item->date,
        //             'count' => (int) $item->count,
        //         ];
        //     });

        
$start = Carbon::now()->startOfMonth();
$end = Carbon::now()->endOfMonth();
$period = new DatePeriod($start, new DateInterval('P1D'), $end);

// Build array with all dates initialized to 0
$dates = collect($period)->mapWithKeys(function ($date) {
    return [$date->format('Y-m-d') => 0];
});

// Get actual visit counts
$visits = Visit::selectRaw('DATE(visit_date) as date, COUNT(*) as count')
    ->whereDate('visit_date', '>=', $start)
    ->whereDate('visit_date', '<=', $end)
    ->groupBy('date')
    ->pluck('count', 'date');

// Merge and preserve all dates
$data = $dates->merge($visits)->map(fn ($count, $date) => [
    'date' => $date,
    'count' => (int) $count,
])->values();
        // dd($data);   
        return view('home',['openVisitsCount'=>$openVisitsCount,'totalVisitsCountMonth'=>$totalVisitsCountMonth, 'todayVisitsCount'=>$todayVisitsCount,'chart_data'=>$data]);
    }   
}
