<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Header Section -->
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-gray-800">Detail Lamaran</h1>
                <p class="text-gray-600 mt-2">Informasi lengkap tentang lamaran Anda</p>
            </div>

            <!-- Main Content Card -->
            <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-xl overflow-hidden">
                <!-- Application Details -->
                <div class="p-6">
                    <div class="grid grid-cols-2 gap-6">
                        <div>
                            <div class="flex items-center space-x-2">
                                <span class="text-gray-600">Nomor Lamaran:</span>
                                <span class="font-semibold">{{ $application->reg_no }}</span>
                            </div>
                            <div class="flex items-center space-x-2 mt-2">
                                <span class="text-gray-600">Tanggal Melamar:</span>
                                <span class="font-semibold">@formatDate($application->created_at)</span>
                            </div>
                        </div>
                        <div>
                            <div class="flex items-center space-x-2">
                                <span class="text-gray-600">Status:</span>
                                <span class="px-3 py-1 text-sm rounded-full
                                    {{ $application->status == 'Approved' ? 'bg-green-100 text-green-600' : 
                                       ($application->status == 'Rejected' ? 'bg-red-100 text-red-600' : 
                                       'bg-yellow-100 text-yellow-600') }}">
                                    {{ $application->status }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Online Test Section -->
                    <div class="mt-8">
                        <h2 class="text-xl font-semibold text-gray-800 mb-4">Psikotes Online</h2>
                        <div class="bg-blue-50 rounded-lg p-4 mb-4">
                            <p class="text-sm text-blue-700">
                                Untuk dapat melanjutkan proses lamaran kerja ini, silahkan mengerjakan test assessment yang ber-status
                                OPEN atau INPROGRESS dibawah ini sampai dengan Job Application 
                                <span class="px-2 py-0.5 bg-green-100 text-green-600 rounded">{{ $application->reg_no }}</span>
                                berstatus <span class="px-2 py-0.5 bg-blue-100 text-blue-600 rounded">COMPLETED</span>
                            </p>
                        </div>

                        <!-- Test Table -->
                        <div class="overflow-x-auto">
                            <table class="w-full">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nomor Tes</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Tes</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nomor Lamaran</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Pengerjaan</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap font-medium">{{ $application->test->test_no }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $application->test->name }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if ($application->test->status == 'DRAFT')
                                                <form method="POST">
                                                    @csrf
                                                    <input type="submit" formaction="{{ route('applicant.application.test.open',$application) }}" 
                                                           class="px-4 py-2 bg-blue-100 text-blue-600 rounded-lg hover:bg-blue-200 cursor-pointer" 
                                                           value="OPEN"/>
                                                </form>
                                            @elseif ($application->test->status == 'OPEN')
                                                <a href="{{ route('applicant.application.test.index',$application) }}" 
                                                   class="px-4 py-2 bg-yellow-100 text-yellow-600 rounded-lg hover:bg-yellow-200">
                                                    INCOMPLETE
                                                </a>
                                            @else
                                                <span class="px-4 py-2 bg-green-100 text-green-600 rounded-lg">
                                                    {{ $application->test->status }}
                                                </span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-3 py-1 bg-blue-100 text-blue-600 rounded-full">
                                                {{ $application->reg_no }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap font-medium">
                                            @if(is_null($application->test->start_time))
                                                BELUM DIMULAI
                                            @else
                                                {{ \Carbon\Carbon::parse($application->test->start_time)->format('d/m/Y H:i:s') }}
                                            @endif
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Status Messages -->
                    @if ($application->test->status == 'COMPLETED' && $application->status == 'Pending')
                        <div class="mt-6 bg-green-50 rounded-lg p-4">
                            <p class="text-green-700">Terima Kasih telah mengikuti test assessment ini. Selanjutnya kami akan review lamaran kamu, dan akan mengupdate statusnya.</p>
                        </div>
                    @elseif($application->status == 'Approved')
                        <div class="mt-6 bg-green-50 rounded-lg p-4">
                            <p class="text-green-800 font-medium">Selamat, anda telah diterima sebagai pegawai perusahaan ini. Silahkan tunggu email kami untuk informasi lebih lanjut.</p>
                            <p class="text-red-600 mt-2">Anda dapat mengabaikan pesan ini jika sudah menerima email kami.</p>
                        </div>
                    @elseif ($application->status == 'Rejected')
                        <div class="mt-6 bg-red-50 rounded-lg p-4">
                            <div class="text-red-700 space-y-2">
                                <p class="font-medium">Terima kasih telah tertarik berkarir di PT XYZ.</p>
                                <p>Dari hasil review kami, profil Anda masih belum sesuai dengan profil yang kami butuhkan di posisi yang Anda lamar.</p>
                                <p>Anda dapat melamar kembali pada posisi lain yang sesuai dengan minat Anda.</p>
                                <p class="font-medium mt-4">Berikut beberapa hal yang dapat Anda lakukan selama masa pencarian kerja:</p>
                                <ul class="list-disc pl-5 space-y-1">
                                    <li>Latihan interview kerja. "Practice makes perfect" tetap lakukan latihan interview kerja supaya Anda lebih rileks dan siap saat menghadapi interview kerja yang sesungguhnya.</li>
                                    <li>Cari tahu terkait perusahaan yang Anda lamar.</li>
                                    <li>Perbaharui CV Anda secara berkala dan sesuaikan dengan posisi yang akan Anda lamar.</li>
                                    <li>Apabila diperlukan, Anda dapat mengambil kelas pelatihan agar kemampuan Anda dapat meningkat dan terasah.</li>
                                </ul>
                                <p class="font-medium mt-4">Kami berharap yang terbaik untuk karir Anda di masa depan.</p>
                            </div>
                        </div>
                    @endif

                    <!-- Interview Section -->
                    <div class="mt-8">
                        <h2 class="text-xl font-semibold text-gray-800 mb-4">Interview</h2>
                        <div class="overflow-x-auto">
                            <table class="w-full">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tempat Interview</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Waktu</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @if ($application->schedule)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap">@onlyDate($application->schedule->schedule->date)</td>
                                            <td class="px-6 py-4">Jl. Bawal No.1, Batu Merah, Kec. Batu Ampar, Kota Batam, Kepulauan Riau 29452</td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                @formatTime($application->schedule->schedule->start_time) - @formatTime($application->schedule->schedule->end_time)
                                            </td>
                                        </tr>
                                    @else
                                        <tr>
                                            <td colspan="3" class="px-6 py-4 text-center text-gray-500">Tidak ada jadwal interview</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>