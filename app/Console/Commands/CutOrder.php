<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Repositories\OrderRepository;
use App\Order;
use Carbon\Carbon;

class CutOrder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'expires';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cut orders expires';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //find order expires
        $order = new OrderRepository(new Order);
        $order->updateOrderExpires();
        $this->info('update orders expires successfully');
        \Log::info('update orders expires ' . Carbon::now());
    }
}
