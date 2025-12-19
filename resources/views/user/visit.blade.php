@extends('layouts.app')

@section('container')
    <div class="min-h-screen bg-[#ed1c24] pb-12">
        <div class="max-w-4xl mx-auto px-4 pt-8">
            <div class="bg-white rounded-[2.5rem] shadow-2xl overflow-hidden">

                <div class="bg-gradient-to-r from-[#ed1c24] to-[#c11219] p-8 text-center text-white">
                    <h1 class="text-3xl font-black uppercase tracking-tight">Catat Kunjungan Baru</h1>
                    <p class="text-sm opacity-90 mt-1 italic">Input data prospek pelanggan Telkom</p>
                </div>

                <form action="{{ route('visit.store') }}" method="POST" enctype="multipart/form-data"
                    class="p-8 sm:p-12 space-y-6">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label class="block text-sm font-bold text-gray-700 ml-1">Nama Customer</label>
                            <input type="text" name="customer_name" placeholder="Nama lengkap customer" required
                                class="w-full px-5 py-3.5 rounded-2xl border border-gray-200 focus:ring-2 focus:ring-[#ed1c24] outline-none transition-all">
                        </div>

                        <div class="space-y-2">
                            <label class="block text-sm font-bold text-gray-700 ml-1">No. Telepon</label>
                            <input type="tel" name="phone" placeholder="08xxxxxxxxxx" required
                                class="w-full px-5 py-3.5 rounded-2xl border border-gray-200 focus:ring-2 focus:ring-[#ed1c24] outline-none transition-all">
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label class="block text-sm font-bold text-gray-700 ml-1">Alamat <span
                                class="text-green-500">●</span> GPS Terdeteksi</label>
                        <input type="text" name="address" id="visitAddress" readonly placeholder="Mendeteksi lokasi..."
                            class="w-full px-5 py-3.5 rounded-2xl border border-gray-200 bg-gray-50 text-gray-500 font-medium outline-none">
                        <input type="hidden" name="latitude" id="lat">
                        <input type="hidden" name="longitude" id="lng">
                    </div>

                    <div class="space-y-2">
                        <label class="block text-sm font-bold text-gray-700 ml-1">Produk Ditawarkan</label>
                        <select name="product" required
                            class="w-full px-5 py-3.5 rounded-2xl border border-gray-200 focus:ring-2 focus:ring-[#ed1c24] outline-none transition-all appearance-none bg-no-repeat bg-[right_1.5rem_center]">
                            <option value="">Pilih Produk</option>
                            <option value="IndiHome">IndiHome</option>
                            <option value="Orbit">Orbit</option>
                            <option value="Telkomsel Halo">Telkomsel Halo</option>
                            <option value="PraBayar">PraBayar</option>
                            <option value="Corporate">Corporate Solution</option>
                        </select>
                    </div>

                    <div class="space-y-2">
                        <label class="block text-sm font-bold text-gray-700 ml-1">Catatan Kunjungan</label>
                        <textarea name="notes" rows="4" placeholder="Detail percakapan, kebutuhan customer, dll"
                            class="w-full px-5 py-4 rounded-2xl border border-gray-200 focus:ring-2 focus:ring-[#ed1c24] outline-none transition-all resize-none"></textarea>
                    </div>

                    <div class="space-y-2">
                        <label class="block text-sm font-bold text-gray-700 ml-1">Target Follow Up <span
                                class="text-red-500">*</span></label>
                        <input type="date" name="follow_up_date" id="followUpDate" required
                            class="w-full px-5 py-3.5 rounded-2xl border border-gray-200 focus:ring-2 focus:ring-[#ed1c24] outline-none transition-all">
                        <p class="text-[11px] text-gray-400 italic ml-1">⏰ Maksimal 14 hari untuk konfirmasi pelanggan</p>
                    </div>

                    <div class="space-y-2">
                        <label class="block text-sm font-bold text-gray-700 ml-1">Upload Foto Dokumentasi <span
                                class="text-red-500">*</span></label>
                        <div onclick="document.getElementById('visitPhotoInput').click()"
                            class="group cursor-pointer w-full border-2 border-dashed border-gray-300 rounded-[2rem] p-8 text-center hover:border-[#ed1c24] hover:bg-red-50 transition-all">
                            <div class="text-5xl mb-3 group-hover:scale-110 transition-transform">📷</div>
                            <p class="text-gray-500 font-semibold text-sm">Klik untuk ambil/upload foto kunjungan</p>
                            <input type="file" name="photo" id="visitPhotoInput" accept="image/*" class="hidden"
                                onchange="previewImage(this)">
                        </div>
                        <img id="preview" class="hidden w-full max-h-64 object-cover rounded-2xl mt-4 border shadow-sm">
                    </div>

                    <button type="submit"
                        class="w-full bg-gradient-to-r from-[#ed1c24] to-[#c11219] text-white font-black py-4 rounded-2xl shadow-lg hover:opacity-90 active:scale-[0.98] transition-all uppercase tracking-widest mt-6">
                        Simpan Kunjungan
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Preview Foto
        function previewImage(input) {
            const preview = document.getElementById('preview');
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = e => {
                    preview.src = e.target.result;
                    preview.classList.remove('hidden');
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        // Geolocation
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(position => {
                const lat = position.coords.latitude;
                const lng = position.coords.longitude;
                document.getElementById('lat').value = lat;
                document.getElementById('lng').value = lng;
                document.getElementById('visitAddress').value = "Koordinat: " + lat.toFixed(6) + ", " + lng.toFixed(
                    6);
            });
        }

        // Set limit tanggal follow up (max 14 hari)
        const today = new Date().toISOString().split('T')[0];
        const maxDate = new Date();
        maxDate.setDate(maxDate.getDate() + 14);
        const maxDateStr = maxDate.toISOString().split('T')[0];

        const dateInput = document.getElementById('followUpDate');
        dateInput.min = today;
        dateInput.max = maxDateStr;

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
