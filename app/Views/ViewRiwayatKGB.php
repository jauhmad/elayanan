<?php
  helper('form');
?>
<?= $this->extend('tataletak/admin/tataletak_admin-tabler') ?>

<?= $this->section('css') ?>
   <!--  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"> -->
<?= $this->endSection() ?>

<?= $this->section('konten') ?>
<?php 
foreach ($biodata as $key) { 
      $nama=$key['nama'];
      $nip=$key['nip'];
      $jabatan=$key['jabatan'];
      $instansi=$key['instansi_kode'];
?>

  <div class="col-md-12">
                <div class="card">
                  <div class="card-body">
                    <div class="row g-2 align-items-center">
                      <div class="col-auto">
                        <span class="avatar avatar-lg" style="background-image: url(<?= base_url('tabler-theme/static/avatars/000m.jpg') ?>"></span>
                      </div>
                      <div class="col">
                        <h4 class="card-title m-0">
                          <a href="#"><?= $nama ?></a>
                        </h4>
                        <div class="text-muted">
                          <?= $nip ?>
                        </div>
                        <div class="small mt-1">
                          <?= $jabatan ?>
                        </div>
                      </div>
                      <!-- <div class="col-auto">
                        <a href="#" class="btn">
                          Subscribe
                        </a>
                      </div> -->
                   
                    </div>
                  </div>
                </div>
              </div>
<?php } ?>    
<br>
<?php 
// Display Response
if(session()->has('message')){
?>

<div class="alert alert-important <?= session()->getFlashdata('alert-class') ?> alert-dismissible" role="alert">
  <div class="d-flex">
    <div>
      <!-- Download SVG icon from http://tabler-icons.io/i/check -->
      <!-- SVG icon code with class="alert-icon" -->
    </div>
    <div>
      <?= session()->getFlashdata('message') ?>
    </div>
  </div>
  <a class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="close"></a>
</div>

<?php
session()->setFlashdata('message');
session()->setFlashdata('alert-class');
}
?>                
<div class="col-12">
  <div class="card">
     <div class="card-header">
        <h3 class="card-title"><?= $page_title2 ?></h3>
         <div class="col-auto ms-auto d-print-none">
                <div class="btn-list">
                  <span class="d-none d-sm-inline">
                    <a href="javascript:window.history.go(-1);" class="btn btn-white">
                        <!-- Download SVG icon from http://tabler-icons.io/i/arrow-back -->
    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 11l-4 4l4 4m-4 -4h11a4 4 0 0 0 0 -8h-1" /></svg>
                      Kembali
                    </a>
                  </span>
                  <?php
                    if(session()->get("level")!='pegawai'){
                  ?>
                  <a href="<?= base_url('/admin/riwayatkgb/'.$ide.'/tambah') ?>" class="btn btn-primary d-none d-sm-inline-block">
                    <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="12" y1="5" x2="12" y2="19" /><line x1="5" y1="12" x2="19" y2="12" /></svg>
                    Tambah Data
                  </a>
                  <?php
                    }
                  ?>
                </div>
              </div>
     </div>

    <div class="card-body border-bottom py-3">
        <div class="d-flex">
            <!-- <a href="#" class="btn btn-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="12" y1="5" x2="12" y2="19" /><line x1="5" y1="12" x2="19" y2="12" /></svg>
                    Tambah Data
            </a>     -->
        </div>
    </div>

    <div class="table-responsive">
        
       <table class="table card-table table-vcenter text-nowrap datatable">
        <thead>
            <tr>
              <th>Surat Pemberitahuan KGB No Tanggal</th>
              <th>Gaji Pokok Lama</th>
              <th>Gaji Pokok Baru</th>
              <th>Berdasar Masa Kerja</th>
              <th>TMT</th>
              <th>KGB Berikutnya</th>
              <th>Status Usulan</th>
              <th></th>
            </tr>
        </thead>
        <tbody> 
            <?= $list_rwy ?>
        </tbody>
       </table>
    </div>
  </div>
</div>

        

   

    <div class="modal modal-blur fade" id="confirm-dialog-hapus" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
        <div class="modal-content">
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          <div class="modal-status bg-danger"></div>
          <div class="modal-body text-center py-4">
            <!-- Download SVG icon from http://tabler-icons.io/i/alert-triangle -->
            <svg xmlns="http://www.w3.org/2000/svg" class="icon mb-2 text-danger icon-lg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 9v2m0 4v.01" /><path d="M5 19h14a2 2 0 0 0 1.84 -2.75l-7.1 -12.25a2 2 0 0 0 -3.5 0l-7.1 12.25a2 2 0 0 0 1.75 2.75" /></svg>
            <h3>Anda yakin hapus?</h3>
            <div class="text-muted">Data akan dihapus dan hilang selamanya...</div>
          </div>
          <div class="modal-footer">
            <div class="w-100">
              <div class="row">
                <div class="col"><a href="#" class="btn btn-white w-100" data-bs-dismiss="modal">
                    Batal
                  </a></div>
                <div class="col"><a href="#" class="btn btn-danger w-100" id="delete-button">
                    Yakin
                  </a></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

     <div class="modal modal-blur fade" id="confirm-dialog-approve" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
        <div class="modal-content">
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          <div class="modal-status bg-info"></div>
          <div class="modal-body text-center py-4">
           <!-- Download SVG icon from http://tabler-icons.io/i/file-check -->
  <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M14 3v4a1 1 0 0 0 1 1h4" /><path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" /><path d="M9 15l2 2l4 -4" /></svg>
            <h3>Anda yakin approve?</h3>
            
          </div>
          <div class="modal-footer">
            <div class="w-100">
              <div class="row">
                <div class="col"><a href="#" class="btn btn-white w-100" data-bs-dismiss="modal">
                    Batal
                  </a></div>
                <div class="col"><a href="#" class="btn btn-info w-100" id="approve-button">
                    Yakin
                  </a></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
<?= $this->endSection() ?>

<?= $this->section('js') ?>
<script>
    function confirm_del(el){
        $("#confirm-dialog-hapus").modal('show');
        $("#delete-button").attr("href", el.dataset.href); 
    }

     function confirm_approve(el){
        $("#confirm-dialog-approve").modal('show');
        $("#approve-button").attr("href", el.dataset.href); 
    }
</script>

    <script type="text/javascript">
      function ajaxgaji() {
                var csrfHash = $("input[name=csrf_token_elayanan]").val();
                var mkg = $('#mk_spangkat_tahun').val();
                var gol = $('#golru').val();
                if(mkg){
                    $.ajax({
                        type:'POST',
                        url:'<?= base_url('ajax_gaji') ?>',
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
                        url:'<?= base_url('ajax_gaji') ?>',
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

