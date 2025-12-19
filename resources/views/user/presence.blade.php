@extends('layouts.app')

@section('container')
    <div class="min-h-screen bg-[#ed1c24] pb-12">
        <div class="max-w-4xl mx-auto px-4 pt-8 space-y-8">

            <div class="bg-white rounded-[2.5rem] shadow-2xl overflow-hidden p-8 sm:p-12">

                <div id="currentClock"
                    class="text-center text-[#ed1c24] text-5xl sm:text-6xl font-black tracking-[0.2em] mb-8">
                    00:00:00
                </div>

                <div class="bg-[#ed1c24] text-white p-4 rounded-2xl flex items-center gap-3 mb-10 shadow-md">
                    <div class="w-3 h-3 bg-white rounded-full animate-pulse"></div>
                    <div class="text-sm sm:text-base">
                        <span class="font-bold uppercase tracking-wider">Status:</span>
                        <span id="absensiStatus" class="font-medium opacity-90 italic">Belum Absen Hari Ini</span>
                    </div>
                </div>

                <form action="{{ route('presence.in') }}" method="POST" id="absensiForm" class="space-y-6">
                    @csrf
                    <input type="hidden" name="latitude" id="lat">
                    <input type="hidden" name="longitude" id="lng">

                    <div class="space-y-2">
                        <label class="block text-sm font-bold text-gray-700 ml-1">Nama Sales</label>
                        {{-- @dd(Auth::user()) --}}
                        <input type="text" id="absensiNama" value="{{ Auth::user()->fullname }}" readonly
                            class="w-full px-5 py-3.5 rounded-2xl border border-gray-200 bg-gray-50 text-gray-500 font-medium outline-none cursor-not-allowed">
                    </div>

                    <div class="space-y-2">
                        <label class="block text-sm font-bold text-gray-700 ml-1">
                            Lokasi <span class="text-green-500">●</span> GPS Terdeteksi
                        </label>
                        <input type="text" id="absensiLokasi" placeholder="Mencari lokasi..." readonly
                            class="w-full px-5 py-3.5 rounded-2xl border border-gray-200 bg-gray-50 text-gray-500 font-medium outline-none">
                        <p class="text-[11px] text-gray-400 italic flex items-center gap-1 ml-1">
                            📍 Lokasi otomatis terdeteksi menggunakan GPS
                        </p>
                    </div>

                    <div class="space-y-2">
                        <label class="block text-sm font-bold text-gray-700 ml-1">Catatan</label>
                        <textarea id="absensiCatatan" name="note" rows="3" placeholder="Catatan tambahan (opsional)"
                            class="w-full px-5 py-4 rounded-2xl border border-gray-200 focus:ring-2 focus:ring-[#ed1c24] focus:border-transparent outline-none transition-all resize-none"></textarea>
                    </div>

                    <div class="flex flex-col sm:flex-row gap-4 pt-4">
                        <button type="button" onclick="handleClockAction('in')"
                            class="flex-1 bg-gradient-to-r from-[#ed1c24] to-[#c11219] text-white font-black py-4 rounded-2xl shadow-lg hover:opacity-90 active:scale-[0.98] transition-all uppercase tracking-widest">
                            CHECK IN SEKARANG
                        </button>
                        <button type="button" onclick="handleClockAction('out')"
                            class="flex-1 bg-[#5d676e] text-white font-black py-4 rounded-2xl shadow-lg hover:bg-[#4a5358] active:scale-[0.98] transition-all uppercase tracking-widest">
                            CHECK OUT SEKARANG
                        </button>
                    </div>
                </form>
            </div>

            {{-- <div class="bg-white rounded-[2.5rem] shadow-xl overflow-hidden border border-gray-100">
            <div class="bg-gray-50 px-8 py-5 border-b border-gray-100">
                <h2 class="text-lg font-black text-gray-800 uppercase tracking-tight">Riwayat Absensi</h2>
            </div>
            <div id="absensiHistory" class="p-12 text-center">
                <p class="text-gray-400 font-medium italic">Belum ada data absensi</p>
            </div>
        </div> --}}

            <div class="bg-white rounded-[2.5rem] shadow-xl overflow-hidden border border-gray-100">
                <div class="bg-gray-50 px-8 py-5 border-b border-gray-100 flex justify-between items-center">
                    <h2 class="text-lg font-black text-gray-800 uppercase tracking-tight">Riwayat Absensi</h2>
                    <span class="text-xs font-bold text-gray-500 bg-gray-200 px-3 py-1 rounded-full">
                        Total: {{ $history->count() }}
                    </span>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-50 text-gray-600 uppercase text-[11px] font-bold tracking-widest">
                                <th class="px-8 py-4 border-b">Tanggal</th>
                                <th class="px-8 py-4 border-b">Masuk</th>
                                <th class="px-8 py-4 border-b">Pulang</th>
                                <th class="px-8 py-4 border-b">Status</th>
                                <th class="px-8 py-4 border-b">Keterangan</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse($history as $item)
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-8 py-5 text-sm font-semibold text-gray-700">
                                        {{ \Carbon\Carbon::parse($item->date)->translatedFormat('d F Y') }}
                                    </td>
                                    <td class="px-8 py-5 text-sm text-green-600 font-bold">
                                        {{ $item->clock_in ?? '--:--' }}
                                    </td>
                                    <td class="px-8 py-5 text-sm text-red-600 font-bold">
                                        {{ $item->clock_out ?? '--:--' }}
                                    </td>
                                    <td class="px-8 py-5">
                                        <span
                                            class="px-3 py-1 rounded-full text-[10px] font-black uppercase shadow-sm
                            {{ $item->status == 'hadir' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                                            {{ $item->status }}
                                        </span>
                                    </td>
                                    <td class="px-8 py-5 text-xs text-gray-500 italic max-w-xs truncate">
                                        {{ $item->note_in ?? '-' }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="p-12 text-center text-gray-400 font-medium italic">
                                        Belum ada data absensi tersedia.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Update Jam Real-time
        function updateClock() {
            const now = new Date();
            const timeString = now.getHours().toString().padStart(2, '0') + '.' +
                now.getMinutes().toString().padStart(2, '0') + '.' +
                now.getSeconds().toString().padStart(2, '0');
            document.getElementById('currentClock').innerText = timeString;
        }
        setInterval(updateClock, 1000);
        updateClock();

        // Ambil Lokasi GPS Otomatis
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(position => {
                const lat = position.coords.latitude;
                const lng = position.coords.longitude;
                document.getElementById('lat').value = lat;
                document.getElementById('lng').value = lng;
                document.getElementById('absensiLokasi').value = lat.toFixed(6) + ", " + lng.toFixed(6);
            }, error => {
                document.getElementById('absensiLokasi').value = "Tidak dapat mendeteksi lokasi";
            });
        }

        // Logika pengiriman form (Sesuaikan route)
        function handleClockAction(type) {
            const form = document.getElementById('absensiForm');
            if (type === 'in') {
                form.action = "{{ route('presence.in') }}";
            } else {
                form.action = "{{ route('presence.out') }}";
            }
            form.submit();
        }

        // Konfigurasi Dasar SweetAlert2 untuk Toast
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        });

        // Munculkan Pop-up jika ada session success
        @if (session('success'))
            Toast.fire({
                icon: 'success',
                title: "{{ session('success') }}"
            });
        @endif

        // Munculkan Pop-up jika ada session error
        @if (session('error'))
            Toast.fire({
                icon: 'error',
                title: "{{ session('error') }}"
            });
        @endif

        // Munculkan Pop-up jika ada error validasi dari Laravel
        @if ($errors->any())
            Toast.fire({
                icon: 'error',
                title: "{{ $errors->first() }}"
            });
        @endif
    </script>
@endsection
