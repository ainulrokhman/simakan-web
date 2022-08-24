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
			<div class="col-md-12">
				<div class="card">
					<div class="card-header">
						<div style="float:left;">
							<h3><i class="fa fa-users text-primary"></i> User</h3>
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
										<th style="text-align:center;vertical-align:middle;">Action</th>
									</tr>
								</thead>
								<tbody>
									<?php
										$no=0;
										foreach($user as $data_user){ 
										$no++;
									?>
									<tr>
										<td style="text-align:center;vertical-align:middle;"><?php echo $no;?></td>
										<td><?php echo $data_user->user_fullname;?></td>
										<td style="text-align:center;vertical-align:middle;"><?php echo $data_user->user_email;?></td>
										<td style="text-align:center;vertical-align:middle;"><?php echo $data_user->user_phone_number;?></td>
										<td style="text-align:center;vertical-align:middle;">
											<a href="<?php echo base_url();?>resetpassword/<?php echo $data_user->user_id;?>" class="btn btn-warning btn-sm" onclick="return confirm('Are you sure reset password this user?');" title="reset password"><i class="fa fa-link"></i></a>
											<a href="<?php echo base_url();?>deleteuser/<?php echo $data_user->user_id;?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure delete this data?');" title="delete user"><i class="fa fa-trash"></i></a>
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
<script type="text/javascript" >
$(document).ready( function () {
    $('#example').DataTable();
    $(".fancybox").fancybox();
} );
</script>