<?php

namespace App\Models;

use CodeIgniter\Model;

class CandidateModel extends Model
{
	protected $table = 'candidate_table';

	protected $primaryKey = 'id';

	protected $allowedFields = ['name', 'found_by', 'last_contacted', 'linkedin', 'position', 'company', 'salary', 'blacklisted','notes'];

	public function noticeTable()
	{
		$builder = $this->db->table('candidate_table');

		return $builder;
	}

	public function button()
	{
		$action_button = function ($row) {
			return '
				<a href="' . base_url() . '/canditates/fetch_single_data/' . $row["id"] . '" class="btn btn-sm btn-warning">Edit</a>
				&nbsp;
				<button type="button" onclick="delete_data(' . $row["id"] . ')" class="btn btn-danger btn-sm">Delete</button>
			';
		};

		return $action_button;
	}
}
