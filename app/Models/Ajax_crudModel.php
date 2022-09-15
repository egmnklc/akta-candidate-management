<?php

namespace App\Models;

use CodeIgniter\Model;

class Ajax_crudModel extends Model
{
	protected $table = 'candidate_table';

	protected $primaryKey = 'id';

	protected $allowedFields = ['name', 'found_by', 'found_date', 'linkedin', 'position', 'notes'];

	public function noticeTable()
	{
		$builder = $this->db->table('candidate_table');

		return $builder;
	}

	public function button()
	{
		$action_button = function($row){
			return '
				<button type="button" name="edit" class="btn btn-warning btn-sm edit" data-id="'.$row['id'].'">Edit</button>
				&nbsp;
				<button type="button" class="btn btn-danger btn-sm delete" data-id="'.$row['id'].'">Delete</button>
				';
		};

		return $action_button;
	}
}


?>