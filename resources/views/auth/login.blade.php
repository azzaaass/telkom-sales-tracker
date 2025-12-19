@extends('layouts.app')

@section('container')
    <div class="min-h-screen bg-[#ed1c24] flex items-center justify-center p-4">
        <div class="w-full max-w-[450px] bg-white rounded-[25px] overflow-hidden shadow-2xl">

            <div class="bg-gradient-to-b from-[#ed1c24] to-[#c11219] p-10 text-center text-white relative">
                <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center mx-auto mb-6 shadow-lg">
                    <span class="text-[#ed1c24] text-3xl font-bold">T</span>
                </div>
                <h1 class="text-3xl font-bold mb-2">Telkom Sales Tracker</h1>
                <p class="text-sm opacity-90">Sistem Monitoring Sales Real-time</p>
            </div>

            <div class="p-10">
                @if (session('success'))
                    <div class="mb-4 p-3 rounded-lg bg-green-100 text-green-600 text-sm border border-green-200">
                        {{ session('success') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="mb-4 p-3 rounded-lg bg-red-100 text-red-600 text-sm border border-red-200">
                        {{ $errors->first('username') }}
                    </div>
                @endif

                <form action="{{ route('login') }}" method="POST" class="space-y-5">
                    @csrf
                    
                    <div class="space-y-2">
                        <label class="block text-sm font-semibold text-gray-700">Username</label>
                        <input type="text" name="username" value="{{ old('username') }}" placeholder="Masukkan username" required
                            class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-[#ed1c24] focus:border-transparent outline-none transition-all placeholder:text-gray-400">
                    </div>

                    <div class="space-y-2">
                        <label class="block text-sm font-semibold text-gray-700">Password</label>
                        <input type="password" name="password" placeholder="Masukkan password" required
                            class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-[#ed1c24] focus:border-transparent outline-none transition-all placeholder:text-gray-400">
                    </div>

                    <button type="submit"
                        class="w-full bg-gradient-to-r from-[#ed1c24] to-[#c11219] text-white font-bold py-3.5 rounded-xl shadow-lg hover:opacity-90 active:scale-[0.98] transition-all mt-4">
                        LOGIN
                    </button>

                    <div class="text-center pt-6 space-y-4">
                        <p class="text-gray-500 text-sm">Belum punya akun?</p>
                        <a href="{{ route('register') }}"
                            class="inline-block px-8 py-2.5 border-2 border-[#ed1c24] text-[#ed1c24] font-bold rounded-xl hover:bg-[#ed1c24] hover:text-white transition-all text-sm">
                            Buat Akun Baru
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection