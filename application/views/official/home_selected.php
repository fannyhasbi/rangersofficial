<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header card-header-primary">
        <h4 class="card-title">Daftar Rangers Yang Memenuhi Kriteria</h4>
        <p class="card-category">Klik <strong>Kirim Email</strong> untuk mengirimkan email konfirmasi kepada mereka.</p>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table">
            <thead>
              <tr>
                <th>Divisi</th>
                <th>Jumlah Diterima</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <?php foreach($selected as $item): ?>
                <tr>
                  <td><?= $item->nama; ?></td>
                  <td><?= $item->jumlah; ?></td>
                  <td>
                    <button onclick="window.location = '<?= site_url('official/division/'.$item->id); ?>'" class="btn btn-outline-info" <?= $item->jumlah == 0 ? 'disabled' : ''; ?>>
                      Lihat Rangers
                    </button>
                    <button class="btn btn-outline-success" onclick="kirim(<?= $item->id; ?>, '<?= $item->nama; ?>')" <?= $item->jumlah == 0 ? 'disabled' : ''; ?>>
                      Kirim Email
                    </button>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
function kirim(id, name){
  swal({
    text: `Kirim email pengumuman ke Rangers divisi ${name}?`,
    type: 'info',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    // cancelButtonColor: '#d33',
    confirmButtonText: 'Kirim',
    cancelButtonText: 'Kembali'
  }).then((result) => {
    if (result.value) {
      // just trial
      window.location = "<?= site_url('official/send-email/'); ?>"+ id;
    }
  })
}
</script>