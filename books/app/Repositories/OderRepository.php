<?php
namespace App\Repositories;

use App\Models\Order;

class OderRepository
{
    public function all()
    {
        return Order::all();
    }

    public function find($id)
    {
        return Order::find($id);
    }

    public function create($data)
    {
        return Order::create($data);
    }

    public function update($id, $data)
    {
        $Order = Order::find($id);
        if ($Order) {
            $Order->update($data);
            return $Order;
        }
        return null;
    }

    public function delete($id)
    {
        $Order = Order::find($id);
        if ($Order) {
            $Order->delete();
            return true;
        }
        return false;
    }
}
