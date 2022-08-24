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
		<div class="row">
			<?php if($this->session->userdata('admin_role') == 'Super Admin'){?>
			<div class="col-md-4">
				<div class="card">
					<div class="card-header">
						<div style="float:left;">
							<h3><i class="fa fa-plus-circle text-primary"></i> Add Admin</h3>
						</div>
						<div style="clear:both;"></div>
					</div>
					<div class="card-body">
					<form action="<?php echo base_url();?>saveadmin" method="post" enctype='multipart/form-data'>
						<div class="form-group">
							<label>Name</label>
							<input type="text" class="form-control" name="name" required="required" placeholder="Name">
						</div>
						<div class="form-group">
							<label>Email</label>
							<input type="email" class="form-control" name="email" required="required" placeholder="Email">
						</div>
						<div class="form-group">
							<label>Phone</label>
							<input type="text" class="form-control" name="phone" required="required" placeholder="Phone">
						</div>
						<i class="text-red text-sm">*default password password123</i>
						<br><br>
						<button type="submit" class="btn btn-primary" style="width:100%;">SUBMIT</button>
					</div>
				</div>
			</div>
			<div class="col-md-8">
			<?php }else{ ?>
			<div class="col-md-12">
			<?php } ?>
				<div class="card">
					<div class="card-header">
						<div style="float:left;">
							<h3><i class="fa fa-user-circle text-primary"></i> Administrator</h3>
						</div>
						<div style="clear:both;"></div>
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table class="table table-bordered" id="datatable-basic">
								<thead>
									<tr>
										<th style="text-align:center;vertical-align:middle;">No</th>
										<th style="text-align:center;vertical-align:middle;">Name</th>
										<th style="text-align:center;vertical-align:middle;">Email</th>
										<th style="text-align:center;vertical-align:middle;">Phone Number</th>
										<th style="text-align:center;vertical-align:middle;">Role</th>
										<th style="text-align:center;vertical-align:middle;">Action</th>
									</tr>
								</thead>
								<tbody>
									<?php
										$no=0;
										foreach($list_admin as $data_admin){ 
										$no++;
									?>
									<tr>
										<td style="text-align:center;vertical-align:middle;"><?php echo $no;?></td>
										<td><?php echo $data_admin->admin_fullname;?></td>
										<td style="text-align:center;vertical-align:middle;"><?php echo $data_admin->admin_email;?></td>
										<td style="text-align:center;vertical-align:middle;"><?php echo $data_admin->admin_phone_number;?></td>
										<td style="text-align:center;vertical-align:middle;"><?php echo $data_admin->admin_role;?></td>
										<td style="text-align:center;vertical-align:middle;">
										<?php if($this->session->userdata('admin_role') == 'Super Admin'){?>
											<a href="<?php echo base_url();?>resetpassword/<?php echo $data_admin->admin_id;?>" class="btn btn-warning btn-sm" onclick="return confirm('Are you sure reset password this user?');" title="reset password"><i class="fa fa-link"></i></a>
											<a href="<?php echo base_url();?>deleteadmin/<?php echo $data_admin->admin_id;?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure delete this data?');" title="delete admin"><i class="fa fa-trash"></i></a>
										<?php }else{ ?>
											<button class="btn btn-warning btn-sm" disabled title="reset password"><i class="fa fa-link"></i></button>
											<button class="btn btn-danger btn-sm" disabled title="delete admin"><i class="fa fa-trash"></i></button>
										<?php } ?>
										</td>
									</tr>	
									<?php } ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>