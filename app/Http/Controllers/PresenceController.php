<?php

namespace App\Http\Controllers;

use App\Models\Presence;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PresenceController extends Controller
{
    public function index()
    {
        $history = Presence::where('user_id', Auth::id())
                ->orderBy('date', 'desc')
                ->orderBy('clock_in', 'desc')
                ->get();

        return view('user.presence', compact('history'));
    }

    public function clockIn(Request $request)
    {
        $userId = Auth::id();
        $today = Carbon::today()->toDateString();

        $alreadyIn = Presence::where('user_id', $userId)->where('date', $today)->first();

        if ($alreadyIn) {
            return back()->with('error', 'Anda sudah melakukan Clock In hari ini!');
        }

        Presence::create([
            'user_id'      => $userId,
            'date'         => $today,
            'clock_in'     => Carbon::now()->toTimeString(),
            'latitude_in'  => $request->latitude, 
            'longitude_in' => $request->longitude,
            'status'       => 'hadir',
            'note_in'      => $request->note,
        ]);

        return back()->with('success', 'Berhasil Clock In. Semangat bekerja!');
    }

    // Fungsi Clock Out
    public function clockOut(Request $request)
    {
        $userId = Auth::id();
        $today = Carbon::today()->toDateString();

        // Cari data absen hari ini yang clock_out nya masih kosong
        $presence = Presence::where('user_id', $userId)
            ->where('date', $today)
            ->whereNull('clock_out')
            ->first();

        if (!$presence) {
            return back()->with('error', 'Data Clock In tidak ditemukan atau Anda sudah Clock Out!');
        }

        $presence->update([
            'clock_out' => Carbon::now()->toTimeString(),
            'note_out'  => $request->note,
        ]);

        return back()->with('success', 'Berhasil Clock Out. Hati-hati di jalan!');
    }
}
