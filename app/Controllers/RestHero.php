<?php  
namespace App\Controllers;
use CodeIgniter\RESTful\ResourceController;

class RestHero extends ResourceController
{
	protected $format = 'json';
	protected $modelName = 'App\Models\Hero_model';

	public function index()
	{
		return $this->respond($this->model->findAll(),200);
	}

	public function show($id1 = NULL, $id2 = NULL)
	{
		if($id2 != NULL? $id = $id2 : $id = $id1);
		$get = $this->model->getData($id);
		if($get)
		{
			$code = 200;
			$response = [
				'status' => $code,
				'error' => false,
				'data' => $get,
			];
		}else{
			$code = 401;
			$msg = ['message' => 'Not Found'];
			$response = [
				'status' => $code,
				'error' => false,
				'data' => $msg,
			];
		}
		return $this->respond($response, $code);
	}

	public function create()
	{
		$name = $this->request->getPost('name');
		$kingdom = $this->request->getPost('kingdom');
		$detail = $this->request->getPost('detail');
		$img = $this->request->getPost('img');

		$data = [
			'name' => $name,
			'kingdom' => $kingdom,
			'detail' => $detail,
			'img' => $img
		];

		$save = $this->model->saveData($data);
		if($save){
			$msg = ['message' => 'Created Success'];
			$response = [
				'status' => 200,
				'error' => false,
				'data' => $msg,
			];
			return $this->respond($response, 200);
		}
	}

	public function update($id1 = NULL, $id2 = NULL)
	{
		if($id2 != NULL? $id = $id2 : $id = $id1);
		$name = $this->request->getPost('name');
		$kingdom = $this->request->getPost('kingdom');
		$detail = $this->request->getPost('detail');
		$img = $this->request->getPost('img');

		$data = [
			'name' => $name,
			'kingdom' => $kingdom,
			'detail' => $detail,
			'img' => $img
		];

		$update = $this->model->updateData($data, $id);
		if($update){
			$msg = ['message' => 'Updated Success'];
			$response = [
				'status' => 200,
				'error' => false,
				'data' => $msg,
			];
		}
		return $this->respond($response, 200);

	}

	public function delete($id1 = NULL, $id2 = NULL)
	{
		if($id2 != NULL? $id = $id2 : $id = $id1);
		$del = $this->model->deleteData($id);
		if($del){
			$code = 200;
			$msg = ['message' => 'Deleted Success'];
			$response = [
				'status' => $code,
				'error' => false,
				'data' => $msg,
			];
		}else{
			$code = 401;
			$msg = ['message' => 'Not Found'];
			$response = [
				'status' => $code,
				'error' => false,
				'data' => $msg,
			];
		}
		return $this->respond($response, $code);
	}

}