<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- Key Metrics Section --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h2 class="text-2xl font-semibold text-gray-800 mb-4">Key Metrics</h2>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                        {{-- Total Users Card --}}
                        <div class="bg-white rounded-xl p-6 shadow-sm hover:shadow-md transition-shadow duration-300">
                            <div class="flex items-center">
                                <div class="p-3 bg-blue-100 rounded-xl">
                                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5.121 17.804A10.967 10.967 0 0112 15c1.933 0 3.73.486 5.303 1.34M9 10a4 4 0 118 0 4 4 0 01-8 0z">
                                        </path>
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm font-medium text-gray-500">Total Users</p>
                                    <p class="text-2xl font-bold text-gray-900">{{ $userCount }}</p>
                                </div>
                            </div>
                        </div>

                        {{-- Job Postings Card --}}
                        <div class="bg-white rounded-xl p-6 shadow-sm hover:shadow-md transition-shadow duration-300">
                            <div class="flex items-center">
                                <div class="p-3 bg-yellow-100 rounded-xl">
                                    <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2">
                                        </path>
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm font-medium text-gray-500">Job Postings</p>
                                    <p class="text-2xl font-bold text-gray-900">{{ $jobCount }}</p>
                                </div>
                            </div>
                        </div>

                        {{-- Interviews Card --}}
                        <div class="bg-white rounded-xl p-6 shadow-sm hover:shadow-md transition-shadow duration-300">
                            <div class="flex items-center">
                                <div class="p-3 bg-green-100 rounded-xl">
                                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm font-medium text-gray-500">Interviews</p>
                                    <p class="text-2xl font-bold text-gray-900">{{ $interviewCount }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Time-based Statistics Section --}}
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">Application Statistics</h2>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        {{-- Today's Applications --}}
                        <div class="bg-white rounded-xl p-6 shadow-sm hover:shadow-md transition-shadow duration-300">
                            <div class="flex items-center">
                                <div class="p-3 bg-indigo-100 rounded-xl">
                                    <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z">
                                        </path>
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm font-medium text-gray-500">Today's Applications</p>
                                    <p class="text-2xl font-bold text-gray-900">{{ $todayAplCount }}</p>
                                </div>
                            </div>
                        </div>

                        {{-- This Week's Applications --}}
                        <div class="bg-white rounded-xl p-6 shadow-sm hover:shadow-md transition-shadow duration-300">
                            <div class="flex items-center">
                                <div class="p-3 bg-purple-100 rounded-xl">
                                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2">
                                        </path>
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm font-medium text-gray-500">This Week</p>
                                    <p class="text-2xl font-bold text-gray-900">{{ $thisWeekAplCount }}</p>
                                </div>
                            </div>
                        </div>

                        {{-- This Month's Applications --}}
                        <div class="bg-white rounded-xl p-6 shadow-sm hover:shadow-md transition-shadow duration-300">
                            <div class="flex items-center">
                                <div class="p-3 bg-rose-100 rounded-xl">
                                    <svg class="w-6 h-6 text-rose-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm font-medium text-gray-500">This Month</p>
                                    <p class="text-2xl font-bold text-gray-900">{{ $thisMonthAplCount }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white shadow-sm sm:rounded-lg p-6">
                        <h3 class="text-lg font-semibold mb-2">Applications per Month ({{ \Carbon\Carbon::now()->year }})</h3>
                        <div id="applications-chart"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var options = {
                chart: {
                    type: 'bar',
                    height: 350
                },
                series: [{
                    name: 'Applications',
                    data: @json($applicationsPerMonth)
                }],
                xaxis: {
                    categories: ['January', 'February', 'March', 'April', 'May', 'June',
                        'July', 'August', 'September', 'October', 'November', 'December'
                    ]
                },
                colors: ['#4CAF50'],
                title: {
                    text: 'Applications Per Month',
                    align: 'center',
                    margin: 10,
                    style: {
                        fontSize: '16px',
                        color: '#263238'
                    }
                }
            };

            var chart = new ApexCharts(document.querySelector("#applications-chart"), options);
            chart.render();
        });
    </script>
</x-app-layout>
