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
  <div class="col-md-8">
    <div class="card">
      <form action="<?php echo base_url();?>planing/update" method="post">
        <input type="hidden" name="id" value="<?php echo $angket['angket_id'];?>">
        <div class="card-header pb-0">
          <div class="d-flex align-items-center">
            <p class="mb-0">Detail Pengerjaan</p>
          </div>
        </div>
        <div class="card-body">
          <p class="text-uppercase text-sm"><?php echo $angket['angket_title'];?></p>
          <div class="row">
            <table class="table align-items-center mb-0">
              <thead>
                <tr>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" style="text-align:center;vertical-align:middle">No</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" style="text-align:center;vertical-align:middle">Nama Responden</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" style="text-align:center;vertical-align:middle">Status</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" style="text-align:center;vertical-align:middle">Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $no = 0;
                foreach($responden as $data_responden) {
                  $no++;
                ?>
                <tr>
                  <td style="text-align:center;vertical-align:middle">
                    <span class="text-secondary text-xs font-weight-bold"><?php echo $no;?>.</span>
                  </td>
                  <td style="text-align:left;vertical-align:middle">
                    <span class="text-secondary text-xs font-weight-bold"><?php echo $data_responden->siswa_name;?></span>
                  </td>
                  <td style="text-align:center;vertical-align:middle">
                    <span class="text-secondary text-xs font-weight-bold">
                      <?php if($data_responden->is_doing == 0) { ?>
                        <span class="badge badge-sm bg-gradient-secondary">Belum Mengerjakan</span>
                      <?php }else if($data_responden->is_doing == 1){?>
                          <span class="badge badge-sm bg-gradient-primary">Sedang Mengerjakan</span>
                      <?php }else{ ?>
                        <span class="badge badge-sm bg-gradient-success">Sudah Mengerjakan</span>
                      <?php } ?>
                    </span>
                  </td>
                  <td class="align-middle" style="text-align:center;vertical-align:middle">
                    <?php if($data_responden->is_doing == 2) { ?>
                    <a href="<?php echo base_url();?>organizing/result/<?php echo $data_responden->angket_id."-".$data_responden->siswa_id;?>" class="font-weight-bold text-sm">
                      <i class="fa fa-search"></i>
                    </a>
                    <?php }else{ ?>
                      <i class="fa fa-search" style="color:#CCC;"></i>
                    <?php } ?>
                  </td>
                </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
      </form>
    </div>
  </div>