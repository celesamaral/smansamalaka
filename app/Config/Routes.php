<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');
$routes->group('admin', ['filter' => 'adminFilter'], static function ($routes) {
    $routes->get('/', 'Home::dashboard_admin');
    $routes->get('jurusan', 'Kelas::jurusan');
    $routes->post('jurusan/store', 'Kelas::store_jurusan');
    $routes->get('jurusan/(:any)/edit', 'Kelas::edit_jurusan/$1');
    $routes->post('jurusan/update', 'Kelas::update_jurusan');
    $routes->post('jurusan/hapus', 'Kelas::hapus_jurusan');
    $routes->get('jurusan/(:any)/kelas', 'Kelas::kelas_jurusan/$1');
    $routes->get('kelas', 'Kelas::kelas');
    $routes->post('kelas/store', 'Kelas::store_kelas');
    $routes->get('kelas/(:any)/edit', 'Kelas::edit_kelas/$1');
    $routes->post('kelas/update', 'Kelas::update_kelas');
    $routes->post('kelas/hapus', 'Kelas::hapus_kelas');
    $routes->get('mapel', 'Mapel::index');
    $routes->post('mapel/store', 'Mapel::store_mapel');
    $routes->post('mapel/update', 'Mapel::update_mapel');
    $routes->post('mapel/hapus', 'Mapel::hapus_mapel');
    $routes->get('mapel/(:any)/kd', 'Mapel::kd/$1');

    $routes->get('tahunajaran', 'Tahunajaran::index');
    $routes->post('tahunajaran/store', 'Tahunajaran::store');
    $routes->post('tahunajaran/update', 'Tahunajaran::update');
    $routes->post('tahunajaran/ubah_status', 'Tahunajaran::ubah_status');

    $routes->get('jadwal', 'Jadwal::index');
    $routes->get('jadwal/(:num)', 'Jadwal::index/$1');
    $routes->post('jadwal/store', 'Jadwal::store');

    $routes->get('siswa/baru', 'Siswa::index');
    $routes->get('siswa/aktif', 'Siswa::siswa_aktif');
    $routes->get('siswa/(:any)/edit', 'Siswa::edit/$1');
    $routes->get('siswa/(:any)', 'Siswa::detail/$1');
    $routes->post('siswa/store', 'Siswa::store');
    $routes->post('siswa/update', 'Siswa::update');
    $routes->post('siswa/hapus', 'Siswa::hapus');

    $routes->get('pembagian_kelas/', 'Kelas::pembagian');
    // $routes->get('pembagian_kelas/(:any)', 'Kelas::pembagian_jurusan/$1');
    $routes->post('pembagian_kelas/store', 'Kelas::store_pembagian');
    $routes->get('pengumuman/', 'Pengumuman::index');
    $routes->post('pengumuman/store', 'Pengumuman::store');
    $routes->post('pengumuman/tarik', 'Pengumuman::drop');
    $routes->post('pengumuman/tampilkan', 'Pengumuman::tampilkan');
    $routes->post('pengumuman/update', 'Pengumuman::update');
    $routes->post('pengumuman/delete', 'Pengumuman::delete');
    $routes->get('pengumuman/edit/(:any)', 'Pengumuman::edit/$1');

    $routes->get('walikelas', 'WaliKelas::index');
    $routes->post('walikelas/store', 'WaliKelas::store');
    $routes->post('walikelas/delete', 'WaliKelas::delete');

    $routes->get('profil', 'Profil::profil_admin');
    $routes->post('update_profile', 'Profil::update_profile');
    $routes->post('ganti_username', 'Profil::ganti_username');
    $routes->post('ganti_password', 'Profil::ganti_password');

    $routes->get('absensi', 'Absensi::index');
    $routes->post('absensi/store', 'Absensi::store');
    $routes->post('absensi/hapus', 'Absensi::hapus');
});

$routes->group('admin/admin', ['filter' => 'adminFilter'], static function ($routes) {
    $routes->get('tambah', 'Admin::tambah');
    $routes->post('store', 'Admin::store');
    $routes->get('/', 'Admin::index');
    // $routes->get('blog', 'Admin\Blog::index');
});
$routes->group('admin/guru', ['filter' => 'adminFilter'], static function ($routes) {
    $routes->get('tambah', 'Guru::tambah');
    $routes->post('store_guru', 'Guru::store_guru');
    $routes->post('update', 'Guru::update');
    $routes->post('hapus', 'Guru::hapus');
    $routes->get('edit/(:any)', 'Guru::edit/$1');
    $routes->get('/', 'Guru::index');
    // $routes->get('blog', 'Admin\Blog::index');
});

$routes->group('guru', ['filter' => 'guruFilter'], static function ($routes) {
    $routes->get('/', 'Home::dashboard_guru');
    $routes->get('mapel', 'Mapel::index_guru');
    $routes->get('mapel/(:num)/kd', 'Mapel::kd/$1');
    $routes->post('kd/store', 'Mapel::store_kd');
    $routes->post('kd/update', 'Mapel::update_kd');
    $routes->post('kd/hapus', 'Mapel::hapus_kd');
    $routes->group('penilaian',  static function ($routes) {
        $routes->get('/', 'Penilaian::index');
        $routes->post('/', 'Penilaian::penilaian');
        $routes->get('(:num)/(:num)', 'Penilaian::kelas/$1/$2');
        $routes->get('(:num)/(:num)/rekapan', 'Penilaian::rekapan/$1/$2');
        $routes->post('store', 'Penilaian::store');
        $routes->post('get_nilai', 'Penilaian::get_nilaii');
    });
    $routes->get('pengumuman/', 'Pengumuman::index');
    $routes->get('jadwal', 'Jadwal::jadwal_guru');
    $routes->get('jadwal', 'Jadwal::jadwal_guru');
    $routes->get('walikelas', 'Guru::wali_kelas');
    $routes->get('walikelas/nilai/(:any)', 'Penilaian::rekapan_siswa/$1');
    $routes->get('walikelas/(:any)', 'Guru::wali_kelas/$1');
    $routes->get('profil', 'Profil::profil_guru');
    $routes->post('ganti_password', 'Profil::ganti_password');
    $routes->post('update_profile', 'Profil::update_profile');
    $routes->post('hitung_nilai', 'Penilaian::hitung_nilai');

    $routes->get('absensi', 'Absensi::index_guru');
    $routes->get('absensi/(:any)', 'Absensi::detail/$1');
    $routes->post('absensi/absen', 'Absensi::absen');
});

$routes->group('siswa', ['filter' => 'siswaFilter'], static function ($routes) {
    $routes->get('/', 'Home::dashboard_siswa');
    $routes->get('nilai', 'Penilaian::rekapan_siswa');
    $routes->get('riwayat_nilai', 'Penilaian::riwayat_nilai');
    $routes->get('riwayat_nilai/(:any)', 'Penilaian::riwayat_nilai/$1');
    $routes->get('pengumuman/', 'Pengumuman::index');
    $routes->get('jadwal/', 'Jadwal::jadwal_kelas');
    $routes->post('nilai/cetak', 'Penilaian::cetak_nilai');
    $routes->get('profil', 'Profil::profil_siswa');
    $routes->post('ganti_password', 'Profil::ganti_password');
    $routes->post('update_profile', 'Profil::update_profile');
    $routes->get('absensi', 'Absensi::rekap_absen_siswa');
});

$routes->group('auth', static function ($routes) {
    $routes->get('login', 'Auth::index');
    $routes->post('login', 'Auth::login');
    $routes->post('logout', 'Auth::logout');
});
/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
