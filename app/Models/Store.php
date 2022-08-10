<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Store extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public function items() {
        return $this->hasMany(Item::class);
    }

    public function getCostValueAttribute() {
        return $this->items()->sum(DB::raw('(purchase_price * quantity)'));
    }

    public function getPotentialNetAttribute() {
        return $this->items()->sum(DB::raw('round( ( ( purchase_price * ( markup + 100.00 ) ) / 100 ) * quantity , 2)'));
    }

    public function getPotentialProfitAttribute() {
        return $this->items()->sum(DB::raw('round( ( ( purchase_price * markup ) / 100 ) * quantity , 2)'));
    }

    public static function boot() {
        parent::boot();

        static::deleting(function($store) {
            $store->items()->delete();
        });
    }
}
