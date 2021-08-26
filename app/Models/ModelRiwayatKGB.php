<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelRiwayatKGB extends Model
{
    protected $table      = 'kgb_riwayat';
    protected $primaryKey = 'id';

    protected $useTimestamps        = true;
    protected $dateFormat           = 'datetime';
    protected $createdField         = 'created_at';
    protected $updatedField         = 'updated_at';
    protected $deletedField         = 'deleted_at';

    protected $useAutoIncrement = true;

    protected $allowedFields = ["usulan_tgl_surat_sbl", "usulan_no_surat_sbl","usulan_kgb_berikut","usulan_approved","tgl_surat", "no_surat", "nip","nama", "golru", "jabatan", "gapok_lama", "sk", "no_spangkat", "tgl_spangkat", "tmt_spangkat", "mk_spangkat_tahun", "mk_spangkat_bulan", "gapok_baru", "mk_tahun_baru", "mk_bulan_baru", "golru_baru", "tmt_baru", "kgb_berikut", "narasi", "nip_kepala", "instansi"]; //create update


}

 