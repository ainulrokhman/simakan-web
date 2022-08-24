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
				<h3><i class="fa fa-plus-circle text-primary"></i> Add Product</h3>
			</div>
			<div class="card-body">
				<form action="<?php echo base_url();?>saveproduct" method="post" enctype='multipart/form-data'>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Product Name</label>
								<input type="text" class="form-control" name="name" required="required" placeholder="Product Name">
							</div>
							<div class="form-group">
								<label>Thumbnails</label>
								<input type="file" class="form-control" name="thumbnails" required="required">
							</div>
							<div class="form-group">
								<label>Banner</label>
								<input type="file" class="form-control" name="banner" required="required">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Product Description</label>
								<textarea class="ckeditor" id="ckedtor" rows="3" name="desc" required="required"></textarea>
							</div>
						</div>
					</div>
					
					
					<button type="submit" class="btn btn-primary" style="width:100%;">SUBMIT</button>
				</form>
			</div>
		</div>
	</div>
</div>