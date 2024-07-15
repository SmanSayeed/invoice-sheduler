<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceItem extends Model
{
    use HasFactory;
    protected $fillable = ['invoice_id', 'device_id', 'service', 'unit_cost', 'total_cost', 'number_of_days'];

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }

    public function device()
    {
        return $this->belongsTo(Device::class);
    }
}
