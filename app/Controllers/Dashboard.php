<?php namespace App\Controllers;

class Dashboard extends BaseController
{
	public function index()
	{
		$data = [];
		if(!session()->get('isLoggedIn')){
			redirect()->to('/');
		}

		echo view('templates/header', $data);
		echo view('dashboard');
		echo view('templates/footer');
	}

}