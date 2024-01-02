<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <title>Tambah Siswa</title>
  </head>

  <body>
    <div class="container" style="margin-top: 80px">
      <div class="row">
        <div class="col-md-8 offset-md-2">
          <div class="card">
            <div class="card-header">
              TAMBAH PRODUK
            </div>
            <div class="card-body">
                <form action="{{route('admin.update_product',$product)}}" method="post" enctype="multipart/form-data">
                @method('patch')              
                @csrf
          
                <div class="form-group">
                 <label for="category_id">Category</label>
                    <select class="form-control" name="category_product_id" id=""required>
                      @foreach($categoryproducts as $id => $categoryName)
                        <option value="{{ $id }}" required>{{ $categoryName }}</option>
                      @endforeach
                    </select>   
                </div>
                <div class="form-group">
                 <label for="jenis">Tag</label>
                    <select class="form-control" name="jenis" id=""required>
                        <option value="Normal"required> Normal</option>
                        <option value="Naik"required> Naik</option>
                        <option value="Turun"required> Turun</option>
                    </select>   
                </div>
                <div class="form-group">
                  <label>Nama Produk</label>
                  <input type="text" name="name" placeholder="Name" class="form-control" value="{{$product->name}}"required>
                </div>
                <div class="form-group">
                  <label>Deskripsi Produk</label>
                <textarea name="description" type="text" cols="30" rows="10" placeholder="Description" class="form-control"required></textarea>
                </div>
                <div class="form-group">
                  <label>Harga Produk</label>
                  <input type="number" name="price" placeholder="Harga" class="form-control" value="{{$product->price}}"required>
                </div>
                <div class="form-group">
                  <label>Stok Produk</label>
                  <input type="text" name="stock" placeholder="Stok" class="form-control" value="{{$product->stock}}"required>
                </div>
                 <div class="form-group">
                  <label>Satuan</label>
                  <input type="text" name="satuan" class="form-control" value="{{$product->satuan}}"required>
                </div>
                <div class="form-group">
                  <label>Gambar Produk</label>
                  <input type="file" name="image" class="form-control" value="{{$product->image}}"required>
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
        window.location.href = "{{ route('admin.index_product') }}";
});
</script>
  </body>
</html>