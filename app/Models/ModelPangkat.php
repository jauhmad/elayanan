<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelPangkat extends Model
{
    protected $table      = 'pangkat';
    protected $primaryKey = 'golru';
    protected $useTimestamps        = true;
 
    protected $allowedFields = []; 

    public function get_nama($golru){
         return $this->db->table('pangkat')
         ->select('nama')
         ->where('golru',$golru)
         ->get()->getResultArray();  
    }

    
}

 