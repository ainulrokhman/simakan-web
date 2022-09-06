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
                        <a href="<?php echo base_url();?>assets/images/default.png" class="fancybox">
                            <img src="<?php echo base_url();?>assets/images/default.png" alt="profile_image" class="w-100 border-radius-lg shadow-sm">
                        </a>
                    </div>
                </div>
                <div class="col-auto my-auto">
                    <div class="h-100">
                    <h5 class="mb-1"> <?php echo $admin['admin_name'];?> </h5>
                    <p class="mb-0 font-weight-bold text-sm"><?php echo $admin['admin_role'];?> </p>
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
        <form action="<?php echo base_url();?>profile/update" method="post">
          <div class="card-body">
            <div class="d-flex align-items-center">
                <p class="mb-0 text-uppercase">Informasi Profil</p>
                <button type="submit" class="btn btn-primary btn-sm ms-auto">Update</button>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="example-text-input" class="form-control-label">NIP</label>
                  <input class="form-control" type="text" value="<?php echo $admin['admin_nip'];?>" name="nip" required readonly>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="example-text-input" class="form-control-label">Nama</label>
                  <input class="form-control" type="text" value="<?php echo $admin['admin_name'];?>" name="name" required>
                </div>
              </div>
              <!-- <div class="col-md-6">
                <div class="form-group">
                  <label for="example-text-input" class="form-control-label">Jabatan</label>
                  <select class="form-control" name="jabatan" required>
                        <option value="Guru BK" <?php if($admin['admin_role'] == "Guru BK") { echo "selected"; } else { echo"";}?>} >Guru BK</option>
                        <option value="Kepala Sekolah" <?php if($admin['admin_role'] == "Kepala Sekolah") { echo "selected"; } else { echo"";}?>>Kepala Sekolah</option>
                        <option value="Super Admin"> <?php if($admin['admin_role'] == "Super Admin") { echo "selected"; } else { echo"";}?>Super Admin</option>
                    </select>
                </div>
              </div> -->
              <div class="col-md-6">
                <div class="form-group">
                  <label for="example-text-input" class="form-control-label">Jabatan</label>
                  <input class="form-control" type="text" value="<?php echo $admin['admin_role'];?>" name="role" required readonly>
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