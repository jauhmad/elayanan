<?= $this->extend('tataletak/admin/tataletak_admin-tabler') ?>

<?= $this->section('css') ?>
   <!--  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"> -->
<?= $this->endSection() ?>

<?= $this->section('konten') ?>
<div class="col-12">
  <div class="card">
    <div class="table-responsive">
       <table class="table" id="users-list">
        <thead>
            <tr><th>NIP</th><th>Nama</th><th>Golru</th><th>Jabatan</th><th>Masa Kerja</th><th>Masa Kerja KGB</th><th>TMT KGB</th><th>TMT KGB Berikutnya</th><th></th></tr>
        </thead>
        <tbody> 
            <?= $list_peg ?>
        </tbody>
       </table>
    </div>
  </div>
</div>   
<?= $this->endSection() ?>

<?= $this->section('js') ?>
   <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
   <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready( function () {
          $('#users-list').DataTable();
      } );
    </script>
<?= $this->endSection() ?>

