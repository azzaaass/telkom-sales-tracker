<?php

namespace App\Http\Controllers;

use App\Models\Deals;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DealsController extends Controller
{
    public function index()
    {
        return view('user.deals');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'branch'          => 'required|string',
            'business_name'   => 'required|string|max:255',
            'address'         => 'required|string',
            'coordinates'     => 'required|string',
            'pic_name'        => 'required|string|max:255',
            'pic_phone'       => 'required|string|max:20',
            'email'           => 'required|email',
            'nik'             => 'required|digits:16',
            'service'         => 'required|string',
            'ktp_photo'       => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'building_photo'  => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'support_doc'     => 'nullable|mimes:jpeg,png,pdf|max:5120',
            'notes'           => 'nullable|string',
        ]);

        // 2. Proses Upload File
        $ktpPath      = $request->file('ktp_photo')->store('deals/ktp', 'public');
        $buildingPath = $request->file('building_photo')->store('deals/building', 'public');

        $docPath = null;
        if ($request->hasFile('support_doc')) {
            $docPath = $request->file('support_doc')->store('deals/docs', 'public');
        }

        // 3. Simpan ke Database
        $deal = Deals::create([
            'sales_id'            => Auth::id(),
            'sales_name'          => Auth::user()->fullname,
            'branch'              => $validated['branch'],
            'business_name'       => $validated['business_name'],
            'address'             => $validated['address'],
            'coordinates'         => $validated['coordinates'],
            'pic_name'            => $validated['pic_name'],
            'pic_phone'           => $validated['pic_phone'],
            'pic_email'           => $validated['email'],
            'pic_nik'             => $validated['nik'],
            'service_type'        => $validated['service'],
            'notes'               => $validated['notes'],
            'ktp_photo_path'      => $ktpPath,
            'building_photo_path' => $buildingPath,
            'support_doc_path'    => $docPath,
            'status'              => 'processing',
        ]);

        // Jika request via AJAX/JSON
        if ($request->expectsJson()) {
            return response()->json([
                'message' => 'Deal Closing berhasil disimpan!',
                'deal'    => $deal
            ], 201);
        }

        // Jika request via Form HTML biasa
        return redirect()->back()->with('success', 'Deal Closing berhasil disimpan!');
    }
}
