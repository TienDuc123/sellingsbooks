<?php
namespace App\Repositories;

use App\Models\Customer;

class CustomerRepository
{
    public function all()
    {
        return Customer::all();
    }

    public function find($id)
    {
        return Customer::find($id);
    }

    public function create($data)
    {
        // return Customer::create($data);
        $customer = Customer::create($data);
        return $customer->id;
    }

    public function update($id, $data)
    {
        $Customer = Customer::find($id);
        if ($Customer) {
            $Customer->update($data);
            return $Customer;
        }
        return null;
    }

    public function delete($id)
    {
        $Customer = Customer::find($id);
        if ($Customer) {
            $Customer->delete();
            return true;
        }
        return false;
    }
}
