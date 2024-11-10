<!-- resources/views/profile/index.blade.php -->
<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-xl shadow-xl overflow-hidden">
                <!-- Profile Header with Photo -->
                <div class="relative h-48 bg-gradient-to-r from-blue-500 to-purple-600">
                    <div class="absolute -bottom-20 left-8">
                        <div class="relative">
                            @if (Auth::user()->profile_photo_path)
                                <img src="{{ Storage::url(Auth::user()->profile_photo_path) }}" alt="Profile Photo"
                                    class="w-40 h-40 rounded-full border-4 border-white shadow-lg object-cover">
                            @else
                                <div
                                    class="w-40 h-40 rounded-full border-4 border-white shadow-lg bg-gray-200 flex items-center justify-center">
                                    <span class="text-4xl text-gray-400">{{ substr(Auth::user()->name, 0, 1) }}</span>
                                </div>
                            @endif

                            <!-- Photo Upload Button -->
                            <form id="photoForm" action="" method="POST" enctype="multipart/form-data"
                                class="hidden">
                                @csrf
                                @method('PUT')
                                <input type="file" name="photo" id="photoInput" class="hidden" accept="image/*">
                            </form>

                            <button onclick="document.getElementById('photoInput').click()"
                                class="absolute bottom-2 right-2 bg-white rounded-full p-2 shadow-lg hover:bg-gray-50">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-600" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Navigation Tabs -->
                <div class="mt-24 px-8">
                    <nav class="flex justify-between border-b">
                        @foreach (['Overview', 'Informasi Pribadi', 'Pendidikan', 'Skill', 'Pengalaman'] as $tab)
                            <button onclick="openTab(event, '{{ str_replace(' ', '', $tab) }}')"
                                class="tab-button py-4 px-6 font-medium transition-colors duration-200 text-gray-500 hover:text-blue-500 border-b-2 border-transparent"
                                :class="{ 'border-blue-500 text-blue-600': activeTab === '{{ $tab }}' }">
                                {{ $tab }}
                            </button>
                        @endforeach
                    </nav>
                </div>

                <!-- Tab Contents -->
                <div class="p-8">
                    <!-- Overview Tab -->
                    <div id="Overview" class="tab-content">
                        <div class="space-y-6">
                            <h2 class="text-2xl font-bold text-gray-800">Welcome, {{ Auth::user()->name }}</h2>
                            <p class="text-gray-600">{{ $profile->bio ?? 'Add your bio here' }}</p>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Skills Overview -->
                                <div class="bg-gray-50 p-6 rounded-lg">
                                    <h3 class="font-semibold text-gray-700 mb-3">Skills Overview</h3>
                                    <div class="flex flex-wrap gap-2">
                                        {{-- @foreach ($skills as $skill) --}}
                                        <span class="px-3 py-1 bg-blue-100 text-blue-600 rounded-full text-sm">
                                            Ngoding
                                        </span>
                                        {{-- @endforeach --}}
                                    </div>
                                </div>

                                <!-- Current Position -->
                                <div class="bg-gray-50 p-6 rounded-lg">
                                    <h3 class="font-semibold text-gray-700 mb-3">Current Position</h3>
                                    {{-- @if ($currentExperience = $experiences->last()) --}}
                                    <p class="text-gray-600">TEST</p>
                                    <p class="text-gray-500 text-sm">TEST</p>
                                    {{-- @else --}}
                                    {{-- <p class="text-gray-500">No current position added</p> --}}
                                    {{-- @endif --}}
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Informasi Pribadi Tab -->
                    <div id="InformasiPribadi" class="tab-content hidden">
                        <form action="{{ route('profile.update') }}" method="POST" class="space-y-6">
                            @csrf
                            @method('PUT')

                            <div class="flex justify-end">
                                <button type="submit"
                                    class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 flex items-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7" />
                                    </svg>
                                    Save Changes
                                </button>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="space-y-2">
                                    <label for="name" class="block text-sm font-medium text-gray-700">Nama</label>
                                    <input type="text" name="name" id="name" value=""
                                        class="w-full p-2 border rounded-lg focus:ring-blue-500 focus:border-blue-500">
                                </div>

                                <div class="space-y-2">
                                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                                    <input type="email" name="email" id="email" value=""
                                        class="w-full p-2 border rounded-lg focus:ring-blue-500 focus:border-blue-500">
                                </div>

                                <div class="space-y-2">
                                    <label for="phone" class="block text-sm font-medium text-gray-700">Nomor
                                        Telepon</label>
                                    <input type="tel" name="phone" id="phone" value=""
                                        class="w-full p-2 border rounded-lg focus:ring-blue-500 focus:border-blue-500">
                                </div>

                                <div class="space-y-2">
                                    <label for="birthdate" class="block text-sm font-medium text-gray-700">Tanggal
                                        Lahir</label>
                                    <input type="date" name="birthdate" id="birthdate" value=""
                                        class="w-full p-2 border rounded-lg focus:ring-blue-500 focus:border-blue-500">
                                </div>

                                <div class="space-y-2 md:col-span-2">
                                    <label for="address"
                                        class="block text-sm font-medium text-gray-700">Alamat</label>
                                    <textarea name="address" id="address" rows="3"
                                        class="w-full p-2 border rounded-lg focus:ring-blue-500 focus:border-blue-500"></textarea>
                                </div>
                            </div>
                        </form>
                    </div>

                    <!-- Skills Tab -->
                    <div id="Skill" class="tab-content hidden">
                        <div class="space-y-6">
                            <!-- Add New Skill Form -->
                            <form action="" method="POST" class="flex gap-4">
                                @csrf
                                <input type="text" name="skill_name" placeholder="Add new skill"
                                    class="flex-1 p-2 border rounded-lg focus:ring-blue-500 focus:border-blue-500">
                                <button type="submit"
                                    class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 flex items-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 4v16m8-8H4" />
                                    </svg>
                                    Add Skill
                                </button>
                            </form>

                            <!-- Skills List -->
                            <div class="flex flex-wrap gap-3">
                                {{-- @foreach ($skills as $skill) --}}
                                <div class="group px-4 py-2 bg-gray-100 rounded-full flex items-center gap-2">
                                    <span>TEST</span>
                                    <form action="" method="POST" class="hidden group-hover:block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-gray-500 hover:text-red-500">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                                {{-- @endforeach --}}
                            </div>
                        </div>
                    </div>

                    <!-- Pengalaman Tab -->
                    <div id="Pengalaman" class="tab-content hidden">
                        <div class="space-y-6">
                            <!-- Add New Experience Form -->
                            <form action="" method="POST" class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                @csrf
                                <input type="text" name="position" placeholder="Position" required
                                    class="p-2 border rounded-lg focus:ring-blue-500 focus:border-blue-500">
                                <input type="text" name="company" placeholder="Company" required
                                    class="p-2 border rounded-lg focus:ring-blue-500 focus:border-blue-500">
                                <div class="flex gap-2">
                                    <input type="text" name="period" placeholder="Period (e.g., 2020 - Present)"
                                        required
                                        class="flex-1 p-2 border rounded-lg focus:ring-blue-500 focus:border-blue-500">
                                    <button type="submit"
                                        class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 4v16m8-8H4" />
                                        </svg>
                                    </button>
                                </div>
                            </form>

                            <!-- Experiences List -->
                            <div class="space-y-4">
                                {{-- @foreach ($experiences as $experience) --}}
                                <div class="group p-4 bg-gray-50 rounded-lg flex justify-between items-center">
                                    <div>
                                        <h3 class="font-semibold text-gray-800">TEST</h3>
                                        <p class="text-gray-600">TEST</p>
                                        <p class="text-gray-500 text-sm">TEST</p>
                                    </div>
                                    <form action="" method="POST" class="hidden group-hover:block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-gray-500 hover:text-red-500">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                                {{-- @endforeach --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
        <script>
            // Tab Functionality
            function openTab(event, tabId) {
                // Hide all tab contents
                document.querySelectorAll('.tab-content').forEach(content => {
                    content.classList.add('hidden');
                });

                // Show selected tab content
                document.getElementById(tabId).classList.remove('hidden');

                // Reset all tab buttons
                document.querySelectorAll('.tab-button').forEach(button => {
                    button.classList.remove('border-blue-500', 'text-blue-600');
                    button.classList.add('border-transparent');
                });

                // Highlight selected tab button
                event.currentTarget.classList.remove('border-transparent');
                event.currentTarget.classList.add('border-blue-500', 'text-blue-600');
            }

            document.getElementById('photoInput').addEventListener('change', function() {
                if (this.files && this.files[0]) {
                    const form = document.getElementById('photoForm');
                    form.submit();
                }
            });

            // Set default tab on page load
            document.addEventListener('DOMContentLoaded', function() {
                // Get tab from URL or default to Overview
                const urlParams = new URLSearchParams(window.location.search);
                const activeTab = urlParams.get('tab') || 'Overview';

                // Find and click the corresponding tab button
                document.querySelector(`[onclick="openTab(event, '${activeTab}')"]`).click();
            });
        </script>

    </x-app-layout>
