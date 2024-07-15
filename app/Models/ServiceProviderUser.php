<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// app/Models/ServiceProviderUser.php
class ServiceProviderUser extends Model
{
    use HasFactory;
    protected $fillable = ['company_name', 'address', 'logo', 'vat_number', 'kvk_number','email','password'];
    protected $hidden = ['password','remember_token'];
    protected $casts = ['email_verified_at' => 'datetime'];

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }
}

