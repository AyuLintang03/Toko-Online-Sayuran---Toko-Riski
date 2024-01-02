<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <title>Tambah Kategori Resep</title>
  </head>

  <body>
    <div class="container" style="margin-top: 80px">
      <div class="row">
        <div class="col-md-8 offset-md-2">
          <div class="card">
            <div class="card-header">
             Tambah Data Kategori Resep
            </div>
            <div class="card-body">
                <form action="{{route('admin.store_category_resep')}}" method="post" enctype="multipart/form-data">
               @csrf
                <div class="form-group">
                  <label>Nama Kategori Resep</label>
                  <input type="text" name="name_category_resep" placeholder="Name" class="form-control" require>
                </div>
                <div class="form-group">
                  <label>Gambar</label>
                  <input type="file" name="image_category_resep" class="form-control" require>
                </div>
                
                <button type="submit" class="btn btn-success">SIMPAN</button>
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
        window.location.href = "{{ route('admin.index_category_resep') }}";
    });
});
</script>
  </body>
</html>