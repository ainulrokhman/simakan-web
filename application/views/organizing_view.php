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
              <h6 class="mb-0">Data Grafik Angket</h6>
              <p class="text-xs text-secondary mb-0">Proses alokasi tugas untuk mencapai sasaran</p>
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
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" style="text-align:center;vertical-align:middle">Judul</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2" style="text-align:center;vertical-align:middle">Jumlah Responden</th>
                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" style="text-align:center;vertical-align:middle">Grafik Angket</th>
                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" style="text-align:center;vertical-align:middle">Batas Waktu</th>
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
						$total = $this->Base_model->getDataBy('responden', array('angket_id' => $data_angket->angket_id));
						echo $total->num_rows();
					?>
				  </span>
                </td>
                <td class="align-middle text-center text-sm">
                  <a data-bs-toggle="modal" data-bs-target="#exampleModal_<?php echo $data_angket->angket_id;?>"><i class="fa fa-chart-pie"></i></a>
                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal_<?php echo $data_angket->angket_id;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Detail Grafik</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <figure class="highcharts-figure">
                              <div id="container-chart-<?php echo $data_angket->angket_id;?>"></div>
                          </figure>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- End Modal -->
                    <?php
                      $sudah_mengerjakan = $this->Base_model->getDataBy('responden', array('angket_id' => $data_angket->angket_id, 'is_doing' => 2));
                      $sedang_mengerjakan = $this->Base_model->getDataBy('responden', array('angket_id' => $data_angket->angket_id, 'is_doing' => 1));
                      $belum_mengerjakan = $this->Base_model->getDataBy('responden', array('angket_id' => $data_angket->angket_id, 'is_doing' => 0));
                    ?>
                    <script>
                    Highcharts.chart('container-chart-<?php echo $data_angket->angket_id;?>', {
                        chart: {
                            plotBackgroundColor: null,
                            plotBorderWidth: null,
                            plotShadow: false,
                            type: 'pie'
                        },
                        title: {
                            text: 'Grafik Angket'
                        },
                        tooltip: {
                            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                        },
                        accessibility: {
                            point: {
                                valueSuffix: '%'
                            }
                        },
                        plotOptions: {
                            pie: {
                                allowPointSelect: true,
                                cursor: 'pointer',
                                dataLabels: {
                                    enabled: true,
                                    format: '<b>{point.name}</b>: {point.percentage:.1f} %'
                                }
                            }
                        },
                        credits: {
                            enabled: false
                        },
                        exporting: { enabled: false },
                        series: [{
                            name: 'Title',
                            colorByPoint: true,
                            data: [{
                                name: 'Sudah Mengerjakan',
                                y: <?php echo (int) $sudah_mengerjakan->num_rows();?>,
                                sliced: true,
                                selected: true
                            }, {
                                name: 'Belum Mengerjakan',
                                y: <?php echo (int) $belum_mengerjakan->num_rows();?>
                            }, {
                                name: 'Sedang Mengerjakan',
                                y: <?php echo (int) $sedang_mengerjakan->num_rows();?>
                            }]
                        }]
                    });
                    </script>
                </td>
                <td class="align-middle text-center">
                  <span class="text-secondary text-xs font-weight-bold"><?php echo date('d M Y', strtotime($data_angket->angket_end_date));?></span>
                </td>
                <td class="align-middle" style="text-align:center;vertical-align:middle">
                  <a href="<?php echo base_url();?>organizing/detail/<?php echo $data_angket->angket_id;?>" class="text-secondary font-weight-bold text-sm">
                    <i class="fa fa-search"></i>
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