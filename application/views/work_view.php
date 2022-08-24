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
			<div class="col-md-4">
				<div class="card">
					<div class="card-header">
						<div style="float:left;">
							<h3><i class="fa fa-plus-circle text-primary"></i> Add Work</h3>
						</div>
						<div style="clear:both;"></div>
					</div>
					<div class="card-body">
					<form action="<?php echo base_url();?>savework" method="post" enctype='multipart/form-data'>
						<div class="form-group">
							<label>Name</label>
							<input type="text" class="form-control" name="name" required="required" placeholder="Name">
						</div>
						<div class="form-group">
							<label>Description</label>
							<textarea class="form-control" rows="3" name="desc" required="required" placeholder="Description"></textarea>
						</div>
						<button type="submit" class="btn btn-primary" style="width:100%;">SUBMIT</button>
					</div>
				</div>
			</div>
			<div class="col-md-8">
				<div class="card">
					<div class="card-header">
						<div style="float:left;">
							<h3><i class="fa fa-suitcase text-primary"></i> Data Work</h3>
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
										<th style="text-align:center;vertical-align:middle;">Description</th>
										<th style="text-align:center;vertical-align:middle;">Action</th>
									</tr>
								</thead>
								<tbody>
									<?php
										$no=0;
										foreach($work as $data_work){ 
										$no++;
									?>
									<tr>
										<td style="text-align:center;vertical-align:middle;"><?php echo $no;?></td>
										</td>
										<td style="text-align:left;vertical-align:middle;"><?php echo $data_work->job_name;?></td>
										<td style="text-align:left;vertical-align:middle;"><?php if(strlen($data_work->job_description) > 50){ echo substr($data_work->job_description, 0, 50)."...";}else{echo $data_work->job_description;}?></td>
										<td style="text-align:center;vertical-align:middle;">
											<a href="<?php echo base_url();?>editwork/<?php echo $data_work->job_id;?>" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>
											<a href="<?php echo base_url();?>deletework/<?php echo $data_work->job_id;?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure delete this data?');"><i class="fa fa-trash"></i></a>
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