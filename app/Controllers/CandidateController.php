<?php

namespace App\Controllers;

use App\Models\CandidateModel;
use monken\TablesIgniter;


class CandidateController extends BaseController
{
	// Salary Colon, Company, Blacklist.
	// Duzenleme tarihlerini kaydedip gosterme, guncellenen seylerin kaydi tutulacak.
	// Rapor cikarma, arama filtreleme vs vs.
	// En son iletisime gecilen tarih found date'e gelecek, 
	function index()
	{
		//echo 'Hello Codeigniter 4';

		$crudModel = new CandidateModel();

		$candidates_title = ['Candidates'];
		$data['user_data'] = $crudModel->orderBy('id', 'ASC')->paginate(10);
		$data['pagination_link'] = $crudModel->pager;

		echo view('templates/header', $candidates_title);
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
			'last_contacted' => 'required|min_length[3]',
			'linkedin' => 'required|min_length[3]|is_unique[candidate_table.linkedin]',
			'position' => 'required|min_length[1]',
			'notes' => 'required|min_length[1]',
			'company' => 'required|min_length[1]',
			'salary' => 'required|min_length[1]',
			'blacklisted' => 'required|min_length[1]',
		]);



		if (!$error) {
			echo view('add_data', [
				'error' => $this->validator
			]);
		} else {
			$crudModel = new CandidateModel();

			$crudModel->save([
				'name'   => $this->request->getVar('name'),
				'found_by' => $this->request->getVar('found_by'),
				'last_contacted' => $this->request->getVar('last_contacted'),
				'linkedin' => $this->request->getVar('linkedin'),
				'position' => $this->request->getVar('position'),
				'notes' => $this->request->getVar('notes'),
				'company' =>$this->request->getVar('company'),
				'notes' => $this->request->getVar('notes'),
				'salary' => $this->request->getVar('salary'),
				'blacklisted' => $this->request->getVar('blacklisted')
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
		$crudModel = new CandidateModel();

		$data_table = new TablesIgniter();

		$data_table->setTable($crudModel->noticeTable())
				   ->setDefaultOrder("id", "DESC")
				   ->setSearch(["id", "name", "found_by", "last_contacted", "linkedin", "position", "notes", "company", "salary", "blacklisted"])
				   ->setOrder(["id", "name", "found_by", "last_contacted", "linkedin", "position", "notes", "company", "salary", "blacklisted"])
				   ->setOutput(["id", "name", "found_by", "last_contacted", "linkedin", "position", "notes", "company", "salary", "blacklisted", $crudModel->button()]);
		return $data_table->getDatatable();
	}

	// show single user
	function fetch_single_data($id = null)
	{
		$crudModel = new CandidateModel();

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
			'last_contacted' => 'required|min_length[3]',
			'linkedin' => 'required|min_length[3]',
			'position' => 'required|min_length[1]',
			'company' => 'required|min_length[1]',
			'salary' => 'required|min_length[1]',
			'blacklisted' => 'required|min_length[1]',
			'notes' => 'required|min_length[1]'
		]);

		$crudModel = new CandidateModel();

		$id = $this->request->getVar('id');

		if (!$error) {
			$data['user_data'] = $crudModel->where('id', $id)->first();
			$data['error'] = $this->validator;
			echo view('templates/header');
			echo view('templates/footer');
			echo view('edit_data', $data);
		} else {
			$data = [
				'name'   => $this->request->getVar('name'),
				'found_by' => $this->request->getVar('found_by'),
				'last_contacted' => $this->request->getVar('last_contacted'),
				'linkedin' => $this->request->getVar('linkedin'),
				'position' => $this->request->getVar('position'),
				'company' =>$this->request->getVar('company'),
				'blacklisted' => $this->request->getVar('blacklisted'),
				'salary' => $this->request->getVar('salary'),
				'notes' => $this->request->getVar('notes'),
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
		$crudModel = new CandidateModel();

		$crudModel->where('id', $id)->delete($id);

		$session = \Config\Services::session();

		$session->setFlashdata('success', 'User Data Deleted');
        echo view('templates/header');
        echo view('templates/footer');
		return $this->response->redirect(site_url('/candidates'));
	}
}
