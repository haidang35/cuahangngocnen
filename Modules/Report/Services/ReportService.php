<?php

namespace Modules\Report\Services;

use Illuminate\Support\Facades\DB;
use Modules\Customer\Entities\Customer;
use Modules\Debit\Entities\Debit;

class ReportService
{
    public function getData()
    {
        $customers = Customer::
            join('debits', 'customers.id', 'debits.customer_id')
            ->select('customers.*')
            ->addSelect(DB::raw('SUM(amount) as total_debit_amount'))
            ->groupBy('debits.customer_id')
            ->orderByDesc('total_debit_amount')
            ->paginate(10);
        return [
            'customers' => $customers
        ];
    }
}
