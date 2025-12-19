@extends('layouts.app')

@section('container')
<div class="min-h-screen bg-gray-50">
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 space-y-8">
        
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <div onclick="scrollToVisits()" class="bg-white p-6 rounded-[2rem] shadow-sm border border-gray-100 flex justify-between items-center cursor-pointer hover:shadow-md hover:border-red-100 transition-all group">
                <div>
                    <div id="totalVisits" class="text-3xl font-black text-gray-800">{{ $totalVisits }}</div>
                    <div class="text-xs text-gray-500 font-medium uppercase mt-1">Kunjungan Hari Ini</div>
                </div>
                <div class="text-3xl bg-red-50 p-4 rounded-2xl group-hover:scale-110 transition-transform">📍</div>
            </div>

            <div class="bg-white p-6 rounded-[2rem] shadow-sm border border-gray-100 flex justify-between items-center">
                <div>
                    <div id="activeSales" class="text-3xl font-black text-gray-800">{{ $activeSales }}</div>
                    <div class="text-xs text-gray-500 font-medium uppercase mt-1">Sales Aktif</div>
                </div>
                <div class="text-3xl bg-blue-50 p-4 rounded-2xl">👥</div>
            </div>

            <div class="bg-white p-6 rounded-[2rem] shadow-sm border border-gray-100 flex justify-between items-center">
                <div>
                    {{-- <div id="totalDeals" class="text-3xl font-black text-gray-800">{{ $totalDeals }}</div> --}}
                    <div class="text-xs text-gray-500 font-medium uppercase mt-1">Total Deals</div>
                </div>
                <div class="text-3xl bg-green-50 p-4 rounded-2xl">💰</div>
            </div>

            <div class="bg-white p-6 rounded-[2rem] shadow-sm border border-gray-100 flex justify-between items-center">
                <div>
                    {{-- <div id="avgVisits" class="text-3xl font-black text-gray-800">{{ number_format($avgVisits, 1) }}</div> --}}
                    <div class="text-xs text-gray-500 font-medium uppercase mt-1">Avg Visit / Sales</div>
                </div>
                <div class="text-3xl bg-purple-50 p-4 rounded-2xl">📈</div>
            </div>
        </div>

        <div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-100 overflow-hidden">
            <div class="px-8 py-6 border-b border-gray-50 flex justify-between items-center">
                <h2 class="text-xl font-bold text-gray-800">Status Sales Real-time</h2>
                <span class="text-[10px] bg-green-100 text-green-600 px-3 py-1 rounded-full font-bold uppercase tracking-wider">Live Monitoring</span>
            </div>
            <div class="p-8 overflow-x-auto">
                <table id="salesTable" class="w-full text-left">
                    <thead>
                        <tr class="text-[11px] font-bold text-gray-400 uppercase tracking-widest border-b border-gray-50">
                            <th class="pb-4 px-4">Nama Sales</th>
                            <th class="pb-4 px-4">Status</th>
                            <th class="pb-4 px-4">Clock In</th>
                            <th class="pb-4 px-4">Lokasi Terakhir</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        {{-- @foreach($salesStatus as $sales)
                        <tr class="group hover:bg-gray-50 transition-all">
                            <td class="py-5 px-4">
                                <div class="font-bold text-gray-700 text-sm">{{ $sales->name }}</div>
                                <div class="text-[10px] text-gray-400">{{ $sales->username }}</div>
                            </td>
                            <td class="py-5 px-4">
                                @php $p = $sales->presences->first(); @endphp
                                @if($p)
                                    <span class="inline-flex items-center gap-1.5 text-green-600 font-bold text-xs">
                                        <span class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></span> Online
                                    </span>
                                @else
                                    <span class="text-gray-300 text-xs italic">Offline</span>
                                @endif
                            </td>
                            <td class="py-5 px-4 text-sm text-gray-500 font-medium">
                                {{ $p->clock_in ?? '--:--' }}
                            </td>
                            <td class="py-5 px-4">
                                <a href="https://www.google.com/maps?q={{ $p->latitude_in }},{{ $p->longitude_in }}" target="_blank" 
                                   class="text-[11px] bg-red-50 text-[#ed1c24] px-3 py-1 rounded-lg font-bold hover:bg-[#ed1c24] hover:text-white transition-all">
                                   📍 Lihat Map
                                </a>
                            </td>
                        </tr>
                        @endforeach --}}
                    </tbody>
                </table>
            </div>
        </div>

        <div id="todayVisitsCard" class="bg-white rounded-[2.5rem] shadow-sm border border-gray-100 overflow-hidden">
            <div class="px-8 py-6 border-b border-gray-50 flex justify-between items-center">
                <h2 class="text-xl font-bold text-gray-800">Detail Kunjungan Hari Ini</h2>
                <span id="todayVisitCount" class="bg-gradient-to-r from-[#ed1c24] to-[#c11219] text-white px-4 py-1.5 rounded-full text-xs font-bold shadow-sm">
                    {{ $totalVisits }} Kunjungan
                </span>
            </div>
            <div id="dashboardVisitContent" class="p-4 sm:p-8">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @forelse($latestVisits as $visit)
                    <div class="flex items-center gap-4 p-4 border border-gray-50 rounded-[1.5rem] hover:shadow-md transition-all">
                        <img src="{{ asset('storage/' . $visit->photo) }}" class="w-20 h-20 object-cover rounded-2xl shadow-sm">
                        <div class="flex-1 min-w-0">
                            <h4 class="text-sm font-black text-gray-800 truncate">{{ $visit->customer_name }}</h4>
                            <p class="text-[11px] text-[#ed1c24] font-bold uppercase">{{ $visit->product }}</p>
                            <p class="text-[10px] text-gray-400 mt-1 italic">Oleh: {{ $visit->user->name }}</p>
                        </div>
                        <div class="text-right">
                            <span class="text-[10px] font-bold text-gray-400 block">{{ $visit->created_at->format('H:i') }}</span>
                        </div>
                    </div>
                    @empty
                    <div class="col-span-full py-12 text-center text-gray-400 font-medium italic">
                        Belum ada kunjungan hari ini
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </main>
</div>

<script>
    function scrollToVisits() {
        document.getElementById('todayVisitsCard').scrollIntoView({ behavior: 'smooth' });
    }
</script>
@endsection