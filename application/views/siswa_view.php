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
<div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
            <div class="row">
            <div class="col-6 d-flex align-items-center">
                <h6 class="mb-0">Data Siswa</h6>
            </div>
            <div class="col-6 text-end">
                <a href="<?php echo base_url();?>siswa/add" class="btn btn-outline-primary btn-sm mb-0"><i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;Tambah Siswa</a>
            </div>
          </div>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" style="text-align:center;vertical-align:middle">Nama Siswa</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2" style="text-align:center;vertical-align:middle">Kelas</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" style="text-align:center;vertical-align:middle">Status</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" style="text-align:center;vertical-align:middle">Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
					<?php
					foreach($siswa as $data_siswa) {
					?>
                  <tr>
                      <td>
                        <div class="d-flex px-2 py-1">
                          <div>
						  	<a href="<?php echo base_url();?>assets/images/siswa/<?php echo $data_siswa->siswa_images;?>" class="fancybox">
                            	<img src="<?php echo base_url();?>assets/images/siswa/<?php echo $data_siswa->siswa_images;?>" class="avatar avatar-sm me-3" alt="user1" style="width:50px;height:50px;">
							</a>
                          </div>
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm"><?php echo $data_siswa->siswa_name;?></h6>
                            <p class="text-xs text-secondary mb-0"><?php echo $data_siswa->siswa_email;?></p>
                          </div>
                        </div>
                      </td>
                      <td style="text-align:center;vertical-align:middle">
                        <p class="text-xs font-weight-bold mb-0"><?php echo $data_siswa->class_name;?></p>
                      </td>
                      <td class="align-middle text-center text-sm" style="text-align:center;vertical-align:middle">
						<?php if($data_siswa->is_active == 1) { ?>
                        <span class="badge badge-sm bg-gradient-success">Aktif</span>
						<?php } else { ?>
                        <span class="badge badge-sm bg-gradient-secondary">Tidak Aktif</span>
						<?php } ?>
                      </td>
                      <td class="align-middle" style="text-align:center;vertical-align:middle">
                        <a href="<?php echo base_url();?>siswa/detail/<?php echo $data_siswa->siswa_id;?>" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                          <i class='fa fa-search'></i>
                        </a>
                      </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script type="text/javascript" >
$(document).ready( function () {
    $('#example').DataTable();
    $(".fancybox").fancybox();
} );
</script>