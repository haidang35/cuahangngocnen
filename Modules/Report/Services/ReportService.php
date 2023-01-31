<?php

namespace Modules\Report\Services;

use Illuminate\Support\Facades\DB;
use Modules\Customer\Entities\Customer;
use Modules\Debit\Entities\Debit;

class ReportService
{
    public function getData()
    {
        $customers = Customer::select('customers.*')
            ->leftJoin('debits', function ($join) {
                $join->on('customers.id', '=' ,'debits.customer_id');
            })
            ->groupBy('customers.id')
            ->addSelect(DB::raw('SUM(amount) as total_debit_amount'))
            ->orderByDesc('total_debit_amount')
            ->paginate(10);
        return [
            'customers' => $customers
        ];
    }
}
