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
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" style="text-align:center;vertical-align:middle">Score</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $no = 0;
                $total_point = 0;
                foreach($answer as $data_answer) {
                  $no++;
                  $check_score = $this->Base_model->getDataBy("questionner", array('angket_id' => $data_answer->angket_id, 'questionner_id' => $data_answer->questionner_id));
                  if($data_answer->answer_value == "A") {
                    $point = (int) $check_score->row()->score_a;
                  } else if($data_answer->answer_value == "B") {
                      $point = (int) $check_score->row()->score_b;
                  } else if($data_answer->answer_value == "C") {
                      $point = (int) $check_score->row()->score_c;
                  } else if($data_answer->answer_value == "D") {
                      $point = (int) $check_score->row()->score_d;
                  } else if($data_answer->answer_value == "E") {
                      $point = (int) $check_score->row()->score_e;
                  } else {
                      $point = 0;
                  }

                  $total_point = $total_point + $point;
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
                      <?php if($point == 10) { ?>
                        <span class="badge badge-sm bg-gradient-success"><?php echo $point;?></span>
                      <?php }else if($point < 10 && $point > 5) { ?>
                        <span class="badge badge-sm bg-gradient-secondary"><?php echo $point;?></span>
                      <?php }else{ ?>
                        <span class="badge badge-sm bg-gradient-danger"><?php echo $point;?></span>
                      <?php } ?>
                    </span>
                  </td>
                </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
          <br><br>
          <p class="mb-0">Skor Pengerjaan</p><br>
          <table class="table align-items-center mb-0">
              <thead>
                <tr>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" style="text-align:center;vertical-align:middle">Total Soal</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" style="text-align:center;vertical-align:middle">Skor</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" style="text-align:center;vertical-align:middle">RPL</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td style="text-align:center;vertical-align:middle">
                    <span class="text-secondary text-xs font-weight-bold"><?php echo $total_soal;?></span>
                  </td>
                  <td style="text-align:center;vertical-align:middle">
                    <b><?php echo $total_point / $total_soal;?></b>
                  </td>
                  <td style="text-align:center;vertical-align:middle">
                      <?php if(($total_point / $total_soal) > 5) { ?>
                        <a href="#" class="text-secondary">
                          <i class="fa fa-file-pdf"></i>
                        </a>
                      <?php }else{ ?>
                        <a href="<?php echo base_url();?>rpl" class="text-danger">
                          <i class="fa fa-file-pdf"></i>
                        </a>
                      <?php } ?>
                  </td>
                </tr>
              </tbody>
          </table>
        </div>
      </form>
    </div>
  </div>