<?php

namespace Modules\Debit\Entities;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Customer\Entities\Customer;
use Modules\Debit\Enums\DebitStatus;

class Debit extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'customer_id',
        'amount',
        'status',
        'payment_date',
        'deadline',
        'note',
        'created_at',
    ];


    protected $casts = [
        'status' => DebitStatus::class,
    ];


    protected static function newFactory()
    {
        return \Modules\Debit\Database\factories\DebitFactory::new();
    }

    public function getCreatedAtAttribute($date)
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('H:i d-m-Y');
    }

    public function getFormattedAmountAttribute()
    {
        return number_format($this->amount, 0) . ' VND';
    }

    public function getDeadlineAttribute($date)
    {
        if ($date) {
            return Carbon::createFromFormat('Y-m-d', $date)->format('d-m-Y');
        }
    }

    public function getPaymentDateAttribute($date)
    {
        if ($date) {
            return Carbon::createFromFormat('Y-m-d', $date)->format('d-m-Y');
        }
    }

    public function getUpdatedAtAttribute($date)
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('H:i d-m-Y');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }

    public function getFormatStatusAttribute()
    {
        $type = '';
        $text = '';
        switch ($this->status) {
            case DebitStatus::PAID:
                $type = 'btn-success';
                $text = 'Đã trả';
                break;
            case DebitStatus::PROCESSING:
                $type = 'btn-info';
                $text = 'Chưa trả';
                break;
            case DebitStatus::OUT_OF_DATE:
                $type = 'btn-warning';
                $text = 'Hủy bỏ';
                break;
            case DebitStatus::CANCEL:
                $type = 'btn-danger';
                $text = 'Quá hạn trả ';
                break;
            default:
                break;
        }
        return '<button class="btn btn-sm ' . $type . '">' . $text . '</button>';
    }

    public function scopeSearchKeyword($query, $keyword)
    {
        if (!$keyword) return $query;
        $keyword = str_replace([',', '.', 'VND'], '', $keyword);
        return $query
            ->whereHas('customer', function ($query) use ($keyword) {
                $query->where('name', 'LIKE', '%' . $keyword . '%')
                    ->orWhere('phone', 'LIKE', '%' . $keyword . '%');
            })
            ->orWhere('amount', 'LIKE', '%' . $keyword . '%');
    }

    public function scopeSearchByCreatedAt($query, $date)
    {
        if (!$date) return $query;
        return $query->whereDate('created_at', $date);
    }
}
