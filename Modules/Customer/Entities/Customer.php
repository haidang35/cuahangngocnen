<?php

namespace Modules\Customer\Entities;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Debit\Entities\Debit;
use Modules\Debit\Enums\DebitStatus;

class Customer extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'phone',
        'email',
        'address',
        'note',
        'avatar'
    ];

    protected static function newFactory()
    {
        return \Modules\Customer\Database\factories\CustomerFactory::new();
    }

    public function getCreatedAtAttribute($date)
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('H:i d-m-Y');
    }

    public function debits()
    {
        return $this->hasMany(Debit::class, 'customer_id', 'id');
    }

    public function scopeSearchKeyword($query, $keyword)
    {
        if (!$keyword) return $query;
        return $query->where('name', 'LIKE', '%' . $keyword . '%')
            ->orWhere('email', 'LIKE', '%' . $keyword . '%')
            ->orWhere('address', 'LIKE', '%' . $keyword . '%')
            ->orWhere('phone', 'LIKE', '%' . $keyword . '%');
    }

    public function getReportAttribute()
    {
        return (object)[
            'total_debit' => $this->debits->count(),
            'total_paid_debit' => $this->debits->where('status', DebitStatus::PAID)->count(),
            'total_out_of_date_debit' => $this->debits->where('status', DebitStatus::OUT_OF_DATE)->count(),
            'total_cancelled_debit' => $this->debits->where('status', DebitStatus::CANCEL)->count(),
            'total_processing_debit' => $this->debits->where('status', DebitStatus::PROCESSING)->count(),
        ];
    }
}
