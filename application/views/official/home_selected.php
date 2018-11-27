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
                    <a href="<?= site_url('official/division/'.$item->id); ?>" class="btn btn-outline-info">
                      Lihat Rangers
                    </a>
                    <button class="btn btn-outline-success" onclick="kirim('<?= $item->nama; ?>')">
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
function kirim(name){
  swal({
    text: `Kirim email konfirmasi Rangers divisi ${name}?`,
    type: 'info',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    // cancelButtonColor: '#d33',
    confirmButtonText: 'Kirim',
    cancelButtonText: 'Kembali'
  }).then((result) => {
    if (result.value) {
      // just trial
      window.location = "<?= site_url('official/send-email/'); ?>";
    }
  })
}
</script>