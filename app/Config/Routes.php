<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php'))
{
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */

//https://ilmucoding.com/middleware-filters-codeigniter-4/
$routes->setDefaultNamespace('App\Controllers');
//$routes->setDefaultController('Home');
$routes->setDefaultController('ControllerLogin');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();

$routes->setAutoRoute(false); // ex. gak perlu didaftaran di route index.php/pages/about

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.



//https://ilmucoding.com/middleware-filters-codeigniter-4/
//tidak ngecek di tiap halaman tapi di route nya
$routes->get('login', 'ControllerLogin::index');
$routes->get('/logout', 'ControllerLogin::logoutToken', ['filter' => 'cektoken']);
$routes->get('/login/token/(:any)', 'ControllerLogin::prosesToken/$1');//ambil param pertama

$routes->get('/home', 'ControllerHome::index', ['filter' => 'cektoken']);

//level adminskpd
if(session()->get('level')!='pegawai'){
    $routes->get('/admin/list_pegawai', 'ControllerKGBAdmin::list_peg_admin_kgb', ['filter' => 'cektoken']);
    $routes->get('/admin/riwayatkgb/(:segment)/lihat', 'ControllerKGBAdmin::LihatRiwayatKGB/$1', ['filter' => 'cektoken']);
    $routes->add('/admin/riwayatkgb/(:segment)/tambah', 'ControllerKGBAdmin::TambahRiwayatKGB/$1', ['filter' => 'cektoken']);
    $routes->add('/admin/riwayatkgb/(:segment)/edit', 'ControllerKGBAdmin::EditRiwayatKGB/$1', ['filter' => 'cektoken']);
    $routes->get('/admin/riwayatkgb/(:segment)/hapus', 'ControllerKGBAdmin::HapusRiwayatKGB/$1', ['filter' => 'cektoken']);
    $routes->get('/admin/riwayatkgb/(:segment)/approve', 'ControllerKGBAdmin::ApproveUsulanKGB/$1', ['filter' => 'cektoken']);
    $routes->get('/admin/riwayatkgb/(:segment)/cetak', 'ControllerKGBAdmin::Cetak/$1', ['filter' => 'cektoken']);
    $routes->post('/admin/ajax_gaji', 'ControllerKGBAdmin::get_gaji', ['filter' => 'cektoken']);

}else{    
    //level pegawai
    $routes->get('/layanan/riwayatkgb/(:segment)/lihat', 'ControllerKGBAdmin::LihatRiwayatKGB/$1', ['filter' => 'cektoken']);
    $routes->add('/layanan/riwayatkgb/(:segment)/usulan', 'ControllerKGBAdmin::PengajuanUsulanKGB/$1', ['filter' => 'cektoken']);

}





$routes->add('/riwayat/pengukuran', 'ControllerUmum::riwayat/pengukuran', ['filter' => 'cektoken']);
$routes->add('/riwayat/perilaku', 'ControllerUmum::riwayat/perilaku', ['filter' => 'cektoken']);
$routes->add('/riwayat/prestasi', 'ControllerUmum::riwayat/prestasi', ['filter' => 'cektoken']);

$routes->get('/target/(:any)/(:any)/(:any)/buat', 'ControllerTarget::buat/$1/$2/$3', ['filter' => 'cektoken']);
$routes->get('/target/(:segment)/lihat', 'ControllerTarget::lihat/$1', ['filter' => 'cektoken']);
$routes->get('/target/(:segment)/hapus', 'ControllerTarget::hapus/$1', ['filter' => 'cektoken']);
$routes->post('/target/(:segment)/setuju', 'ControllerTarget::setuju/$1', ['filter' => 'cektoken']);
$routes->post('/target/(:segment)/atasansetuju', 'ControllerTarget::atasansetuju/$1', ['filter' => 'cektoken']);
$routes->get('/target/(:segment)/cetak', 'ControllerTarget::cetak/$1', ['filter' => 'cektoken']);

$routes->add('/ktj/(:segment)/tambah', 'ControllerKTJ::tambah/$1', ['filter' => 'cektoken']);
$routes->add('/ktj/(:segment)/edit', 'ControllerKTJ::edit/$1', ['filter' => 'cektoken']);
$routes->get('/ktj/(:segment)/hapus', 'ControllerKTJ::hapus/$1', ['filter' => 'cektoken']);

$routes->get('/pengukuran/(:segment)/lihat', 'ControllerPengukuran::lihat/$1/page', ['filter' => 'cektoken']);
$routes->add('/pengukuran/(:segment)/edit', 'ControllerPengukuran::edit/$1', ['filter' => 'cektoken']);
$routes->post('/pengukuran/(:segment)/radio', 'ControllerPengukuran::radio/$1', ['filter' => 'cektoken']);
$routes->post('/pengukuran/(:segment)/setuju', 'ControllerPengukuran::setuju/$1', ['filter' => 'cektoken']);
$routes->post('/pengukuran/(:segment)/atasansetuju', 'ControllerPengukuran::atasansetuju/$1', ['filter' => 'cektoken']);
$routes->get('/pengukuran/(:segment)/reset', 'ControllerPengukuran::reset/$1', ['filter' => 'cektoken']);
$routes->get('/pengukuran/(:segment)/cetak', 'ControllerPengukuran::lihat/$1/cetak', ['filter' => 'cektoken']);

$routes->add('/tambahan/(:segment)/tambah', 'ControllerPengukuran::tambahan/$1', ['filter' => 'cektoken']);
$routes->add('/tambahan/(:segment)/edit', 'ControllerPengukuran::edittambahan/$1', ['filter' => 'cektoken']);
$routes->get('/tambahan/(:segment)/hapus', 'ControllerPengukuran::hapus/$1', ['filter' => 'cektoken']);

$routes->get('/perilaku/(:segment)/lihat', 'ControllerPerilaku::lihat/$1/page', ['filter' => 'cektoken']);
$routes->add('/perilaku/(:segment)/tambah', 'ControllerPerilaku::tambah/$1', ['filter' => 'cektoken']);
$routes->add('/perilaku/(:segment)/edit', 'ControllerPerilaku::edit/$1', ['filter' => 'cektoken']);
$routes->post('/perilaku/(:segment)/setuju', 'ControllerPerilaku::setuju/$1', ['filter' => 'cektoken']);
$routes->post('/perilaku/(:segment)/atasansetuju', 'ControllerPerilaku::atasansetuju/$1', ['filter' => 'cektoken']);
$routes->get('/perilaku/(:segment)/hapus', 'ControllerPerilaku::hapus/$1', ['filter' => 'cektoken']);
$routes->get('/perilaku/(:segment)/cetak', 'ControllerPerilaku::lihat/$1/cetak', ['filter' => 'cektoken']);

$routes->get('/prestasi/(:segment)/lihat', 'ControllerPrestasi::lihat/$1/page', ['filter' => 'cektoken']);
$routes->add('/prestasi/(:segment)/tambah', 'ControllerPrestasi::tambah/$1', ['filter' => 'cektoken']);
$routes->get('/prestasi/(:segment)/reset', 'ControllerPrestasi::reset/$1', ['filter' => 'cektoken']);
$routes->post('/prestasi/(:segment)/atasansetuju', 'ControllerPrestasi::atasansetuju/$1', ['filter' => 'cektoken']);
$routes->post('/prestasi/(:segment)/setuju', 'ControllerPrestasi::setuju/$1', ['filter' => 'cektoken']);
$routes->get('/prestasi/(:segment)/cetak', 'ControllerPrestasi::lihat/$1/cetak', ['filter' => 'cektoken']);

$routes->get('/bawahan/target/lihat', 'ControllerBawahan::index/target', ['filter' => 'cektoken']);
$routes->get('/bawahan/pengukuran/lihat', 'ControllerBawahan::index/pengukuran', ['filter' => 'cektoken']);
$routes->get('/bawahan/perilaku/lihat', 'ControllerBawahan::index/perilaku', ['filter' => 'cektoken']);
$routes->get('/bawahan/prestasi/lihat', 'ControllerBawahan::index/prestasi', ['filter' => 'cektoken']);

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
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php'))
{
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
