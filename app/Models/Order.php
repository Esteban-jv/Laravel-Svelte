<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
// TODO: import available scope
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'status',
        'customer_id'
    ];

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class,'customer_id');
    }

    public function products()
    {
        return $this->morphToMany(Product::class,'productable')->withPivot('quantity');
    }

    public function getTotalAttribute()
    {
        return $this->products()
            //->withoutGlobalScope(AvailableScope::class)
            ->get()
            ->pluck('total')
            ->sum();
    }
}
