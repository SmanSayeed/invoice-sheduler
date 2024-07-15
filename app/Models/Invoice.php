<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'service_provider_user_id',
        'invoice_number',
        'invoice_date',
        'due_date',
        'status',
        'unit_cost',
        'number_of_days',
        'total_cost',
        'footnote',
        'gbs_information'
    ];

    protected $dates = [
        'invoice_date',
        'due_date',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    // public function serviceProvider()
    // {
    //     return $this->belongsTo(ServiceProviderUser::class, 'service_provider_user_id');
    // }

    public function items()
    {
        return $this->hasMany(InvoiceItem::class);
    }
}
