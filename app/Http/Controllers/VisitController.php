<?php

namespace App\Http\Controllers;

use App\Models\Visit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VisitController extends Controller
{
    public function index(){
        $visits = Visit::where('user_id', Auth::id());
        return view('user.visit', compact('visits'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_name' => 'required',
            'phone'         => 'required',
            'product'       => 'required',
            'follow_up_date' => 'required|date',
            'photo'         => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Proses Simpan Foto ke folder storage/app/public/visits
        $photoPath = $request->file('photo')->store('visits', 'public');

        Visit::create([
            'user_id'       => Auth::id(),
            'customer_name' => $request->customer_name,
            'phone'         => $request->phone,
            'address'       => $request->address,
            'latitude'      => $request->latitude,
            'longitude'     => $request->longitude,
            'product'       => $request->product,
            'notes'         => $request->notes,
            'follow_up_date' => $request->follow_up_date,
            'photo'         => $photoPath,
        ]);

        return redirect()->route('visit')->with('success', 'Data kunjungan berhasil disimpan!');
    }
}
