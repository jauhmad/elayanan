<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelPegawai extends Model
{
    protected $table      = 'pegawai';
    protected $primaryKey = 'id';
    protected $useTimestamps        = true;
    protected $dateFormat           = 'datetime';
    protected $createdField         = 'created_at';
    protected $updatedField         = 'updated_at';
    protected $deletedField         = 'deleted_at';
    protected $useAutoIncrement = true;
    protected $allowedFields = ["nip","nama"]; 

    public function get_nama($nip){
         return $this->db->table('pegawai')
         ->select('nama')
         ->where('nip',$nip)
         ->get()->getResultArray();  
    }
}

 