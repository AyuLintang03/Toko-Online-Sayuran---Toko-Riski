<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Order Offline</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
</head>
<body>
    <div class="container" style="margin-top: 80px">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header">
                        EDIT ORDER OFFLINE
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.update_order_offline', $orderoffline) }}" method="post">
                            @method('patch')
                            @csrf
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" name="name" placeholder="Name" class="form-control" value="{{ $orderoffline->name }}">
                            </div>
                            <div class="form-group">
                                <label for="alamat">Alamat</label>
                                <input type="text" name="alamat" placeholder="Alamat" class="form-control" value="{{ $orderoffline->alamat }}">
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
                            <div class="form-group">
                                <label for="product_id">Product</label>
                                <select class="form-control" name="product_id[]" id="product_id"required>
                                    @foreach($productOptions as $id => $productOption)
                                        <option value="{{ $id }}">{{ $productOption }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="product_amount">Amount</label>
                                <input type="number" name="product_amount[]" placeholder="Amount" class="form-control"required>
                            </div>
                            <!-- Add other fields as needed -->

                            <!-- Dynamic Product Input Fields -->
                            <div class="form-group" id="products-container">
                                <!-- Existing product input fields will be appended here -->
                            </div>
                            <button type="button" class="btn btn-primary" id="add-product">Add Product</button>
                            <!-- End Dynamic Product Input Fields -->
                            <br>
                            <br>
                            <!-- Add other orderoffline fields as needed -->

                            <button type="submit" class="btn btn-success">UPDATE</button>
                            <button type="reset" class="btn btn-warning">RESET</button>
                            <a href="{{ route('admin.index_order_offline') }}" class="btn btn-danger">BATAL</a>
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
            $("#add-product").click(function() {
                let productInput = '<div class="product-input">' +
                    '<select class="form-control" name="product_id[]" id="product_id">' +
                    '@foreach($productOptions as $id => $productOption)' +
                    '<option value="{{ $id }}">{{ $productOption }}</option>' +
                    '@endforeach' +
                    '</select>' +
                    '<input type="number" name="product_amount[]" placeholder="Amount" class="form-control">' +
                    // Add other input fields here
                    '<button type="button" class="btn btn-danger remove-product">Remove</button>' +
                    '</div>';
                $("#products-container").append(productInput);
            });

            $(document).on("click", ".remove-product", function() {
                $(this).closest(".product-input").remove();
            });
        });
    </script>
</body>
</html>
