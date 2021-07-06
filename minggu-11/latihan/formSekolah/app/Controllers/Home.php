<?php

namespace App\Controllers;

use App\Models\DaftarSekolahModel;

class Home extends BaseController
{
	protected $koneksiDB;

	public function __construct()
	{
		$this->koneksiDB = new DaftarSekolahModel();
	}

	public function index()
	{
		// return view('welcome_message');

		// $ambil = $this->koneksiDB->findAll();

		//sekolah_terdekat disini adalah nama tabel
		//yang kita pilih sebelumnya
		// $data = [
		// 	'sekolah_terdekat' => $ambil
		// ];
		return view('halaman_utama');
	}

	// public function view($page = 'home')
	// {
	// 	if (!is_file(APPPATH . '/Views/inventarisasi/' . $page . '.php')) {
	// 		// Whoops, we don't have a page for that!
	// 		throw new \CodeIgniter\Exceptions\PageNotFoundException($page);
	// 	}

	// 	$model = new ManipulasiDB();
	// 	$data['sekolah_terdekat'] = $model->getSekolahTerdekat();
	// 	// // var_dump($sekolah_terdekat);

	// 	// $data['title'] = ucfirst($page); // Capitalize the first letter
	// 	// $data = null;
	// 	// echo view('templates/header');
	// 	// // echo "hello world";
	// 	// echo view('inventarisasi/home', $data);
	// 	// echo view('templates/footer');
	// }

	public function addData()
	{
		return view('tambah_data');
	}
}
