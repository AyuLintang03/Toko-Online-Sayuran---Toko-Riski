<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Order Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h2>Data Laporan</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Waktu</th>
                <th>Nama</th>
                <th>Alamat</th>
                <th>Nomer HP</th>
                <th>Order ID</th>
                <th>Total</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
               <!-- Inisialisasi counter -->
                            @php
                                $counter = 1;
                            @endphp
            @foreach ($orders as $order)
            <tr><td>{{ $counter }}</td>
                <td>{{ $order->batas_waktu }}</td>
                <td>{{ $order->user->username }}</td>
                <td>{{ $order->alamat }}</td>
                <td>{{ $order->phone }}</td>
                <td>{{ $order->id }}</td>
                <td>{{ $order->subtotal }}</td>
                <td>{{ $order->status }}</td>
            </tr>
              @php
                                $counter++;
                            @endphp
            @endforeach

            @foreach ($orderofflines as $orderoffline)
            <tr>
                <td>{{ $counter }}</td>
                <td>{{ $orderoffline->batas_waktu }}</td>
                <td>{{ $orderoffline->name }}</td>
                <td>{{ $orderoffline->alamat }}</td>
                <td>{{ $orderoffline->phone }}</td>
                <td>{{ $orderoffline->id }}</td>
                <td>{{ $orderoffline->subtotal }}</td>
                <td>{{ $orderoffline->status }}</td>
            </tr>
              @php
                                $counter++;
                            @endphp
            @endforeach
        </tbody>
    </table>
     <p>Tanggal Cetak Laporan: {{ date('Y-m-d') }}</p>
</body>
</html>
