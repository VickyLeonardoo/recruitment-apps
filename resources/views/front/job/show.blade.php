<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mt-8 mx-auto sm:px-6 lg:px-8">
            <!-- Back Button -->
            <div class="mb-6">
                <a href="{{ route('applicant.job.index') }}" class="inline-flex items-center text-gray-600 hover:text-gray-800 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                    </svg>
                    Kembali ke Daftar Pekerjaan
                </a>
            </div>

            <div class="bg-white/80 backdrop-blur-sm overflow-hidden shadow-xl sm:rounded-2xl">
                <!-- Header Section -->
                <div class="p-8 border-b border-gray-100">
                    <div class="flex items-start justify-between">
                        <div class="flex items-center space-x-6">
                            <div class="w-20 h-20 bg-blue-100 rounded-xl flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <div>
                                <h1 class="text-3xl font-bold text-gray-800 mb-2">{{ $job->title }}</h1>
                                <div class="flex items-center space-x-4">
                                    <span class="px-3 py-1 text-sm text-green-600 bg-green-100 rounded-full">{{ $job->type }}</span>
                                    <span class="text-gray-500">Posted {{ $job->created_at->diffForHumans() }}</span>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="flex items-center space-x-4">
                            <button class="p-2 text-gray-400 hover:text-gray-600 rounded-full hover:bg-gray-100 transition">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"/>
                                </svg>
                            </button>
                        </div> --}}
                    </div>

                    <!-- Job Quick Info -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-8">
                        <div class="flex items-center space-x-3 text-gray-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            <span>Jakarta, Indonesia</span>
                        </div>
                        <div class="flex items-center space-x-3 text-gray-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <span>{{ $job->type }}</span>
                        </div>
                        <div class="flex items-center space-x-3 text-gray-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <span>@currency($job->max_salary)</span>
                        </div>
                    </div>
                </div>

                <!-- Main Content -->
                <div class="p-8">
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                        <!-- Left Column - Job Details -->
                        <div class="lg:col-span-2 space-y-8">
                            <section>
                                <h2 class="text-xl font-bold text-gray-800 mb-4">Deskripsi Pekerjaan</h2>
                                <div class="prose max-w-none text-gray-600">
                                    {{ $job->description }}
                                </div>
                            </section>

                            <section>
                                <h2 class="text-xl font-bold text-gray-800 mb-4">Kualifikasi</h2>
                                <ul class="space-y-3 text-gray-600">
                                    {!! nl2br(e($job->requirements)) !!}
                                    {{-- @foreach($job->responsibilitiess as $responsibilities)
                                    <li class="flex items-start">
                                        <svg class="h-5 w-5 text-green-500 mr-3 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        {{ $responsibilities }}
                                    </li>
                                    @endforeach --}}
                                </ul>
                            </section>

                            <section>
                                <h2 class="text-xl font-bold text-gray-800 mb-4">Tanggung Jawab</h2>
                                <ul class="space-y-3 text-gray-600">
                                    {!! nl2br(e($job->responsibilities)) !!}
                                    {{-- @foreach($job->responsibilities as $responsibility)
                                    <li class="flex items-start">
                                        <svg class="h-5 w-5 text-blue-500 mr-3 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        {{ $responsibility }}
                                    </li>
                                    @endforeach --}}
                                </ul>
                            </section>
                        </div>

                        <!-- Right Column - Apply Section -->
                        <div class="lg:col-span-1">
                            @if (session('error'))
                                <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-200 dark:bg-gray-800 dark:text-red-400 relative"
                                    role="alert">
                                    <span class="font-medium">{{ session('error') }}!</span>
                                    <!-- Tombol silang dengan SVG -->
                                    <button type="button"
                                        class="absolute top-0 right-0 p-4 rounded-md text-red-600 hover:bg-red-300 hover:text-red-800"
                                        aria-label="Close" onclick="this.parentElement.style.display='none';">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mt-2" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </div>
                            @endif
                            @if (!$application)
                            <div class="bg-sky-100 rounded-xl p-6 sticky top-8">
                                <h2 class="text-xl font-bold text-gray-800 mb-4">Lamar Pekerjaan</h2>
                                <p class="text-gray-600 mb-6">Tertarik dengan posisi ini? Kirim lamaran Anda sekarang.</p>
                                <form action="{{ route('applicant.application.store') }}" method="POST">
                                    @csrf
                                    <input type="hidden" value="{{ $job->id }}" name="job_id">
                                    <button type="submit" class="w-full bg-blue-600 text-white rounded-lg px-4 py-3 font-semibold hover:bg-blue-700 transition duration-300 mb-4">
                                    Lamar Sekarang
                                    </button>
                                </form>
                                
                                {{-- <div class="text-center">
                                    <p class="text-sm text-gray-500">atau</p>
                                </div>
                                
                                <button class="w-full mt-4 bg-white border border-gray-300 text-gray-700 rounded-lg px-4 py-3 font-semibold hover:bg-gray-50 transition duration-300">
                                    Simpan Pekerjaan
                                </button> --}}
                                
                                
                                {{-- <div class="mt-6 pt-6 border-t border-gray-200">
                                    <h3 class="text-sm font-semibold text-gray-800 mb-3">Bagikan lowongan ini:</h3>
                                    <div class="flex space-x-4">
                                        <button class="p-2 text-gray-400 hover:text-blue-500 rounded hover:bg-blue-50 transition">
                                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                                        </button>
                                        <button class="p-2 text-gray-400 hover:text-blue-400 rounded hover:bg-blue-50 transition">
                                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/></svg>
                                        </button>
                                        <button class="p-2 text-gray-400 hover:text-blue-600 rounded hover:bg-blue-50 transition">
                                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.066 0-1.139.919-2.066 2.063-2.066S7.4 4.228 7.4 5.367c0 1.14-.92 2.066-2.063 2.066zm.02 2.067h3.554v11.302H5.357V9.5z"></path></svg>
                                        </button>
                                    </div>
                                </div> --}}
                            </div>
                            @else
                            <div class="bg-green-100 rounded-xl p-6 sticky top-8">
                                Kamu sudah mendaftar, periksa lamaran kamu <a class="text-blue-600" href="{{ route('applicant.application.show',$application) }}">disini</a>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>