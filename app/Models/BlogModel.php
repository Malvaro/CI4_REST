<?php namespace App\Models;

use CodeIgniter\Model;

class BlogModel extends Model{
    protected $table = 'blog';
    protected $primaryKey = 'blog_id';
    protected $allowedFields = ['blog_titulo','blog_descripcion','blog_usuario','blog_estado','region_id'];  
    
    
}

