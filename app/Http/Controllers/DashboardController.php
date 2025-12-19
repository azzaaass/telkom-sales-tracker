<?php

namespace App\Http\Controllers;

use App\Models\Presence;
use App\Models\User;
use App\Models\Visit;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $today = date('Y-m-d');

        return view('user.dashboard', [
            // Total kunjungan dari semua sales hari ini
            'totalVisits' => Visit::whereDate('created_at', $today)->count(),

            // Menghitung sales yang sudah melakukan Clock In hari ini
            'activeSales' => Presence::where('date', $today)->distinct('user_id')->count(),

            // Menghitung total deal (misal jika ada kolom status 'deal' di tabel visits)
            // 'totalDeals'  => Visit::where('status', 'deal')->count(),

            // List sales untuk tabel "Status Sales Real-time"
            // 'salesStatus' => User::with(['presences' => function ($q) use ($today) {
            //     $q->where('date', $today);
            // }])->where('role', 'user')->get(),

            // List kunjungan terbaru untuk bagian bawah
            'latestVisits' => Visit::with('user')->whereDate('created_at', $today)->latest()->take(5)->get()
        ]);
    }
}
