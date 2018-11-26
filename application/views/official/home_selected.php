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
                    <button class="btn btn-outline-info">
                      Lihat Rangers
                    </button>
                    <button class="btn btn-outline-success">
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