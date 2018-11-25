<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header card-header-primary">
        <h4 class="card-title ">Daftar Pendaftar Rangers FLS 2019</h4>
        <p class="card-category"> Total pendaftar <strong>Rangers</strong> tercatat : <?= count($rangers); ?></p>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table">
            <thead class=" text-primary">
              <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Email</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach($rangers as $item): ?>
                <tr>
                  <td><?= $item->id; ?></td>
                  <td><?= $item->nama; ?></td>
                  <td><?= $item->email; ?></td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>