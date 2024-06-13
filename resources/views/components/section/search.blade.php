{{-- Searching --}}
<form action="{{ $url }}" method="get">
    <div class="relative mx-3 ">
        <span class="absolute inset-y-0 left-0 flex items-center pl-3">
            <svg class="w-3 h-3  md:w-4 md:h-4 text-gray-500" viewBox="0 0 24 24" fill="none">
                <path
                    d="M21 21L15 15M17 10C17 13.866 13.866 17 10 17C6.13401 17 3 13.866 3 10C3 6.13401 6.13401 3 10 3C13.866 3 17 6.13401 17 10Z"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                </path>
            </svg>
        </span>

        <input
            class="form-input w-36 pl-7 pr-1 pt-1 pb-1 text-xs md:pl-9 md:pr-4  md:text-sm  sm:w-64 focus:ring-0 focus:border-indigo-600 border border-gray-500 rounded-md"
            name="search" value="{{ request('search') }}" type="text" placeholder="{{ $placeholder }}">
    </div>
</form>
