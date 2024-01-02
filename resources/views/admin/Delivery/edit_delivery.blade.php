<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <title>Ubah Pengiriman</title>
  </head>

  <body>
    <div class="container" style="margin-top: 80px">
      <div class="row">
        <div class="col-md-8 offset-md-2">
          <div class="card">
            <div class="card-header">
              UBAH PENGIRIMAN
            </div>
            <div class="card-body">
                <form action="{{ route('admin.update_delivery',  $delivery) }}" method="post" enctype="multipart/form-data">
                @method('patch')              
                @csrf
                
            <div class="form-group">
                <label for="delivery_status">Delivery Status:</label>
                <select name="delivery_status" id="delivery_status" class="form-control" required>
                    <option value="Proses"required>Proses</option>
                    <option value="Pesanan Sedang Diantar"required>Pesanan Sedang Diantar</option>
                    <option value="Dibatalkan">Dibatalkan</option>
                    <option value="Pesanan Belum Diterima"required>Pesanan Belum Diterima</option>
                    <option value="Pesanan Diterima"required>Pesanan Diterima</option>
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
        window.location.href = "{{ route('admin.index_delivery') }}";
    });
});
</script>
  </body>
</html>
