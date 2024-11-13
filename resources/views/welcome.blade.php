<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Sanmax Laundry') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
</head>
<body class="bg-blue-50 text-gray-800 font-sans">

    @include('layouts.front-navigation') 

    <main >
        <section class="h-[60vh] bg-cover bg-center" style="background-image: url('https://images.unsplash.com/photo-1521737711867-e3b97375f902?q=80&w=2340&auto=format&fit=crop');">
            <div class="h-full bg-black bg-opacity-50 flex items-center">
                <div class="container mx-auto px-4">
                    <div class="max-w-xl text-white">
                        <h1 class="text-4xl font-bold mb-4">Temukan Karier Impian Anda</h1>
                        <p class="text-xl mb-6">Bergabunglah dengan tim kami dan kembangkan potensi Anda!</p>
                        <a href="{{ route('applicant.job.index') }}" class="bg-blue-500 text-white px-6 py-2 rounded-full text-lg font-semibold hover:bg-blue-600 transition-colors duration-300 inline-block">Lihat Lowongan</a>
                    </div>
                </div>
            </div>
        </section>
    
        <section id="layanan" class="py-16 bg-white">
            <div class="container mx-auto px-4">
                <h2 class="text-3xl font-bold text-center text-gray-800 mb-12">Proses Rekrutmen</h2>
                <div class="grid md:grid-cols-2 gap-8">
                    <div class="bg-blue-50 p-8 rounded-lg shadow-sm hover:shadow-md transition-shadow duration-300">
                        <i data-feather="file-text" class="text-blue-400 mb-4 h-10 w-10"></i>
                        <h3 class="text-2xl font-semibold text-gray-800 mb-4">Aplikasi Online</h3>
                        <p class="text-gray-600">Proses aplikasi yang mudah dan cepat. Kirim CV dan dokumen pendukung Anda secara online.</p>
                    </div>
                    <div class="bg-blue-50 p-8 rounded-lg shadow-sm hover:shadow-md transition-shadow duration-300">
                        <i data-feather="users" class="text-blue-400 mb-4 h-10 w-10"></i>
                        <h3 class="text-2xl font-semibold text-gray-800 mb-4">Wawancara</h3>
                        <p class="text-gray-600">Kesempatan untuk bertemu tim kami dan diskusi tentang pengalaman serta aspirasi Anda.</p>
                    </div>
                </div>
            </div>
        </section>
    
        <section id="tentang" class="py-16 bg-blue-50">
            <div class="container mx-auto px-4">
                <h2 class="text-3xl font-bold text-center text-gray-800 mb-12">Mengapa Bergabung Dengan Kami?</h2>
                <div class="grid md:grid-cols-4 gap-8">
                    <div class="text-center">
                        <i data-feather="trending-up" class="text-blue-400 mb-4 h-10 w-10 mx-auto"></i>
                        <h3 class="text-xl font-semibold mb-2">Pengembangan Karier</h3>
                        <p class="text-gray-600">Kesempatan pertumbuhan karier yang jelas</p>
                    </div>
                    <div class="text-center">
                        <i data-feather="book-open" class="text-blue-400 mb-4 h-10 w-10 mx-auto"></i>
                        <h3 class="text-xl font-semibold mb-2">Pelatihan Berkelanjutan</h3>
                        <p class="text-gray-600">Program pengembangan skill yang komprehensif</p>
                    </div>
                    <div class="text-center">
                        <i data-feather="heart" class="text-blue-400 mb-4 h-10 w-10 mx-auto"></i>
                        <h3 class="text-xl font-semibold mb-2">Benefit Menarik</h3>
                        <p class="text-gray-600">Paket kompensasi dan tunjangan kompetitif</p>
                    </div>
                    <div class="text-center">
                        <i data-feather="coffee" class="text-blue-400 mb-4 h-10 w-10 mx-auto"></i>
                        <h3 class="text-xl font-semibold mb-2">Budaya Kerja Positif</h3>
                        <p class="text-gray-600">Lingkungan kerja yang dinamis dan inklusif</p>
                    </div>
                </div>
            </div>
        </section>
    
        <section id="kontak" class="py-16 bg-white">
            <div class="container mx-auto px-4 text-center">
                <h2 class="text-3xl font-bold text-gray-800 mb-8">Hubungi Tim Rekrutmen</h2>
                <p class="text-xl text-gray-600 mb-8">Punya pertanyaan? Kami siap membantu!</p>
                <div class="flex justify-center space-x-8">
                    <a href="tel:+6281234567890" class="flex items-center text-blue-500 hover:text-blue-600 transition-colors duration-300">
                        <i data-feather="phone" class="mr-2"></i>
                        0895629511226
                    </a>
                    <a href="mailto:recruitment@company.com" class="flex items-center text-blue-500 hover:text-blue-600 transition-colors duration-300">
                        <i data-feather="mail" class="mr-2"></i>
                        recruitment@company.com
                    </a>
                </div>
            </div>
        </section>
    </main>
    
    <footer class="bg-gray-100 text-gray-600 py-8">
        <div class="container mx-auto px-4">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <div class="mb-4 md:mb-0">
                    <img src="https://www.svgrepo.com/show/501266/company.svg" alt="Company Logo" class="h-8 w-8 inline-block mr-2">
                    <span class="text-lg font-semibold">Your Company</span>
                </div>
                <div class="flex space-x-4">
                    <a href="#" class="hover:text-blue-400 transition-colors duration-300"><i data-feather="linkedin"></i></a>
                    <a href="#" class="hover:text-blue-400 transition-colors duration-300"><i data-feather="instagram"></i></a>
                    <a href="#" class="hover:text-blue-400 transition-colors duration-300"><i data-feather="twitter"></i></a>
                </div>
            </div>
            <div class="mt-8 text-center text-gray-500">
                <p>&copy; 2024 Your Company. All Rights Reserved.</p>
            </div>
        </div>
    </footer>

    <script>
        feather.replace();
        
        const userMenu = document.getElementById('userMenu');
        const userDropdown = document.getElementById('userDropdown');
        if (userMenu && userDropdown) {
            userMenu.addEventListener('click', () => {
                userDropdown.classList.toggle('hidden');
            });

            window.addEventListener('click', (e) => {
                if (!userMenu.contains(e.target)) {
                    userDropdown.classList.add('hidden');
                }
            });
        }
    </script>
</body>
</html>