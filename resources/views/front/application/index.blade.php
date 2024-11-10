<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Search Bar -->
            <div class="flex justify-between items-center mb-8">
                <div>
                    <h1 class="text-3xl font-bold text-gray-800">Lamaran Saya</h1>
                    <p class="text-gray-600 mt-2">Pantau status lamaran pekerjaan Anda</p>
                </div>
                <div class="flex space-x-4">
                    <select
                        class="rounded-lg border-gray-300 text-gray-700 text-sm focus:ring-blue-500 focus:border-blue-500">
                        <option value="">Semua Status</option>
                        <option value="pending">Pending</option>
                        <option value="reviewed">Direview</option>
                        <option value="interview">Interview</option>
                        <option value="accepted">Diterima</option>
                        <option value="rejected">Ditolak</option>
                    </select>
                    <select
                        class="rounded-lg border-gray-300 text-gray-700 text-sm focus:ring-blue-500 focus:border-blue-500">
                        <option value="">Urutkan</option>
                        <option value="newest">Terbaru</option>
                        <option value="oldest">Terlama</option>
                    </select>
                </div>
            </div>

            <!-- Stats Cards -->
                {{-- <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                    <div class="bg-white rounded-xl p-6 shadow-sm">
                        <div class="flex items-center">
                            <div class="p-3 bg-blue-100 rounded-lg">
                                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2">
                                    </path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-semibold text-gray-700">Total Lamaran</h3>
                                <p class="text-2xl font-bold text-gray-900">12</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-xl p-6 shadow-sm">
                        <div class="flex items-center">
                            <div class="p-3 bg-yellow-100 rounded-lg">
                                <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-semibold text-gray-700">Pending</h3>
                                <p class="text-2xl font-bold text-gray-900">5</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-xl p-6 shadow-sm">
                        <div class="flex items-center">
                            <div class="p-3 bg-green-100 rounded-lg">
                                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                    </path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-semibold text-gray-700">Interview</h3>
                                <p class="text-2xl font-bold text-gray-900">3</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-xl p-6 shadow-sm">
                        <div class="flex items-center">
                            <div class="p-3 bg-purple-100 rounded-lg">
                                <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-semibold text-gray-700">Diterima</h3>
                                <p class="text-2xl font-bold text-gray-900">2</p>
                            </div>
                        </div>
                    </div>
                </div> --}}

            <!-- Applications List -->
            <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-xl overflow-hidden">
                <div class="divide-y divide-gray-100">
                    <!-- Application Item 1 -->
                    {{-- <div class="p-6 hover:bg-gray-50 transition duration-150">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-6">
                                <div class="w-16 h-16 bg-blue-100 rounded-xl flex items-center justify-center">
                                    <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-xl font-semibold text-gray-800">Senior Frontend Developer</h3>
                                    <div class="flex items-center mt-2 space-x-4">
                                        <span class="text-sm text-gray-500">PT Tech Indonesia</span>
                                        <span class="text-sm text-gray-500">•</span>
                                        <span class="text-sm text-gray-500">Jakarta</span>
                                        <span class="text-sm text-gray-500">•</span>
                                        <span class="text-sm text-gray-500">Dilamar 2 hari yang lalu</span>
                                    </div>
                                </div>
                            </div>
                            <div class="flex items-center space-x-4">
                                <span class="px-3 py-1 text-sm text-yellow-600 bg-yellow-100 rounded-full">Sedang
                                    Direview</span>
                                <button class="text-gray-400 hover:text-gray-600">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z">
                                        </path>
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <!-- Progress Timeline -->
                        <div class="mt-6 pl-28">
                            <div class="relative">
                                <div class="absolute left-0 w-full h-0.5 bg-gray-200"></div>
                                <div class="absolute left-0 w-1/3 h-0.5 bg-blue-500"></div>
                                <div class="relative flex justify-between">
                                    <div class="flex flex-col items-center">
                                        <div class="w-6 h-6 bg-blue-500 rounded-full"></div>
                                        <span class="mt-2 text-sm font-medium text-gray-600">Lamaran Terkirim</span>
                                    </div>
                                    <div class="flex flex-col items-center">
                                        <div class="w-6 h-6 bg-blue-500 rounded-full"></div>
                                        <span class="mt-2 text-sm font-medium text-gray-600">Direview</span>
                                    </div>
                                    <div class="flex flex-col items-center">
                                        <div class="w-6 h-6 bg-gray-300 rounded-full"></div>
                                        <span class="mt-2 text-sm font-medium text-gray-400">Interview</span>
                                    </div>
                                    <div class="flex flex-col items-center">
                                        <div class="w-6 h-6 bg-gray-300 rounded-full"></div>
                                        <span class="mt-2 text-sm font-medium text-gray-400">Keputusan</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> --}}

                    <!-- Application Item 2 -->
                    {{-- <div class="p-6 hover:bg-gray-50 transition duration-150">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-6">
                                <div class="w-16 h-16 bg-purple-100 rounded-xl flex items-center justify-center">
                                    <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-xl font-semibold text-gray-800">UI/UX Designer</h3>
                                    <div class="flex items-center mt-2 space-x-4">
                                        <span class="text-sm text-gray-500">Creative Digital Agency</span>
                                        <span class="text-sm text-gray-500">•</span>
                                        <span class="text-sm text-gray-500">Remote</span>
                                        <span class="text-sm text-gray-500">•</span>
                                        <span class="text-sm text-gray-500">Dilamar 1 minggu yang lalu</span>
                                    </div>
                                </div>
                            </div>
                            <div class="flex items-center space-x-4">
                                <span
                                    class="px-3 py-1 text-sm text-green-600 bg-green-100 rounded-full">Interview</span>
                                <button class="text-gray-400 hover:text-gray-600">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z">
                                        </path>
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <!-- Interview Schedule -->
                        <div class="mt-6 pl-28">
                            <div class="bg-green-50 rounded-lg p-4">
                                <div class="flex items-center">
                                    <svg class="w-5 h-5 text-green-500 mr-2" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    <span class="font-medium text-green-800">Interview Dijadwalkan</span>
                                </div>
                                <p class="mt-2 text-green-700">Selasa, 12 November 2024 • 14:00 WIB • Video Call (Zoom)
                                </p>
                            </div>
                        </div>
                    </div> --}}
                    
                    <div class="p-6 hover:bg-gray-50 transition duration-150">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-6">
                                <div class="w-16 h-16 bg-purple-100 rounded-xl flex items-center justify-center">
                                    <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-xl font-semibold text-gray-800">UI/UX Designer</h3>
                                    <div class="flex items-center mt-2 space-x-4">
                                        <span class="text-sm text-gray-500">Creative Digital Agency</span>
                                        <span class="text-sm text-gray-500">•</span>
                                        <span class="text-sm text-gray-500">Remote</span>
                                        <span class="text-sm text-gray-500">•</span>
                                        <span class="text-sm text-gray-500">Dilamar 1 minggu yang lalu</span>
                                    </div>
                                </div>
                            </div>
                            <div class="flex items-center space-x-4">
                                <span
                                    class="px-3 py-1 text-sm text-green-600 bg-green-100 rounded-full">Interview</span>
                                <button class="text-gray-400 hover:text-gray-600">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z">
                                        </path>
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <!-- Interview Schedule -->
                        <div class="mt-6 pl-28">
                            <div class="bg-green-50 rounded-lg p-4">
                                <div class="flex items-center">
                                    <svg class="w-5 h-5 text-green-500 mr-2" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    <span class="font-medium text-green-800">Interview Dijadwalkan</span>
                                </div>
                                <p class="mt-2 text-green-700">Selasa, 12 November 2024 • 14:00 WIB • Video Call (Zoom)
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="p-6 hover:bg-gray-50 transition duration-150">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-6">
                                <div class="w-16 h-16 bg-purple-100 rounded-xl flex items-center justify-center">
                                    <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-xl font-semibold text-gray-800">UI/UX Designer</h3>
                                    <div class="flex items-center mt-2 space-x-4">
                                        <span class="text-sm text-gray-500">Creative Digital Agency</span>
                                        <span class="text-sm text-gray-500">•</span>
                                        <span class="text-sm text-gray-500">Remote</span>
                                        <span class="text-sm text-gray-500">•</span>
                                        <span class="text-sm text-gray-500">Dilamar 1 minggu yang lalu</span>
                                    </div>
                                </div>
                            </div>
                            <div class="flex items-center space-x-4">
                                <span
                                    class="px-3 py-1 text-sm text-green-600 bg-green-100 rounded-full">Interview</span>
                                <button class="text-gray-400 hover:text-gray-600">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z">
                                        </path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="p-6 hover:bg-gray-50 transition duration-150">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-6">
                                <div class="w-16 h-16 bg-purple-100 rounded-xl flex items-center justify-center">
                                    <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-xl font-semibold text-gray-800">UI/UX Designer</h3>
                                    <div class="flex items-center mt-2 space-x-4">
                                        <span class="text-sm text-gray-500">Creative Digital Agency</span>
                                        <span class="text-sm text-gray-500">•</span>
                                        <span class="text-sm text-gray-500">Remote</span>
                                        <span class="text-sm text-gray-500">•</span>
                                        <span class="text-sm text-gray-500">Dilamar 1 minggu yang lalu</span>
                                    </div>
                                </div>
                            </div>
                            <div class="flex items-center space-x-4">
                                <span
                                    class="px-3 py-1 text-sm text-green-600 bg-green-100 rounded-full">Interview</span>
                                <button class="text-gray-400 hover:text-gray-600">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z">
                                        </path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
</x-app-layout>
