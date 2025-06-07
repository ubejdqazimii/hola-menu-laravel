<x-guest-layout>
    {{-- HEADER --}}


    <div
        class="w-full h-60 bg-cover bg-center mb-6"
        style="background-image: url('{{ asset('images/cover.png') }}');"
    ></div>

    <div class="relative -mt-12 z-10">
        <div class="bg-secondary-450 rounded-t-3xl pt-16 ">
            <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
                <div class="text-center  ">
                    <h1 class="text-4xl font-black text-center">
                        Hola Cafe
                    </h1>
                    <p class="text-lg font-semibold">Self Service</p>
                    <p>
                        <a href="https://instagram.com/holacafemk"
                           target="_blank" rel="noopener"
                           class="inline-flex items-center text-primary-500 hover:text-primary-600">
                            {{-- Insta Icon --}}
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" fill="currentColor"
                                 viewBox="0 0 24 24">
                                <path
                                    d="M7.75 2h8.5A5.75 5.75 0 0122 7.75v8.5A5.75 5.75 0 0116.25 22h-8.5A5.75 5.75 0 012 16.25v-8.5A5.75 5.75 0 017.75 2zm0 1.5A4.25 4.25 0 003.5 7.75v8.5A4.25 4.25 0 007.75 20.5h8.5a4.25 4.25 0 004.25-4.25v-8.5A4.25 4.25 0 0016.25 3.5h-8.5zM12 7a5 5 0 100 10 5 5 0 000-10zm4.75-.75a1 1 0 11-2 0 1 1 0 012 0z"/>
                            </svg>
                            @holacafemk
                        </a>
                    </p>
                </div>
                <form method="GET" action="{{ route('home') }}">
                <div class="bg-secondary-450 rounded-t-3xl  pb-5 px-4 sm:px-6 lg:px-8">
                    <div class="mt-6 max-w-md mx-auto relative">
            <span class="absolute inset-y-0 left-4 flex items-center text-secondary-450">
             <svg xmlns="http://www.w3.org/2000/svg"
                  class="w-5 h-5"
                  fill="none" viewBox="0 0 24 24"
                  stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M21 21l-4.35-4.35M5.5 11
                     a5.5 5.5 0 1111 0 5.5 5.5 0 01-11 0z"/>
          </svg>
        </span>
                        <input
                            type="text"
                            name="search"
                            placeholder="Search"
                            value="{{ request('search') }}"
                            class="w-full pl-12 pr-4 py-3 bg-primary-500 text-secondary-450
                 placeholder-secondary-450 rounded-lg border-0 focus:outline-none focus:ring-0"
                        >
                    </div>
                </div>
                </form>
                <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
                    @if(isset($items))
                        {{-- SEARCH RESULTS: menu items --}}
                        <h2 class="text-3xl font-extrabold text-primary-500">
                            Results for “{{ $search }}”
                        </h2>

                        <div class="flex flex-col space-y-8">
                            @forelse($items as $item)
                                <a href="#" class="block w-full rounded-2xl overflow-hidden shadow-lg transform transition hover:-translate-y-1">
                                    <div class="w-full h-32 sm:h-40 md:h-48 overflow-hidden">
                                        <img src="{{ $item->image_url ?? asset('images/default-cat.jpg') }}"
                                             alt="{{ $item->name }}"
                                             class="w-full h-full object-cover">
                                    </div>
                                    <div class="px-6 py-4 bg-primary-500 rounded-b-2xl">
                                        <h3 class="text-2xl font-semibold text-secondary-450">{{ $item->name }}</h3>
                                        @if($item->description)
                                            <p class="mt-2 text-secondary-450">{{ $item->description }}</p>
                                        @endif
                                        <div class="mt-4 flex items-center justify-between">
                                            <span class="text-lg font-bold text-secondary-450">{{ number_format($item->price,2) }}ден</span>
                                            @unless($item->is_available)
                                                <span class="px-2 py-1 bg-gray-300 text-gray-700 rounded-full text-xs">Unavailable</span>
                                            @endunless
                                        </div>
                                    </div>
                                </a>
                            @empty
                                <p class="text-center text-primary-500">No items match your search.</p>
                            @endforelse
                        </div>

                        {{-- pagination --}}
                        <div class="mt-8 flex justify-center">
                            {{ $items->links('pagination::tailwind') }}
                        </div>

                    @else
                        {{-- DEFAULT: categories grid --}}
                        <h2 class="sr-only">Categories</h2>
                        <div class="flex flex-col space-y-8">
                            @forelse($categories as $category)
                                <a href="{{ route('categories.show', $category) }}"
                                   class="block w-full rounded-2xl overflow-hidden shadow-lg transform transition hover:-translate-y-1">
                                    <div class="w-full h-32 sm:h-48 md:h-64 bg-cover bg-center"
                                         style="background-image: url('{{ $category->image_url ?? asset('images/default-cat.jpg') }}')">
                                        <div class="absolute inset-0 bg-primary-500"></div>
                                        <h3 class="absolute inset-0 flex items-center justify-center text-secondary-450 text-2xl font-semibold">
                                            {{ $category->name }}
                                        </h3>
                                    </div>
                                </a>
                            @empty
                                <p class="text-center text-gray-500">No categories found.</p>
                            @endforelse
                        </div>

                        {{-- pagination --}}
                        <div class="mt-8 flex justify-center">
                            {{ $categories->links('pagination::tailwind') }}
                        </div>
                    @endif
                </div>
</x-guest-layout>
