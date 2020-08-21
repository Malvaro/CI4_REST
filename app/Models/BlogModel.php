<?php namespace App\Models;

use CodeIgniter\Model;

class BlogModel extends Model{
    protected $table = 'blog';
    protected $primaryKey = 'post_id';
    protected $allowedFields = ['blog_titulo','blog_descripcion'];  
    
    
}

