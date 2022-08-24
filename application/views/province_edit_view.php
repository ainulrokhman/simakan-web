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
							<h3><i class="fa fa-edit text-primary"></i> Edit Province</h3>
						</div>
						<div style="clear:both;"></div>
					</div>
					<div class="card-body">
					<form action="<?php echo base_url();?>updateprovince" method="post" enctype='multipart/form-data'>
						<input type="hidden" name="id" required="required" value="<?php echo $province['province_id'];?>">
						<div class="form-group">
							<label>Name</label>
							<input type="text" class="form-control" name="name" required="required" placeholder="Name" value="<?php echo $province['province_name'];?>">
						</div>
						<button type="submit" class="btn btn-primary" style="width:100%;">UPDATE</button>
					</div>
				</div>
			</div>
			<div class="col-md-8">
				<div class="card">
					<div class="card-header">
						<div style="float:left;">
							<h3><i class="fa fa-database text-primary"></i> Data Province</h3>
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
										foreach($list_province as $data_province){ 
										$no++;
									?>
									<tr>
										<td style="text-align:center;vertical-align:middle;"><?php echo $no;?></td>
										</td>
										<td style="text-align:left;vertical-align:middle;"><?php echo $data_province->province_name;?></td>
										<td style="text-align:center;vertical-align:middle;">
											<a href="<?php echo base_url();?>location/editprovince/<?php echo $data_province->province_id;?>" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>
											<a href="<?php echo base_url();?>location/deleteprovince/<?php echo $data_province->province_id;?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure delete this data?');"><i class="fa fa-trash"></i></a>
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