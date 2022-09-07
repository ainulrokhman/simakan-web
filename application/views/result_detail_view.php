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
            <p class="mb-0">Hasil Pengerjaan</p>
          </div>
        </div>
        <div class="card-body">
          <div class="row">
            <table class="table align-items-center mb-0">
              <thead>
                <tr>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" style="text-align:center;vertical-align:middle">No</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" style="text-align:center;vertical-align:middle">Pertanyaan</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" style="text-align:center;vertical-align:middle">Jawaban</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" style="text-align:center;vertical-align:middle">Status</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $no = 0;
                $benar = 0;
                $salah = 0;
                foreach($answer as $data_answer) {
                  $no++;
                  if($data_answer->answer_value == $data_answer->true_answer) {
                    $benar++;
                  } else {
                    $salah++;
                  }
                ?>
                <tr>
                  <td style="text-align:center;vertical-align:middle">
                    <span class="text-secondary text-xs font-weight-bold"><?php echo $no;?>.</span>
                  </td>
                  <td style="text-align:left;vertical-align:middle">
                    <span class="text-secondary text-xs font-weight-bold"><?php echo $data_answer->questionner_title;?></span>
                  </td>
                  <td style="text-align:center;vertical-align:middle">
                    <span class="text-secondary text-xs font-weight-bold"><?php echo $data_answer->answer_value;?></span>
                  </td>
                  <td style="text-align:center;vertical-align:middle;">
                    <span class="text-secondary text-xs font-weight-bold">
                      <?php if($data_answer->answer_value == $data_answer->true_answer) { ?>
                        <span class="badge badge-sm bg-gradient-success">Benar</span>
                      <?php }else{ ?>
                        <span class="badge badge-sm bg-gradient-danger">Salah</span>
                      <?php } ?>
                    </span>
                  </td>
                </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
          <br><br>
          <p class="mb-0 text-secondary text-xxs font-weight-bolder opacity-7">Total Soal : <?php echo $total_soal;?></p>
          <p class="mb-0 text-secondary text-xxs font-weight-bolder opacity-7">Total Benar : <?php echo $benar;?></p>
          <p class="mb-0 text-secondary text-xxs font-weight-bolder opacity-7">Total Salah : <?php echo $salah;?></p>
          <p class="mb-0"><b>Skor : <?php echo $benar / $total_soal * 100;?></p>
        </div>
      </form>
    </div>
  </div>