<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use App\Models\Transaction;
use App\Models\Order;
use App\Models\TransactionResep;
class DeleteUnpaidOrders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:delete-unpaid-orders';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
          //$this->info('Command started at: ' . now());
          //$this->info('Command finished at: ' . now());
        //$cutoffTime = Carbon::now()->subHours(1);
        $cutoffTime = Carbon::now()->subMinutes(1);
        $ordersToDelete = Order::where('status', 'Belum Bayar')
            ->where('created_at', '<', $cutoffTime)
            ->get();

        foreach ($ordersToDelete as $order) {
            // Delete related transactions and transaction reseps
            Transaction::where('order_id', $order->id)->delete();
            TransactionResep::where('order_id', $order->id)->delete();

            // Delete the order
           // $order->delete();
        }
    }
}

