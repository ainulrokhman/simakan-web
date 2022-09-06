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
            <h6 class="mb-0">Data Angket</h6>
          </div>
          <div class="col-6 text-end">
            <a href="<?php echo base_url();?>planing/add" class="btn btn-outline-primary btn-sm mb-0">
              <i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;Tambah Angket </a>
          </div>
        </div>
      </div>
      <br>
      <div class="card-body px-0 pt-0 pb-2">
        <div class="table-responsive p-0">
          <table class="table align-items-center mb-0" id="datatable-basic">
            <thead>
              <tr>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" style="text-align:center;vertical-align:middle">No</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" style="text-align:center;vertical-align:middle">Judul</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2" style="text-align:center;vertical-align:middle">Jumlah Pertanyaan</th>
                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" style="text-align:center;vertical-align:middle">Status</th>
                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" style="text-align:center;vertical-align:middle">Tanggal Mengerjakan</th>
                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" style="text-align:center;vertical-align:middle">Aksi</th>
              </tr>
            </thead>
            <tbody>
				<?php  
				$no=0;
				foreach($angket as $data_angket){ 
				$no++;
				?>
              <tr>
                <td style="text-align:center;vertical-align:middle">
                  <span class="text-secondary text-xs font-weight-bold"><?php echo $no;?>.</span>
                </td>
                <td>
                  <div class="d-flex px-2 py-1">
                    <div class="d-flex flex-column justify-content-center">
                      <h6 class="mb-0 text-sm"><?php echo $data_angket->angket_title;?></h6>
                      <p class="text-xs text-secondary mb-0"><?php echo $data_angket->angket_description;?></p>
                    </div>
                  </div>
                </td>
                <td style="text-align:center;vertical-align:middle">
                  <span class="text-secondary text-xs font-weight-bold">
					<?php
						$total = $this->Base_model->getDataBy('questionner', array('angket_id' => $data_angket->angket_id));
						echo $total->num_rows();
					?>
				  </span>
                </td>
                <td class="align-middle text-center text-sm">
					<?php if($data_angket->is_active == 1) { ?>
                  	<span class="badge badge-sm bg-gradient-success">Aktif</span>
					<?php }else{?>
                  	<span class="badge badge-sm bg-gradient-secondary">Tidak Aktif</span>
					<?php } ?>
                </td>
                <td class="align-middle text-center">
                  <span class="text-secondary text-xs font-weight-bold"><?php echo date('d M Y', strtotime($data_angket->angket_start_date));?></span>
                </td>
                <td class="align-middle" style="text-align:center;vertical-align:middle">
                  <a href="<?php echo base_url();?>planing/detail/<?php echo $data_angket->angket_id;?>" class="text-secondary font-weight-bold text-sm">
                    <i class="fa fa-edit"></i>
                  </a> &nbsp;&nbsp;&nbsp; <a href="<?php echo base_url();?>planing/delete/<?php echo $data_angket->angket_id;?>" class="text-danger font-weight-bold text-sm" onclick="return confirm('Are you sure delete this data?');">
                    <i class="fa fa-trash"></i>
                  </a>
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