@extends('layouts.app')

@section('container')
<div class="py-8 space-y-12 max-w-6xl mx-auto" x-data="{ openVisit: false, openDeal: false, selectedData: {} }">
    
    {{-- SECTION VISIT --}}
    <div class="bg-white rounded-[2.5rem] shadow-xl border border-gray-100 overflow-hidden">
        <div class="px-8 py-6 bg-white border-b border-gray-100 flex flex-col sm:flex-row justify-between items-center gap-4">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 bg-blue-500 rounded-2xl flex items-center justify-center text-white shadow-lg shadow-blue-200">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                </div>
                <div>
                    <h2 class="text-xl font-black text-gray-800 tracking-tight uppercase tracking-tighter">History Kunjungan</h2>
                    <p class="text-xs text-gray-400 font-medium italic">Data prospek pelanggan</p>
                </div>
            </div>
            <span class="bg-blue-50 text-blue-600 px-5 py-2 rounded-2xl font-black text-sm border border-blue-100 italic">
                {{ $visits->count() }} TOTAL VISIT
            </span>
        </div>

        <div class="overflow-x-auto p-6">
            <table class="w-full text-left border-separate border-spacing-y-3">
                <thead>
                    <tr class="text-gray-400 text-[10px] uppercase font-black tracking-widest">
                        <th class="px-6">Waktu</th>
                        <th class="px-6">Customer</th>
                        <th class="px-6">Produk</th>
                        <th class="px-6">Follow Up</th>
                        <th class="px-6 text-center">Detail</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($visits as $v)
                    <tr class="bg-gray-50 hover:bg-blue-50 transition-all group rounded-2xl">
                        <td class="px-6 py-4 rounded-l-2xl">
                            <span class="block font-bold text-gray-700 text-sm italic">{{ $v->created_at->format('d/m/Y') }}</span>
                            <span class="text-[10px] text-gray-400 font-medium uppercase">{{ $v->created_at->format('H:i') }} WIB</span>
                        </td>
                        <td class="px-6 py-4">
                            <span class="block font-extrabold text-gray-800 uppercase tracking-tighter">{{ $v->customer_name }}</span>
                            <span class="text-[10px] text-blue-500 font-bold uppercase">{{ $v->phone }}</span>
                        </td>
                        <td class="px-6 py-4">
                            <span class="text-xs font-bold text-gray-600 bg-white px-3 py-1 rounded-lg border border-gray-200 uppercase">{{ $v->product }}</span>
                        </td>
                        <td class="px-6 py-4">
                            <span class="text-[#ed1c24] font-black italic text-sm">{{ \Carbon\Carbon::parse($v->follow_up_date)->format('d M y') }}</span>
                        </td>
                        <td class="px-6 py-4 rounded-r-2xl text-center">
                            <button @click="selectedData = {{ $v->toJson() }}; openVisit = true" class="w-10 h-10 bg-white text-blue-500 rounded-xl hover:bg-blue-500 hover:text-white transition-all shadow-sm flex items-center justify-center mx-auto border border-gray-100 shadow-lg shadow-blue-100/50">
                                👁️
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- SECTION DEALS --}}
    <div class="bg-white rounded-[2.5rem] shadow-xl border border-gray-100 overflow-hidden mt-12">
        <div class="px-8 py-6 bg-white border-b border-gray-100 flex flex-col sm:flex-row justify-between items-center gap-4">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 bg-green-500 rounded-2xl flex items-center justify-center text-white shadow-lg shadow-green-200">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <div>
                    <h2 class="text-xl font-black text-gray-800 tracking-tight uppercase tracking-tighter">History Closing</h2>
                    <p class="text-xs text-gray-400 font-medium italic">Data instalasi baru</p>
                </div>
            </div>
            <span class="bg-green-50 text-green-600 px-5 py-2 rounded-2xl font-black text-sm border border-green-100 italic">
                {{ $deals->count() }} TOTAL DEALS
            </span>
        </div>

        <div class="overflow-x-auto p-6">
            <table class="w-full text-left border-separate border-spacing-y-3">
                <thead>
                    <tr class="text-gray-400 text-[10px] uppercase font-black tracking-widest">
                        <th class="px-6">Waktu</th>
                        <th class="px-6">Bisnis/PIC</th>
                        <th class="px-6">Layanan</th>
                        <th class="px-6">Status</th>
                        <th class="px-6 text-center">Detail</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($deals as $d)
                    <tr class="bg-gray-50 hover:bg-green-50 transition-all group rounded-2xl">
                        <td class="px-6 py-4 rounded-l-2xl font-bold text-gray-700 text-sm italic">{{ $d->created_at->format('d/m/Y') }}</td>
                        <td class="px-6 py-4">
                            <span class="block font-extrabold text-gray-800 uppercase tracking-tighter">{{ $d->business_name }}</span>
                            <span class="text-[10px] text-green-600 font-bold italic uppercase tracking-widest">{{ $d->pic_name }}</span>
                        </td>
                        <td class="px-6 py-4 text-xs font-bold text-gray-600">{{ $d->service_type }}</td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center px-3 py-1 bg-orange-50 text-orange-600 text-[10px] font-black uppercase rounded-lg border border-orange-100 italic">
                                {{ $d->status }}
                            </span>
                        </td>
                        <td class="px-6 py-4 rounded-r-2xl text-center">
                            <button @click="selectedData = {{ $d->toJson() }}; openDeal = true" class="w-10 h-10 bg-white text-green-500 rounded-xl hover:bg-green-500 hover:text-white transition-all shadow-sm flex items-center justify-center mx-auto border border-gray-100 shadow-lg shadow-green-100/50">
                                👁️
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- POP-UP DETAIL (Modal Alpine.js) --}}
    <div x-show="openVisit || openDeal" 
         x-transition:enter="transition ease-out duration-300" 
         x-transition:enter-start="opacity-0" 
         x-transition:enter-end="opacity-100" 
         class="fixed inset-0 z-[999] flex items-center justify-center p-4 bg-black/60 backdrop-blur-sm" x-cloak>
        
        <div @click.away="openVisit = false; openDeal = false" class="bg-white w-full max-w-3xl rounded-[2.5rem] overflow-hidden shadow-2xl">
            {{-- Modal Header --}}
            <div :class="openVisit ? 'bg-blue-600' : 'bg-green-600'" class="p-6 text-white flex justify-between items-center">
                <div>
                    <p class="text-[10px] font-black uppercase tracking-[0.2em] opacity-70" x-text="openVisit ? 'Activity Log' : 'Closing Record'"></p>
                    <h3 class="font-black uppercase italic tracking-wider text-xl" x-text="openVisit ? 'Detail Kunjungan' : 'Detail Deal Closing'"></h3>
                </div>
                <button @click="openVisit = false; openDeal = false" class="w-10 h-10 flex items-center justify-center rounded-full bg-white/20 hover:bg-white/40 transition-all font-bold">✕</button>
            </div>
            
            <div class="p-8 max-h-[80vh] overflow-y-auto space-y-8">
                
                {{-- AREA FOTO --}}
                <div class="space-y-3 text-center">
                    <p class="text-[11px] font-black text-gray-400 uppercase tracking-widest">📸 Dokumentasi Lapangan</p>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <template x-if="openVisit">
                            <div class="md:col-span-2">
                                <img :src="'/storage/' + selectedData.photo" class="w-full h-64 object-cover rounded-[2rem] border-4 border-gray-50 shadow-sm">
                            </div>
                        </template>
                        <template x-if="openDeal">
                            <div class="contents">
                                <div class="space-y-2">
                                    <p class="text-[9px] font-bold text-gray-400 uppercase italic">Foto KTP PIC</p>
                                    <img :src="'/storage/' + selectedData.ktp_photo_path" class="w-full h-44 object-cover rounded-[2rem] border-4 border-gray-50 shadow-sm">
                                </div>
                                <div class="space-y-2">
                                    <p class="text-[9px] font-bold text-gray-400 uppercase italic">Foto Lokasi Bangunan</p>
                                    <img :src="'/storage/' + selectedData.building_photo_path" class="w-full h-44 object-cover rounded-[2rem] border-4 border-gray-50 shadow-sm">
                                </div>
                            </div>
                        </template>
                    </div>
                </div>

                {{-- DATA DETAILS --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="bg-gray-50 p-5 rounded-[1.5rem] border border-gray-100">
                        <label class="text-[9px] font-black text-gray-400 uppercase block mb-1 tracking-tighter">Nama Pelanggan/Bisnis</label>
                        <p class="font-extrabold text-gray-800 uppercase italic" x-text="openVisit ? selectedData.customer_name : selectedData.business_name"></p>
                    </div>

                    <div class="bg-gray-50 p-5 rounded-[1.5rem] border border-gray-100">
                        <label class="text-[9px] font-black text-gray-400 uppercase block mb-1 tracking-tighter">Kontak/Phone</label>
                        <p class="font-extrabold text-blue-600" x-text="openVisit ? selectedData.phone : selectedData.pic_phone"></p>
                    </div>

                    <template x-if="openDeal">
                        <div class="contents">
                            <div class="bg-gray-50 p-5 rounded-[1.5rem] border border-gray-100">
                                <label class="text-[9px] font-black text-gray-400 uppercase block mb-1 tracking-tighter">NIK PIC (16 Digit)</label>
                                <p class="font-bold text-gray-700 tracking-widest" x-text="selectedData.pic_nik"></p>
                            </div>
                            <div class="bg-gray-50 p-5 rounded-[1.5rem] border border-gray-100">
                                <label class="text-[9px] font-black text-gray-400 uppercase block mb-1 tracking-tighter">Email Terdaftar</label>
                                <p class="font-bold text-gray-700" x-text="selectedData.pic_email"></p>
                            </div>
                            <div class="bg-gray-50 p-5 rounded-[1.5rem] border border-gray-100">
                                <label class="text-[9px] font-black text-gray-400 uppercase block mb-1 tracking-tighter">Branch & Layanan</label>
                                <p class="font-bold text-gray-700 tracking-tighter"><span x-text="selectedData.branch"></span> - <span x-text="selectedData.service_type" class="text-green-600"></span></p>
                            </div>
                            <div class="bg-gray-50 p-5 rounded-[1.5rem] border border-gray-100">
                                <label class="text-[9px] font-black text-gray-400 uppercase block mb-1 tracking-tighter">Koordinat GPS</label>
                                <p class="font-mono text-[10px] text-gray-500 italic" x-text="selectedData.coordinates"></p>
                            </div>
                        </div>
                    </template>

                    <div class="bg-gray-50 p-5 rounded-[1.5rem] border border-gray-100 md:col-span-2">
                        <label class="text-[9px] font-black text-gray-400 uppercase block mb-1 tracking-tighter">Alamat Lengkap Lokasi</label>
                        <p class="text-xs text-gray-700 leading-relaxed font-bold italic" x-text="selectedData.address"></p>
                    </div>

                    <div class="bg-red-50/50 p-5 rounded-[1.5rem] border border-red-100 md:col-span-2">
                        <label class="text-[9px] font-black text-red-400 uppercase block mb-1 tracking-tighter">Catatan Sales / Notes</label>
                        <p class="text-xs italic text-gray-600 leading-relaxed font-medium" x-text="selectedData.notes || 'Tidak ada catatan tambahan.'"></p>
                    </div>
                </div>

                {{-- Action Modal --}}
                <div class="flex gap-3 pt-2">
                    <template x-if="openDeal && selectedData.support_doc_path">
                        <a :href="'/storage/' + selectedData.support_doc_path" target="_blank" class="flex-1 text-center py-4 bg-blue-600 text-white rounded-2xl text-[10px] font-black uppercase tracking-widest shadow-lg shadow-blue-200 hover:opacity-90 italic">📎 Lihat Dokumen SIUP/NPWP</a>
                    </template>
                    <button @click="openVisit = false; openDeal = false" class="flex-1 py-4 bg-gray-100 text-gray-400 rounded-2xl text-[10px] font-black uppercase tracking-widest hover:bg-gray-200 italic">Kembali</button>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    [x-cloak] { display: none !important; }
</style>

{{-- Pastikan Alpine.js di-load --}}
<script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
@endsection