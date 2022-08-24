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
		<div class="card">
			<div class="card-header">
				<h3><i class="fa fa-globe text-orange"></i> About Site</h3>
			</div>
			<div class="card-body">
				<form action="<?php echo base_url();?>about/updateData" method="post" enctype='multipart/form-data'>
					<div class="row">
						<div class="col-md-6">
							<input type="hidden" name="id" value="<?php echo $app['app_id'];?>">
							<div class="form-group">
								<label>App Name</label>
								<input type="text" class="form-control" name="app_name" required="required" value="<?php echo $app['app_name'];?>">
							</div>
							<div class="form-group">
								<label>App Description</label>
								<input type="text" class="form-control" name="app_desc_short" required="required" value="<?php echo $app['app_description_short'];?>">
							</div>
							<div class="form-group">
								<label>Phone Number</label>
								<input type="text" class="form-control" name="phone_number" required="required" value="<?php echo $app['phone_number'];?>">
							</div>
							<div class="form-group">
								<label>Whatsapp Number</label>
								<input type="text" class="form-control" name="wa_number" required="required" value="<?php echo $app['whatsapp_number'];?>">
							</div>
							<div class="form-group">
								<label>Address</label>
								<input type="text" class="form-control" name="address" required="required" value="<?php echo $app['address'];?>">
							</div>
							<div class="form-group">
								<label>Support Email</label>
								<input type="text" class="form-control" name="email" required="required" value="<?php echo $app['support_email'];?>">
							</div>
							<div class="form-group">
								<label>Facebook URL</label>
								<input type="text" class="form-control" name="fb" required="required" value="<?php echo $app['facebook_url'];?>">
							</div>
							<div class="form-group">
								<label>Instagram URL</label>
								<input type="text" class="form-control" name="ig" required="required" value="<?php echo $app['instagram_url'];?>">
							</div>
							<div class="form-group">
								<label>Twitter URL</label>
								<input type="text" class="form-control" name="tw" required="required" value="<?php echo $app['twitter_url'];?>">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>About Us</label>
								<textarea class="ckeditor" id="ckedtor" rows="3" name="app_desc_full" required="required"><?php echo $app['app_description_full'];?></textarea>
							</div>
							<div class="form-group">
								<label>App Logo</label><br>
								<a class="fancybox" href="<?php base_url();?>../assets/images/<?php echo $app['app_logo'];?>">
									<img src="<?php base_url();?>../assets/images/<?php echo $app['app_logo'];?>" style="width:80px;height:80px;object-fit:cover;">
								</a>
								<br><br>
								<input type="file" name="app_logo" class="form-control">
							</div>
							<div class="form-group">
								<label>App Favicon</label><br>
								<a class="fancybox" href="<?php base_url();?>../assets/images/<?php echo $app['app_favicon'];?>">
									<img src="<?php base_url();?>../assets/images/<?php echo $app['app_favicon'];?>" style="width:80px;height:80px;object-fit:cover;">
								</a>
								<br><br>
								<input type="file" name="app_favicon" class="form-control">
							</div>
						</div>
					</div>
					
					
					<button type="submit" class="btn btn-primary" style="width:100%;">UPDATE</button>
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