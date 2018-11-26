<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header card-header-primary">
        <h4 class="card-title">Daftar Rangers Yang Memenuhi Kriteria Divisi {{ Yoyoy }}</h4>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table">
            <thead>
              <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Email</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
                <tr>
                  <td>1</td>
                  <td>Fanny Hasbi</td>
                  <td>me@example.com</td>
                  <td>
                    <button rel="tooltip" title="Batalkan" class="btn btn-danger btn-link btn-sm" onclick="batalkan(1, 'Fanny Hasbi')">
                      <i class="material-icons">clear</i>
                    </button>
                  </td>
                </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
function batalkan(id, name){
  swal({
    text: `Yakin ingin membatalkan ${name}?`,
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    // cancelButtonColor: '#d33',
    confirmButtonText: 'Ya',
    cancelButtonText: 'Kembali'
  }).then((result) => {
    if (result.value) {
      window.location = "<?= site_url('official/cancel-rangers/'); ?>"+ id;
    }
  })
}
</script>