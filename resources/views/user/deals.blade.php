@extends('layouts.app')

@section('container')
    <div class="min-h-screen bg-[#ed1c24] pb-12">
        <div class="max-w-4xl mx-auto px-4 pt-8">
            <div class="bg-white rounded-[2.5rem] shadow-2xl overflow-hidden">

                {{-- Header --}}
                <div class="bg-gradient-to-r from-[#ed1c24] to-[#c11219] p-8 text-center text-white">
                    <h1 class="text-3xl font-black uppercase tracking-tight">Form Deal Closing</h1>
                    <p class="text-sm opacity-90 mt-1 italic">Instalasi Baru Pelanggan Telkom</p>
                </div>

                {{-- Update route ke deals.store --}}
                <form action="{{ route('deals.store') }}" method="POST" enctype="multipart/form-data"
                    class="p-8 sm:p-12 space-y-8">
                    @csrf

                    {{-- Section 1: Informasi Sales & Branch --}}
                    <div class="space-y-4">
                        <h3 class="text-lg font-bold text-gray-800 border-b pb-2 flex items-center">
                            <span class="mr-2">📋</span> Informasi Sales & Branch
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label class="block text-sm font-bold text-gray-700 ml-1">Branch Instalasi <span class="text-red-500">*</span></label>
                                <select name="branch" required
                                    class="w-full px-5 py-3.5 rounded-2xl border border-gray-200 focus:ring-2 focus:ring-[#ed1c24] outline-none transition-all appearance-none bg-white">
                                    <option value="">-- Pilih Branch --</option>
                                    @foreach(['Tandes', 'Surabaya Pusat', 'Surabaya Timur', 'Surabaya Barat', 'Surabaya Selatan'] as $branch)
                                        <option value="{{ $branch }}" {{ old('branch') == $branch ? 'selected' : '' }}>{{ $branch }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="space-y-2">
                                <label class="block text-sm font-bold text-gray-700 ml-1">Jenis Layanan <span class="text-red-500">*</span></label>
                                <select name="service" required
                                    class="w-full px-5 py-3.5 rounded-2xl border border-gray-200 focus:ring-2 focus:ring-[#ed1c24] outline-none transition-all appearance-none bg-white">
                                    <option value="">-- Pilih Jenis Layanan --</option>
                                    @foreach(['IndiHome 20 Mbps', 'IndiHome 30 Mbps', 'IndiHome 50 Mbps', 'IndiHome 100 Mbps', 'Astinet', 'Metro Ethernet', 'VPN IP', 'Wifi Corner', 'Dedicated Internet'] as $svc)
                                        <option value="{{ $svc }}" {{ old('service') == $svc ? 'selected' : '' }}>{{ $svc }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    {{-- Section 2: Data Usaha & Lokasi --}}
                    <div class="space-y-4">
                        <h3 class="text-lg font-bold text-gray-800 border-b pb-2 flex items-center">
                            <span class="mr-2">🏢</span> Data Usaha & Lokasi
                        </h3>
                        <div class="space-y-2">
                            <label class="block text-sm font-bold text-gray-700 ml-1">Nama Usaha/Perusahaan <span class="text-red-500">*</span></label>
                            <input type="text" name="business_name" value="{{ old('business_name') }}" placeholder="Nama usaha/perusahaan" required
                                class="w-full px-5 py-3.5 rounded-2xl border border-gray-200 focus:ring-2 focus:ring-[#ed1c24] outline-none transition-all">
                        </div>
                        <div class="space-y-2">
                            <label class="block text-sm font-bold text-gray-700 ml-1">Alamat Lengkap <span class="text-red-500">*</span></label>
                            <textarea name="address" rows="3" placeholder="Alamat lengkap lokasi instalasi" required
                                class="w-full px-5 py-4 rounded-2xl border border-gray-200 focus:ring-2 focus:ring-[#ed1c24] outline-none transition-all resize-none">{{ old('address') }}</textarea>
                        </div>
                        <div class="space-y-2">
                            <label class="block text-sm font-bold text-gray-700 ml-1">Titik Koordinat <span class="text-green-500">●</span> GPS Terdeteksi</label>
                            <input type="text" name="coordinates" id="dealCoordinates" value="{{ old('coordinates') }}" readonly placeholder="Mendeteksi koordinat..."
                                class="w-full px-5 py-3.5 rounded-2xl border border-gray-200 bg-gray-50 text-gray-500 font-medium outline-none">
                        </div>
                    </div>

                    {{-- Section 3: Data PIC --}}
                    <div class="space-y-4">
                        <h3 class="text-lg font-bold text-gray-800 border-b pb-2 flex items-center">
                            <span class="mr-2">👤</span> Data Person In Charge (PIC)
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label class="block text-sm font-bold text-gray-700 ml-1">Nama PIC <span class="text-red-500">*</span></label>
                                <input type="text" name="pic_name" value="{{ old('pic_name') }}" placeholder="Nama lengkap PIC" required
                                    class="w-full px-5 py-3.5 rounded-2xl border border-gray-200 focus:ring-2 focus:ring-[#ed1c24] outline-none transition-all">
                            </div>
                            <div class="space-y-2">
                                <label class="block text-sm font-bold text-gray-700 ml-1">Nomor Telepon <span class="text-red-500">*</span></label>
                                <input type="tel" name="pic_phone" value="{{ old('pic_phone') }}" placeholder="08xxxxxxxxxx" required
                                    class="w-full px-5 py-3.5 rounded-2xl border border-gray-200 focus:ring-2 focus:ring-[#ed1c24] outline-none transition-all">
                            </div>
                            <div class="space-y-2">
                                <label class="block text-sm font-bold text-gray-700 ml-1">Email Pelanggan <span class="text-red-500">*</span></label>
                                <input type="email" name="email" value="{{ old('email') }}" placeholder="email@example.com" required
                                    class="w-full px-5 py-3.5 rounded-2xl border border-gray-200 focus:ring-2 focus:ring-[#ed1c24] outline-none transition-all">
                            </div>
                            <div class="space-y-2">
                                <label class="block text-sm font-bold text-gray-700 ml-1">NIK PIC <span class="text-red-500">*</span></label>
                                <input type="text" name="nik" value="{{ old('nik') }}" maxlength="16" placeholder="16 digit NIK" required
                                    class="w-full px-5 py-3.5 rounded-2xl border border-gray-200 focus:ring-2 focus:ring-[#ed1c24] outline-none transition-all">
                            </div>
                        </div>
                    </div>

                    {{-- Section 4: Upload Dokumen --}}
                    <div class="space-y-4">
                        <h3 class="text-lg font-bold text-gray-800 border-b pb-2 flex items-center">
                            <span class="mr-2">📄</span> Dokumen Pendukung
                        </h3>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label class="block text-sm font-bold text-gray-700 ml-1">Foto KTP PIC <span class="text-red-500">*</span></label>
                                <div onclick="document.getElementById('ktpInput').click()"
                                    class="group cursor-pointer w-full border-2 border-dashed border-gray-300 rounded-3xl p-6 text-center hover:border-[#ed1c24] hover:bg-red-50 transition-all">
                                    <div class="text-3xl mb-2">🆔</div>
                                    <p class="text-gray-500 text-xs font-semibold">Upload KTP</p>
                                    <input type="file" name="ktp_photo" id="ktpInput" accept="image/*" class="hidden" onchange="previewFile(this, 'previewKtp')">
                                </div>
                                <img id="previewKtp" class="hidden w-full h-32 object-cover rounded-2xl mt-2 border">
                            </div>
                            <div class="space-y-2">
                                <label class="block text-sm font-bold text-gray-700 ml-1">Foto Lokasi <span class="text-red-500">*</span></label>
                                <div onclick="document.getElementById('buildingInput').click()"
                                    class="group cursor-pointer w-full border-2 border-dashed border-gray-300 rounded-3xl p-6 text-center hover:border-[#ed1c24] hover:bg-red-50 transition-all">
                                    <div class="text-3xl mb-2">🏢</div>
                                    <p class="text-gray-500 text-xs font-semibold">Upload Bangunan</p>
                                    <input type="file" name="building_photo" id="buildingInput" accept="image/*" class="hidden" onchange="previewFile(this, 'previewBuilding')">
                                </div>
                                <img id="previewBuilding" class="hidden w-full h-32 object-cover rounded-2xl mt-2 border">
                            </div>
                        </div>

                        <div class="space-y-2">
                            <label class="block text-sm font-bold text-gray-700 ml-1">Dokumen Tambahan (NPWP/SIUP) <span class="text-gray-400 font-normal">(Opsional)</span></label>
                            <div onclick="document.getElementById('supportDocInput').click()"
                                class="group cursor-pointer w-full border-2 border-dashed border-gray-300 rounded-3xl p-6 text-center hover:border-[#ed1c24] hover:bg-red-50 transition-all">
                                <div class="text-3xl mb-2">📋</div>
                                <p class="text-gray-500 text-xs font-semibold">Klik untuk upload dokumen (JPG, PNG, PDF)</p>
                                <input type="file" name="support_doc" id="supportDocInput" accept="image/*,application/pdf" class="hidden" onchange="previewSupportFile(this)">
                            </div>
                            <div id="supportDocPreviewArea" class="hidden mt-2 p-4 bg-gray-50 rounded-2xl border flex items-center justify-between">
                                <div class="flex items-center space-x-3">
                                    <span id="docIcon" class="text-2xl">📄</span>
                                    <span id="docName" class="text-sm font-medium text-gray-600 truncate max-w-[200px]"></span>
                                </div>
                                <button type="button" onclick="removeSupportFile()" class="text-red-500 font-bold text-sm">Hapus</button>
                            </div>
                        </div>

                        <div class="space-y-2">
                            <label class="block text-sm font-bold text-gray-700 ml-1">Catatan Tambahan</label>
                            <textarea name="notes" rows="2" placeholder="Informasi tambahan lainnya..."
                                class="w-full px-5 py-4 rounded-2xl border border-gray-200 focus:ring-2 focus:ring-[#ed1c24] outline-none transition-all resize-none">{{ old('notes') }}</textarea>
                        </div>
                    </div>

                    <button type="submit"
                        class="w-full bg-gradient-to-r from-[#ed1c24] to-[#c11219] text-white font-black py-4 rounded-2xl shadow-lg hover:opacity-90 active:scale-[0.98] transition-all uppercase tracking-widest mt-6">
                        Submit Deal Closing
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Preview Function & Geolocation sama seperti sebelumnya...
        function previewFile(input, previewId) {
            const preview = document.getElementById(previewId);
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = e => {
                    preview.src = e.target.result;
                    preview.classList.remove('hidden');
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        function previewSupportFile(input) {
            const area = document.getElementById('supportDocPreviewArea');
            const nameLabel = document.getElementById('docName');
            const iconLabel = document.getElementById('docIcon');
            if (input.files && input.files[0]) {
                const file = input.files[0];
                nameLabel.textContent = file.name;
                iconLabel.textContent = file.type === 'application/pdf' ? '📕' : '🖼️';
                area.classList.remove('hidden');
            }
        }

        function removeSupportFile() {
            document.getElementById('supportDocInput').value = '';
            document.getElementById('supportDocPreviewArea').classList.add('hidden');
        }

        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(position => {
                const lat = position.coords.latitude;
                const lng = position.coords.longitude;
                const coordStr = lat.toFixed(6) + ", " + lng.toFixed(6);
                // Hanya isi koordinat jika old() kosong (agar tidak menimpa data manual jika ada)
                const coordInput = document.getElementById('dealCoordinates');
                if(!coordInput.value) coordInput.value = coordStr;
            });
        }

        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 4000,
            timerProgressBar: true
        });

        @if (session('success'))
            Toast.fire({ icon: 'success', title: "{{ session('success') }}" });
        @endif

        @if ($errors->any())
            Toast.fire({ 
                icon: 'error', 
                title: "Validasi Gagal",
                text: "{{ $errors->first() }}" 
            });
        @endif
    </script>
@endsection