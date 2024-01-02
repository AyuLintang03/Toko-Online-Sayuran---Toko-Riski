<?php

namespace App\Http\Controllers;

use App\Models\CartProduct;
use App\Models\CartResep;
use App\Models\Order;
use App\Models\Transaction;
use App\Models\TransactionResep;
use App\Models\Product;
use App\Models\Delivery;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

use App\Models\OrderOffline;
use PDF;
class ReportController extends Controller
{


public function generatePDF(Request $request)
{
     $month = $request->input('month');;

    $orders = Order::whereMonth('batas_waktu', $month)
                 ->whereYear('batas_waktu', date('Y'))
                 ->get();
    $orderofflines = OrderOffline::whereMonth('batas_waktu', $month)
                 ->whereYear('batas_waktu', date('Y'))
                 ->get();
     $date = now()->format('Y-m-d');
    $pdf = PDF::loadView('admin.Report.report_order', compact('orders','orderofflines','date'));

    $pdfFileName = 'monthly_report_' . date('Y') . '-' . $month . '.pdf';
    return $pdf->download($pdfFileName);
}


    public function searchraport(Request $request)
{
    $search = $request->input('search');
    $orders = Order::join('users', 'orders.user_id', '=', 'users.id')
        ->where(function ($query) use ($search) {
            $query->where('orders.alamat', 'like', '%' . $search . '%')
                ->orWhere('orders.postcode', 'like', '%' . $search . '%') 
                ->orWhere('users.username', 'like', '%' . $search . '%')
                ->orWhere('orders.status', 'like', '%' . $search . '%'); 
        })
        ->paginate();

    return view('admin.Report.index_report', ['orders' => $orders]);
}
    

}

