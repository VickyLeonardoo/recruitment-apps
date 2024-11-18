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
                    <select id="sortSelect"
                        class="rounded-lg border-gray-300 text-gray-700 text-sm focus:ring-blue-500 focus:border-blue-500">
                        <option value="" disabled selected>Urutkan</option>
                        <option value="newest">Terbaru</option>
                        <option value="oldest">Terlama</option>
                    </select>
                </div>
            </div>

            <!-- Stats Cards -->
            

            <!-- Applications List -->
            <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-xl overflow-hidden">
                <div class="divide-y divide-gray-100">
                    @foreach ($applications as $application)
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
                                        <a href="{{ route('applicant.application.show', $application) }}"
                                            class="text-xl font-semibold text-gray-800">{{ $application->job->title }}</a>
                                        <div class="flex items-center mt-2 space-x-4">
                                            <span class="text-sm text-gray-500">{{ $application->job->code }}</span>
                                            <span class="text-sm text-gray-500">•</span>
                                            <span class="text-sm text-gray-500">{{ $application->job->type }}</span>
                                            <span class="text-sm text-gray-500">•</span>
                                            <span class="text-sm text-gray-500"><span
                                                    class="text-sm text-gray-500">{{ \Carbon\Carbon::parse($application->created_at)->diffForHumans() }}</span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex items-center space-x-4">
                                    @if ($application->status == 'Rejected')
                                        <span
                                            class="px-3 py-1 text-sm text-red-600 bg-red-100 rounded-full">{{ $application->status }}
                                        </span>
                                    @else
                                        <span
                                            class="px-3 py-1 text-sm text-green-600 bg-green-100 rounded-full">{{ $application->status }}
                                        </span>
                                    @endif
                                </div>
                            </div>
                            @if ($application->is_interview == true && $application->status == 'Interview')
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
                                        <p class="mt-2 text-green-700">@formatFullDate($application->schedule->schedule->date) • @formatTime($application->schedule->schedule->start_time) - @formatTime($application->schedule->schedule->end_time) • Jl. Bawal No.1, Batu Merah, Kec. Batu Ampar, Kota Batam, Kepulauan Riau 29452
                                        </p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    @endforeach

                </div>
            </div>
            <script>
                document.getElementById('sortSelect').addEventListener('change', function() {
                    const sortOrder = this.value;
                    window.location.href = `{{ route('applicant.application.index') }}?sort=${sortOrder}`;
                });
            </script>
</x-app-layout>
