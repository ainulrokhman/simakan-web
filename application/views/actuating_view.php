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
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2" style="text-align:center;vertical-align:middle">Jumlah Benar</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2" style="text-align:center;vertical-align:middle">Jumlah Salah</th>
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
          $benar = 0;
          $salah = 0;
          foreach($answer as $data_answer) {
            if($data_answer->answer_value == $data_answer->true_answer) {
              $benar++;
            } else {
              $salah++;
            }
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
                  <span class="text-secondary text-xs font-weight-bold"><?php echo $benar;?></span>
                </td>
                <td class="align-middle text-center">
                  <span class="text-secondary text-xs font-weight-bold"><?php echo $salah;?></span>
                </td>
                <td class="align-middle text-center">
                  <span class="text-secondary text-xs font-weight-bold"><b><?php echo $benar / $question->num_rows() * 100;?></b></span>
                </td>
                <td class="align-middle" style="text-align:center;vertical-align:middle">
                      <?php if(($benar / $question->num_rows() * 100) > 50) { ?>
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