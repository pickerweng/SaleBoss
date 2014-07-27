<?php namespace SaleBoss\Events;

use Illuminate\Support\Facades\Log;
use SaleBoss\Models\Order as ModelOrder;
use SaleBoss\Repositories\Exceptions\RepositoryException;
use SaleBoss\Repositories\OrderLogRepositoryInterface;

class OrderLog{

    protected $orderLogRepo;

    /**
     * @param OrderLogRepositoryInterface $orderLogRepo
     */
    public function __construct(
        OrderLogRepositoryInterface $orderLogRepo
    ){
        $this->orderLogRepo = $orderLogRepo;
    }

    /**
     * When an order is updated log it into database
     *
     * @param ModelOrder $order
     */
    public function whenOrderHasBeenUpdated(ModelOrder $order)
    {
        try {
            $this->orderLogRepo->store($order,$order->creator_id,$order->creator_id);
        }catch (RepositoryException $e){
            Log::info($e->getMessage());
        }
    }
}