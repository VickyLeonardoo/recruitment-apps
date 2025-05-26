<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PsikotesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Pastikan tabel dikosongkan terlebih dahulu jika Anda menjalankan seeder berulang kali
        DB::table('choices')->truncate();
        DB::table('questions')->truncate();

        // Data pertanyaan dan jawaban psikotes
        $questionsData = [
            [
                'description' => 'Jika "Rumah" berhubungan dengan "Atap", maka "Buku" berhubungan dengan...',
                'difficult' => 'easy',
                'answers' => [
                    ['answerText' => 'Halaman', 'is_correct' => false],
                    ['answerText' => 'Penulis', 'is_correct' => false],
                    ['answerText' => 'Kata', 'is_correct' => false],
                    ['answerText' => 'Sampul', 'is_correct' => true], // Correct
                ],
            ],
            [
                'description' => 'Temukan kata yang tidak termasuk dalam kelompok berikut: Apel, Jeruk, Pisang, Wortel, Anggur',
                'difficult' => 'easy',
                'answers' => [
                    ['answerText' => 'Apel', 'is_correct' => false],
                    ['answerText' => 'Jeruk', 'is_correct' => false],
                    ['answerText' => 'Wortel', 'is_correct' => true], // Correct
                    ['answerText' => 'Anggur', 'is_correct' => false],
                ],
            ],
            [
                'description' => 'Lengkapi urutan angka berikut: 2, 4, 8, 16, ___',
                'difficult' => 'medium',
                'answers' => [
                    ['answerText' => '20', 'is_correct' => false],
                    ['answerText' => '24', 'is_correct' => false],
                    ['answerText' => '32', 'is_correct' => true], // Correct
                    ['answerText' => '64', 'is_correct' => false],
                ],
            ],
            [
                'description' => 'Panas >< ...',
                'difficult' => 'easy',
                'answers' => [
                    ['answerText' => 'Api', 'is_correct' => false],
                    ['answerText' => 'Dingin', 'is_correct' => true], // Correct
                    ['answerText' => 'Terik', 'is_correct' => false],
                    ['answerText' => 'Hangat', 'is_correct' => false],
                ],
            ],
            [
                'description' => 'Guru : Murid = Dokter : ...',
                'difficult' => 'easy',
                'answers' => [
                    ['answerText' => 'Perawat', 'is_correct' => false],
                    ['answerText' => 'Obat', 'is_correct' => false],
                    ['answerText' => 'Pasien', 'is_correct' => true], // Correct
                    ['answerText' => 'Rumah Sakit', 'is_correct' => false],
                ],
            ],
            [
                'description' => 'Saat menghadapi masalah sulit di tempat kerja, saya cenderung:',
                'difficult' => 'hard', // Bisa dianggap 'hard' karena melibatkan penilaian diri
                'answers' => [
                    ['answerText' => 'Mencari bantuan dari rekan kerja atau atasan secepatnya.', 'is_correct' => true], // Ideal
                    ['answerText' => 'Mencoba menyelesaikannya sendiri terlebih dahulu, bahkan jika butuh waktu lebih lama.', 'is_correct' => false],
                    ['answerText' => 'Menunda penyelesaian masalah sampai ada instruksi yang jelas.', 'is_correct' => false],
                    ['answerText' => 'Menyalahkan pihak lain atas masalah tersebut.', 'is_correct' => false],
                ],
            ],
            [
                'description' => 'Ketika ada perbedaan pendapat dalam tim, saya biasanya:',
                'difficult' => 'medium',
                'answers' => [
                    ['answerText' => 'Mempertahankan pendapat saya tanpa kompromi.', 'is_correct' => false],
                    ['answerText' => 'Mencoba mencari titik temu dan solusi yang adil.', 'is_correct' => true], // Ideal
                    ['answerText' => 'Mengikuti pendapat mayoritas meskipun tidak setuju.', 'is_correct' => false],
                    ['answerText' => 'Menarik diri dari diskusi.', 'is_correct' => false],
                ],
            ],
            [
                'description' => 'Manakah kelanjutan pola berikut: 5, 10, 20, 40, ...',
                'difficult' => 'easy',
                'choices' => [
                    ['label' => 'A', 'text' => '45', 'is_correct' => false],
                    ['label' => 'B', 'text' => '60', 'is_correct' => false],
                    ['label' => 'C', 'text' => '70', 'is_correct' => false],
                    ['label' => 'D', 'text' => '80', 'is_correct' => true],
                ]
            ],
            [
                'description' => 'Sinonim dari kata “terampil” adalah:',
                'difficult' => 'easy',
                'choices' => [
                    ['label' => 'A', 'text' => 'Ahli', 'is_correct' => true],
                    ['label' => 'B', 'text' => 'Lambat', 'is_correct' => false],
                    ['label' => 'C', 'text' => 'Canggung', 'is_correct' => false],
                    ['label' => 'D', 'text' => 'Baru', 'is_correct' => false],
                ]
            ],
            [
                'description' => 'Jika 1 = A, 2 = B, 3 = C, maka 26 adalah:',
                'difficult' => 'easy',
                'choices' => [
                    ['label' => 'A', 'text' => 'Z', 'is_correct' => true],
                    ['label' => 'B', 'text' => 'Y', 'is_correct' => false],
                    ['label' => 'C', 'text' => 'X', 'is_correct' => false],
                    ['label' => 'D', 'text' => 'W', 'is_correct' => false],
                ]
            ],
            [
                'description' => 'Kata yang berlawanan arti dengan “optimis” adalah:',
                'difficult' => 'medium',
                'choices' => [
                    ['label' => 'A', 'text' => 'Realistis', 'is_correct' => false],
                    ['label' => 'B', 'text' => 'Pesimis', 'is_correct' => true],
                    ['label' => 'C', 'text' => 'Logis', 'is_correct' => false],
                    ['label' => 'D', 'text' => 'Emosional', 'is_correct' => false],
                ]
            ],
            [
                'description' => 'Kakek dari anak ayahku adalah?',
                'difficult' => 'easy',
                'choices' => [
                    ['label' => 'A', 'text' => 'Saya', 'is_correct' => false],
                    ['label' => 'B', 'text' => 'Ayah saya', 'is_correct' => true],
                    ['label' => 'C', 'text' => 'Anak saya', 'is_correct' => false],
                    ['label' => 'D', 'text' => 'Paman saya', 'is_correct' => false],
                ]
            ],
            [
                'description' => 'Jika 3 anak dapat menyelesaikan pekerjaan dalam 6 hari, maka 6 anak akan menyelesaikan pekerjaan dalam:',
                'difficult' => 'medium',
                'choices' => [
                    ['label' => 'A', 'text' => '9 hari', 'is_correct' => false],
                    ['label' => 'B', 'text' => '6 hari', 'is_correct' => false],
                    ['label' => 'C', 'text' => '3 hari', 'is_correct' => true],
                    ['label' => 'D', 'text' => '12 hari', 'is_correct' => false],
                ]
            ],
            [
                'description' => 'Apa huruf selanjutnya dalam urutan berikut: A, C, E, G, ...?',
                'difficult' => 'easy',
                'choices' => [
                    ['label' => 'A', 'text' => 'I', 'is_correct' => true],
                    ['label' => 'B', 'text' => 'H', 'is_correct' => false],
                    ['label' => 'C', 'text' => 'J', 'is_correct' => false],
                    ['label' => 'D', 'text' => 'F', 'is_correct' => false],
                ]
            ],
            [
                'description' => 'Urutan berikut adalah: 121, 144, 169, 196, ...?',
                'difficult' => 'medium',
                'choices' => [
                    ['label' => 'A', 'text' => '225', 'is_correct' => true],
                    ['label' => 'B', 'text' => '210', 'is_correct' => false],
                    ['label' => 'C', 'text' => '215', 'is_correct' => false],
                    ['label' => 'D', 'text' => '220', 'is_correct' => false],
                ]
            ],
            [
                'description' => 'Apa yang tidak termasuk dalam kelompok berikut: Mobil, Motor, Sepeda, Televisi?',
                'difficult' => 'easy',
                'choices' => [
                    ['label' => 'A', 'text' => 'Mobil', 'is_correct' => false],
                    ['label' => 'B', 'text' => 'Motor', 'is_correct' => false],
                    ['label' => 'C', 'text' => 'Sepeda', 'is_correct' => false],
                    ['label' => 'D', 'text' => 'Televisi', 'is_correct' => true],
                ]
            ],
            [
                'description' => 'Pilih pasangan kata yang paling berhubungan: Dokter : Pasien = Guru : ...?',
                'difficult' => 'easy',
                'choices' => [
                    ['label' => 'A', 'text' => 'Ilmu', 'is_correct' => false],
                    ['label' => 'B', 'text' => 'Siswa', 'is_correct' => true],
                    ['label' => 'C', 'text' => 'Buku', 'is_correct' => false],
                    ['label' => 'D', 'text' => 'Sekolah', 'is_correct' => false],
                ]
            ],
            [
                'description' => 'Jika semua kucing adalah hewan, dan beberapa hewan adalah harimau, maka:',
                'difficult' => 'medium',
                'choices' => [
                    ['label' => 'A', 'text' => 'Semua kucing adalah harimau', 'is_correct' => false],
                    ['label' => 'B', 'text' => 'Semua harimau adalah kucing', 'is_correct' => false],
                    ['label' => 'C', 'text' => 'Beberapa kucing mungkin harimau', 'is_correct' => false],
                    ['label' => 'D', 'text' => 'Tidak ada kesimpulan pasti', 'is_correct' => true],
                ]
            ],
            [
                'description' => 'Jam menunjukkan pukul 3:15, berapa sudut antara jarum jam dan jarum menit?',
                'difficult' => 'hard',
                'choices' => [
                    ['label' => 'A', 'text' => '7.5°', 'is_correct' => true],
                    ['label' => 'B', 'text' => '0°', 'is_correct' => false],
                    ['label' => 'C', 'text' => '15°', 'is_correct' => false],
                    ['label' => 'D', 'text' => '30°', 'is_correct' => false],
                ]
            ],
            [
                'description' => 'Kata “kreatif” berlawanan dengan:',
                'difficult' => 'easy',
                'choices' => [
                    ['label' => 'A', 'text' => 'Inovatif', 'is_correct' => false],
                    ['label' => 'B', 'text' => 'Pasif', 'is_correct' => false],
                    ['label' => 'C', 'text' => 'Mandek', 'is_correct' => true],
                    ['label' => 'D', 'text' => 'Kritis', 'is_correct' => false],
                ]
            ],
            [
                'description' => 'Manakah dari berikut ini yang merupakan bilangan prima?',
                'difficult' => 'easy',
                'choices' => [
                    ['label' => 'A', 'text' => '9', 'is_correct' => false],
                    ['label' => 'B', 'text' => '15', 'is_correct' => false],
                    ['label' => 'C', 'text' => '13', 'is_correct' => true],
                    ['label' => 'D', 'text' => '21', 'is_correct' => false],
                ]
            ],
            [
                'description' => 'Jika Senin adalah hari ke-1, maka hari ke-10 adalah:',
                'difficult' => 'easy',
                'choices' => [
                    ['label' => 'A', 'text' => 'Rabu', 'is_correct' => true],
                    ['label' => 'B', 'text' => 'Selasa', 'is_correct' => false],
                    ['label' => 'C', 'text' => 'Kamis', 'is_correct' => false],
                    ['label' => 'D', 'text' => 'Jumat', 'is_correct' => false],
                ]
            ],
            [
                'description' => 'Berapakah hasil dari 3 + 6 × (5 + 4) ÷ 3 - 7?',
                'difficult' => 'hard',
                'choices' => [
                    ['label' => 'A', 'text' => '11', 'is_correct' => false],
                    ['label' => 'B', 'text' => '12', 'is_correct' => true],
                    ['label' => 'C', 'text' => '14', 'is_correct' => false],
                    ['label' => 'D', 'text' => '15', 'is_correct' => false],
                ]
            ],
            [
                'description' => 'Manakah kata yang tidak berhubungan: Bunga, Daun, Akar, Meja?',
                'difficult' => 'easy',
                'choices' => [
                    ['label' => 'A', 'text' => 'Bunga', 'is_correct' => false],
                    ['label' => 'B', 'text' => 'Akar', 'is_correct' => false],
                    ['label' => 'C', 'text' => 'Daun', 'is_correct' => false],
                    ['label' => 'D', 'text' => 'Meja', 'is_correct' => true],
                ]
            ],
            [
                'description' => 'Jika 2x + 3 = 11, maka x = ?',
                'difficult' => 'easy',
                'choices' => [
                    ['label' => 'A', 'text' => '4', 'is_correct' => true],
                    ['label' => 'B', 'text' => '3', 'is_correct' => false],
                    ['label' => 'C', 'text' => '5', 'is_correct' => false],
                    ['label' => 'D', 'text' => '6', 'is_correct' => false],
                ]
            ],
            [
                'description' => 'Burung berhubungan dengan terbang seperti ikan berhubungan dengan ...?',
                'difficult' => 'easy',
                'choices' => [
                    ['label' => 'A', 'text' => 'Air', 'is_correct' => false],
                    ['label' => 'B', 'text' => 'Laut', 'is_correct' => false],
                    ['label' => 'C', 'text' => 'Berenang', 'is_correct' => true],
                    ['label' => 'D', 'text' => 'Sirip', 'is_correct' => false],
                ]
            ],
            [
                'description' => 'Apabila besok adalah hari Minggu, maka 4 hari yang lalu adalah?',
                'difficult' => 'medium',
                'choices' => [
                    ['label' => 'A', 'text' => 'Rabu', 'is_correct' => true],
                    ['label' => 'B', 'text' => 'Kamis', 'is_correct' => false],
                    ['label' => 'C', 'text' => 'Jumat', 'is_correct' => false],
                    ['label' => 'D', 'text' => 'Selasa', 'is_correct' => false],
                ]
            ],
            [
                'description' => 'Jika semua A adalah B dan semua B adalah C, maka:',
                'difficult' => 'medium',
                'choices' => [
                    ['label' => 'A', 'text' => 'Semua C adalah A', 'is_correct' => false],
                    ['label' => 'B', 'text' => 'Semua A adalah C', 'is_correct' => true],
                    ['label' => 'C', 'text' => 'Semua B adalah A', 'is_correct' => false],
                    ['label' => 'D', 'text' => 'C adalah A', 'is_correct' => false],
                ]
            ],
            [
                'description' => 'Manakah kelanjutan dari urutan: 2, 6, 12, 20, ...?',
                'difficult' => 'medium',
                'choices' => [
                    ['label' => 'A', 'text' => '28', 'is_correct' => false],
                    ['label' => 'B', 'text' => '30', 'is_correct' => true],
                    ['label' => 'C', 'text' => '32', 'is_correct' => false],
                    ['label' => 'D', 'text' => '36', 'is_correct' => false],
                ]
            ],
            [
                'description' => 'Kebalikan dari kata “ceroboh” adalah:',
                'difficult' => 'easy',
                'choices' => [
                    ['label' => 'A', 'text' => 'Cermat', 'is_correct' => true],
                    ['label' => 'B', 'text' => 'Berani', 'is_correct' => false],
                    ['label' => 'C', 'text' => 'Santai', 'is_correct' => false],
                    ['label' => 'D', 'text' => 'Cepat', 'is_correct' => false],
                ]
            ],
            [
                'description' => '2, 4, 8, 16, ...?',
                'difficult' => 'easy',
                'choices' => [
                    ['label' => 'A', 'text' => '24', 'is_correct' => false],
                    ['label' => 'B', 'text' => '30', 'is_correct' => false],
                    ['label' => 'C', 'text' => '32', 'is_correct' => true],
                    ['label' => 'D', 'text' => '36', 'is_correct' => false],
                ]
            ],
            [
                'description' => 'Apa sinonim dari kata “bijak”?',
                'difficult' => 'medium',
                'choices' => [
                    ['label' => 'A', 'text' => 'Arogan', 'is_correct' => false],
                    ['label' => 'B', 'text' => 'Pandai', 'is_correct' => false],
                    ['label' => 'C', 'text' => 'Hikmat', 'is_correct' => false],
                    ['label' => 'D', 'text' => 'Bijaksana', 'is_correct' => true],
                ]
            ],
            
        ];

        $labels = ['A', 'B', 'C', 'D'];

        foreach ($questionsData as $qData) {
            $questionId = DB::table('questions')->insertGetId([
                'description' => $qData['description'],
                'image' => null,
                'difficult' => $qData['difficult'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            foreach ($qData['answers'] as $index => $aData) {
                DB::table('choices')->insert([
                    'question_id' => $questionId,
                    'answerText' => $aData['answerText'],
                    'answerImage' => null,
                    'is_correct' => $aData['is_correct'],
                    'label' => $labels[$index],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        
    }
}
