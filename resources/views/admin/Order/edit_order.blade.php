<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <title>Ubah Orderan</title>
  </head>

  <body>
    <div class="container" style="margin-top: 80px">
      <div class="row">
        <div class="col-md-8 offset-md-2">
          <div class="card">
            <div class="card-header">
              UBAH ORDERAN
            </div>
            <div class="card-body">
                <form a action="{{ route('admin.update_order_status', $order) }}" method="POST" enctype="multipart/form-data">
                @method('patch')              
                @csrf
          
                <div class="form-group">
                 <label for="status">Status</label>
                  <select class="form-control" name="status"required>
                      <option value="Validasi"required>Validasi</option>
                      <option value="Diterima"required>Diterima</option>
                      <option value="Ditolak"required>Ditolak</option>
                      <option value="Belum Bayar"required>Belum Bayar</option>
                      <option value="Lunas"required>Lunas</option>
                </select>
                </div>
                
                <button type="submit" class="btn btn-success">UBAH</button>
                <button type="reset" class="btn btn-warning">RESET</button>
                <button type="button" class="btn btn-danger" id="cancel-button">BATAL</button>

              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script>
$(document).ready(function() {
    $("#cancel-button").click(function() {
        window.location.href = "{{ route('admin.index_order') }}";
    });
});
</script>
  </body>
</html>