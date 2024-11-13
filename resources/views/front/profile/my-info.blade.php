<!-- resources/views/profile/index.blade.php -->
<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <div class="py-3 mb-4 w-full bg-red-500 text-white">
                        <p class="ml-3">{{ $error }}</p>
                    </div>
                @endforeach
            @endif

            @if (session('success'))
                <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-200 dark:bg-gray-800 dark:text-green-400 relative"
                    role="alert">
                    <span class="font-medium">{{ session('success') }}!</span>
                    <!-- Tombol silang dengan SVG -->
                    <button type="button"
                        class="absolute top-0 right-0 p-4 rounded-md text-green-600 hover:bg-green-300 hover:text-green-800"
                        aria-label="Close" onclick="this.parentElement.style.display='none';">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            @elseif (session('error'))
                <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-200 dark:bg-gray-800 dark:text-red-400 relative"
                    role="alert">
                    <span class="font-medium">{{ session('error') }}!</span>
                    <!-- Tombol silang dengan SVG -->
                    <button type="button"
                        class="absolute top-0 right-0 p-4 rounded-md text-red-600 hover:bg-red-300 hover:text-red-800"
                        aria-label="Close" onclick="this.parentElement.style.display='none';">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            @endif
            <div class="bg-white rounded-xl shadow-xl overflow-hidden">
                <!-- Profile Header with Photo -->
                <div class="relative h-48 bg-gradient-to-r from-blue-500 to-purple-600">
                    <div class="absolute -bottom-20 left-8">
                        <div class="relative">
                            @if (Auth::user()->profile_picture)
                                <img src="{{ Storage::url(Auth::user()->profile_picture) }}" alt="Profile Photo"
                                    id="photoPreview"
                                    class="w-40 h-40 rounded-full border-4 border-white shadow-lg object-cover">
                            @else
                                <div class="w-40 h-40 rounded-full border-4 border-white shadow-lg bg-gray-200 flex items-center justify-center"
                                    id="photoFallback">
                                    <span class="text-4xl text-gray-400">{{ substr(Auth::user()->name, 0, 1) }}</span>
                                </div>
                            @endif

                            <form id="photoForm" action="{{ route('applicant.profile.photo.update') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <input type="file" name="photo" id="photoInput" class="hidden" accept="image/*"
                                    onchange="previewImage(this)">

                                <!-- Tombol untuk memilih foto -->
                                <button type="button" onclick="document.getElementById('photoInput').click()"
                                    class="absolute bottom-2 right-2 bg-white rounded-full p-2 shadow-lg hover:bg-gray-50">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-600" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                    </svg>
                                </button>

                                <!-- Tombol Upload - Repositioned -->
                                <button type="submit" id="uploadButton"
                                    class="hidden absolute bottom-2 -right-24 px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 shadow-md">
                                    Simpan
                                </button>
                            </form>
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
                                        @foreach (Auth::user()->skill_details as $skill)
                                            <span class="px-3 py-1 bg-blue-100 text-blue-600 rounded-full text-sm">
                                                {{ $skill->name }}
                                            </span>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Informasi Pribadi Tab -->
                    <div id="InformasiPribadi" class="tab-content hidden">
                        <form action="{{ route('applicant.profile.update.personal.information') }}" method="POST"
                            class="space-y-6">
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
                                    Simpan Perubahan
                                </button>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Existing Fields -->
                                <div class="space-y-2">
                                    <label for="name" class="block text-sm font-medium text-gray-700">Nama</label>
                                    <input type="text" name="name" id="name"
                                        value="{{ Auth::user()->name }}"
                                        class="w-full p-2 border rounded-lg focus:ring-blue-500 focus:border-blue-500">
                                </div>

                                <div class="space-y-2">
                                    <label for="email"
                                        class="block text-sm font-medium text-gray-700">Email</label>
                                    <input type="email" name="email" readonly id="email"
                                        value="{{ Auth::user()->email }}"
                                        class="w-full p-2 border rounded-lg focus:ring-blue-500 focus:border-blue-500">
                                </div>

                                <!-- Identity Number -->
                                <div class="space-y-2">
                                    <label for="identity_no" class="block text-sm font-medium text-gray-700">Nomor
                                        Identitas (KTP)</label>
                                    <input type="text" name="identity_no" id="identity_no"
                                        value="{{ Auth::user()->identity_no }}"
                                        class="w-full p-2 border rounded-lg focus:ring-blue-500 focus:border-blue-500">
                                </div>

                                <!-- Phone -->
                                <div class="space-y-2">
                                    <label for="phone" class="block text-sm font-medium text-gray-700">Nomor
                                        Telepon</label>
                                    <input type="tel" name="phone" id="phone"
                                        value="{{ Auth::user()->phone }}"
                                        class="w-full p-2 border rounded-lg focus:ring-blue-500 focus:border-blue-500">
                                </div>

                                <!-- Date of Birth -->
                                <div class="space-y-2">
                                    <label for="birthdate" class="block text-sm font-medium text-gray-700">Tanggal
                                        Lahir</label>
                                    <input type="date" name="dob" id="birthdate"
                                        value="{{ Auth::user()->dob }}"
                                        class="w-full p-2 border rounded-lg focus:ring-blue-500 focus:border-blue-500">
                                </div>

                                <!-- Gender -->
                                <div class="space-y-2">
                                    <label for="gender" class="block text-sm font-medium text-gray-700">Jenis
                                        Kelamin</label>
                                    <select name="gender" id="gender"
                                        class="w-full p-2 border rounded-lg focus:ring-blue-500 focus:border-blue-500">
                                        <option value="male" {{ Auth::user()->gender == 'male' ? 'selected' : '' }}>
                                            Laki-laki</option>
                                        <option value="female"
                                            {{ Auth::user()->gender == 'female' ? 'selected' : '' }}>Perempuan</option>
                                    </select>
                                </div>

                                <!-- Status -->
                                <div class="space-y-2">
                                    <label for="status" class="block text-sm font-medium text-gray-700">Status
                                        Pernikahan</label>
                                    <select name="status" id="status"
                                        class="w-full p-2 border rounded-lg focus:ring-blue-500 focus:border-blue-500">
                                        <option value="Single"
                                            {{ Auth::user()->status == 'Single' ? 'selected' : '' }}>Belum Menikah
                                        </option>
                                        <option value="Married"
                                            {{ Auth::user()->status == 'Married' ? 'selected' : '' }}>Menikah</option>
                                        <option value="Divorced"
                                            {{ Auth::user()->status == 'Divorced' ? 'selected' : '' }}>Cerai</option>
                                    </select>
                                </div>

                                <!-- Religion -->
                                <div class="space-y-2">
                                    <label for="religion"
                                        class="block text-sm font-medium text-gray-700">Agama</label>
                                    <select name="religion" id="religion"
                                        class="w-full p-2 border rounded-lg focus:ring-blue-500 focus:border-blue-500">
                                        <option value="Islam"
                                            {{ Auth::user()->religion == 'Islam' ? 'selected' : '' }}>Islam</option>
                                        <option value="Kristen"
                                            {{ Auth::user()->religion == 'Kristen' ? 'selected' : '' }}>Kristen
                                        </option>
                                        <option value="Katolik"
                                            {{ Auth::user()->religion == 'Katolik' ? 'selected' : '' }}>Katolik
                                        </option>
                                        <option value="Hindu"
                                            {{ Auth::user()->religion == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                                        <option value="Buddha"
                                            {{ Auth::user()->religion == 'Buddha' ? 'selected' : '' }}>Buddha</option>
                                        <option value="Konghucu"
                                            {{ Auth::user()->religion == 'Konghucu' ? 'selected' : '' }}>Konghucu
                                        </option>
                                    </select>
                                </div>

                                <!-- Nationality -->
                                <div class="space-y-2">
                                    <label for="nationality"
                                        class="block text-sm font-medium text-gray-700">Kewarganegaraan</label>
                                    <input type="text" name="nationality" id="nationality"
                                        value="{{ Auth::user()->nationality }}"
                                        class="w-full p-2 border rounded-lg focus:ring-blue-500 focus:border-blue-500">
                                </div>

                                <!-- City -->
                                <div class="space-y-2">
                                    <label for="city" class="block text-sm font-medium text-gray-700">Kota</label>
                                    <input type="text" name="city" id="city"
                                        value="{{ Auth::user()->city }}"
                                        class="w-full p-2 border rounded-lg focus:ring-blue-500 focus:border-blue-500">
                                </div>

                                <!-- Address (Full Width) -->
                                <div class="space-y-2 md:col-span-2">
                                    <label for="address" class="block text-sm font-medium text-gray-700">Alamat
                                        Lengkap</label>
                                    <textarea name="address" id="address" rows="3"
                                        class="w-full p-2 border rounded-lg focus:ring-blue-500 focus:border-blue-500">{{ Auth::user()->address }}</textarea>
                                </div>
                            </div>
                        </form>
                    </div>

                    <!-- Pendidikan Tab -->
                    <div id="Pendidikan" class="tab-content hidden">
                        <div class="space-y-6">
                            <!-- Add New cation Form -->
                            <form action="{{ route('applicant.profile.education.store') }}" method="POST"
                                class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                @csrf

                                <div class="space-y-2">
                                    <input type="text" name="institution" placeholder="Nama Institusi" required
                                        class="w-full p-2 border rounded-lg focus:ring-blue-500 focus:border-blue-500">
                                </div>

                                <div class="space-y-2">
                                    <select name="degree"
                                        class="w-full p-2 border rounded-lg focus:ring-blue-500 focus:border-blue-500">
                                        <option value="SMA/SMK" {{ old('degree') == 'SMA/SMK' ? 'selected' : '' }}>
                                            SMA/SMK</option>
                                        <option value="D3" {{ old('degree') == 'D3' ? 'selected' : '' }}>D3
                                        </option>
                                        <option value="D4" {{ old('degree') == 'D4' ? 'selected' : '' }}>D4
                                        </option>
                                        <option value="S1" {{ old('degree') == 'S1' ? 'selected' : '' }}>S1
                                        </option>
                                        <option value="S2" {{ old('degree') == 'S2' ? 'selected' : '' }}>S2
                                        </option>
                                        <option value="S3" {{ old('degree') == 'S3' ? 'selected' : '' }}>S3
                                        </option>
                                    </select>
                                </div>

                                <div class="space-y-2">
                                    <input type="text" name="major" placeholder="Jurusan" required
                                        class="w-full p-2 border rounded-lg focus:ring-blue-500 focus:border-blue-500">
                                </div>

                                <div class="space-y-2">
                                    <input type="text" name="entry_year" placeholder="Tahun Mulai (e.g., 2018)"
                                        required
                                        class="w-full p-2 border rounded-lg focus:ring-blue-500 focus:border-blue-500">
                                </div>

                                <div class="space-y-2">
                                    <input type="text" name="end_year" placeholder="Tahun Selesai (e.g., 2022)"
                                        required
                                        class="w-full p-2 border rounded-lg focus:ring-blue-500 focus:border-blue-500">
                                </div>

                                <div class="space-y-2 ">
                                    <input type="number" name="grade" placeholder="IPK (Optional)" step="0.01"
                                        min="0" max="100"
                                        class="w-full p-2 border rounded-lg focus:ring-blue-500 focus:border-blue-500">
                                </div>

                                <div class="md:col-span-2 flex justify-end">
                                    <button type="submit"
                                        class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 flex items-center gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 4v16m8-8H4" />
                                        </svg>
                                        Tambah Pendidikan
                                    </button>
                                </div>
                            </form>


                            <!-- Education List -->
                            <div class="space-y-4">
                                @forelse(Auth::user()->education_details as $education)
                                    <div class="group p-4 bg-gray-50 rounded-lg flex justify-between items-center">
                                        <div>
                                            <h3 class="font-semibold text-gray-800">{{ $education->institution }}</h3>
                                            <p class="text-gray-600">{{ $education->degree }} -
                                                {{ $education->major }}</p>
                                            <p class="text-gray-500 text-sm">{{ $education->entry_year }} -
                                                {{ $education->end_year }}</p>
                                            <p class="text-gray-500 text-sm">IPK: {{ $education->grade }}</p>
                                        </div>
                                        <form action="{{ route('applicant.profile.education.destroy', $education) }}"
                                            method="POST" class="hidden group-hover:block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-gray-500 hover:text-red-500">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                @empty
                                    <div class="text-center text-gray-500 py-4">
                                        Belum ada riwayat pendidikan yang ditambahkan
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </div>

                    <!-- Skills Tab -->
                    <div id="Skill" class="tab-content hidden">
                        <div class="space-y-6">
                            <!-- Add New Skill Form -->
                            <form action="{{ route('applicant.profile.skill.store') }}" method="POST"
                                class="flex gap-4">
                                @csrf
                                <input type="text" name="name" placeholder="Add new skill"
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
                                @forelse (Auth::user()->skill_details as $skill)
                                    <div class="group px-4 py-2 bg-sky-100 rounded-full flex items-center gap-2">
                                        <span>{{ $skill->name }}</span>
                                        <form action="{{ route('applicant.profile.skill.destroy', $skill) }}"
                                            method="POST" class="hidden group-hover:block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-gray-500 hover:text-red-500">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                @empty
                                    <div class="text-center text-gray-500 py-4">
                                        Belum ada riwayat pendidikan yang ditambahkan
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </div>

                    <!-- Pengalaman Tab -->
                    <div id="Pengalaman" class="tab-content hidden">
                        <div class="space-y-6">
                            <!-- Add New Experience Form -->
                            <form action="{{ route('applicant.profile.experience.store') }}" method="POST"
                                class="grid grid-cols-1 md:grid-cols-3 gap-4">
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
                                @forelse (Auth::user()->experience_details as $experience)
                                    <div class="group p-4 bg-gray-50 rounded-lg flex justify-between items-center">
                                        <div>
                                            <h3 class="font-semibold text-gray-800">{{ $experience->position }}</h3>
                                            <p class="text-gray-600">{{ $experience->company }}</p>
                                            <p class="text-gray-500 text-sm">{{ $experience->period }}</p>
                                        </div>
                                        <form
                                            action="{{ route('applicant.profile.experience.destroy', $experience) }}"
                                            method="POST" class="hidden group-hover:block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-gray-500 hover:text-red-500">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                @empty
                                    <div class="text-center text-gray-500 py-4">
                                        Belum ada riwayat pendidikan yang ditambahkan
                                    </div>
                                @endforelse
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

        // Set default tab on page load
        document.addEventListener('DOMContentLoaded', function() {
            // Get tab from session/URL or default to Overview
            const activeTab = '{{ session('tab') }}' || 'Overview';

            // Find and click the corresponding tab button
            document.querySelector(`[onclick="openTab(event, '${activeTab}')"]`).click();
        });

        function previewImage(input) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    const previewElement = document.getElementById('photoPreview');
                    const fallbackElement = document.getElementById('photoFallback');
                    const uploadButton = document.getElementById('uploadButton');

                    // Show upload button
                    uploadButton.classList.remove('hidden');

                    if (previewElement) {
                        // If preview img exists, update src
                        previewElement.src = e.target.result;
                    } else if (fallbackElement) {
                        // If using fallback, replace with new img
                        const img = document.createElement('img');
                        img.src = e.target.result;
                        img.id = 'photoPreview';
                        img.className = 'w-40 h-40 rounded-full border-4 border-white shadow-lg object-cover';
                        img.alt = 'Profile Photo';
                        fallbackElement.parentNode.replaceChild(img, fallbackElement);
                    }
                }

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>

</x-app-layout>
