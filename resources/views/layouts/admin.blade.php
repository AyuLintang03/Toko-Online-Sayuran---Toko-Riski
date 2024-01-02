<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
     <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Dashboard</title>
    
    <!-- Css Styles -->
    <link rel="stylesheet" href="{{asset('build/assets/css/style-admin.css')}}" type="text/css" />
    <link rel="stylesheet" href="{{asset('build/assets/css/font-awesome.min.css')}}" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200">
    @stack('style-alt')
</head>

    <script src="{{asset('build/assets/js/script.js')}}"></script>
    <script src="{{asset('build/assets/js/feather.min.js')}}"></script>
    <script src="{{asset('build/assets/js/chart.min.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.3/jspdf.umd.min.js"></script>
    @stack('script-alt')
<script>
    document.getElementById('export-pdf-btn').addEventListener('click', function () {
    console.log('Export button clicked');
    const pdf = new jsPDF();
    const table = document.querySelector('.posts-table'); // Your table's class or ID
    pdf.autoTable({ html: table });
    pdf.save('report.pdf');
    });
</script>

    <script>
    function confirmDelete(url) {
        Swal.fire({
            title: 'Kamu yakin?',
            text: "ingin menghapus data ini",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Hapus'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = url;
            }
        });
    }
</script>
</body>

</html>