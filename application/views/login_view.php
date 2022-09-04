<!DOCTYPE html>
<html>
<head>
	<title>Simakan - Login</title>
    <link rel="icon" href="<?php echo base_url('assets/images/logo.png');?>" type="image/png">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
    <link rel="stylesheet" href="<?php echo base_url('assets/lib/nucleo/css/nucleo.css')?>" type="text/css">
    <link rel="stylesheet" href="<?php echo base_url('assets/lib/fortawesome/css/all.min.css');?>" type="text/css">
    <link rel="stylesheet" href="<?php echo base_url('assets/lib/datatables/css/dataTables.bootstrap4.min.css');?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/lib/datatables/css/buttons.bootstrap4.min.css');?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/lib/datatables/css/select.bootstrap4.min.css');?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/argon.min.css');?>" type="text/css">
	<link rel="stylesheet" href="<?php echo base_url('assets/css/sweetalert2.min.css');?>" type="text/css">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
	
    <script src="<?php echo base_url('assets/js/jquery.min.js');?>"></script>
	<script src="<?php echo base_url('assets/js/sweetalert2.min.js');?>"></script>
</head>
<body>
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
	<div class="container" style="margin-top:50px;">
		<div class="row justify-content-center">
			<div class="col-lg-5 col-md-7">
				<div class="card bg-secondary shadow border-0">
					<div class="card-body px-lg-5 py-lg-5">
						<div class="text-center text-muted mb-4">
							<div style="text-align:center;margin-bottom:20px;">
								<img src="<?php echo base_url('assets/images/logo.png');?>" style="width:150px" />
							</div>
							<small>masukkan NIP and kata sandi Anda</small>
						</div>
						<form role="form" action="<?php echo base_url('checklogin'); ?>" method="post">
							<div class="form-group mb-3">
								<div class="input-group input-group-alternative">
									<div class="input-group-prepend">
										<span class="input-group-text"><i class="fa fa-user"></i></span>
									</div>
									<input class="form-control" placeholder="Nomor Induk Pegawai" type="text" name="nip" required="required">
								</div>
							</div>
							<div class="form-group">
								<div class="input-group input-group-alternative">
									<div class="input-group-prepend">
										<span class="input-group-text"><i class="fa fa-lock"></i></span>
									</div>
									<input class="form-control" placeholder="Kata Sandi" type="password" name="password" required="required">
								</div>
							</div>
							<div class="text-center">
								<button type="submit" class="btn btn-purple text-white bg-purple my-4" style="width:100%;">Masuk</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>