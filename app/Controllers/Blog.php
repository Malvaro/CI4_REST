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

    public function create(){
        helper(['form']);
        
        $rules = [
          'titulo' => 'required|min_length[6]',
          'descripcion' => 'required',
          'usuario' => 'required',
          'region' => 'required'
        ];
        
        if(!$this->validate($rules)){
            return $this->fail($this->validator->getErrors());            
        }
        else {
            $data = [
              'blog_titulo' => $this->request->getVar('titulo'),
              'blog_descripcion' => $this->request->getVar('descripcion'), 
              'blog_usuario' => $this->request->getVar('usuario'), 
              'blog_estado' => 'PUBLICADO',
              'region_id' => $this->request->getVar('region'),
            ];
            
            $blog_id = $this->model->insert($data);
            $data['blog_id'] = $blog_id;
            return $this->respondCreated($data);
        }
    }    
    
    public function show($id = null){
        $data = $this->model->find($id);
        return $this->respond($data);
        
    }
    
    public function update($id = null)
    {
        helper(['form']);
        
        $rules = [
          'titulo' => 'required|min_length[6]',
          'descripcion' => 'required',
          'usuario' => 'required',
          'region' => 'required'
        ];
        
        if(!$this->validate($rules)){
            return $this->fail($this->validator->getErrors());            
        }
        else {
            $input = $this->request->getRawInput();
            
            $data = [
               'blog_id' => $id, 
               'blog_titulo' => $input['titulo'],
               'blog_descripcion' =>  $input['descripcion'], 
               'blog_usuario' =>  $input['usuario'], 
               'blog_estado' =>  $input['estado'],
               'region_id' =>  $input['region'], 
                
            ];
        
        $this->model->save($data);    
        return $this->respond($data);    
        }
    }
    
    public function delete($id = null){
        $data = $this->model->find($id);
        if($data){
            $this->model->delete($id);
            return $this->respondDeleted($data);
        } else {
            return $this->failNotFound('Item no encontrado');
            
        }
        
    }
}
