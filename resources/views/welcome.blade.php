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

    <main class="pt-16">
        <section class="h-[60vh] bg-cover bg-center" style="background-image: url('https://images.unsplash.com/photo-1648627667032-d02d79b28066?q=80&w=2350&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D');">
            <div class="h-full bg-black bg-opacity-50 flex items-center">
                <div class="container mx-auto px-4">
                    <div class="max-w-xl text-white">
                        <h1 class="text-4xl font-bold mb-4">Laundry Premium di Ujung Jari Anda</h1>
                        <p class="text-xl mb-6">Bersih, Rapi, dan Wangi. Antar Jemput Gratis!</p>
                        <a href="" class="bg-blue-500 text-white px-6 py-2 rounded-full text-lg font-semibold hover:bg-blue-600 transition-colors duration-300 inline-block">Pesan Sekarang</a>
                    </div>
                </div>
            </div>
        </section>

        <section id="layanan" class="py-16 bg-white">
            <div class="container mx-auto px-4">
                <h2 class="text-3xl font-bold text-center text-gray-800 mb-12">Layanan Unggulan Kami</h2>
                <div class="grid md:grid-cols-2 gap-8">
                    <div class="bg-blue-50 p-8 rounded-lg shadow-sm hover:shadow-md transition-shadow duration-300">
                        <i data-feather="zap" class="text-blue-400 mb-4 h-10 w-10"></i>
                        <h3 class="text-2xl font-semibold text-gray-800 mb-4">Layanan Express</h3>
                        <p class="text-gray-600">Selesai dalam waktu ±6 jam. Sempurna untuk kebutuhan mendesak Anda.</p>
                    </div>
                    <div class="bg-blue-50 p-8 rounded-lg shadow-sm hover:shadow-md transition-shadow duration-300">
                        <i data-feather="clock" class="text-blue-400 mb-4 h-10 w-10"></i>
                        <h3 class="text-2xl font-semibold text-gray-800 mb-4">Layanan Reguler</h3>
                        <p class="text-gray-600">Selesai dalam 2 hari. Kualitas premium dengan harga terjangkau.</p>
                    </div>
                </div>
            </div>
        </section>

        <section id="tentang" class="py-16 bg-blue-50">
            <div class="container mx-auto px-4">
                <h2 class="text-3xl font-bold text-center text-gray-800 mb-12">Mengapa Memilih Kami?</h2>
                <div class="grid md:grid-cols-4 gap-8">
                    <div class="text-center">
                        <i data-feather="truck" class="text-blue-400 mb-4 h-10 w-10 mx-auto"></i>
                        <h3 class="text-xl font-semibold mb-2">Antar Jemput Gratis</h3>
                        <p class="text-gray-600">Layanan door-to-door tanpa biaya tambahan</p>
                    </div>
                    <div class="text-center">
                        <i data-feather="shield" class="text-blue-400 mb-4 h-10 w-10 mx-auto"></i>
                        <h3 class="text-xl font-semibold mb-2">Proses Higienis</h3>
                        <p class="text-gray-600">Standar kebersihan tertinggi untuk keamanan Anda</p>
                    </div>
                    <div class="text-center">
                        <i data-feather="award" class="text-blue-400 mb-4 h-10 w-10 mx-auto"></i>
                        <h3 class="text-xl font-semibold mb-2">Kualitas Terjamin</h3>
                        <p class="text-gray-600">Hasil cucian bersih, rapi, dan wangi setiap saat</p>
                    </div>
                    <div class="text-center">
                        <i data-feather="users" class="text-blue-400 mb-4 h-10 w-10 mx-auto"></i>
                        <h3 class="text-xl font-semibold mb-2">Tim Profesional</h3>
                        <p class="text-gray-600">Staf berpengalaman dan terlatih</p>
                    </div>
                </div>
            </div>
        </section>

        <section id="kontak" class="py-16 bg-white">
            <div class="container mx-auto px-4 text-center">
                <h2 class="text-3xl font-bold text-gray-800 mb-8">Hubungi Kami</h2>
                <p class="text-xl text-gray-600 mb-8">Siap melayani kebutuhan laundry Anda</p>
                <div class="flex justify-center space-x-8">
                    <a href="tel:+6281234567890" class="flex items-center text-blue-500 hover:text-blue-600 transition-colors duration-300">
                        <i data-feather="phone" class="mr-2"></i>
                        0895629511226
                    </a>
                    <a href="mailto:info@sanmaxlaundry.com" class="flex items-center text-blue-500 hover:text-blue-600 transition-colors duration-300">
                        <i data-feather="mail" class="mr-2"></i>
                        sanmaxlaundry@gmail.com
                    </a>
                </div>
            </div>
        </section>
    </main>

    <footer class="bg-gray-100 text-gray-600 py-8">
        <div class="container mx-auto px-4">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <div class="mb-4 md:mb-0">
                    <img src="https://www.svgrepo.com/show/195928/laundry.svg" alt="Sanmax Laundry Logo" class="h-8 w-8 inline-block mr-2">
                    <span class="text-lg font-semibold">Sanmax Laundry</span>
                </div>
                <div class="flex space-x-4">
                    <a href="#" class="hover:text-blue-400 transition-colors duration-300"><i data-feather="facebook"></i></a>
                    <a href="#" class="hover:text-blue-400 transition-colors duration-300"><i data-feather="instagram"></i></a>
                    <a href="#" class="hover:text-blue-400 transition-colors duration-300"><i data-feather="twitter"></i></a>
                </div>
            </div>
            <div class="mt-8 text-center text-gray-500">
                <p>&copy; 2024 Sanmax Laundry. Semua Hak Dilindungi.</p>
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