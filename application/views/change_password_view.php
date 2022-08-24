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
<div class="header pb-12">
	<div class="container-fluid">
	<div class="col-xl-8 order-xl-1">
          <div class="card">
            <div class="card-header">
              <div class="row align-items-center">
                <div class="col-8">
                  <h3 class="mb-0"><i class="fa fa-lock text-red"></i> Change Password </h3>
                </div>
              </div>
            </div>
            <div class="card-body">
              <form action="<?php echo base_url();?>updatepassword" method="post">
                <h6 class="heading-small text-muted mb-4">User credential</h6>
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-lg-12">
                      <div class="form-group">
                        <label class="form-control-label" for="input-username">Old Password</label>
                        <input type="password" id="input-username" class="form-control" placeholder="Old Password" name="old" required="required">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label">New Password</label>
                        <input type="password" class="form-control" placeholder="New Password" name="new" required="required">
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label">Confirmation Password</label>
                        <input type="password" class="form-control" placeholder="Confirmation Password" name="confirm" required="required">
                      </div>
                    </div>
                  </div>
                </div>
                <hr class="my-4" />
			        	<button type="submit" class="btn btn-primary" style="width:100%;">Update</button>
              </form>
            </div>
          </div>
        </div>
      </div>
	</div>
</div>