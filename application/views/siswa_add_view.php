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
        <form action="<?php echo base_url();?>siswa/save" method="post">
            <div class="card-body">
            <div class="d-flex align-items-center">
                <p class="mb-0 text-uppercase">Informasi Siswa</p>
                <button type="submit" class="btn btn-primary btn-sm ms-auto">Simpan</button>
            </div>
            <div class="row">
                <div class="col-md-6">
                <div class="form-group">
                    <label for="example-text-input" class="form-control-label">NIS</label>
                    <input class="form-control" type="text" name="nis" required>
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
                    <label for="example-text-input" class="form-control-label">Email</label>
                    <input class="form-control" type="email" name="email" required>
                </div>
                </div>
                <div class="col-md-6">
                <div class="form-group">
                    <label for="example-text-input" class="form-control-label">Nomor Telepon</label>
                    <input class="form-control" type="text" name="phone" required>
                </div>
                </div>
                <div class="col-md-6">
                <div class="form-group">
                    <label for="example-text-input" class="form-control-label">Kelas</label>
                    <select class="form-control" name="class" required>
                        <option value="" disabled selected>Pilih Kelas</option>
                        <?php foreach($class as $data_class) { ?>
                            <option value="<?php echo $data_class->class_id;?>"><?php echo $data_class->class_name;?></option>
                        <?php } ?>
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