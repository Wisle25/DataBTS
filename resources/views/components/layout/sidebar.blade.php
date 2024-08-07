<div class="bg-violet-100">
    <div :class="sidebarOpen ? 'block' : 'hidden'" @click="sidebarOpen = false" class="fixed inset-0 z-20 transition-opacity bg-black opacity-50 lg:hidden"></div>

    <div :class="sidebarOpen ? 'translate-x-0 ease-out' : '-translate-x-full ease-in'" class="fixed inset-y-0 left-0 z-30 w-64 overflow-y-auto transition duration-300 transform bg-violet-100 lg:translate-x-0 lg:static lg:inset-0">

        {{-- SIDEBAR TITLE --}}
        <div class="flex items-center justify-center mt-4">
            <div class="flex items-center">
                <span class="mx-2 text-2xl font-semibold text-gray-700 drop-shadow font-nunito">
                    Master Data BTS
                </span>
            </div>
        </div>

        <nav class="mt-8">
            {{-- SIDEBAR HOME --}}
            <a class="flex items-center px-6 py-2 mt-4 {{ request()->is('/') ? 'bg-opacity-25 text-violet-700 font-bold' : 'text-gray-700 hover:bg-violet-200 hover:bg-opacity-25 hover:text-violet-700 font-semibold' }}" href="/">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
                </svg>
                <span class="mx-3">Home</span>
            </a>

            {{-- SIDEBAR DASHBOARD --}}
            @auth
            @if (auth()->user()->peran=="Administrator" || auth()->user()->peran == "PIC")
            <a class="flex items-center px-6 py-2 mt-4 {{ request()->is('dashboard') ? 'bg-opacity-25 text-violet-700 font-bold' : 'text-gray-700 hover:bg-violet-200 hover:bg-opacity-25 hover:text-violet-700 font-semibold' }}" href="/dashboard">
                <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"></path>
                </svg>
                <span class="mx-3">Dashboard</span>
            </a>
            @endif
            @endauth

            {{-- SIDEBAR BTS --}}
            <a class="flex items-center px-6 py-2 mt-4 {{ request()->is('bts') ? 'bg-opacity-25 text-violet-700 font-bold' : 'text-gray-700 hover:bg-violet-200 hover:bg-opacity-25 hover:text-violet-700 font-semibold' }}" href="/bts">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9.348 14.652a3.75 3.75 0 0 1 0-5.304m5.304 0a3.75 3.75 0 0 1 0 5.304m-7.425 2.121a6.75 6.75 0 0 1 0-9.546m9.546 0a6.75 6.75 0 0 1 0 9.546M5.106 18.894c-3.808-3.807-3.808-9.98 0-13.788m13.788 0c3.808 3.807 3.808 9.98 0 13.788M12 12h.008v.008H12V12Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                </svg>
                <span class="mx-3">BTS</span>
            </a>

            {{-- SIDEBAR MONITORING --}}
            @auth
            @if (auth()->user()->peran=="Administrator" || auth()->user()->peran=="PIC" || auth()->user()->peran=="Surveyor")
            <a class="flex items-center px-6 py-2 mt-4 {{ request()->is('monitoring') ? 'bg-opacity-25 text-violet-700 font-bold' : 'text-gray-700 hover:bg-violet-200 hover:bg-opacity-25 hover:text-violet-700 font-semibold' }}" href="/monitoring">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 14.25v2.25m3-4.5v4.5m3-6.75v6.75m3-9v9M6 20.25h12A2.25 2.25 0 0 0 20.25 18V6A2.25 2.25 0 0 0 18 3.75H6A2.25 2.25 0 0 0 3.75 6v12A2.25 2.25 0 0 0 6 20.25Z" />
                </svg>

                <span class="mx-3">Monitoring</span>
            </a>
            @endif
            @endauth

            {{-- SIDEBAR KUESIONER --}}
            @auth
            <a class="flex items-center px-6 py-2 mt-4 {{ request()->is('kuesioner') ? 'bg-opacity-25 text-violet-700 font-bold' : 'text-gray-700 hover:bg-violet-200 hover:bg-opacity-25 hover:text-violet-700 font-semibold' }}" href="/kuesioner">
                <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                    </path>
                </svg>
                <span class="mx-3">Kuesioner</span>
            </a>
            @endauth

            {{-- SIDEBAR USERS --}}
            @auth
            @if (auth()->user()->peran=="Administrator")
            <a class="flex items-center px-6 py-2 mt-4 {{ request()->is('pengguna') ? 'bg-opacity-25 text-violet-700 font-bold' : 'text-gray-700 hover:bg-violet-200 hover:bg-opacity-25 hover:text-violet-700 font-semibold' }}" href="/pengguna">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                </svg>

                <span class="mx-3">Users</span>
            </a>
            @endif
            @endauth
        </nav>
    </div>
</div>