<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\News;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        News::insert([
             [
                'id' => 11,
                'title' => 'Pelatihan AED Bersama PT ALSOK Tingkatkan Kesiapsiagaan Siswa di SMK Mitra Industri MM2100',
                'slug' => 'pelatihan-aed-bersama-pt-alsok-tingkatkan-kesiapsiagaan-siswa-di-smk-mitra-industri-mm2100',
                'content' => 'Cikarang Barat, — SMK Mitra Industri MM2100 kembali menunjukkan komitmennya dalam meningkatkan keselamatan dan kesiapsiagaan di lingkungan sekolah melalui kegiatan Automated External Defibrillator (AED) Training yang diselenggarakan bersama PT ALSOK pada hari ini.\r\n\r\nPelatihan tersebut diikuti oleh total 100 siswa yang berasal dari komunitas sekolah yang berkaitan langsung dengan keselamatan, yaitu siswa Safety Dojo, Palang Merah Remaja (PMR), dan Safety Student Council.\r\n\r\nKegiatan pelatihan diawali dengan pengenalan mengenai fungsi dan peran AED sebagai alat penyelamat nyawa pada kondisi henti jantung mendadak. Para instruktur dari PT ALSOK menjelaskan cara penggunaan AED yang tepat serta lima langkah penting dalam menanganinya secara cepat dan efektif di lapangan.\r\n\r\nSiswa kemudian mendapatkan kesempatan untuk bertanya langsung kepada instruktur terkait prosedur penggunaan AED dalam kondisi darurat yang sesungguhnya. Setelah sesi diskusi, pelatihan dilanjutkan dengan praktik langsung penggunaan AED, di mana seluruh peserta berlatih menangani simulasi henti jantung menggunakan alat yang telah disediakan.\r\n\r\nMelalui kegiatan ini, para peserta memperoleh pemahaman komprehensif mengenai pentingnya tanggap darurat serta memiliki keterampilan dasar dalam membantu menyelamatkan nyawa seseorang sebelum tenaga medis tiba di lokasi. Pelatihan ditutup dengan penyampaian ringkasan hasil kegiatan dan harapan agar seluruh peserta dapat menjadi garda terdepan dalam menjaga keselamatan dan kesehatan di lingkungan sekolah.\r\n\r\nKegiatan pelatihan AED ini menjadi salah satu bentuk kontribusi nyata SMK Mitra Industri MM2100 bersama PT ALSOK dalam membangun budaya sekolah yang peduli keselamatan serta meningkatkan kemampuan siswa dalam menghadapi keadaan darurat secara profesional dan bertanggung jawab.',
                'thumbnail' => 'AED-Training--768x576.jpg',
                'status' => 'publish',
                'created_at' => '2026-01-30 02:02:52',
                'updated_at' => '2026-01-30 02:02:52',
            ],
            [
                'id' => 12,
                'title' => 'Inagurasi Kolaborasi AHM di SMK Mitra Industri MM2100 Dorong Generasi Muda Sehat dan Produktif',
                'slug' => 'inagurasi-kolaborasi-ahm-di-smk-mitra-industri-mm2100-dorong-generasi-muda-sehat-dan-produktif',
                'content' => 'SMK Mitra Industri MM2100 sukses menyelenggarakan kegiatan AHM Collaboration Inaguration pada Rabu, 12 November 2025. Kegiatan ini dirancang untuk mendukung pembentukan generasi muda yang sehat, produktif, dan berkontribusi positif bagi Indonesia.\r\n\r\nAcara dibuka dengan talk show bertema “Generasi Sehat dan Produktif Menuju Indonesia Sehat”, yang menghadirkan pemaparan tentang pentingnya kesehatan dan produktivitas remaja. Kegiatan dilanjutkan dengan sosialisasi kesehatan remaja oleh BKKBN, yang memberikan edukasi komprehensif terkait kesehatan fisik dan mental para siswa.\r\n\r\nSelain itu, PMR SMK Mitra Industri MM2100 melakukan screening kesehatan remaja untuk seluruh siswa kelas XII Akuntansi, sementara PT. AHM menanamkan program duta remaja sehat guna meningkatkan kesadaran akan pola hidup sehat. Kegiatan ini juga dimeriahkan dengan donor darah yang bekerja sama dengan PMI, sebagai bentuk kepedulian sosial dan praktik nyata generasi muda dalam membantu masyarakat.\r\n\r\nKegiatan ini mendapatkan partisipasi aktif dari seluruh siswa dan tenaga pendidik, dengan harapan dapat menumbuhkan kesadaran akan pentingnya kesehatan remaja serta membentuk generasi muda yang tangguh, produktif, dan peduli terhadap lingkungan sosialnya.',
                'thumbnail' => '1-768x432.png',
                'status' => 'publish',
                'created_at' => '2026-01-30 02:06:29',
                'updated_at' => '2026-01-30 02:06:29',
            ],
            [
                'id' => 13,
                'title' => 'Kunjungan Kagawa Bank Diwarnai Sambutan Hangat dan Pembahasan Program CSR',
                'slug' => 'kunjungan-kagawa-bank-diwarnai-sambutan-hangat-dan-pembahasan-program-csr',
                'content' => 'Suasana hangat dan penuh semangat menyambut kedatangan tamu dari Kagawa Bank pada Kamis, 20 November 2025, pukul 08.30 WIB. Kunjungan ini dihadiri oleh tiga perwakilan dan menjadi bagian dari penjajakan kerja sama Program Corporate Social Responsibility (CSR) di bidang pendidikan.\r\n\r\nSetibanya di lingkungan sekolah, para tamu disambut dengan alunan angklung yang merdu serta yel-yel penuh semangat dari tim OSIS, menciptakan kesan pertama yang hangat dan berkesan. Sambutan ini mencerminkan kekompakan, keramahan, serta semangat positif warga sekolah dalam menyambut mitra internasional.\r\n\r\nSetelah sesi penyambutan, kegiatan dilanjutkan dengan diskusi dan pembahasan Program CSR yang berfokus pada peluang kolaborasi dan kontribusi nyata bagi pengembangan pendidikan. Diskusi berlangsung dalam suasana terbuka dan konstruktif sebagai langkah awal menuju kerja sama yang berkelanjutan.\r\n\r\nMelalui kunjungan ini, diharapkan terjalin tindak lanjut kerja sama CSR yang dapat memberikan manfaat bagi siswa serta mendukung penguatan ekosistem pendidikan yang relevan dengan kebutuhan global.',
                'thumbnail' => 'Kagawa-768x432.jpg',
                'status' => 'publish',
                'created_at' => '2026-01-30 02:09:06',
                'updated_at' => '2026-01-30 02:09:06',
            ],
            [
                'id' => 14,
                'title' => 'Studi Banding Bersama LPK One Creative dan Tenant Buka Peluang Kerja Sama Rekrutmen',
                'slug' => 'studi-banding-bersama-lpk-one-creative-dan-tenant-buka-peluang-kerja-sama-rekrutmen',
                'content' => 'Kegiatan studi banding bersama LPK One Creative dan para tenant dilaksanakan pada Rabu, 19 November 2025, pukul 14.00 WIB. Kunjungan ini diikuti oleh 12 orang peserta dan menjadi ajang saling berbagi pengalaman serta praktik baik dalam pengelolaan program dan kesiapan rekrutmen.\r\n\r\nMelalui kegiatan ini, para peserta melakukan pengamatan langsung terhadap sistem, alur pembinaan, serta pendekatan yang diterapkan dalam mendukung kesiapan peserta menuju dunia kerja. Diskusi yang berlangsung membuka ruang pertukaran gagasan terkait strategi penguatan kompetensi dan efektivitas proses rekrutmen.\r\n\r\nStudi banding ini menghasilkan kesepahaman bersama untuk menjalin kerja sama dalam bidang rekrutmen, sebagai tindak lanjut konkret dari kunjungan yang telah dilakukan. Kerja sama tersebut diharapkan dapat memberikan manfaat timbal balik serta memperluas akses peluang kerja bagi peserta.\r\n\r\nKegiatan ini menjadi salah satu bentuk upaya membangun jejaring yang produktif antar lembaga, sekaligus mendorong pengembangan program yang selaras dengan kebutuhan dunia industri.',
                'thumbnail' => 'LPK-One-Creative-2-768x432.jpg',
                'status' => 'publish',
                'created_at' => '2026-01-30 02:10:07',
                'updated_at' => '2026-01-30 02:10:07',
            ],
            [
                'id' => 15,
                'title' => 'Dialog Awal Kerja Sama Mengemuka dalam Kunjungan Nanto Bank',
                'slug' => 'dialog-awal-kerja-sama-mengemuka-dalam-kunjungan-nanto-bank',
                'content' => 'Kunjungan tamu dari Nanto Bank pada Jumat, 7 November 2025, pukul 08.00 WIB, menjadi ruang dialog awal untuk membangun kerja sama yang berkelanjutan. Kegiatan ini dihadiri oleh empat perwakilan dan berlangsung dalam suasana diskusi yang terbuka dan profesional.\r\n\r\nDalam kunjungan tersebut, dilakukan pembahasan mengenai potensi kolaborasi yang dapat dikembangkan bersama, seiring dengan komitmen kedua belah pihak dalam mendukung penguatan pendidikan dan pengembangan sumber daya manusia. Diskusi difokuskan pada keselarasan visi serta peluang kerja sama yang relevan untuk jangka panjang.\r\n\r\nSebagai hasil dari pertemuan ini, disepakati adanya tindak lanjut (follow up) kerja sama guna membahas langkah-langkah konkret yang dapat direalisasikan ke depannya. Tahap ini menjadi fondasi penting dalam membangun hubungan kemitraan yang saling mendukung.\r\n\r\nKunjungan Nanto Bank ini menegaskan pentingnya komunikasi dan kepercayaan sebagai dasar dalam menjalin kolaborasi strategis antara dunia pendidikan dan sektor keuangan.',
                'thumbnail' => 'DSC09220-768x432.jpg',
                'status' => 'publish',
                'created_at' => '2026-01-30 02:11:11',
                'updated_at' => '2026-01-30 02:11:11',
            ],
            [
                'id' => 16,
                'title' => 'Kesempatan Datang! Rekrutmen Magang Global Dibuka',
                'slug' => 'kesempatan-datang!-rekrutmen-magang-global-dibuka',
                'content' => 'SMK Mitra Industri MM2100 menjadi lokasi pelaksanaan kegiatan rekrutmen dan wawancara peserta magang yang difasilitasi oleh Leo Global Works pada Jumat, 5 Desember 2025, pukul 08.30 WIB. Kegiatan ini diikuti oleh peserta dari program Horenso sebagai bagian dari proses seleksi magang.\r\n\r\nDalam kegiatan tersebut, para peserta mengikuti sesi wawancara langsung dengan user untuk menilai kesiapan, motivasi, serta pemahaman mereka terhadap budaya dan lingkungan kerja industri. Proses rekrutmen ini memberikan pengalaman nyata bagi siswa dalam menghadapi tahapan seleksi dunia kerja secara profesional.\r\n\r\nSeluruh rangkaian kegiatan dilaksanakan di lingkungan SMK Mitra Industri MM2100 dengan pendampingan dari pihak sekolah dan perwakilan Leo Global Works yang berjumlah tiga orang. Para peserta menunjukkan antusiasme serta keseriusan selama proses seleksi berlangsung.\r\n\r\nMelalui kegiatan ini, beberapa peserta dinyatakan berhasil dan diterima sebagai peserta magang. Capaian tersebut menjadi indikator positif atas kesiapan siswa SMK Mitra Industri MM2100 dalam mengikuti program magang dan menghadapi tantangan dunia industri, termasuk pada skala internasional.\r\n\r\nSMK Mitra Industri MM2100 terus berupaya memberikan akses dan peluang terbaik bagi siswa melalui kerja sama dengan berbagai mitra industri, guna membekali lulusan dengan pengalaman kerja yang relevan dan berdaya saing.',
                'thumbnail' => 'Leo-Global-Works-768x432.jpg',
                'status' => 'publish',
                'created_at' => '2026-01-30 02:12:25',
                'updated_at' => '2026-01-30 02:12:25',
            ]
        ]);
    }
}
