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
        <div class="card shadow-lg mx-4 ">
            <div class="card-body p-3">
                <div class="row gx-4">
                <div class="col-auto">
                    <div class="avatar avatar-xl position-relative">
                        <a href="<?php echo base_url();?>assets/images/siswa/<?php echo $siswa['siswa_images'];?>" class="fancybox">
                            <img src="<?php echo base_url();?>assets/images/siswa/<?php echo $siswa['siswa_images'];?>" alt="profile_image" class="w-100 border-radius-lg shadow-sm">
                        </a>
                    </div>
                </div>
                <div class="col-auto my-auto">
                    <div class="h-100">
                    <h5 class="mb-1"> <?php echo $siswa['siswa_name'];?> </h5>
                    <p class="mb-0 font-weight-bold text-sm"> siswa/siswi Kelas <?php echo $siswa['class_name'];?> </p>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid py-4">
  <div class="row">
    <div class="col-md-8">
      <div class="card">
        <div class="card-body">
          <p class="text-uppercase text-sm">Informaasi Siswa</p>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="example-text-input" class="form-control-label">NIS</label>
                <input class="form-control" type="text" value="<?php echo $siswa['siswa_nis'];?>" name="nis" required readonly>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="example-text-input" class="form-control-label">Nama</label>
                <input class="form-control" type="text" value="<?php echo $siswa['siswa_name'];?>" name="name" required readonly>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="example-text-input" class="form-control-label">Email</label>
                <input class="form-control" type="email" value="<?php echo $siswa['siswa_email'];?>" name="email" required readonly>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="example-text-input" class="form-control-label">Nomor Telepon</label>
                <input class="form-control" type="text" value="<?php echo $siswa['siswa_phone_number'];?>" name="phone" required readonly>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript" >
$(document).ready( function () {
    $(".fancybox").fancybox();
} );
</script>