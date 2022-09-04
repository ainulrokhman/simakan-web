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
      <div class="card-header pb-0">
        <div class="d-flex align-items-center">
          <p class="mb-0">Detail Angket</p>
          <button class="btn btn-primary btn-sm ms-auto">Update</button>
        </div>
      </div>
      <div class="card-body">
        <p class="text-uppercase text-sm">Informasi Umum</p>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="example-text-input" class="form-control-label">Judul Angket</label>
              <input class="form-control" type="text" placeholder="Judul Angket" name="title" value="<?php echo $angket['angket_title'];?>">
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="example-text-input" class="form-control-label">Deskripsi</label>
              <input class="form-control" type="text" placeholder="Deskripsi" name="desc" value="<?php echo $angket['angket_description'];?>">
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="example-text-input" class="form-control-label">Kategori</label>
              <select class="form-control">
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
              <select class="form-control">
                  <option value="1" <?php if($angket['is_active'] == 1){echo"selected";}else{echo"";}?>>Aktif</option>
                  <option value="0" <?php if($angket['is_active'] == 0){echo"selected";}else{echo"";}?>>Tidak Aktif</option>
              </select>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="example-text-input" class="form-control-label">Tanggal Mengerjakan</label>
              <input class="form-control" type="date" name="start_date"  value="<?php echo date('Y-m-d',strtotime($angket['angket_start_date']));?>">
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="example-text-input" class="form-control-label">Batas Waktu</label>
              <input class="form-control" type="date" name="end_date"  value="<?php echo date('Y-m-d',strtotime($angket['angket_end_date']));?>">
            </div>
          </div>
        </div>
        <hr class="horizontal dark">
        <div class="d-flex align-items-center">
          <p class="mb-0">Daftar Pertanyaan</p>
          <button class="btn btn-primary btn-sm ms-auto">Tambah Pertanyaan</button>
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
              <tr>
                <td style="text-align:center;vertical-align:middle">
                  <span class="text-secondary text-xs font-weight-bold">1.</span>
                </td>
                <td style="text-align:left;vertical-align:middle">
                  <span class="text-secondary text-xs font-weight-bold">Apakah Anda setuju dengan pembelajaran offline?</span>
                </td>
                <td style="text-align:center;vertical-align:middle">
                  <span class="text-secondary text-xs font-weight-bold">Pilihan Ganda</span>
                </td>
                <td class="align-middle" style="text-align:center;vertical-align:middle">
                  <a href="#" class="text-secondary font-weight-bold text-sm">
                    <i class="fa fa-edit"></i>
                  </a> &nbsp;&nbsp;&nbsp; <a href="#" class="text-danger font-weight-bold text-sm">
                    <i class="fa fa-trash-o"></i>
                  </a>
                </td>
              </tr>
              <tr>
                <td style="text-align:center;vertical-align:middle">
                  <span class="text-secondary text-xs font-weight-bold">2.</span>
                </td>
                <td style="text-align:left;vertical-align:middle">
                  <span class="text-secondary text-xs font-weight-bold">Apakah alasan Anda?</span>
                </td>
                <td style="text-align:center;vertical-align:middle">
                  <span class="text-secondary text-xs font-weight-bold">Essay</span>
                </td>
                <td class="align-middle" style="text-align:center;vertical-align:middle">
                  <a href="#" class="text-secondary font-weight-bold text-sm">
                    <i class="fa fa-edit"></i>
                  </a> &nbsp;&nbsp;&nbsp; <a href="#" class="text-danger font-weight-bold text-sm">
                    <i class="fa fa-trash-o"></i>
                  </a>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
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
                <p class="text-sm">10 Responden terpilih</p>
                <button class="btn btn-primary btn-sm ms-auto">Pilih</button>
              </div>
            </div>
        </div>
    </div>
</div>