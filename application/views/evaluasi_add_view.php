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
      <form action="<?php echo base_url();?>controlling/save" method="post">
        <div class="card-header pb-0">
          <div class="d-flex align-items-center">
            <p class="mb-0">Tambah Evaluasi</p>
            <button type="submit" class="btn btn-primary btn-sm ms-auto">Simpan</button>
          </div>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="example-text-input" class="form-control-label">Angket</label>
                <select class="form-control" required name="angket">
                  <option disabled selected>Pilih Angket</option>
                  <?php foreach($angket as $data_angket) { ?>
                    <option value="<?php echo $data_angket->angket_id;?>"><?php echo $data_angket->angket_title;?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="example-text-input" class="form-control-label">Judul</label>
                <input class="form-control" type="text" placeholder="Judul" name="title" required>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <label for="example-text-input" class="form-control-label">Deskripsi</label>
                <input class="form-control" type="text" placeholder="Deskripsi" name="desc" required>
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>