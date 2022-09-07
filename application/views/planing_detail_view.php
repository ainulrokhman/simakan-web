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
            <p class="mb-0">Detail Angket</p>
            <button type="submit" class="btn btn-primary btn-sm ms-auto">Update</button>
          </div>
        </div>
        <div class="card-body">
          <p class="text-uppercase text-sm">Informasi Umum</p>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="example-text-input" class="form-control-label">Judul Angket</label>
                <input class="form-control" type="text" placeholder="Judul Angket" name="title" value="<?php echo $angket['angket_title'];?>" required>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="example-text-input" class="form-control-label">Deskripsi</label>
                <input class="form-control" type="text" placeholder="Deskripsi" name="desc" value="<?php echo $angket['angket_description'];?>" required>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="example-text-input" class="form-control-label">Kategori</label>
                <select class="form-control" name="category" required>
                  <!-- <option disabled selected>Pilih Kategori</option> -->
                  <?php foreach($category as $data_category) { ?>
                    <option value="<?php echo $data_category->category_id;?>" <?php if($data_category->category_id == $angket['category_id']){echo"selected";}else{echo"";}?>)><?php echo $data_category->category_name;?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="example-text-input" class="form-control-label">Status</label>
                <select class="form-control" required name="status">
                    <option value="1" <?php if($angket['is_active'] == 1){echo"selected";}else{echo"";}?>>Aktif</option>
                    <option value="0" <?php if($angket['is_active'] == 0){echo"selected";}else{echo"";}?>>Tidak Aktif</option>
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="example-text-input" class="form-control-label">Tanggal Mengerjakan</label>
                <input class="form-control" type="date" name="start_date"  value="<?php echo date('Y-m-d',strtotime($angket['angket_start_date']));?>" required>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="example-text-input" class="form-control-label">Batas Waktu</label>
                <input class="form-control" type="date" name="end_date"  value="<?php echo date('Y-m-d',strtotime($angket['angket_end_date']));?>" required>
              </div>
            </div>
          </div>
          <hr class="horizontal dark">
          <div class="d-flex align-items-center">
            <p class="mb-0">Daftar Pertanyaan</p>
            <a data-bs-toggle="modal" data-bs-target="#modal_question" class="btn btn-primary btn-sm ms-auto">Tambah Pertanyaan</a>
          </div>
          <div class="row">
            <table class="table align-items-center mb-0">
              <thead>
                <tr>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" style="text-align:center;vertical-align:middle">No</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" style="text-align:center;vertical-align:middle">Pertanyaan</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" style="text-align:center;vertical-align:middle">Jenis</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" style="text-align:center;vertical-align:middle">Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $no = 0;
                foreach($questionner as $data_questionner) {
                  $no++;
                ?>
                <tr>
                  <td style="text-align:center;vertical-align:middle">
                    <span class="text-secondary text-xs font-weight-bold"><?php echo $no;?>.</span>
                  </td>
                  <td style="text-align:left;vertical-align:middle">
                    <span class="text-secondary text-xs font-weight-bold"><?php echo $data_questionner->questionner_title;?></span>
                  </td>
                  <td style="text-align:center;vertical-align:middle">
                    <span class="text-secondary text-xs font-weight-bold">
                      <?php if($data_questionner->questionner_type == 'pg') {
                        echo "Pilihan Ganda";
                      } else {
                        echo "Essay";
                      }?>
                    </span>
                  </td>
                  <td class="align-middle" style="text-align:center;vertical-align:middle">
                    <!-- <a href="#" class="text-secondary font-weight-bold text-sm">
                      <i class="fa fa-edit"></i>
                    </a>  -->
                    <!-- &nbsp;&nbsp;&nbsp;  -->
                    <a href="<?php echo base_url();?>planing/deletequestion/<?php echo $data_questionner->questionner_id;?>" class="text-danger font-weight-bold text-sm" onclick="return confirm('Are you sure delete this data?');">
                      <i class="fa fa-trash"></i>
                    </a>
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
  <div class="col-md-4">
        <div class="card">
            <div class="card-header pb-0">
              <div class="d-flex align-items-center">
                <p class="mb-0">Pilih Responden</p>
              </div>
            </div>
            <div class="card-body">
              <div class="d-flex align-items-center">
                <p class="text-sm"><?php echo $responden;?> Responden terpilih</p>
                <a data-bs-toggle="modal" data-bs-target="#modal_responden" class="btn btn-primary btn-sm ms-auto">Pilih</a>
              </div>
            </div>
        </div>
    </div>
</div>



<!-- Modal Responden -->
<div class="modal fade" id="modal_responden" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <form action="<?php echo base_url();?>planing/saveresponden" method="post">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Pilih Responden</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="angket" value="<?php echo $angket['angket_id'];?>">
          <?php foreach($siswa as $data_siswa) { ?>
            <?php
              $checked = "";
              $check = $this->Base_model->getDataBy('responden', array('angket_id' => $angket['angket_id'], 'siswa_id' => $data_siswa->siswa_id));
              if($check->num_rows() > 0) {
                $checked = "checked";
              } else {
                $checked = "";
              }
            ?>
            <input type="checkbox" <?php echo $checked;?> name="siswa[]" value="<?php echo $data_siswa->siswa_id;?>">&nbsp;&nbsp;&nbsp;<?php echo $data_siswa->siswa_name;?><br>
          <?php } ?>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn bg-gradient-primary" data-bs-dismiss="modal">Simpan</button>
          <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Tutup</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal Question -->
<div class="modal fade" id="modal_question" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <form action="<?php echo base_url();?>planing/savequestion" method="post">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Pertanyaan</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="angket" value="<?php echo $angket['angket_id'];?>">
          <div class="form-group">
            <label for="example-text-input" class="form-control-label">Pertanyaan</label>
            <input class="form-control" placeholder="Pertanyaan" type="text" name="question" required="required">
          </div>
          <div class="form-group">
            <label for="example-text-input" class="form-control-label">Opsi A</label>
            <input class="form-control" placeholder="Opsi A" type="text" name="opsi_a" required="required">
          </div>
          <div class="form-group">
            <label for="example-text-input" class="form-control-label">Opsi B</label>
            <input class="form-control" placeholder="Opsi B" type="text" name="opsi_b" required="required">
          </div>
          <div class="form-group">
            <label for="example-text-input" class="form-control-label">Opsi C</label>
            <input class="form-control" placeholder="Opsi C" type="text" name="opsi_c">
          </div>
          <div class="form-group">
            <label for="example-text-input" class="form-control-label">Opsi D</label>
            <input class="form-control" placeholder="Opsi D" type="text" name="opsi_d">
          </div>
          <div class="form-group">
            <label for="example-text-input" class="form-control-label">Opsi E</label>
            <input class="form-control" placeholder="Opsi E" type="text" name="opsi_e">
          </div>
          <div class="form-group">
            <label for="example-text-input" class="form-control-label">Jawaban</label>
            <select class="form-control" name="answer" required>
              <option value="A">A</option>
              <option value="B">B</option>
              <option value="C">C</option>
              <option value="D">D</option>
              <option value="E">E</option>
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn bg-gradient-primary">Simpan</button>
          <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Tutup</button>
        </div>
      </form>
    </div>
  </div>
</div>