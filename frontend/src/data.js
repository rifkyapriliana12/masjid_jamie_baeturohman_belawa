// ============================================================
//  DATA MASJID — edit file ini untuk mengubah isi website.
//  Bagian yang ditandai "TODO" masih menunggu konfirmasi
//  dari pengurus DKM (alamat lengkap, kontak, rekening).
// ============================================================

export const mosque = {
  name: 'Masjid Jami Baeturohman',
  village: 'Desa Belawa',
  tagline: 'Pusat Ibadah, Ilmu, dan Kebersamaan Umat',
  description:
    'Masjid Jami Baeturohman adalah masjid jami kebanggaan warga Desa Belawa. ' +
    'Selain menjadi pusat pelaksanaan sholat lima waktu dan Sholat Jumat, masjid ini ' +
    'menjadi pusat pembinaan umat: pengajian rutin, pendidikan Al-Qur’an bagi anak-anak, ' +
    'peringatan hari besar Islam, serta kegiatan sosial kemasyarakatan. ' +
    'Dikelola oleh Dewan Kemakmuran Masjid (DKM) bersama jamaah, masjid ini terbuka ' +
    'untuk seluruh umat yang ingin beribadah, belajar, dan berbagi.',
  // Alamat terverifikasi dari Google Maps (link yang dikirim user, 2026-10-25)
  address:
    'Jl. Wangkelang, Belawa, Kec. Lemahabang, Kab. Cirebon, Jawa Barat 45183',
  mapsUrl:
    'https://www.google.com/maps/place/Masjid+Baiturrohman+Desa+Belawa/@-6.8338184,108.5836161,17z',
  plusCode: '5H8M+FCH',
  contact: {
    phone: null, // TODO: nomor HP/WA pengurus DKM
    email: null, // TODO: email DKM (opsional)
  },
  // TODO: rekening resmi infaq — JANGAN diisi nomor asal; minta ke pengurus DKM
  infaqAccount: null,
};

export const features = [
  {
    title: 'Sholat Jumat',
    text: 'Sholat Jumat berjamaah setiap pekan, terbuka untuk seluruh jamaah Desa Belawa dan sekitarnya.',
    icon: '🕌',
  },
  {
    title: 'Pengajian Rutin',
    text: 'Kajian dan pengajian rutin untuk memperdalam ilmu agama bagi bapak, ibu, dan remaja masjid.',
    icon: '📖',
  },
  {
    title: 'TPA & TPQ Anak',
    text: 'Pendidikan Al-Qur’an bagi anak-anak: belajar membaca, menghafal, dan adab Islami sejak dini.',
    icon: '🧒',
  },
  {
    title: 'Hari Besar Islam',
    text: 'Peringatan Isra Mi’raj, Maulid Nabi, Ramadhan, Idul Fitri, dan Idul Adha bersama jamaah.',
    icon: '🌙',
  },
];

export const activities = [
  {
    title: 'Sholat Lima Waktu Berjamaah',
    schedule: 'Setiap hari',
    text: 'Sholat Subuh, Dzuhur, Ashar, Maghrib, dan Isya dilaksanakan berjamaah di masjid.',
  },
  {
    title: 'Sholat Jumat',
    schedule: 'Setiap Jumat',
    text: 'Khutbah dan Sholat Jumat berjamaah bersama seluruh jamaah Desa Belawa.',
  },
  {
    title: 'Pengajian Rutin',
    schedule: 'Mingguan',
    text: 'Kajian kitab dan tausiyah bersama ustadz, untuk jamaah bapak, ibu, dan remaja.',
  },
  {
    title: 'TPA & TPQ',
    schedule: 'Sore hari',
    text: 'Belajar membaca Al-Qur’an, hafalan surat pendek, dan praktik ibadah untuk anak-anak.',
  },
  {
    title: 'Peringatan Hari Besar Islam',
    schedule: 'Tahunan',
    text: 'Isra Mi’raj, Maulid Nabi Muhammad SAW, pesantren kilat Ramadhan, dan qurban Idul Adha.',
  },
  {
    title: 'Kegiatan Sosial',
    schedule: 'Berkala',
    text: 'Santunan, bakti sosial, dan gotong royong jamaah untuk kemaslahatan warga sekitar.',
  },
];

// Jadwal sholat diambil LIVE dari API Aladhan (metode Kemenag RI)
// untuk wilayah Cirebon & sekitarnya. Ubah kota di App.jsx bila lokasi berbeda.
export const prayerCity = { city: 'Cirebon', country: 'Indonesia', method: 20 };
