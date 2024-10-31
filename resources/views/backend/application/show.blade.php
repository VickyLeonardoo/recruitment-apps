<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Detail Application') }}
            </h2>
            @role('superadmin')
                <a href="{{ route('application.index', $application->job) }}"
                    class="font-bold py-2 px-4 bg-indigo-700 hover:bg-indigo-400 text-white rounded-full">
                    Back
                </a>
            @endrole
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @if (session('success'))
                <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-200 dark:bg-gray-800 dark:text-green-400 relative" role="alert">
                    <span class="font-medium">{{ session('success') }}!</span>
                    <!-- Tombol silang dengan SVG -->
                    <button type="button" class="absolute top-0 right-0 p-4 rounded-md text-green-600 hover:bg-green-300 hover:text-green-800" aria-label="Close" onclick="this.parentElement.style.display='none';">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            @endif  
            <!-- Section Title for Score Details -->
            <div class="text-xl font-semibold mt-8 mb-4 text-center">
                Score Detail
            </div>

            <!-- Bottom Cards Section -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="bg-white shadow-sm sm:rounded-lg p-6 flex flex-col items-center justify-center h-64">
                    <h3 class="text-lg font-semibold mb-2">Score Test</h3>
                    <p class="text-4xl font-bold">{{ $finalGrade }}</p>
                </div>
                <div class="bg-white shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-semibold mb-2">Question Difficulty Distribution</h3>
                    <div id="chart"></div> <!-- Placeholder for chart -->
                </div>
            </div>

                <!-- Recommendation Button -->
            <div class="flex mt-6">
                <form method="POST">
                    @csrf
                    @method('PUT')
                    @if ($application->is_recomended == true)
                        <button formaction="{{ route('application.recommendation', $application) }}" class="bg-red-500 text-white font-semibold py-2 px-6 rounded-lg shadow-md hover:bg-red-200 focus:outline-none focus:ring-2 focus:ring-red-300">
                            Cancel Recommendation
                        </button>
                    @else
                        <button formaction="{{ route('application.recommendation', $application) }}" class="bg-blue-500 text-white font-semibold py-2 px-6 rounded-lg shadow-md hover:bg-blue-200 focus:outline-none focus:ring-2 focus:ring-blue-300">
                            Recommendation
                        </button>
                    @endif
                </form>
            </div>

            <!-- Section Title for Personal Information -->
            <div class="text-xl font-semibold mt-8 mb-4 text-center">
                Personal Information
            </div>

            <!-- Profile Information Section -->
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-semibold mb-4">Personal Information</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div><strong>Name:</strong> {{ $application->user->name }}</div>
                    <div><strong>Email:</strong> {{ $application->user->eail }}</div>
                    <div><strong>Phone:</strong> {{ $application->user->phone }}</div>
                    <div><strong>Address:</strong> {{ $application->user->address }}</div>
                    <div><strong>City:</strong> {{ $application->user->city }}</div>
                    <div><strong>Date of Birth:</strong> {{ $application->user->dob }}</div>
                    <div><strong>Gender:</strong> {{ $application->user->gender }}</div>
                    <div><strong>Status:</strong> {{ $application->user->status }}</div>
                    <div><strong>Nationality:</strong> {{ $application->user->nationality }}</div>
                    <div><strong>Religion:</strong> {{ $application->user->religion }}</div>
                    <div class="col-span-2">
                        <strong>Profile Picture:</strong>
                        <img src="profile_picture_url" class="w-20 h-20 rounded-full mt-2" alt="Profile Picture">
                    </div>
                </div>
            </div>

            <!-- Education Section -->
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-semibold mb-4">Education</h3>
                <div class="space-y-4">
                    @foreach ($application->user->education_details as $education)
                        <div class="bg-gray-100 border border-gray-300 rounded-lg p-4">
                            <p><strong>Degree:</strong> {{ $education->degree }}</p>
                            <p><strong>Major:</strong> {{ $education->major }}</p>
                            <p><strong>University:</strong> {{ $education->university }}</p>
                            <p><strong>Entry Year:</strong> {{ $education->entry_year }}</p>
                            <p><strong>End Year:</strong> {{ $education->end_year }}</p>
                            <p><strong>Grade:</strong> {{ $education->grade }} GPA</p>
                        </div>
                    @endforeach
                    <!-- Add more education entries if needed -->
                </div>
            </div>
            <!-- Experience Section -->
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-semibold mb-4">Experience</h3>
                <div class="space-y-4">
                    @foreach ($application->user->experience_details as $experience)
                        <div class="bg-gray-100 border border-gray-300 rounded-lg p-4">
                            <p><strong>Company Name:</strong> {{ $experience->company }}</p>
                            <p><strong>Designatiom:</strong> {{ $experience->position }}</p>
                            <p><strong>Start Date:</strong> {{ $experience->start_date }}</p>
                            <p><strong>End Date:</strong> {{ $experience->end_date }}</p>
                        </div>
                    @endforeach
                    <!-- Add more education entries if needed -->
                </div>
            </div>

            <!-- Skills and Languages Section -->
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-semibold mb-4">Skills & Languages</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <h4 class="font-semibold">Skills</h4>
                        <ul class="list-disc list-inside">
                            @foreach ($application->user->skill_details as $skill)
                                <li>{{ $skill->name }}</li>
                            @endforeach
                        </ul>
                    </div>
                    <div>
                        <h4 class="font-semibold">Languages</h4>
                        <ul class="list-disc list-inside">
                            @foreach ($application->user->language_details as $language)
                                <li>{{ $language->language->name }} ({{ $language->level }})</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>

            
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var options = {
                chart: {
                    type: 'pie',
                    height: 150
                },
                series: [{{ $question_count_easy }}, {{ $question_count_medium }},
                    {{ $question_count_hard }}],
                labels: ['Easy', 'Medium', 'Hard'],
                colors: ['#4CAF50', '#FFC107', '#F44336']
            };

            var chart = new ApexCharts(document.querySelector("#chart"), options);
            chart.render();
        });
    </script>
</x-app-layout>
