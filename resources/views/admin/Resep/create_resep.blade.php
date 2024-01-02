<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <title>Tambah Resep</title>
  </head>

  <body>
    <div class="container" style="margin-top: 80px">
      <div class="row">
        <div class="col-md-8 offset-md-2">
          <div class="card">
            <div class="card-header">
              Tambah Resep
            </div>
            <div class="card-body">
                <form action="{{route('admin.store_resep')}}" method="post" enctype="multipart/form-data">
               @csrf
                <div class="form-group">
                 <label for="category_resep_id">Category</label>
                    <select class="form-control" name="category_resep_id" id="">
                      @foreach($categoryreseps as $id => $categoryName)
                        <option value="{{ $id }}">{{ $categoryName }}</option>
                      @endforeach
                    </select>   
                </div>
                <div class="form-group">
                  <label>Nama Produk</label>
                  <input type="text" name="name" placeholder="Name" class="form-control">
                </div>
                <div class="form-group">
                  <label>Deskripsi Produk</label>
                  <textarea name="description" type="text" cols="30" rows="10" placeholder="Description" class="form-control"></textarea>
                </div>
                <div class="form-group">
                  <label>Harga Produk</label>
                  <input type="number" name="price" placeholder="Harga" class="form-control">
                </div>
                <div class="form-group">
                  <label>Gambar Produk</label>
                  <input type="file" name="image" class="form-control">
                </div>
                
                 <!-- Dynamic Product Input Fields -->
                    
                  <div class="form-group">
                      <label>Products</label>
                      <div id="products-container">
                          <div class="product-input">
                                <select class="form-control" name="product_id[]" id="">
                                    @foreach($products as $id => $product)
                                        <option value="{{ $id }}">{{ $product }}</option>
                                    @endforeach
                                </select>
                                  <input type="number" name="product_amount[]" placeholder="Jumlah" class="form-control">
                                  <input type="text" name="jenis[]" placeholder="Contoh : ekor" class="form-control">
                                  <button type="button" class="btn btn-danger remove-product">Remove</button>
                          </div>
                          
                      </div>
                      <button type="button" class="btn btn-primary add-product">Add Product</button>
                    </div>
                            <!-- End Dynamic Product Input Fields -->
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
    $(".add-product").click(function() {
        let productInput = '<div class="product-input">' +
            '<select class="form-control" name="product_id[]" id="">@foreach($products as $id => $product)<option value="{{ $id }}">{{ $product }}</option>@endforeach</select>' +
            '<input type="number" name="product_amount[]" placeholder="Jumlah" class="form-control">' +
            '<input type="text" name="jenis[]" placeholder="Contoh : ekor" class="form-control">'+
            '<button type="button" class="btn btn-danger remove-product">Remove</button>' +
            '</div>';
        $("#products-container").append(productInput);
    });

    $(document).on("click", ".remove-product", function() {
        $(this).closest(".product-input").remove();
    });
});
</script>
<script>
$(document).ready(function() {
    $("#cancel-button").click(function() {
        window.location.href = "{{ route('admin.index_resep') }}";
    });
});
</script>
  </body>
</html>