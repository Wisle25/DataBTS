<header class="flex items-center justify-between px-6 py-4 bg-white border-b-4 border-violet-500">
    <div class="flex items-center">
        <button @click="sidebarOpen = true" class="text-gray-500 focus:outline-none lg:hidden">
            <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M4 6H20M4 12H20M4 18H11" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round"></path>
            </svg>
        </button>

        
    </div>

    <div class="flex items-center">
        @if (Auth::check())
        <div x-data="{ dropdownOpen: false }" class="relative">
            <button @click="dropdownOpen = !dropdownOpen"
                :class="dropdownOpen ? 'bg-violet-200 text-violet-600' :
                    'transition delay-150 hover:bg-violet-200 hover:text-violet-600'"
                class="font-medium rounded-md text-sm md:text-base px-3 py-1 mx-1 sm:mx-6 transition delay-150">
                <!-- Zasxy -->
                {{ "Hello," . Auth::user()->username . "!" }}
            </button>

            <div x-show="dropdownOpen" @click="dropdownOpen = false" class="fixed inset-0 z-10 w-full h-full"
                style="display: none;"></div>

            <div x-show="dropdownOpen" @click.away="dropdownOpen = false"
                class="absolute right-0 z-10 w-40 md:mr-5 mt-2 overflow-hidden bg-white rounded-md shadow-xl divide-y divide-gray-300"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="transform opacity-0 scale-95"
                x-transition:enter-end="transform opacity-100 scale-100"
                x-transition:leave="transition ease-in duration-75"
                x-transition:leave-start="transform opacity-100 scale-100"
                x-transition:leave-end="transform opacity-0 scale-95">
                <a href="{{ route('profile') }}" class="flex px-4 py-1 text-sm text-gray-700 hover:bg-indigo-600 hover:text-white transition delay-50">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                    </svg>
                    <p class="mx-3 mt-0.5">
                        Profile
                    </p>
                </a>
                <a href="#" class="flex px-4 py-1 text-sm text-gray-700 hover:bg-red-600 hover:text-white transition delay-50" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15M12 9l-3 3m0 0 3 3m-3-3h12.75" />
                    </svg>
                    <p class="mx-3 mt-0.5">Logout</p>
                </a>

                <form id="logout-form" action="{{ route('auth.logout') }}" method="POST" style="display: none;">
                    @csrf
                    @method('DELETE')
                </form>
            </div>
        </div>
        @else
            <div class="flex items-center space-x-4">
                <a href="{{ route('login') }}" class="text-gray-700 hover:text-gray-900">Login</a>
                <a href="{{ route('register') }}" class="text-gray-700 hover:text-gray-900">Register</a>
            </div>
        @endif
    </div>
</header>
