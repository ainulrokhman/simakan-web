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
				<h3><i class="fa fa-edit text-primary"></i> Edit Promo</h3>
			</div>
			<div class="card-body">
				<form action="<?php echo base_url();?>updatepromo" method="post" enctype='multipart/form-data'>
					<input type="hidden" name="id" value="<?php echo $promo['promo_id'];?>">
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label>Title</label>
								<input type="text" class="form-control" name="name" required="required" placeholder="Title" value="<?php echo $promo['promo_title'];?>">
							</div>
							<div class="form-group">
								<label>Description</label>
								<textarea class="ckeditor" id="ckedtor" rows="3" name="desc" required="required"><?php echo $promo['promo_description'];?></textarea>
							</div>
							<div class="form-group">
								<label>Iimages</label><br>
								<div>
									<a href="data:image/jpeg;base64,<?php echo base64_encode($promo['promo_images']);?>" class="fancybox">
										<img src="data:image/jpeg;base64,<?php echo base64_encode($promo['promo_images']);?>" style="width:50px;height:50px;object-fit:cover;">
									</a>
								</div>
								<br>
								<input type="file" class="form-control" name="images">
								<small><i class="text-grey">*ignore if not replaced images</i></small>
							</div>
						</div>
						<div class="col-md-6">
							
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