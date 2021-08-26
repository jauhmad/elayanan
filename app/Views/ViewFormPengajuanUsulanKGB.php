<?php
  helper('form');
?>
<?= $this->extend('tataletak/admin/tataletak_admin-tabler') ?>

<?= $this->section('css') ?>
   <!--  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"> -->
<?= $this->endSection() ?>

<?= $this->section('konten') ?>
   <?php echo form_open('', 'class="card"'); ?>

   <?php 
    $usulan_no_surat_sbl=isset($usulan_no_surat_sbl)? $usulan_no_surat_sbl:'';
    $usulan_tgl_surat_sbl=isset($usulan_tgl_surat_sbl)? $usulan_tgl_surat_sbl:'';
    $usulan_kgb_berikut=isset($usulan_kgb_berikut)? $usulan_kgb_berikut:'';
   ?>
    <div class="row row-cards">
        
        <div class="col-2">
        </div> 
        <div class="col-8">
          <div class="card-header">
            <h4 class="card-title"><?= $aksi ?></h4>
          </div>
          
          <div class="card-body">
            <div class="row">
              <div class="col-lg-12">
                <div class="mb-3">
                  <label class="form-label">Pengajuan untuk KGB berikutnya dengan TMT</label>
                  <input type="date" class="form-control" name="usulan_kgb_berikut" value="<?= $usulan_kgb_berikut ?>" required readonly>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="mb-3">
                  <label class="form-label">Nomor Surat Pemberitahuan KGB sebelumnya</label>
                  <input type="text" class="form-control" name="usulan_no_surat_sbl" value="<?= $usulan_no_surat_sbl ?>" required>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="mb-3">
                  <label class="form-label">Tanggal Surat Pemberitahuan KGB sebelumnya</label>
                  <input type="date" class="form-control" name="usulan_tgl_surat_sbl" value="<?= $usulan_tgl_surat_sbl ?>" required>
                </div>
              </div>
              
            
            </div>
          </div>

 

          <div class="card-footer text-end">
            <div class="d-flex">
            <a href="javascript:window.history.go(-1);" class="btn btn-link link-secondary">
              Batal
            </a>
            <button type="submit" class="btn btn-primary ms-auto">
             
              <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="12" y1="5" x2="12" y2="19" /><line x1="5" y1="12" x2="19" y2="12" /></svg>
              Simpan
            </button>
          </div>
          </div>
        </div>
        <div class="col-2">
        </div> 
      
    </div>   

    </form>
<?= $this->endSection() ?>

<?= $this->section('js') ?>

<?= $this->endSection() ?>

