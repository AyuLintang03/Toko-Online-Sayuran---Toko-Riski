<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <title>Tambah Pesanan Offline</title>
</head>
<body>
<div class="container" style="margin-top: 80px">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    Tambah Pesanan Offline
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.store_order_offline') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label>Nama</label>
                            <input type="text" name="name" placeholder="Nama" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Alamat</label>
                            <input type="text" name="alamat" placeholder="Alamat" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>RT/RW</label>
                            <input type="text" name="RTRW" placeholder="RT/RW" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Kode Pos</label>
                            <input type="text" name="postcode" placeholder="Kode Pos" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Nomor Telepon</label>
                            <input type="text" name="phone" placeholder="Nomor Telepon" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Status</label>
                            <select name="status" class="form-control" required>
                                <option value="Belum Bayar"required>Belum Bayar</option>
                                <option value="Lunas"required>Lunas</option>
                                <option value="Hutang"required>Hutang</option>
                                <!-- Tambahkan opsi lain sesuai dengan kebutuhan Anda -->
                            </select>
                        </div>
                        <div class="form-group">
                            <label> Waktu</label>
                            <input type="datetime-local" name="batas_waktu" class="form-control" required>
                        </div>
                        <!-- Dynamic Product Input Fields -->
                        <div class="form-group">
                            <label>Produk</label>
                            <div id="products-container">
                                <div class="product-input">
                                    <select class="form-control" name="product_id[]" id=""required>
                                        @foreach($productOptions as $id => $product)
                                            <option value="{{ $id }}">{{ $product }}</option>
                                            
                                        @endforeach
                                    </select>
                                    <input type="number" name="product_amount[]" placeholder="Jumlah" class="form-control"required>
                                   <!-- <input type="text" name="jenis[]" placeholder="Contoh : ekor" class="form-control">-->
                                    <button type="button" class="btn btn-danger remove-product">Hapus</button>
                                </div>
                            </div>
                            <button type="button" class="btn btn-primary add-product">Tambah Produk</button>
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
    $(document).ready(function () {
        $(".add-product").click(function () {
            let productInput = '<div class="product-input">' +
                '<select class="form-control" name="product_id[]" id="">' +
                '@foreach($productOptions as $id => $product)' +
                '<option value="{{ $id }}">{{ $product }}</option>' +
                '@endforeach' +
                '</select>' +
                '<input type="number" name="product_amount[]" placeholder="Jumlah" class="form-control">' +
               // '<input type="text" name="jenis[]" placeholder="Contoh : ekor" class="form-control">' +
                '<button type="button" class="btn btn-danger remove-product">Hapus</button>' +
                '</div>';
            $("#products-container").append(productInput);
        });

        $(document).on("click", ".remove-product", function () {
            $(this).closest(".product-input").remove();
        });
    });
</script>
<script>
    $(document).ready(function () {
        $("#cancel-button").click(function () {
            window.location.href = "{{ route('admin.index_resep') }}";
        });
    });
</script>
</body>
</html>
