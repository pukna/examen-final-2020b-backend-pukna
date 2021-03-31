<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Supplier extends Model
{
    protected $fillable = ['name'];
    public static function boot()
    {
        parent::boot();
        static::creating(function ($article) {
            $article->registered_by = Auth::id();
        });
    }
    public function users()
    {
        return $this->belongsToMany('App\User')->withTimestamps();
    }
    public function products()
    {
        return $this->belongsToMany('App\Product')->as('producer')->withTimestamps();
    }




}
