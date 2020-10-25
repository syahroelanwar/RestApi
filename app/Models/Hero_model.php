<?php 
namespace App\Models;
use CodeIgniter\Model;

class Hero_model extends Model
{
	protected $table = 'tbl_heroes';
	public function getData($id = false)
	{
		if($id === false)
		{
			return $this->findAll();
		}
		elseif ($id=='no' or $id=='yes') 
		{
			return $this->table('tbl_heroes')->orderBy('id','RANDOM')->where(['popular' => $id])->findAll();
		}
		elseif ($id=='shu' or $id=='wu' or $id=='wei' or $id=='other') 
		{
			return $this->table('tbl_heroes')->orderBy('id','RANDOM')->where(['kingdom' => $id])->findAll();
		}
		else
		{
			return $this->getWhere(['id' => $id])->getRowArray();
		}
	}

	public function saveData($data)
	{
		$query = $this->db->table($this->table)->insert($data);
		return $query;
	}

	public function updateData($data, $id)
	{
		$query = $this->db->table($this->table)->update($data, array('id' => $id));
		return $query;
	}

	public function deleteData($id)
	{
		$query = $this->db->table($this->table)->delete(array('id' => $id));
		return $query;
	}
}