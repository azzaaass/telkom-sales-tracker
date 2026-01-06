<?php

namespace App\Http\Controllers;

use App\Models\Deals;
use App\Models\Visit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

    class HistoryController extends Controller
    {
        public function index()
        {
            $userId = Auth::id();

            $visits = Visit::where('user_id', $userId)->latest()->get();
            $deals = Deals::where('sales_id', $userId)->latest()->get();

            return view('user.history', compact('visits', 'deals'));
        }
    }
