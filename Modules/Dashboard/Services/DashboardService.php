<?php 

namespace Modules\Dashboard\Services;

use Carbon\Carbon;
use Modules\Customer\Entities\Customer;
use Modules\Debit\Entities\Debit;
use Modules\Debit\Enums\DebitStatus;

class DashboardService 
{
    public function getReportInfo()
    {
        $totalDebitInYear = Debit::whereYear('created_at', Carbon::now())->count();
        $totalDebitThisMonth = Debit::whereBetween('created_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])->count();
        $totalDebitThisWeek = Debit::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->count();
        $totalDebitToday = Debit::whereDate('created_at', Carbon::now())->count();
        return [
            'total_customer' => Customer::count(),
            'total_debit' => Debit::count(),
            'total_paid_debit' => Debit::whereStatus(DebitStatus::PAID)->count(),
            'total_processing_debit' => Debit::whereStatus(DebitStatus::PROCESSING)->count(),
            'total_debit_in_year' => $totalDebitInYear,
            'total_debit_this_month' => $totalDebitThisMonth,
            'total_debit_this_week' => $totalDebitThisWeek,
            'total_debit_today' => $totalDebitToday,
        ];
    }
}