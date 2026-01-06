<header class="bg-gradient-to-r from-[#ed1c24] to-[#c11219] text-white shadow-lg">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <div class="flex flex-col md:flex-row justify-between items-center gap-4">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 bg-white rounded-xl flex items-center justify-center shadow-inner">
                    <span class="text-[#ed1c24] text-2xl font-black">T</span>
                </div>
                <div>
                    <h1 class="text-2xl font-bold leading-tight">Telkom Sales Tracker</h1>
                    <p class="text-xs opacity-80 tracking-wide uppercase">Real-time Monitoring System</p>
                </div>
            </div>

            <div class="flex items-center gap-6 bg-black/10 p-3 rounded-2xl backdrop-blur-sm border border-white/10">
                <div class="text-right">
                    <div id="currentUserName" class="text-sm font-bold block">{{ Auth::user()->name ?? 'User' }}</div>
                    <div id="currentUserRole"
                        class="text-[10px] opacity-80 uppercase tracking-tighter bg-white/20 px-2 py-0.5 rounded mt-1 inline-block">
                        {{ Auth::user()->role ?? 'Role' }}
                    </div>
                </div>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit"
                        class="bg-white text-[#ed1c24] px-5 py-2 rounded-xl text-xs font-bold hover:bg-gray-100 transition-all shadow-md active:scale-95">
                        LOGOUT
                    </button>
                </form>
            </div>
        </div>
    </div>
</header>

<nav class="bg-white border-b sticky top-0 z-30 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 overflow-x-auto">
    <div class="flex space-x-8 py-4 whitespace-nowrap">
        <a href="{{ route('dashboard') }}" 
           class="{{ request()->routeIs('dashboard') ? 'text-[#ed1c24] border-b-2 border-[#ed1c24] font-bold' : 'text-gray-500 hover:text-[#ed1c24] font-medium' }} pb-4 px-1 text-sm transition-colors">
           Dashboard
        </a>

        <a href="{{ route('presence') }}" 
           class="{{ request()->routeIs('presence.*') ? 'text-[#ed1c24] border-b-2 border-[#ed1c24] font-bold' : 'text-gray-500 hover:text-[#ed1c24] font-medium' }} pb-4 px-1 text-sm transition-colors">
           Absensi
        </a>

        <a href="{{ route('visit') }}" 
           class="{{ request()->routeIs('visit.*') ? 'text-[#ed1c24] border-b-2 border-[#ed1c24] font-bold' : 'text-gray-500 hover:text-[#ed1c24] font-medium' }} pb-4 px-1 text-sm transition-colors">
           Tambah Visit
        </a>

        <a href="{{ route('deals') }}" 
           class="{{ request()->routeIs('deals.*') ? 'text-[#ed1c24] border-b-2 border-[#ed1c24] font-bold' : 'text-gray-500 hover:text-[#ed1c24] font-medium' }} pb-4 px-1 text-sm transition-colors">
           Deal Closing
        </a>

        <a href="{{ route('history') }}" 
           class="{{ request()->routeIs('history.*') ? 'text-[#ed1c24] border-b-2 border-[#ed1c24] font-bold' : 'text-gray-500 hover:text-[#ed1c24] font-medium' }} pb-4 px-1 text-sm transition-colors">
           History
        </a>
    </div>
</div>
</nav>
