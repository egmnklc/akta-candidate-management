<?php

namespace App\Controllers;

use App\Models\Ajax_crudModel;
use monken\TablesIgniter;


class CandidateController extends BaseController
{
	// Salary Colon, Company, Blacklist.
	// Duzenleme tarihlerini kaydedip gosterme, guncellenen seylerin kaydi tutulacak.
	// Rapor cikarma, arama filtreleme vs vs.
	function dum()
	{
		$crudModel = new Ajax_crudModel();

		$data['user_data'] = $crudModel->orderBy('id', 'DESC')->paginate(10);

		$data['pagination_link'] = $crudModel->pager;

		echo view('templates/header');
		echo view('templates/footer');
		return view('test', $data);
	}
	function index()
	{
		//echo 'Hello Codeigniter 4';

		$crudModel = new Ajax_crudModel();

		$data['user_data'] = $crudModel->orderBy('id', 'DESC')->paginate(10);

		$data['pagination_link'] = $crudModel->pager;

		echo view('templates/header');
		echo view('templates/footer');
		return view('candidates', $data);
	}
	function add()
	{
		echo view('templates/header');
        echo view('templates/footer');
		return view('add_data');
	}

	function add_validation()
	{
		echo view('templates/header');
        echo view('templates/footer');
		helper(['form', 'url']);

		$error = $this->validate([
			'name' 	=> 'required|min_length[3]',
			'found_by' => 'required|min_length[3]',
			'found_date' => 'required|min_length[3]',
			'linkedin' => 'required|min_length[3]',
			'position' => 'required|min_length[1]',
			'notes' => 'required|min_length[1]'
		]);



		if (!$error) {
			echo view('add_data', [
				'error' => $this->validator
			]);
		} else {
			$crudModel = new Ajax_crudModel();

			$crudModel->save([
				'name'   => $this->request->getVar('name'),
				'found_by' => $this->request->getVar('found_by'),
				'found_date' => $this->request->getVar('found_date'),
				'linkedin' => $this->request->getVar('linkedin'),
				'position' => $this->request->getVar('position'),
				'notes' => $this->request->getVar('notes')
			]);

			$session = \Config\Services::session();

			$session->setFlashdata('success', 'User Data Added');
			echo view('templates/header');
			echo view('templates/footer');
			return $this->response->redirect(site_url('/candidates'));
		}
	}

	function fetch_all()
	{
		$crudModel = new Ajax_crudModel();

		$data_table = new TablesIgniter();

		$data_table->setTable($crudModel->noticeTable())
				   ->setDefaultOrder("id", "DESC")
				   ->setSearch(["id", "name", "found_by", "found_date", "linkedin", "position", "notes", "updated_at"])
				   ->setOrder(["id", "name", "found_by", "found_date", "linkedin", "position", "notes", "updated_at"])
				   ->setOutput(["id", "name", "found_by", "found_date", "linkedin", "position", "notes", "updated_at", $crudModel->button()]);
		return $data_table->getDatatable();
	}

	// show single user
	function fetch_single_data($id = null)
	{
		$crudModel = new Ajax_crudModel();

		$data['user_data'] = $crudModel->where('id', $id)->first();
        echo view('templates/header');
        echo view('templates/footer');
		return view('edit_data', $data);
	}

	function edit_validation()
	{
		helper(['form', 'url']);

		$error = $this->validate([
			'name' 	=> 'required|min_length[3]',
			'found_by' => 'required|min_length[3]',
			'found_date' => 'required|min_length[3]',
			'linkedin' => 'required|min_length[3]',
			'position' => 'required|min_length[3]',
			'notes' => 'required|min_length[1]',
		]);

		$crudModel = new Ajax_crudModel();

		$id = $this->request->getVar('id');

		if (!$error) {
			$data['user_data'] = $crudModel->where('id', $id)->first();
			$data['error'] = $this->validator;
			echo view('edit_data', $data);
		} else {
			$data = [
				'name' => $this->request->getVar('name'),
				'found_by' => $this->request->getVar('found_by'),
				'found_date' => $this->request->getVar('found_date'),
				'linkedin' => $this->request->getVar('linkedin'),
				'position' => $this->request->getVar('position'),
				'notes' => $this->request->getVar('notes')
			];

			$crudModel->update($id, $data);

			$session = \Config\Services::session();

			$session->setFlashdata('success', 'User Data Updated');
			echo view('templates/header');
			echo view('templates/footer');
			return $this->response->redirect(site_url('/candidates'));
		}
	}

	function delete($id)
	{
		$crudModel = new Ajax_crudModel();

		$crudModel->where('id', $id)->delete($id);

		$session = \Config\Services::session();

		$session->setFlashdata('success', 'User Data Deleted');
        echo view('templates/header');
        echo view('templates/footer');
		return $this->response->redirect(site_url('/candidates'));
	}
}
