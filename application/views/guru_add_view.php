<?php if($this->session->flashdata()) {?>
  <script>
    setTimeout(function() {
      swal({
        title : "<?php echo $this->session->flashdata('title');?>",
        text : "<?php echo $this->session->flashdata('message');?>",
        type: "<?php echo $this->session->flashdata('type');?>",
        timer: 2000,
        showConfirmButton: false
      });  
    },10);
  </script>
<?php } ?>
<div class="container-fluid py-4">
  <div class="row">
    <div class="col-md-8">
      <div class="card">
        <form action="<?php echo base_url();?>guru/save" method="post">
            <div class="card-body">
            <div class="d-flex align-items-center">
                <p class="mb-0 text-uppercase">Informasi Guru</p>
                <button type="submit" class="btn btn-primary btn-sm ms-auto">Simpan</button>
            </div>
            <div class="row">
                <div class="col-md-6">
                <div class="form-group">
                    <label for="example-text-input" class="form-control-label">NIP</label>
                    <input class="form-control" type="text" name="nip" required>
                </div>
                </div>
                <div class="col-md-6">
                <div class="form-group">
                    <label for="example-text-input" class="form-control-label">Nama</label>
                    <input class="form-control" type="text" name="name" required>
                </div>
                </div>
                <div class="col-md-6">
                <div class="form-group">
                    <label for="example-text-input" class="form-control-label">Jabatan</label>
                    <select class="form-control" name="jabatan" required>
                        <option value="" disabled selected>Pilih Jabatan</option>
                        <option value="Guru BK">Guru BK</option>
                        <option value="Kepala Sekolah">Kepala Sekolah</option>
                    </select>
                </div>
                </div>
                <div class="col-md-6">
                <div class="form-group">
                    <label for="example-text-input" class="form-control-label">Password</label><br>
                    <span>Password default : <span class="text-danger">password123</span></span>
                </div>
                </div>
            </div>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript" >
$(document).ready( function () {
    $(".fancybox").fancybox();
} );
</script>