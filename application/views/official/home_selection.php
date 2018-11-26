<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header card-header-primary">
        <h4 class="card-title">Seleksi Rangers Terpilih</h4>
        <p class="card-category">Silahkan pilih Rangers terpilih berdasarkan divisinya</p>
      </div>
      <div class="card-body">
        <form action="" method="post">
          <div class="form-group">
            <label for="division" class="control-label">Divisi</label>
            <select class="form-control selection-input" name="division">
              <?php foreach($division as $item): ?>
                <option value="<?= $item->id; ?>"><?= $item->nama; ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="form-group">
            <label for="rangers" class="control-label">Rangers</label>
            <select class="form-control selection-input" name="rangers[]" multiple="multiple">
              <?php foreach($rangers as $item): ?>
                <option value="<?= $item->id; ?>"><?= $item->nama; ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="form-group">
            <input type="submit" name="send-selection" class="btn btn-success" value="Simpan">
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
  $(document).ready(function(){
    $('.selection-input').select2();
  });
</script>