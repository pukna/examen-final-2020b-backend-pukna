<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Product extends Model
{
    protected $fillable = ['name', 'code', 'price','status'];

    public static function boot()
    {
        parent::boot();
        static::creating(function ($product) {
            $product->user_id = Auth::id();
        });
    }

    public function suppliers()
    {
        return $this->belongsToMany('App\Supplier')->as('producer')->withTimestamps();
    }

}
