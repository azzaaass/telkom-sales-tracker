@extends('layouts.app')

@section('container')
<div class="min-h-screen bg-[#ed1c24] flex items-center justify-center p-6">
    <div class="w-full max-w-[500px] bg-white rounded-[30px] overflow-hidden shadow-2xl my-10">
        
        <div class="bg-gradient-to-b from-[#ed1c24] to-[#c11219] p-8 text-center text-white relative">
            <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center mx-auto mb-4 shadow-lg">
                <span class="text-[#ed1c24] text-3xl font-bold">T</span>
            </div>
            <h1 class="text-3xl font-bold mb-1">Buat Akun Baru</h1>
            <p class="text-sm opacity-90 italic">Daftar sebagai Sales Telkom</p>
        </div>

        <div class="p-8 sm:p-10">
            @if ($errors->any())
                <div class="mb-6 p-3 rounded-xl bg-red-100 text-red-600 text-sm border border-red-200">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('register.store') }}" method="POST" class="space-y-5">
                @csrf
                
                <div class="space-y-1.5">
                    <label class="block text-sm font-semibold text-gray-700">Nama Lengkap <span class="text-red-500">*</span></label>
                    <input type="text" name="fullname" value="{{ old('name') }}" placeholder="Masukkan nama lengkap" required
                        class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-[#ed1c24] outline-none text-sm">
                </div>

                <div class="space-y-1.5">
                    <label class="block text-sm font-semibold text-gray-700">Username <span class="text-red-500">*</span></label>
                    <input type="text" name="username" value="{{ old('username') }}" placeholder="Pilih username" required
                        class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-[#ed1c24] outline-none text-sm">
                </div>

                <div class="space-y-1.5">
                    <label class="block text-sm font-semibold text-gray-700">Password <span class="text-red-500">*</span></label>
                    <input type="password" name="password" placeholder="Min. 6 karakter" required
                        class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-[#ed1c24] outline-none text-sm">
                </div>

                <div class="space-y-1.5">
                    <label class="block text-sm font-semibold text-gray-700">Konfirmasi Password <span class="text-red-500">*</span></label>
                    <input type="password" name="password_confirmation" placeholder="Ketik ulang password" required
                        class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-[#ed1c24] outline-none text-sm">
                </div>

                <div class="space-y-1.5">
                    <label class="block text-sm font-semibold text-gray-700">Nomor Telepon <span class="text-red-500">*</span></label>
                    <input type="tel" name="phone" value="{{ old('phone') }}" placeholder="08xxxxxxxxxx" required
                        class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-[#ed1c24] outline-none text-sm">
                </div>

                <div class="space-y-1.5">
                    <label class="block text-sm font-semibold text-gray-700">Email <span class="text-red-500">*</span></label>
                    <input type="email" name="email" value="{{ old('email') }}" placeholder="email@example.com" required
                        class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-[#ed1c24] outline-none text-sm">
                </div>

                <button type="submit" 
                    class="w-full bg-gradient-to-r from-[#ed1c24] to-[#c11219] text-white font-bold py-3.5 rounded-xl shadow-lg hover:opacity-90 active:scale-[0.98] transition-all mt-6 uppercase">
                    DAFTAR SEKARANG
                </button>
            </form>

            <div class="text-center pt-6 space-y-3">
                <p class="text-gray-500 text-sm">Sudah punya akun?</p>
                <a href="{{ route('login') }}" 
                    class="inline-block px-8 py-2.5 border-2 border-gray-400 text-gray-600 font-bold rounded-xl hover:bg-gray-100 transition-all text-sm">
                    Kembali ke Login
                </a>
            </div>
        </div>
    </div>
</div>
@endsection