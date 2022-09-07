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
              <div>
                <h6 class="mb-0">Data Kategori</h6>
              </div>
            </div>
            <div class="col-6 text-end">
                <a href="<?php echo base_url();?>category/add" class="btn btn-outline-primary btn-sm mb-0"><i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;Tambah Kategori</a>
            </div>
          </div>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" style="text-align:center;vertical-align:middle">No</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2" style="text-align:center;vertical-align:middle">Nama Kategori</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" style="text-align:center;vertical-align:middle">Deskripsi</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" style="text-align:center;vertical-align:middle">Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
					<?php
          $no = 0;
					foreach($category as $data_category) {
            $no++;
					?>
                  <tr>
                  <td style="text-align:center;vertical-align:middle">
                        <p class="text-xs font-weight-bold mb-0"><?php echo $no;?></p>
                      </td>
                    <td style="text-align:left;vertical-align:middle">
                      <p class="text-xs font-weight-bold mb-0"><?php echo $data_category->category_name;?></p>
                      </td>
                      <td style="text-align:left;vertical-align:middle">
                        <p class="text-xs font-weight-bold mb-0"><?php echo $data_category->category_description;?></p>
                      </td>
                      <td class="align-middle" style="text-align:center;vertical-align:middle">
						            <a href="<?php echo base_url();?>category/delete/<?php echo $data_category->category_id;?>" class="text-danger font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Hapus Evaluasi" onclick="return confirm('Are you sure delete this data?');">
                          <i class='fa fa-trash'></i>
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