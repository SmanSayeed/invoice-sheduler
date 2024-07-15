<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'email', 'address', 'phone', 'payment_due_date', 'per_day_per_device_cost', 'vat_slab', 'gbs_info', 'discount_eligibility', 'valuable_client_status'];

    public function devices()
    {
        return $this->hasMany(Device::class);
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }
}


