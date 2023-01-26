<?php

namespace Modules\Debit\Services;

use Modules\Customer\Entities\Customer;
use Modules\Debit\Entities\Debit;

class DebitService
{

    /**
     * findAll
     *
     * @param  mixed $request
     * @return void
     */
    public function findAll($request)
    {
        $debits = Debit::latest()
            ->searchKeyword($request->keyword)
            ->searchByCreatedAt($request->created_at)
            ->paginate(15);
        return $debits;
    }

    public function findById($id)
    {
        $debit = Debit::findOrFail($id);
        return $debit;
    }

    public function save($request)
    {
        $amount = str_replace('.', '', $request->amount);
        $newDebit = Debit::create([
            'customer_id' => $request->customer_id,
            'amount' => $amount,
            'deadline' => $request->deadline,
            'note' => $request->note
        ]);
        return $newDebit;
    }

    public function update($id, $request)
    {
        $debit = Debit::findOrFail($id);
        $amount = str_replace('.', '', $request->amount);
        return $debit->update([
            'amount' => $amount,
            'payment_date' => $request->payment_date,
            'deadline' => $request->deadline,
            'note' => $request->note
        ]);
    }

    public function delete($id)
    {
        return Debit::findOrFail($id)->delete();
    }

    public function updateStatus($id, $status)
    {
        $debit = Debit::findOrFail($id);
        $debit->update([
            'status' => $status
        ]);
        return $debit;
    }
}
