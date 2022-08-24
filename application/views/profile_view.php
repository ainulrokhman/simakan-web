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
                  <h3 class="mb-0"><i class="fa fa-user text-red"></i> Edit profile </h3>
                </div>
              </div>
            </div>
            <div class="card-body">
              <form action="<?php echo base_url();?>updateprofile" method="post">
                <h6 class="heading-small text-muted mb-4">User information</h6>
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-username">Full Name</label>
                        <input type="text" id="input-username" name="name" class="form-control" placeholder="Full Name" value="<?php echo $user['user_fullname'];?>" required="required">
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-email">Email address</label>
                        <input type="email" id="input-email" name="email" disabled class="form-control" placeholder="test@example.com"  value="<?php echo $user['user_email'];?>" required="required">
                      </div>
                    </div>
                  </div>
                </div>
                <hr class="my-4" />
                <h6 class="heading-small text-muted mb-4">Contact information</h6>
                  <div class="pl-lg-4">
                    <div class="row">
                      <div class="col-lg-12">
                        <div class="form-group">
                          <label class="form-control-label" for="input-city">Phone Number</label>
                          <input type="text" id="input-city" name="phone" class="form-control" placeholder="ex: 08xxxxxxxx" value="<?php echo $user['user_phone_number'];?>" required="required">
                        </div>
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