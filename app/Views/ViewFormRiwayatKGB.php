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
    $no_surat=isset($no_surat)? $no_surat:'';
    $tgl_surat=isset($tgl_surat)? $tgl_surat:'';
    $nama=isset($nama)? $nama:'';
    $nip=isset($nip)? $nip:'';
    $golru=isset($golru)? $golru:'';
    $jabatan=isset($jabatan)? $jabatan:'';
    $rjabatan=isset($rjabatan)? $rjabatan:'';
    $no_spangkat=isset($no_spangkat)? $no_spangkat:'';
    $tgl_spangkat=isset($tgl_spangkat)? $tgl_spangkat:'';
    $tmt_spangkat=isset($tmt_spangkat)? $tmt_spangkat:'';
    $mk_spangkat_tahun=isset($mk_spangkat_tahun)? $mk_spangkat_tahun:'';
    $mk_spangkat_bulan=isset($mk_spangkat_bulan)? $mk_spangkat_bulan:'';
    $gapok_lama=isset($gapok_lama)? $gapok_lama:'';
    $gapok_baru=isset($gapok_baru)? $gapok_baru:'';
    $mk_tahun_baru=isset($mk_tahun_baru)? $mk_tahun_baru:'';
    $mk_bulan_baru=isset($mk_bulan_baru)? $mk_bulan_baru:'';
    $golru_baru=isset($golru_baru)? $golru_baru:'';
    $tmt_baru=isset($tmt_baru)? $tmt_baru:'';
    $kgb_berikut=isset($kgb_berikut)? $kgb_berikut:'';
   ?>
    <div class="row row-cards">
        <input type="hidden" name="nip_kepala" value="<?= $nip_kepala ?>">
        <input type="hidden" name="instansi" value="<?= $instansi ?>">
        <div class="col-2">
        </div> 
        <div class="col-8">
          <div class="card-header">
            <h4 class="card-title"><?= $aksi ?> Data</h4>
          </div>
          
          <div class="card-body">
            <div class="row">
              <div class="col-lg-6">
                <div class="mb-3">
                  <label class="form-label">Surat Pemberitahuan KGB Nomor</label>
                  <input type="text" class="form-control" name="no_surat" value="<?= $no_surat ?>" required>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="mb-3">
                  <label class="form-label">Tanggal</label>
                  <input type="date" class="form-control" name="tgl_surat" value="<?= $tgl_surat ?>" required>
                </div>
              </div>
            
            </div>
          </div>

          <div class="card-body">
            <div class="row">
              <div class="col-lg-6">
                <div class="mb-3">
                  <label class="form-label">Nama</label>
                  <input type="text" class="form-control" name="nama" value="<?= $nama ?>" readonly>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="mb-3">
                  <label class="form-label">NIP</label>
                  <input type="text" class="form-control" name="nip" value="<?= $nip ?>" readonly>
                </div>
              </div>
              <div class="col-lg-2">
                <div class="mb-3">
                  <label class="form-label">Golru</label>
                  <select class="form-select" id="golru" name="golru">
                    <?= $golru ?>
                  </select>
                </div>
              </div>
              <div class="col-lg-10">
                <div class="mb-3">
                  <label class="form-label">Jabatan</label>
                  <select class="form-select" name="jabatan">
                    <?= $rjabatan ?>
                  </select>
                </div>
              </div>
            </div>
          </div>    

          <div class="card-body">
            <div class="row">
            <div class="col-lg-4">
              <div class="mb-3">
                <label class="form-label">Surat Kenaikan Pangkat Nomor</label>
                <input type="text" class="form-control" name="no_spangkat" value="<?= $no_spangkat ?>" required>
              </div>
            </div>
             <div class="col-lg-4">
                <div class="mb-3">
                  <label class="form-label">Tanggal</label>
                  <input type="date" class="form-control" name="tgl_spangkat" value="<?= $tgl_spangkat ?>" required>
                </div>
             </div>
           
            <div class="col-lg-4">
                <div class="mb-3">
                  <label class="form-label">TMT</label>
                  <input type="date" class="form-control" name="tmt_spangkat" value="<?= $tmt_spangkat ?>" required>
                </div>
             </div>
            <div class="col-lg-4">
              <div class="mb-3">
                <label class="form-label">Masa Kerja Tahun</label>
                <input type="text" class="form-control" id="mk_spangkat_tahun" name="mk_spangkat_tahun" value="<?= $mk_spangkat_tahun ?>" required placeholder="... Tahun"> 
              </div>
            </div>
            <div class="col-lg-4">
              <div class="mb-3">
                <label class="form-label">Masa Kerja Bulan</label>
                <input type="text" class="form-control" name="mk_spangkat_bulan" value="<?= $mk_spangkat_bulan ?>" required placeholder="... Bulan">
              </div>
            </div>
              <div class="col-lg-4">
                <label class="form-label">Gaji Pokok Lama Rp.</label>
              <div class="input-icon mb-3">
                  <input type="text" class="form-control" name="gapok_lama" id="gapok_lama" value="<?= $gapok_lama ?>" readonly>
                  <span class="input-icon-addon">
                      <div id="loading" class="spinner-border spinner-border-sm text-muted" role="status"></div>
                  </span>
              </div>
              </div>
            </div>  
          
          </div>

          <div class="card-body">
            <div class="row">
              <div class="col-lg-4">
              <div class="mb-3">
                <label class="form-label">Berdasar Masa Kerja Tahun</label>
                <input type="text" class="form-control"  id="mk_tahun_baru" name="mk_tahun_baru" value="<?= $mk_tahun_baru ?>" placeholder="... Tahun" required>
              </div>
            </div>

            <div class="col-lg-4">
              <div class="mb-3">
                <label class="form-label">Bulan</label>
                <input type="text" class="form-control" name="mk_bulan_baru" placeholder="... Bulan" value="<?= $mk_bulan_baru ?>"required>
              </div>
            </div>
              <div class="col-lg-4">
              <div class="mb-3">
                  <label class="form-label">Golru</label>
                  <select class="form-select" name="golru_baru" id="golru_baru">
                    <?= $golru_baru ?>
                  </select>
                </div>
            </div>
              

          

            
         
            <div class="col-lg-4">
                <div class="mb-3">
                  <label class="form-label">TMT</label>
                  <input type="date" class="form-control" name="tmt_baru" value="<?= $tmt_baru ?>" required>
                </div>
             </div>
            <div class="col-lg-4">
              <div class="mb-3">
                <label class="form-label">KGB Berikutnya</label>
                <input type="date" class="form-control" name="kgb_berikut" value="<?= $kgb_berikut ?>" required>
              </div>
            </div>

            <div class="col-lg-4">
              <label class="form-label">Gaji Pokok Baru Rp.</label>
              <div class="input-icon mb-3">
                  <input type="text" class="form-control" name="gapok_baru" id="gapok_baru" value="<?= $gapok_baru ?>" readonly>
                  <span class="input-icon-addon">
                      <div id="loading2" class="spinner-border spinner-border-sm text-muted" role="status"></div>
                  </span>
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



    <script type="text/javascript">
      function ajaxgaji() {
                var csrfHash = $("input[name=csrf_token_elayanan]").val();
                var mkg = $('#mk_spangkat_tahun').val();
                var gol = $('#golru').val();
                if(mkg){
                    $.ajax({
                        type:'POST',
                        url:'<?= base_url('/admin/ajax_gaji') ?>',
                        dataType: "json",     
                        data:{'gol':gol, 'mkg':mkg, 'csrf_token_elayanan':csrfHash },
                        beforeSend: function() {
                        $("#loading").show();
                        $('#gapok_lama').attr('placeholder' , "Memuat..");
                      },
                        success:function(html){
                            $('#gapok_lama').val(html.gaji);
                            $("input[name=csrf_token_elayanan]").val(html.csrf);
                            $("#loading").hide();
                            $('#gapok_lama').removeAttr('placeholder');
                        }
                    }); 
                }
      }

      function ajaxgaji2() {
                var csrfHash = $("input[name=csrf_token_elayanan]").val();
                var mkg = $('#mk_tahun_baru').val();
                var gol = $('#golru_baru').val();
                if(mkg){
                    $.ajax({
                        type:'POST',
                        url:'<?= base_url('/admin/ajax_gaji') ?>',
                        dataType: "json",     
                        data:{'gol':gol, 'mkg':mkg, 'csrf_token_elayanan':csrfHash },
                        beforeSend: function() {
                        $("#loading2").show();
                        $('#gapok_baru').attr('placeholder' , "Memuat..");
                      },
                        success:function(html){
                            $('#gapok_baru').val(html.gaji);
                            $("input[name=csrf_token_elayanan]").val(html.csrf);
                            $("#loading2").hide();
                            $('#gapok_baru').removeAttr('placeholder');
                        }
                    }); 
                }
      }

$(document).ready(function(){
        $("#loading").hide();
        $("#loading2").hide();
        $('#golru').on('change', function(){
                ajaxgaji();
            });
        $('#mk_spangkat_tahun').on('blur', function(){
                ajaxgaji();
            });
        $('#golru_baru').on('change', function(){
                ajaxgaji2();
            });
        $('#mk_tahun_baru').on('blur', function(){
                ajaxgaji2();
            });
});
   </script>
<?= $this->endSection() ?>

