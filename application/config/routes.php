<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route['default_controller'] = 'Login/login';
$route['404_override'] = '';

$route['login'] = "Login/login";
$route['logout'] = "Login/logout";
$route['beranda'] = "Beranda";

$route['institusi'] = "Institusi";
$route['tarik-institusi'] = "Institusi/aksi_tarik_data";
$route['tarik-institusi-by-email'] = "Institusi/aksi_tarik_data_by_email";

$route['penilai'] = "Penilai";
$route['tambah-penilai'] = "Penilai/tambah";
$route['ubah-penilai/(:any)'] = "Penilai/ubah/*";
$route['upload-penilai'] = "Penilai/upload_penilai";

$route['pengguna'] = "Pengguna";
$route['tambah-pengguna'] = "Pengguna/tambah";
$route['ubah-pengguna/(:any)'] = "Pengguna/ubah/*";
$route['hapus-pengguna/(:any)'] = "Pengguna/hapus/*";

$route['pengaturan-akun'] = "Pengaturan_akun";

$route['bab-dan-sub-bab'] = "Bab_dan_sub_bab";
$route['ubah-bab/(:any)'] = "Bab_dan_sub_bab/ubah_bab/*";
$route['ubah-sub-bab/(:any)'] = "Bab_dan_sub_bab/ubah_sub_bab/*";

$route['pedoman'] = "Pedoman";
$route['ubah-pedoman'] = "Pedoman/ubah";

$route['panduan'] = "Panduan";

$route['sdm-institusi'] = "Sdm_institusi";
$route['tarik-sdm-institusi'] = "Sdm_institusi/aksi_tarik_data";
$route['tarik-sdm-by-institusi'] = "Sdm_institusi/aksi_tarik_sdm_by_institusi";
$route['tarik-sdm-by-institusi-institusi/(:any)'] = "Sdm_institusi/aksi_tarik_sdm_by_institusi_institusi/*";
$route['buat-akun-sdm/(:any)'] = "Sdm_institusi/buat_akun/*";

$route['kurikulum'] = "Kurikulum";
$route['tambah-kurikulum'] = "Kurikulum/tambah";
$route['ubah-pengajuan-kurikulum/(:any)'] = "Kurikulum/ubah/*";
$route['ubah-informasi-kurikulum/(:any)'] = "Kurikulum/ubah_informasi/*";
$route['verifikasi-kebutuhan-pelatihan/(:any)'] = "Kurikulum/verifikasi_kebutuhan_pelatihan/*";
$route['aksi-verifikasi-kebutuhan-pelatihan'] = "Kurikulum/aksi_verifikasi_kebutuhan_pelatihan";
$route['verifikasi-ketersediaan-kurikulum/(:any)'] = "Kurikulum/verifikasi_ketersediaan_kurikulum/*";
$route['aksi-verifikasi-ketersediaan-kurikulum'] = "Kurikulum/aksi_verifikasi_ketersediaan_kurikulum";
$route['list-pengisian-kurikulum/(:any)'] = "Kurikulum/list_pengisian_kurikulum/*";
$route['isi-bab-kurikulum/(:any)/(:any)'] = "Kurikulum/isi_bab_kurikulum/*/*";
$route['isi-subbab-kurikulum/(:any)/(:any)'] = "Kurikulum/isi_subbab_kurikulum/*/*";
$route['tambah-materi/(:any)'] = "Kurikulum/tambah_materi/*";
$route['ubah-materi/(:any)'] = "Kurikulum/ubah_materi/*";
$route['isi-ubah-rbpmp/(:any)'] = "Kurikulum/isi_ubah_rbpmp/*";
$route['aksi-isi-ubah-rbpmp/(:any)'] = "Kurikulum/aksi_isi_ubah_rbpmp/*";
$route['isi-deskripsi-mata-pelatihan-materi/(:any)'] = "Kurikulum/isi_deskripsi_mata_pelatihan_materi/*";
$route['isi-hasil-belajar-materi/(:any)'] = "Kurikulum/isi_hasil_belajar_materi/*";
$route['tambah-indikator-hasil-belajar/(:any)'] = "Kurikulum/tambah_indikator_hasil_belajar/*";
$route['ubah-indikator-hasil-belajar/(:any)'] = "Kurikulum/ubah_indikator_hasil_belajar/*";
$route['hapus-indikator-hasil-belajar/(:any)'] = "Kurikulum/hapus_indikator_hasil_belajar/*";
$route['tambah-metode-materi/(:any)'] = "Kurikulum/tambah_metode_materi/*";
$route['ubah-metode-materi/(:any)'] = "Kurikulum/ubah_metode_materi/*";
$route['hapus-metode-materi/(:any)'] = "Kurikulum/hapus_metode_materi/*";
$route['tambah-media-alat-bantu-materi/(:any)'] = "Kurikulum/tambah_media_alat_bantu_materi/*";
$route['ubah-media-alat-bantu-materi/(:any)'] = "Kurikulum/ubah_media_alat_bantu_materi/*";
$route['hapus-media-alat-bantu-materi/(:any)'] = "Kurikulum/hapus_media_alat_bantu_materi/*";
$route['tambah-referensi-materi/(:any)'] = "Kurikulum/tambah_referensi_materi/*";
$route['ubah-referensi-materi/(:any)'] = "Kurikulum/ubah_referensi_materi/*";
$route['hapus-referensi-materi/(:any)'] = "Kurikulum/hapus_referensi_materi/*";
$route['tambah-master-jadwal/(:any)'] = "Kurikulum/tambah_master_jadwal/*";
$route['ubah-master-jadwal/(:any)'] = "Kurikulum/ubah_master_jadwal/*";
$route['hapus-master-jadwal/(:any)'] = "Kurikulum/hapus_master_jadwal/*";
$route['isi-ubah-panduan-penugasan/(:any)'] = "Kurikulum/isi_ubah_panduan_penugasan/*";
$route['tambah-alat-bahan-panduan-penugasan-metode/(:any)'] = "Kurikulum/tambah_alat_bahan_panduan_penugasan_metode/*";
$route['hapus-alat-bahan-panduan-penugasan-metode/(:any)'] = "Kurikulum/hapus_alat_bahan_panduan_penugasan_metode/*";
$route['tambah-petunjuk-panduan-penugasan-metode/(:any)'] = "Kurikulum/tambah_petunjuk_panduan_penugasan_metode/*";
$route['ubah-petunjuk-panduan-penugasan-metode/(:any)'] = "Kurikulum/ubah_petunjuk_panduan_penugasan_metode/*";
$route['hapus-petunjuk-panduan-penugasan-metode/(:any)'] = "Kurikulum/hapus_petunjuk_panduan_penugasan_metode/*";
$route['isi-ubah-panduan-praktik-lapang/(:any)'] = "Kurikulum/isi_ubah_panduan_praktik_lapang/*";
$route['tambah-petunjuk-panduan-praktik-lapang/(:any)'] = "Kurikulum/tambah_petunjuk_panduan_praktik_lapang/*";
$route['ubah-petunjuk-panduan-praktik-lapang/(:any)'] = "Kurikulum/ubah_petunjuk_panduan_praktik_lapang/*";
$route['hapus-petunjuk-panduan-praktik-lapang/(:any)'] = "Kurikulum/hapus_petunjuk_panduan_praktik_lapang/*";
$route['aksi-isi-ubah-panduan-praktik-lapang/(:any)'] = "Kurikulum/aksi_isi_ubah_panduan_praktik_lapang/*";
$route['aksi-isi-ubah-panduan-penugasan/(:any)'] = "Kurikulum/aksi_isi_ubah_panduan_penugasan/*";
$route['tambah-kriteria-peserta/(:any)'] = "Kurikulum/tambah_kriteria_peserta/*";
$route['ubah-kriteria-peserta/(:any)'] = "Kurikulum/ubah_kriteria_peserta/*";
$route['hapus-kriteria-peserta/(:any)'] = "Kurikulum/hapus_kriteria_peserta/*";
$route['isi-ubah-jumlah-peserta/(:any)'] = "Kurikulum/isi_ubah_jumlah_peserta/*";
$route['isi-ubah-kriteria-fasilitator/(:any)'] = "Kurikulum/isi_ubah_kriteria_fasilitator/*";
$route['isi-ubah-ketentuan-penyelenggara/(:any)'] = "Kurikulum/isi_ubah_ketentuan_penyelenggara/*";
$route['isi-ubah-sertifikat/(:any)'] = "Kurikulum/isi_ubah_sertifikat/*";
$route['tambah-nilai-instrumen-evaluasi/(:any)'] = "Kurikulum/tambah_nilai_instrumen_evaluasi/*";
$route['tambah-aspek-penilaian/(:any)'] = "Kurikulum/tambah_aspek_penilaian/*";
$route['ubah-nilai-instrumen-evaluasi/(:any)'] = "Kurikulum/ubah_nilai_instrumen_evaluasi/*";
$route['ubah-aspek-penilaian/(:any)'] = "Kurikulum/ubah_aspek_penilaian/*";
$route['hapus-nilai-instrumen-evaluasi/(:any)'] = "Kurikulum/hapus_nilai_instrumen_evaluasi/*";
$route['hapus-aspek-penilaian/(:any)'] = "Kurikulum/hapus_aspek_penilaian/*";
$route['kirim-draft/(:any)'] = "Kurikulum/kirim_draft/*";
$route['pengecekan-kesesuaian-kurikulum/(:any)'] = "Kurikulum/pengecekan_kesesuaian/*";
$route['pemilihan-penilai/(:any)'] = "Kurikulum/pemilihan_penilai/*";
$route['penilaian-penilai/(:any)'] = "Kurikulum/penilaian_penilai/*";
$route['beri-penilaian-bab/(:any)'] = "Kurikulum/beri_penilaian_bab/*";
$route['ubah-penilaian-bab/(:any)'] = "Kurikulum/ubah_penilaian_bab/*";
$route['beri-penilaian-subbab/(:any)'] = "Kurikulum/beri_penilaian_subbab/*";
$route['ubah-penilaian-subbab/(:any)'] = "Kurikulum/ubah_penilaian_subbab/*";
$route['penilaian-materi/(:any)/(:any)'] = "Kurikulum/penilaian_materi/*/*";
$route['penilaian-materi-rbpmp/(:any)/(:any)'] = "Kurikulum/penilaian_materi_rbpmp/*/*";
$route['penilaian-panduan-penugasan-metode-materi/(:any)/(:any)'] = "Kurikulum/penilaian_panduan_penugasan_metode_materi/*/*";
$route['penilaian-panduan-penugasan-praktik-lapang/(:any)/(:any)'] = "Kurikulum/penilaian_panduan_penugasan_praktik_lapang/*/*";
$route['ubah-penilaian-panduan-penugasan-praktik-lapang/(:any)/(:any)'] = "Kurikulum/ubah_penilaian_panduan_penugasan_praktik_lapang/*/*";
$route['penilaian-ketentuan-penyelenggara-pelatihan-item/(:any)/(:any)'] = "Kurikulum/penilaian_ketentuan_penyelenggara_pelatihan_item/*/*";
$route['ubah-penilaian_ketentuan_penyelenggara-pelatihan-item/(:any)/(:any)'] = "Kurikulum/ubah_penilaian_ketentuan_penyelenggara_pelatihan_item/*/*";
$route['list-penilaian/(:any)'] = "Kurikulum/list_penilaian/*";
$route['lihat-penilaian/(:any)'] = "Kurikulum/lihat_penilaian/*";
$route['kirim-penilaian-kurikulum/(:any)/(:any)'] = "Kurikulum/kirim_penilaian_kurikulum/*/*";
$route['preview-kurikulum/(:any)'] = "Kurikulum/preview_kurikulum/*";
$route['kirim-draft-perbaikan-kurikulum/(:any)'] = "Kurikulum/kirim_draft_perbaikan/*";
$route['selesaikan-kurikulum/(:any)'] = "Kurikulum/selesaikan_kurikulum/*";
$route['upload-cover-kata-pengantar/(:any)'] = "Kurikulum/upload_cover_kata_pengantar/*";
$route['pemilihan-ketentuan-kurikulum/(:any)'] = "Kurikulum/pemilihan_ketentuan_kurikulum/*";
$route['pengesahan-kurikulum/(:any)'] = "Kurikulum/pengesahan_kurikulum/*";
$route['detail-kurikulum-selesai/(:any)'] = "Kurikulum/detail_kurikulum_selesai/*";
$route['surat-pengesahan-kurikulum/(:any)'] = "Kurikulum/surat_pengesahan_kurikulum/*";
$route['kirim-kurikulum-siakpel/(:any)'] = "Kurikulum/kirim_kurikulum_siakpel/*";
$route['konfirmasi-kelanjutan-penyusunan-kurikulum/(:any)'] = "Kurikulum/konfirmasi_kelanjutan_penyusunan_kurikulum/*";
$route['verifikasi-permohonan-kelanjutan-penyusunan-kurikulum/(:any)'] = "Kurikulum/verifikasi_permohonan_kelanjutan_penyusunan_kurikulum/*";

$route['kurikulum-sah'] = "Kurikulum_sah";

$route['request-hubungi-penilai-institusi'] = "Request_hub";
$route['request-hubungi-penilai/(:any)'] = "Request_hub/request_hubungi_penilai/*";
$route['setujui-request/(:any)'] = "Request_hub/acc_request_hubungi_penilai/*";

$route['metode'] = "Metode";
$route['tambah-metode'] = "Metode/tambah";
$route['ubah-metode/(:any)'] = "Metode/ubah/*";
$route['hapus-metode/(:any)'] = "Metode/hapus/*";

$route['media-alat-bantu'] = "Media_alat_bantu";
$route['tambah-media-alat-bantu'] = "Media_alat_bantu/tambah";
$route['ubah-media-alat-bantu/(:any)'] = "Media_alat_bantu/ubah/*";
$route['hapus-media-alat-bantu/(:any)'] = "Media_alat_bantu/hapus/*";

$route['jenis-pelatihan'] = "Jenis_pelatihan";
$route['tambah-jenis-pelatihan'] = "Jenis_pelatihan/tambah";
$route['ubah-jenis-pelatihan/(:any)'] = "Jenis_pelatihan/ubah/*";
$route['hapus-jenis-pelatihan/(:any)'] = "Jenis_pelatihan/hapus/*";

$route['kategori-pelatihan'] = "Kategori_pelatihan";
$route['tambah-kategori-pelatihan'] = "Kategori_pelatihan/tambah";
$route['ubah-kategori-pelatihan/(:any)'] = "Kategori_pelatihan/ubah/*";
$route['hapus-kategori-pelatihan/(:any)'] = "Kategori_pelatihan/hapus/*";

$route['tanggal-merah'] = "Tanggal_merah";
$route['tambah-tanggal-merah'] = "Tanggal_merah/tambah";
$route['ubah-tanggal-merah/(:any)'] = "Tanggal_merah/ubah/*";
$route['hapus-tanggal-merah/(:any)'] = "Tanggal_merah/hapus/*";

$route['master-pengesah'] = "Master_pengesah";
$route['ubah-master-pengesah/(:any)'] = "Master_pengesah/ubah/*";

// Pengaturan Logo
$route['pengaturan-logo'] = 'Pengaturan/logo';
$route['ubah-logo/(:any)'] = 'Pengaturan/ubah_logo/*';

// Panduan
$route['master-data-panduan'] = 'Panduan/index_panduan';
$route['ubah-panduan/(:any)'] = 'Panduan/ubah/*';

// Informasi Profil
$route['informasi-profil'] = 'Profil';
$route['update-institusi'] = 'Profil/tarik_institusi';
$route['update-sdm-institusi'] = 'Profil/tarik_sdm_institusi';


// $route['(:any)'] = "portal/home";


/* End of file routes.php */
/* Location: ./application/config/routes.php */