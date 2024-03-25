<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contract;
use App\Models\Client;
use App\Models\Lead;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $contractCount=Contract::UserWise()->when($request->start_date, function ($query, $startDate) {
            return $query->where('contracts.start_date', '>=', $startDate);
        })->when($request->end_date, function ($query, $endDate) {
            return $query->where('contracts.end_date', '<=', $endDate);
        })->where('status', 'Active')->count();
        $clientCount=Client::UserWise()->count();
        $leadCount=Lead::UserWise()->count();
        $totalMonthlyFee=Contract::UserWise()->when($request->start_date, function ($query, $startDate) {
            return $query->where('contracts.start_date', '>=', $startDate);
        })->when($request->end_date, function ($query, $endDate) {
            return $query->where('contracts.end_date', '<=', $endDate);
        })->where('status', 'Active')->sum('monthly_fee');
        return view('dashboard',compact('contractCount','clientCount','leadCount','totalMonthlyFee'));
    }
}
