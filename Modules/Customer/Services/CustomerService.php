<?php

namespace Modules\Customer\Services;

use Illuminate\Support\Facades\Auth;
use Modules\Customer\Entities\Customer;

class CustomerService
{
    /**
     * login
     *
     * @param  mixed $request
     * @return mixed
     */
    public function findAll($request)
    {
        $customers = Customer::latest()
            ->searchKeyword($request->keyword)
            ->paginate(15);
        return $customers;
    }

    /**
     * save
     *
     * @param  mixed $request
     * @return mixed
     */
    public function save($request)
    {
        $newCustomer = Customer::create($request->all());
        return $newCustomer;
    }

    public function findById($id)
    {
        $customer = Customer::findOrFail($id);
        return $customer;
    }

    public function update($request, $id)
    {
        $customer = Customer::findOrFail($id);
        $customer->update($request->all());
        return $customer;
    }

    public function delete($id)
    {
        $customer = Customer::findOrFail($id)->delete();
        return $customer;
    }
}
