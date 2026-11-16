<?php

namespace Database\Seeders;

use App\Models\ArsitekturFilosofi;
use App\Models\ArsitekturSimbol;
use App\Models\KategoriBerita;
use App\Models\Lingkungan;
use App\Models\LiturgiPeran;
use App\Models\OrganisasiKategorial;
use App\Models\ProfilParoki;
use App\Models\SakramenInformasi;
use App\Models\Stasi;
use Illuminate\Database\Seeder;

class MasterDataParokiSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Profil Paroki
        ProfilParoki::firstOrCreate(
            ['nama_paroki' => 'Paroki Santo Paulus Wonosobo'],
            [
                'keuskupan' => 'Keuskupan Purwokerto',
                'pelindung' => 'Santo Paulus Rasul',
                'pesta_nama' => '29 Juni',
                'alamat' => 'Jl. Letjen S. Parman No. 2, Wonosobo, Jawa Tengah',
                'kelurahan' => 'Wonosobo Timur',
                'kecamatan' => 'Wonosobo',
                'kabupaten' => 'Wonosobo',
                'provinsi' => 'Jawa Tengah',
                'kode_pos' => '56311',
                'telepon' => '(0286) 321xxx',
                'email' => 'sekretariat@parokiwonosobo.org',
                'whatsapp' => '081234567890',
                'google_maps_embed' => '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3957.5701460367375!2d109.9022!3d-7.3621!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zN8KwMjEnNDMuNiJTIDEwOcKwNTQnMDcuOSJF!5e0!3m2!1sid!2sid!4v1" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>',
                'latitude' => -7.36210000,
                'longitude' => 109.90220000,
                'deskripsi_singkat' => 'Gereja Paroki Santo Paulus Wonosobo merupakan pusat persekutuan umat beriman Katolik di lereng pegunungan Dieng, bercirikan inkulturasi arsitektur Joglo Pangrawit Ceblokan dan spiritualitas Goa Garba yang ramah, hangat, dan berakar pada budaya lokal.',
                'sambutan_pastor' => 'Berkah Dalem. Selamat datang di portal resmi Paroki Santo Paulus Wonosobo. Semoga website ini menjadi sarana perjumpaan kasih, pewartaan kabar sukacita, dan jembatan komunikasi bagi seluruh umat di lingkungan, stasi, maupun siapa saja yang mencari berkat Tuhan.',
                'visi' => 'Terwujudnya persekutuan umat beriman yang berakar mendalam dalam Kristus, berjiwa inklusif, merawat kebudayaan lokal, dan berbela rasa bagi sesama dan keutuhan ciptaan di bumi Wonosobo.',
                'misi' => "1. Menumbuhkembangkan kehidupan doa, sakramental, dan katekese yang berakar pada Sabda Allah.\n2. Mengembangkan dialog kehidupan dan inkulturasi nilai-nilai luhur budaya Jawa dalam liturgi dan pastoral.\n3. Mewujudkan persaudaraan sejati di 14 lingkungan dan 7 stasi melalui karya karitatif dan pemberdayaan sosial ekonomi.",
                'foto_gereja_utama' => null,
            ]
        );

        // 2. Arsitektur Filosofis
        ArsitekturFilosofi::firstOrCreate(
            ['nama_arsitektur' => 'Joglo Pangrawit Ceblokan'],
            [
                'konsep_utama' => 'Garbha Griha / Goa Garba',
                'inkulturasi' => 'Penyatuan nilai arsitektur vernakular Jawa (Joglo Pangrawit Ceblokan) dengan teologi Katolik tentang Bait Allah. Konsep Goa Garba (rahim) melambangkan gereja sebagai rahim rohani yang melahirkan kembali umat manusia melalui sakramen baptis dan ekaristi.',
                'deskripsi_lengkap' => 'Bangunan Gereja Santo Paulus Wonosobo mengadopsi struktur Joglo Pangrawit dengan sistem konstruksi Ceblokan (tiang soko guru yang tertanam kokoh ke dalam umpak bumi), melambangkan iman umat yang berakar teguh pada Kristus di tanah Wonosobo yang berbukit dan sejuk. Ruang ibadat dirancang dengan hierarki sakral dari pendopo (pelataran umat/pancaran keterbukaan), pringgitan (transisi kesiapan hati), hingga dalem / goa garba sakral (altar suci tempat hadirat Allah bersemayam).',
                'foto_arsitektur' => null,
            ]
        );

        // 3. 20 Simbol Arsitektur Gereja
        $simbols = [
            [
                'nomor_simbol' => 1,
                'nama_simbol' => 'Umpak Batu Hitam Gunung',
                'arti_filosofis' => 'Landasan dasar tiang berbatu alam lokal Dieng melambangkan keteguhan jiwa Jawa yang membumi (ora kagetan, ora gumunan).',
                'makna_teologis' => 'Kristus sebagai Batu Penjuru yang hidup, dasar di mana seluruh bangunan iman umat bertumpu kokoh (1 Petrus 2:4-5).',
                'lokasi_pada_gereja' => 'Kaki seluruh soko guru utama dan soko rawa gereja',
            ],
            [
                'nomor_simbol' => 2,
                'nama_simbol' => 'Soko Guru Papat (Empat Tiang Pokok)',
                'arti_filosofis' => 'Empat pilar utama penyangga atap tajug mewakili empat anasir kehidupan mikrokosmos dan makrokosmos (sedulur papat lima pancer).',
                'makna_teologis' => 'Empat Penginjil (Matius, Markus, Lukas, Yohanes) yang menopang pewartaan Kabar Sukacita Injil Kristus ke seluruh penjuru bumi.',
                'lokasi_pada_gereja' => 'Pusat ruang ibadat utama mengelilingi ruang panti imam',
            ],
            [
                'nomor_simbol' => 3,
                'nama_simbol' => 'Tumpang Sari Bertingkat',
                'arti_filosofis' => 'Susunan balok kayu bertingkat ke atas melambangkan tahapan penyempurnaan batin manusia menuju Hyang Widhi (Kasampurnan).',
                'makna_teologis' => 'Tujuh tingkatan rahmat Roh Kudus dan pendakian jiwa menuju kesatuan mistik dengan Allah dalam doa kontemplatif.',
                'lokasi_pada_gereja' => 'Langit-langit atap utama di atas area altar',
            ],
            [
                'nomor_simbol' => 4,
                'nama_simbol' => 'Goa Garba (Panti Imam Tersembunyi)',
                'arti_filosofis' => 'Ruang rahim ibu (garbha griha) yang hening, terlindung, dan teduh; tempat mula pertama kehidupan dirajut dalam kehangatan kasih.',
                'makna_teologis' => 'Misteri Inkarnasi Sabda menjadi manusia dalam rahim Santa Perawan Maria dan rahim kasih Allah yang tanpa syarat bagi ciptaan-Nya.',
                'lokasi_pada_gereja' => 'Ruang altar utama dan tabernakel',
            ],
            [
                'nomor_simbol' => 5,
                'nama_simbol' => 'Salib Pedang Santo Paulus',
                'arti_filosofis' => 'Keseimbangan garis vertikal (manembah) dan horizontal (memayu hayuning bawana).',
                'makna_teologis' => 'Pedang Roh yang adalah Firman Allah dan atribut kemartiran Rasul Paulus, pelindung utama paroki.',
                'lokasi_pada_gereja' => 'Dinding utama di belakang meja altar',
            ],
            [
                'nomor_simbol' => 6,
                'nama_simbol' => 'Atap Tajug Ceblokan',
                'arti_filosofis' => 'Puncak atap meruncing tinggi ke arah langit Dieng, menghubungkan manusia dengan Sang Pencipta Jagat.',
                'makna_teologis' => 'Doa umat yang membubung bagaikan asap dupa harum ke hadirat Tuhan Yang Mahatinggi.',
                'lokasi_pada_gereja' => 'Kubah eksterior atap bangunan tengah gereja',
            ],
            [
                'nomor_simbol' => 7,
                'nama_simbol' => 'Ukiran Bunga Melati Sekar Jagad',
                'arti_filosofis' => 'Bunga melati putih harum semerbak tanpa pamer warna, simbol kesucian hati, ketulusan budi, dan kerendahan hati.',
                'makna_teologis' => 'Keharuman hidup orang-orang beriman dan kemurnian Bunda Maria Ratu Surgawi.',
                'lokasi_pada_gereja' => 'Listplang balok galar dan ornamen pilar kayu',
            ],
            [
                'nomor_simbol' => 8,
                'nama_simbol' => 'Pintu Kori Ukir Tiga Arah',
                'arti_filosofis' => 'Pintu gerbang keterbukaan bagi siapa pun yang datang mencari perlindungan dan ketenangan jiwa.',
                'makna_teologis' => 'Panggilan Trinitaris (Bapa, Putra, dan Roh Kudus) yang mengundang semua orang masuk ke dalam persekutuan keselamatan.',
                'lokasi_pada_gereja' => 'Pintu utama masuk gereja',
            ],
            [
                'nomor_simbol' => 9,
                'nama_simbol' => 'Meja Altar Kayu Jati Utuh',
                'arti_filosofis' => 'Batu gilig kayu jati alas Wonosobo yang tahan zaman, simbol kesetiaan janji dan ketulusan niat.',
                'makna_teologis' => 'Meja Perjamuan Ekaristi Kristus, kurban abadi yang mempersatukan umat dengan korban Kalvari.',
                'lokasi_pada_gereja' => 'Pusat panti imam',
            ],
            [
                'nomor_simbol' => 10,
                'nama_simbol' => 'Bejana Baptis Gentong Tirta Kamandanu',
                'arti_filosofis' => 'Gentong sumber air suci pegunungan Jawa penyejuk raga dan jiwa pengelana.',
                'makna_teologis' => 'Air pembaptisan yang membersihkan noda dosa asal dan melahirkan insan baru anak-anak Allah.',
                'lokasi_pada_gereja' => 'Sayap kiri pintu gerbang masuk utama',
            ],
            [
                'nomor_simbol' => 11,
                'nama_simbol' => 'Lampu Robyong Altar',
                'arti_filosofis' => 'Cahaya pencerah di tengah kegelapan malam temaram (madhangi jagad).',
                'makna_teologis' => 'Terang Kristus yang menerangi bangsa-bangsa dan menuntun langkah umat manusia keluar dari kegelapan dosa.',
                'lokasi_pada_gereja' => 'Tergantung di tengah panti imam',
            ],
            [
                'nomor_simbol' => 12,
                'nama_simbol' => 'Kaca Patri Alfa dan Omega',
                'arti_filosofis' => 'Keseimbangan awal mula (purwa) dan akhir perjalanan hidup manusia (wusana).',
                'makna_teologis' => 'Kristus adalah Yang Awal dan Yang Akhir, Penguasa segala zaman dan masa (Wahyu 22:13).',
                'lokasi_pada_gereja' => 'Jendela kaca atas fasad barat',
            ],
            [
                'nomor_simbol' => 13,
                'nama_simbol' => 'Papan Gandrung Sedulur Umat (Bale Umat)',
                'arti_filosofis' => 'Ruang duduk komunal yang setara tanpa kasta atau pembeda sosial duniawi.',
                'makna_teologis' => 'Persekutuan Tubuh Mistik Kristus; semua anggota sama bernilai di mata Tuhan.',
                'lokasi_pada_gereja' => 'Nave utama ruang duduk umat',
            ],
            [
                'nomor_simbol' => 14,
                'nama_simbol' => 'Tabernakel Candi Kencana',
                'arti_filosofis' => 'Bentuk stupa candi kejawen yang anggun melambangkan takhta suci kehadiran Gusti Kang Akarya Jagad.',
                'makna_teologis' => 'Kemah Suci tempat Sakramen Mahakudus disemayamkan dan disembah sujud oleh umat beriman.',
                'lokasi_pada_gereja' => 'Sisi tengah panti imam tersembunyi',
            ],
            [
                'nomor_simbol' => 15,
                'nama_simbol' => 'Bale Pasowanan (Ruang Pengakuan Dosa)',
                'arti_filosofis' => 'Ruang sowan ngaturaken luput (menghaturkan salah) dengan penuh sesal dan pertobatan batin.',
                'makna_teologis' => 'Sakramen Rekonsiliasi tempat kerahiman Allah menyambut anak-Nya yang terhilang kembali ke pelukan Bapa.',
                'lokasi_pada_gereja' => 'Sayap kanan belakang ruang gereja',
            ],
            [
                'nomor_simbol' => 16,
                'nama_simbol' => 'Mimbar Sabda Pangandika Kayu Jati',
                'arti_filosofis' => 'Tempat mengumandangkan pitutur luhur pegangan urip.',
                'makna_teologis' => 'Mimbar Sabda tempat Firman Tuhan diwartakan dan diuraikan untuk menerangi peziarahan iman umat.',
                'lokasi_pada_gereja' => 'Sisi kiri panti imam',
            ],
            [
                'nomor_simbol' => 17,
                'nama_simbol' => 'Patung Bunda Maria Semesta Hati Bercorak Jawa',
                'arti_filosofis' => 'Sosok Ibu (Wanita Utama) berbusana kebaya Jawa anggun penuh welas asih.',
                'makna_teologis' => 'Bunda Maria sebagai perantara doa umat beriman dan teladan ketaatan iman kepada Allah.',
                'lokasi_pada_gereja' => 'Sayap kanan altar ruang devosi maria',
            ],
            [
                'nomor_simbol' => 18,
                'nama_simbol' => 'Patung Santo Paulus Sang Rasul Pendidik',
                'arti_filosofis' => 'Karakter satria pinandhita yang gagah berani menegakkan kebenaran dan keadilan.',
                'makna_teologis' => 'Rasul bangsa-bangsa pelindung paroki yang mewartakan salib Kristus dengan penuh gairah misi.',
                'lokasi_pada_gereja' => 'Sayap kiri altar ruang devosi',
            ],
            [
                'nomor_simbol' => 19,
                'nama_simbol' => 'Kenthongan Kayu Sonokeling',
                'arti_filosofis' => 'Alat komunikasi tradisional desa untuk mengundang warga berkumpul rukun (tetulung).',
                'makna_teologis' => 'Panggilan pertobatan dan tanda berkumpulnya kawanan domba Allah untuk merayakan Ekaristi Kudus.',
                'lokasi_pada_gereja' => 'Serambi depan samping lonceng gereja',
            ],
            [
                'nomor_simbol' => 20,
                'nama_simbol' => 'Lonceng Baja Santo Paulus',
                'arti_filosofis' => 'Suara genta yang bergema menembus kabut lembah Dieng memanggil kedamaian.',
                'makna_teologis' => 'Doa Malaikat Tuhan (Angelus) dan pujian syukur atas keselamatan yang telah tiba bagi bumi Wonosobo.',
                'lokasi_pada_gereja' => 'Menara lonceng luar gereja',
            ],
        ];

        foreach ($simbols as $s) {
            ArsitekturSimbol::firstOrCreate(
                ['nomor_simbol' => $s['nomor_simbol']],
                array_merge($s, ['urutan' => $s['nomor_simbol']])
            );
        }

        // 4. 14 Lingkungan Paroki
        $lingkungans = [
            ['nomor_lingkungan' => 'L-01', 'nama_lingkungan' => 'Lingkungan Santo Petrus', 'nama_pelindung' => 'Santo Petrus', 'wilayah' => 'Wilayah I Kota'],
            ['nomor_lingkungan' => 'L-02', 'nama_lingkungan' => 'Lingkungan Santo Yohanes', 'nama_pelindung' => 'Santo Yohanes Rasul', 'wilayah' => 'Wilayah I Kota'],
            ['nomor_lingkungan' => 'L-03', 'nama_lingkungan' => 'Lingkungan Santa Maria', 'nama_pelindung' => 'Santa Maria Bunda Allah', 'wilayah' => 'Wilayah I Kota'],
            ['nomor_lingkungan' => 'L-04', 'nama_lingkungan' => 'Lingkungan Santo Yusuf', 'nama_pelindung' => 'Santo Yusuf Pekerja', 'wilayah' => 'Wilayah II Wonosobo Selatan'],
            ['nomor_lingkungan' => 'L-05', 'nama_lingkungan' => 'Lingkungan Santo Fransiskus Asisi', 'nama_pelindung' => 'Santo Fransiskus Asisi', 'wilayah' => 'Wilayah II Wonosobo Selatan'],
            ['nomor_lingkungan' => 'L-06', 'nama_lingkungan' => 'Lingkungan Santo Antonius Padua', 'nama_pelindung' => 'Santo Antonius Padua', 'wilayah' => 'Wilayah II Wonosobo Selatan'],
            ['nomor_lingkungan' => 'L-07', 'nama_lingkungan' => 'Lingkungan Santo Stefanus', 'nama_pelindung' => 'Santo Stefanus Martir', 'wilayah' => 'Wilayah III Wonosobo Barat'],
            ['nomor_lingkungan' => 'L-08', 'nama_lingkungan' => 'Lingkungan Santa Theresia', 'nama_pelindung' => 'Santa Theresia Kanak-kanak Yesus', 'wilayah' => 'Wilayah III Wonosobo Barat'],
            ['nomor_lingkungan' => 'L-09', 'nama_lingkungan' => 'Lingkungan Santo Ignatius Loyola', 'nama_pelindung' => 'Santo Ignatius Loyola', 'wilayah' => 'Wilayah III Wonosobo Barat'],
            ['nomor_lingkungan' => 'L-10', 'nama_lingkungan' => 'Lingkungan Santo Vincentius', 'nama_pelindung' => 'Santo Vincentius a Paulo', 'wilayah' => 'Wilayah IV Wonosobo Timur'],
            ['nomor_lingkungan' => 'L-11', 'nama_lingkungan' => 'Lingkungan Santa Monika', 'nama_pelindung' => 'Santa Monika', 'wilayah' => 'Wilayah IV Wonosobo Timur'],
            ['nomor_lingkungan' => 'L-12', 'nama_lingkungan' => 'Lingkungan Santo Mikael', 'nama_pelindung' => 'Malaikat Agung Santo Mikael', 'wilayah' => 'Wilayah IV Wonosobo Timur'],
            ['nomor_lingkungan' => 'L-13', 'nama_lingkungan' => 'Lingkungan Santo Thomas Aquinas', 'nama_pelindung' => 'Santo Thomas Aquinas', 'wilayah' => 'Wilayah V Wonosobo Utara'],
            ['nomor_lingkungan' => 'L-14', 'nama_lingkungan' => 'Lingkungan Santo Aloysius Gonzaga', 'nama_pelindung' => 'Santo Aloysius Gonzaga', 'wilayah' => 'Wilayah V Wonosobo Utara'],
        ];

        foreach ($lingkungans as $l) {
            Lingkungan::firstOrCreate(['nomor_lingkungan' => $l['nomor_lingkungan']], $l);
        }

        // 5. 7 Stasi Paroki
        $stasis = [
            ['nama_stasi' => 'Stasi Santo Yusuf Garung', 'nama_pelindung' => 'Santo Yusuf', 'lokasi_desa_kecamatan' => 'Garung, Wonosobo', 'jarak_dari_pusat_km' => 8.5],
            ['nama_stasi' => 'Stasi Santa Maria Kejajar', 'nama_pelindung' => 'Santa Maria', 'lokasi_desa_kecamatan' => 'Kejajar, Wonosobo', 'jarak_dari_pusat_km' => 16.0],
            ['nama_stasi' => 'Stasi Santo Petrus Selomerto', 'nama_pelindung' => 'Santo Petrus', 'lokasi_desa_kecamatan' => 'Selomerto, Wonosobo', 'jarak_dari_pusat_km' => 6.2],
            ['nama_stasi' => 'Stasi Santo Antonius Kertek', 'nama_pelindung' => 'Santo Antonius', 'lokasi_desa_kecamatan' => 'Kertek, Wonosobo', 'jarak_dari_pusat_km' => 9.8],
            ['nama_stasi' => 'Stasi Santa Theresia Mojotengah', 'nama_pelindung' => 'Santa Theresia', 'lokasi_desa_kecamatan' => 'Mojotengah, Wonosobo', 'jarak_dari_pusat_km' => 5.1],
            ['nama_stasi' => 'Stasi Santo Fransiskus Kalikajar', 'nama_pelindung' => 'Santo Fransiskus', 'lokasi_desa_kecamatan' => 'Kalikajar, Wonosobo', 'jarak_dari_pusat_km' => 14.5],
            ['nama_stasi' => 'Stasi Santo Yohanes Wadaslintang', 'nama_pelindung' => 'Santo Yohanes', 'lokasi_desa_kecamatan' => 'Wadaslintang, Wonosobo', 'jarak_dari_pusat_km' => 32.0],
        ];

        foreach ($stasis as $st) {
            Stasi::firstOrCreate(['nama_stasi' => $st['nama_stasi']], $st);
        }

        // 6. 7 Organisasi Kategorial
        $kategorials = [
            [
                'kode_organisasi' => 'OMK',
                'nama_organisasi' => 'Orang Muda Katolik (OMK)',
                'deskripsi' => 'Wadah pembinaan iman, persaudaraan, kreativitas, dan keterlibatan aktif kaum muda Paroki Santo Paulus Wonosobo dalam Gereja dan masyarakat.',
                'visi_misi' => 'Membangun generasi muda Katolik yang militan, berakar pada Kristus, kreatif dalam karya, dan peduli sesama.',
                'urutan' => 1,
            ],
            [
                'kode_organisasi' => 'WKRI',
                'nama_organisasi' => 'Wanita Katolik Republik Indonesia (WKRI)',
                'deskripsi' => 'Organisasi kemasyarakatan wanita Katolik yang berfokus pada ketahanan keluarga, pembinaan martabat wanita, serta aksi sosial kemasyarakatan.',
                'visi_misi' => 'Menjadi organisasi mandiri yang berdaya dorong dan berdaya guna dalam meningkatkan harkat dan martabat manusia.',
                'urutan' => 2,
            ],
            [
                'kode_organisasi' => 'PWK_SANTA_MONIKA',
                'nama_organisasi' => 'Paguyuban Warga Katolik Santa Monika (PWK Santa Monika)',
                'deskripsi' => 'Komunitas persekutuan doa dan saling menguatkan bagi para ibu dan warakawuri Katolik dalam mendidik anak dan keluarga beriman.',
                'visi_misi' => 'Meneladani ketekunan doa Santa Monika dalam menghantarkan keluarga menuju keselamatan Kristus.',
                'urutan' => 3,
            ],
            [
                'kode_organisasi' => 'LEGIO_MARIAE',
                'nama_organisasi' => 'Legio Mariae',
                'deskripsi' => 'Kelompok kerasulan awam Katolik yang bertumbuh dalam spiritualitas Maria melalui doa rosario bersama, kunjungan orang sakit, lansia, dan karya karitatif.',
                'visi_misi' => 'Mulia karena berdoa, tekun melayani sesama bersama Bunda Maria Bunda Gereja.',
                'urutan' => 4,
            ],
            [
                'kode_organisasi' => 'PDPKK',
                'nama_organisasi' => 'Persekutuan Doa Pembaharuan Karismatik Katolik (PDPKK)',
                'deskripsi' => 'Wadah persekutuan doa pujian, penyembahan, pendalaman Sabda Allah, dan pembaharuan hidup dalam bimbingan karunia-karunia Roh Kudus.',
                'visi_misi' => 'Membangkitkan api Roh Kudus dalam hati setiap umat untuk hidup baru dalam kepenuhan kasih Kristus.',
                'urutan' => 5,
            ],
            [
                'kode_organisasi' => 'CFM',
                'nama_organisasi' => 'Christian Family Movement (CFM)',
                'deskripsi' => 'Gerakan keluarga kristiani yang berfokus pada penguatan spiritualitas pasutri dan keluarga melalui metode Lihat-Nilai-Aksi (Observe-Judge-Act).',
                'visi_misi' => 'Mewujudkan keluarga kristiani sebagai Gereja Domestik (Ecclesia Domestica) yang tangguh di tengah tantangan zaman.',
                'urutan' => 6,
            ],
            [
                'kode_organisasi' => 'ME',
                'nama_organisasi' => 'Marriage Encounter (ME)',
                'deskripsi' => 'Gerakan penghayatan hidup perkawinan yang membantu pasangan suami-istri dan para imam/religius memperbaharui relasi cinta serta komunikasi mendalam.',
                'visi_misi' => 'Ubah dirimu, ubah pasanganmu, ubah dunia melalui kasih perkawinan yang tulus dan intim.',
                'urutan' => 7,
            ],
        ];

        foreach ($kategorials as $k) {
            OrganisasiKategorial::firstOrCreate(['kode_organisasi' => $k['kode_organisasi']], $k);
        }

        // 7. 7 Sakramen Gereja (Pure Information, No Online Forms)
        $sakramens = [
            [
                'kode_sakramen' => 'baptis_bayi',
                'nama_sakramen' => 'Sakramen Baptis (Bayi/Anak)',
                'deskripsi_teologis' => 'Pintu gerbang kehidupan rohani yang membebaskan manusia dari dosa asal, mengangkatnya menjadi anak Allah, dan menggabungkannya ke dalam Tubuh Mistik Kristus.',
                'persyaratan' => "1. Fotokopi Akta Kelahiran anak dari Dinas Kependudukan dan Catatan Sipil.\n2. Fotokopi Surat Nikah Gereja orang tua.\n3. Fotokopi Kartu Keluarga Katolik (KKK) Paroki yang telah diperbarui.\n4. Memilih satu orang Wali Baptis (Pria/Wanita yang telah menerima Sakramen Inisiasi lengkap: Baptis, Krisma, Ekaristi dan hidup sesuai ajaran Gereja).\n5. Orang tua dan wali baptis wajib mengikuti katekese rekoleksi pembekalan sebelum upacara baptisan.",
                'prosedur_pelayanan' => "1. Orang tua melapor ke Ketua Lingkungan setempat untuk mendapatkan surat pengantar.\n2. Mengambil dan mengisi berkas administrasi fisik di Kantor Sekretariat Paroki Santo Paulus Wonosobo.\n3. Mengikuti pertemuan rekoleksi persiapan orang tua & wali baptis sesuai jadwal yang ditentukan oleh Pastor Paroki.\n4. Pelaksanaan upacara penerimaan Sakramen Baptis di Gereja Utama.",
                'jadwal_pelayanan_rutin' => 'Dilaksanakan setiap Minggu kedua pada bulan ganjil (Januari, Maret, Mei, Juli, September, November) setelah Misa Pagi.',
                'kontak_layanan' => 'Sekretariat Paroki: (0286) 321xxx / WhatsApp Sekretariat',
                'urutan' => 1,
            ],
            [
                'kode_sakramen' => 'ekaristi_komuni_pertama',
                'nama_sakramen' => 'Sakramen Ekaristi (Komuni Pertama)',
                'deskripsi_teologis' => 'Puncak dan sumber seluruh hidup kristiani. Melalui Tubuh dan Darah Kristus, umat beriman dipersatukan secara intim dengan Tuhan dan sesama saudara seiman.',
                'persyaratan' => "1. Telah menerima Sakramen Baptis Katolik (melampirkan fotokopi Surat Baptis).\n2. Berusia minimal 10 tahun atau duduk di kelas IV Sekolah Dasar.\n3. Mengikuti pembinaan intensif katekese Komuni Pertama selama minimal 6 bulan oleh Tim Inisiasi Paroki.\n4. Telah menerima Sakramen Tobat pertama sebelum hari perayaan Komuni Pertama.\n5. Fotokopi Kartu Keluarga Katolik (KKK) Paroki.",
                'prosedur_pelayanan' => "1. Mendaftarkan anak melalui seksi katekese lingkungan atau koordinator sekolah binaan paroki.\n2. Mengikuti kelas katekese rutin setiap hari Minggu.\n3. Mengikuti gladi bersih dan penerimaan Sakramen Tobat/Rekonsiliasi.\n4. Penerimaan Komuni Pertama bersama pada Hari Raya Tubuh dan Darah Kristus.",
                'jadwal_pelayanan_rutin' => 'Satu kali dalam setahun bertepatan dengan Hari Raya Tubuh dan Darah Kristus.',
                'kontak_layanan' => 'Tim Katekese Paroki / Sekretariat',
                'urutan' => 2,
            ],
            [
                'kode_sakramen' => 'krisma',
                'nama_sakramen' => 'Sakramen Krisma (Penguatan)',
                'deskripsi_teologis' => 'Menyempurnakan rahmat pembaptisan dengan menganugerahkan Roh Kudus, mengikat para penerimanya lebih erat kepada Gereja, serta meneguhkan mereka sebagai saksi Kristus yang berani.',
                'persyaratan' => "1. Telah menerima Sakramen Baptis dan Ekaristi (melampirkan Surat Baptis berlegalisir asli paroki asal).\n2. Berusia minimal 14 tahun (setingkat SMP kelas 3 ke atas).\n3. Mengikuti program katekese krisma dan bakti pastoral selama 9 bulan.\n4. Memiliki Surat Baptis & Krisma dari seorang Saksi Krisma (Godparent).\n5. Melampirkan fotokopi Kartu Keluarga Katolik.",
                'prosedur_pelayanan' => "1. Pendaftaran calon krismawan melalui Tim Kerja Inisiasi Paroki.\n2. Menjalani masa pembinaan katekese, rekoleksi, dan wawancara pastor.\n3. Pelaksanaan upacara penerimaan krisma oleh Uskup Keuskupan Purwokerto atau Delegatus.",
                'jadwal_pelayanan_rutin' => 'Dilaksanakan satu kali dalam 2 tahun sesuai jadwal kunjungan pastoral Bapa Uskup Purwokerto.',
                'kontak_layanan' => 'Seksi Inisiasi & Sekretariat Paroki',
                'urutan' => 3,
            ],
            [
                'kode_sakramen' => 'tobat_rekonsiliasi',
                'nama_sakramen' => 'Sakramen Rekonsiliasi (Tobat)',
                'deskripsi_teologis' => 'Umat beriman yang menyesali dosa-dosanya menerima pengampunan dari belas kasih Allah melalui pelayanan imam, dan diperdamaikan kembali dengan Gereja.',
                'persyaratan' => "1. Telah dibaptis Katolik dan telah menerima Komuni Pertama.\n2. Melakukan pemeriksaan batin dengan jujur dan tulus sebelum masuk kamar pengakuan.\n3. Memiliki penyesalan sejati atas dosa, berniat untuk tidak berbuat dosa lagi, serta bersedia menjalankan laku tobat (penitensi).",
                'prosedur_pelayanan' => "1. Masuk ke ruang/kamar pengakuan doa yang telah disiapkan di gereja.\n2. Menyampaikan pengakuan dosa secara pribadi kepada Romo dengan penuh kerendahan hati.\n3. Menerima nasihat rohani, doa absolusi pengampunan dosa, dan doa penitensi.\n4. Mendoakan penitensi di hadapan Sakramen Mahakudus.",
                'jadwal_pelayanan_rutin' => "1. Setiap Sabtu sore pukul 16.30 (sebelum Misa Sabtu).\n2. Ibadat Tobat Massal menyambut Masa Adven dan Masa Prapaskah.\n3. Dapat dilayani setiap saat dengan membuat janji temu langsung kepada Romo Paroki.",
                'kontak_layanan' => 'Sekretariat Paroki Santo Paulus',
                'urutan' => 4,
            ],
            [
                'kode_sakramen' => 'perkawinan',
                'nama_sakramen' => 'Sakramen Perkawinan',
                'deskripsi_teologis' => 'Perjanjian perkawinan antara seorang pria dan seorang wanita yang dibaptis, membentuk persekutuan hidup dan kasih seumur hidup yang tak terceraikan, terarah pada kesejahteraan suami-istri serta kelahiran dan pendidikan anak.',
                'persyaratan' => "1. Melapor ke Pastor Paroki minimal 3 bulan sebelum rencana tanggal pernikahan.\n2. Surat Baptis terbaru (asli berlegalisir maksimal 6 bulan terakhir dengan catatan belum pernah menikah).\n3. Sertifikat Kursus Persiapan Perkawinan (KPP/Membangun Rumah Tangga) yang diakui Keuskupan.\n4. Surat Pengantar dari Ketua Lingkungan masing-masing calon mempelai.\n5. Fotokopi KTP, Akta Kelahiran, dan Kartu Keluarga kedua calon mempelai.\n6. Fotokopi KTP 2 orang Saksi Nikah Katolik.\n7. Surat izin orang tua / wali bagi calon mempelai.",
                'prosedur_pelayanan' => "1. Pasangan menghadap Romo Paroki untuk konsultasi awal dan menjadwalkan Kursus Persiapan Perkawinan.\n2. Melaksanakan Penyelidikan Kanonik (wawancara kanonik) bersama Pastor Paroki.\n3. Pengumuman perkawinan di warta paroki selama 3 hari Minggu berturut-turut.\n4. Gladi bersih liturgi perkawinan.\n5. Peneguhan Sakramen Perkawinan / Pemberkatan Nikah di hadapan Imam dan Saksi Gereja.",
                'jadwal_pelayanan_rutin' => 'Jadwal ditentukan berdasarkan kesepakatan keluarga dengan Pastor Paroki setelah penyelidikan kanonik dinyatakan tuntas.',
                'kontak_layanan' => 'Sekretariat Paroki & Pastor Kepala',
                'urutan' => 5,
            ],
            [
                'kode_sakramen' => 'imamat',
                'nama_sakramen' => 'Sakramen Imamat (Tahbisan Suci)',
                'deskripsi_teologis' => 'Meneruskan perutusan yang dipercayakan Kristus kepada para rasul-Nya sampai akhir zaman melalui tiga jenjang tahbisan: episkopat (uskup), presbeterat (imam/pastor), dan diakonat.',
                'persyaratan' => "1. Pria Katolik yang telah menerima Sakramen Inisiasi lengkap dan hidup saleh.\n2. Menjalani proses panggilan rohani dan seleksi di Seminari Menengah / Tahun Orientasi Rohani (TOR).\n3. Menempuh pendidikan filsafat teologi dan formasi seminari tinggi tarekat / diosesan yang disetujui Bapa Uskup.\n4. Memiliki kesehatan rohani, jasmani, psikologis, dan rekomendasi dari para formator serta Pastor Paroki asal.",
                'prosedur_pelayanan' => "Konsultasi panggilan imamat dapat dilakukan langsung dengan menghubungi Pastor Paroki Santo Paulus Wonosobo atau Pembina Putra Altar & Remaja Paroki.",
                'jadwal_pelayanan_rutin' => 'Sesuai agenda tahbisan suci Keuskupan Purwokerto atau tarekat terkait.',
                'kontak_layanan' => 'Pastor Paroki Santo Paulus Wonosobo',
                'urutan' => 6,
            ],
            [
                'kode_sakramen' => 'perminyakan_orang_sakit',
                'nama_sakramen' => 'Sakramen Pengurapan Orang Sakit',
                'deskripsi_teologis' => 'Menganugerahkan rahmat khusus Roh Kudus kepada umat beriman yang menghadapi bahaya maut karena sakit berat atau lanjut usia, memberikan kekuatan, penghiburan, pengampunan dosa, dan pemulihan jiwa raga.',
                'persyaratan' => "1. Umat Katolik yang menderita sakit berat, lanjut usia yang kesehatannya melemah, atau menjelang operasi besar medis.\n2. Keluarga mendampingi di samping tempat tidur penderita dengan suasana hening dan penuh doa.\n3. Menyiapkan salib, lilin bernyala, air suci, dan kain bersih di dekat penderita.",
                'prosedur_pelayanan' => "1. Keluarga segera menghubungi Ketua Lingkungan atau langsung menelepon Kantor Sekretariat / Romo Paroki.\n2. Romo paroki akan segera berkunjung ke rumah sakit / kediaman penderita untuk melayankan pengurapan minyak suci dan memberikan Viaticum (Komuni bekal suci).",
                'jadwal_pelayanan_rutin' => 'Dapat dilayani 24 jam untuk keadaan darurat / bahaya maut; serta diadakan misa bersama perminyakan orang sakit pada Hari Orang Sakit Sedunia (11 Februari).',
                'kontak_layanan' => 'Telepon Darurat Pastoral Romo: Hubungi Sekretariat Paroki',
                'urutan' => 7,
            ],
        ];

        foreach ($sakramens as $sk) {
            SakramenInformasi::firstOrCreate(['kode_sakramen' => $sk['kode_sakramen']], $sk);
        }

        // 8. Master Peran Liturgi
        $perans = [
            ['nama_peran' => 'Lektor', 'deskripsi' => 'Petugas pembaca Sabda Kitab Suci (Bacaan Pertama, Bacaan Kedua, dan Doa Umat).'],
            ['nama_peran' => 'Pemazmur', 'deskripsi' => 'Petugas pelantun Mazmur Tanggapan di mimbar sabda.'],
            ['nama_peran' => 'Misdinar / Putra-Putri Altar', 'deskripsi' => 'Petugas pendamping imam di seputar meja altar suci.'],
            ['nama_peran' => 'Dirigen / Pemimpin Koor', 'deskripsi' => 'Pemimpin kelompok koor paduan suara dan nyanyian umat.'],
            ['nama_peran' => 'Organis / Pengiring Musik', 'deskripsi' => 'Pemusik pengiring lagu-lagu liturgis Ekaristi.'],
            ['nama_peran' => 'Kolektan / Persembahan', 'deskripsi' => 'Petugas pengumpul persembahan kolekte umat dan pembawa bahan persembahan ke altar.'],
            ['nama_peran' => 'Prodiakon / Asisten Imam', 'deskripsi' => 'Asisten luar biasa penerimaan komuni kudus dan pembawa komuni untuk orang sakit.'],
            ['nama_peran' => 'Tata Tertib & Penyambut Umat', 'deskripsi' => 'Petugas penerima umat di pintu gerbang gereja dan penertib protokol perayaan.'],
        ];

        foreach ($perans as $p) {
            LiturgiPeran::firstOrCreate(['nama_peran' => $p['nama_peran']], $p);
        }

        // 9. Master Kategori Berita
        $kategoris = [
            ['nama_kategori' => 'Warta Paroki', 'slug' => 'warta-paroki', 'deskripsi' => 'Kabar dan pengumuman resmi dewan paroki.', 'urutan' => 1],
            ['nama_kategori' => 'Liputan Kegiatan', 'slug' => 'liputan-kegiatan', 'deskripsi' => 'Dokumentasi dan liputan acara pastoral paroki, lingkungan, dan stasi.', 'urutan' => 2],
            ['nama_kategori' => 'Komsos & OMK', 'slug' => 'komsos-dan-omk', 'deskripsi' => 'Kreativitas, warta kepemudaan, dan media komunikasi Katolik.', 'urutan' => 3],
            ['nama_kategori' => 'Pewartaan & Liturgi', 'slug' => 'pewartaan-dan-liturgi', 'deskripsi' => 'Informasi seputar masa liturgi, katekese, dan perayaan gereja.', 'urutan' => 4],
        ];

        foreach ($kategoris as $kt) {
            KategoriBerita::firstOrCreate(['slug' => $kt['slug']], $kt);
        }
    }
}

