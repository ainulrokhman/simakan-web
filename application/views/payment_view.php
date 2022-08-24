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
				<div style="float:left;">
					<h3><i class="fa fa-credit-card text-primary"></i> Payment Channel</h3>
				</div>
				<div style="float:right;">
					<a href="<?php echo base_url();?>addpayment" class="btn btn-primary btn-sm"><i class="fa fa-plus-circle"></i> Add Payment</a>
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
								<th style="text-align:center;vertical-align:middle;">Images</th>
								<th style="text-align:center;vertical-align:middle;">Status</th>
								<th style="text-align:center;vertical-align:middle;">Action</th>
							</tr>
						</thead>
						<tbody>
							<?php
								$no=0;
								foreach($payment as $data_payment){ 
								$no++;
							?>
							<tr>
								<td style="text-align:center;vertical-align:middle;"><?php echo $no;?></td>
								<td style="text-align:left;vertical-align:middle;"><?php if(strlen($data_payment->payment_name) > 50){ echo substr($data_payment->payment_name, 0, 50)."...";}else{echo $data_payment->payment_name;}?></td>
								<td style="text-align:left;vertical-align:middle;"><?php if(strlen($data_payment->payment_instruction) > 50){ echo substr($data_payment->payment_instruction, 0, 50)."...";}else{echo $data_payment->payment_instruction;}?></td>
								<td style="text-align:center;vertical-align:middle;">
									<a href="data:image/jpeg;base64,<?php echo base64_encode($data_payment->payment_logo);?>" class="fancybox btn btn-primary btn-sm">
										<i class="fa fa-image"></i>
									</a>
								</td>
								<td style="text-align:center;vertical-align:middle;">
									<?php if($data_payment->is_active == 1){?>
										<a href="<?php echo base_url();?>paymentstatus/<?php echo $data_payment->payment_id;?>" class="btn btn-success btn-sm" title="active" onclick="return confirm('Are you sure non active this data?');"><i class="fa fa-thumbs-up"></i></a>
									<?php }else{ ?>
										<a href="<?php echo base_url();?>paymentstatus/<?php echo $data_payment->payment_id;?>" class="btn btn-danger btn-sm" title="non active"><i class="fa fa-thumbs-down"></i></a>
									<?php } ?>
								</td>
								<td style="text-align:center;vertical-align:middle;">
									<a href="<?php echo base_url();?>editpayment/<?php echo $data_payment->payment_id;?>" class="btn btn-primary btn-sm" title="Edit Data"><i class="fa fa-edit"></i></a>
									<a href="<?php echo base_url();?>deletepayment/<?php echo $data_payment->payment_id;?>" class="btn btn-danger btn-sm" title="Delete Data" onclick="return confirm('Are you sure delete this data?');"><i class="fa fa-trash"></i></a>
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
<script type="text/javascript" >
$(document).ready( function () {
    $('#example').DataTable();
    $(".fancybox").fancybox();
} );
</script>