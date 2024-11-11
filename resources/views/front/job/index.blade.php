<x-app-layout>
    @if (!auth()->user())
        @include('layouts.front-navigation')
    @endif
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Search Bar -->
            <div class="mb-8 relative">
                <form action="{{ route('applicant.job.index') }}" method="GET">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari lowongan pekerjaan..."
                        class="w-full px-6 py-4 rounded-full shadow-sm border-0 focus:ring-2 focus:ring-blue-500 transition duration-300">
                    <button type="submit"
                        class="absolute right-4 top-1/2 transform -translate-y-1/2 bg-blue-600 text-white px-6 py-2 rounded-full hover:bg-blue-700 transition duration-300">
                        Cari
                    </button>
                </form>
            </div>

            <div class="bg-white/80 backdrop-blur-sm overflow-hidden shadow-xl sm:rounded-2xl p-8">
                <div class="flex justify-between items-center mb-8">
                    <h2 class="text-3xl font-bold text-gray-800">Daftar Pekerjaan</h2>
                    <div class="flex gap-4">
                        <button class="text-gray-500 hover:text-gray-700 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 4h13M3 8h9m-9 4h6m4 0l4-4m0 0l4 4m-4-4v12" />
                            </svg>
                        </button>
                        <button class="text-gray-500 hover:text-gray-700 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                        </button>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @forelse ($jobs as $job)
                        <div
                            class="group bg-white p-6 rounded-xl shadow-md hover:shadow-xl transform hover:-translate-y-1 transition duration-300 border border-gray-100">
                            <div class="flex justify-between items-start mb-4">
                                <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <span class="px-3 py-1 text-sm text-green-600 bg-green-100 rounded-full">Full
                                    Time</span>
                            </div>

                            <h3 class="text-xl font-bold text-gray-800 mb-2 group-hover:text-blue-600 transition">
                                {{ $job->title }}
                            </h3>
                            <p class="text-sm text-gray-600 mb-2">{{ $job->position->name }}</p>
                            <p class="text-sm text-gray-500 mb-4">{{ $job->code }}</p>

                            <div class="flex items-center gap-4 mb-4">
                                <span class="flex items-center text-gray-500 text-sm">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                    Jakarta
                                </span>
                                <span class="flex items-center text-gray-500 text-sm">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    Full Time
                                </span>
                            </div>

                            <div class="flex justify-between items-center pt-4 border-t border-gray-100">
                                <span class="text-blue-600 font-bold">Rp. 10.000.000</span>
                                <a href="{{ route('applicant.job.show', $job) }}"
                                    class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-300 text-sm font-semibold">
                                    Selengkapnya
                                </a>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full text-center py-12">
                            <div class="text-gray-500 text-lg font-semibold mb-4">Tidak ada lowongan kerja yang
                                ditemukan</div>
                            <p class="text-gray-400 mb-6">Silakan coba pencarian dengan kata kunci lain atau periksa
                                kembali nanti.</p>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto text-gray-300"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    @endforelse
                </div>

                <!-- Pagination -->
                <div class="mt-12">
                    {{ $jobs->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
