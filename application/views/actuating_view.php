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
<script src="<?php echo base_url();?>assets/js/highcharts.js"></script>
<script src="<?php echo base_url();?>assets/js/exporting.js"></script>
<script src="<?php echo base_url();?>assets/js/export-data.js"></script>
<script src="<?php echo base_url();?>assets/js/accessibility.js"></script>
<div class="row">
  <div class="col-12">
    <div class="card mb-4">
      <div class="card-header pb-0">
        <div class="row">
          <div class="col-6 d-flex align-items-center">
            <div>
              <h6 class="mb-0">Data Lembar RPL</h6>
              <p class="text-xs text-secondary mb-0">Menampilkan hasil dibawah 50 untuk tiap Angket</p>
            </div>
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
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" style="text-align:center;vertical-align:middle">Judul Angket</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2" style="text-align:center;vertical-align:middle">Nama Siswa</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2" style="text-align:center;vertical-align:middle">Total Pertanyaan</th>
                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" style="text-align:center;vertical-align:middle">Skor</th>
                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" style="text-align:center;vertical-align:middle">Aksi</th>
              </tr>
            </thead>
            <tbody>
				<?php  
				$no=0;
          foreach($angket as $data_angket){ 
          $no++;
          $question = $this->Base_model->getDataBy('questionner', array('angket_id' => $data_angket->angket_id));
          $answer = $this->db->select('*')->from('answer a')->join('questionner b', 'a.questionner_id = b.questionner_id', 'left')->where(array('a.angket_id' => $data_angket->angket_id, 'a.siswa_id' => $data_angket->siswa_id))->get()->result();
          $total_point = 0;
          foreach($answer as $data_answer) {
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
          }
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
                <td class="align-middle text-center text-sm">
                  <span class="text-secondary text-xs font-weight-bold"><?php echo $data_angket->siswa_name;?></span>
                </td>
                <td class="align-middle text-center">
                  <span class="text-secondary text-xs font-weight-bold"><?php echo $question->num_rows();?></span>
                </td>
                <td class="align-middle text-center">
                  <span class="text-secondary text-xs font-weight-bold"><b><?php echo $total_point / $question->num_rows();?></b></span>
                </td>
                <td class="align-middle" style="text-align:center;vertical-align:middle">
                      <?php if(($total_point / $question->num_rows()) > 5) { ?>
                        <a href="#" class="text-secondary">
                          <i class="fa fa-file-pdf"></i>
                        </a>
                      <?php }else{ ?>
                        <a href="#" class="text-danger">
                          <i class="fa fa-file-pdf"></i>
                        </a>
                      <?php } ?>
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