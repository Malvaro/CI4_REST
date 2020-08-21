<?php namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

class Blog extends ResourceController
{
    protected $modelName = 'App\Models\BlogModel';
    protected $format = 'json';
    
    public function index()
    {
        $blogs  = $this->model->findAll();
        return $this->respond($blogs);
    }

}
