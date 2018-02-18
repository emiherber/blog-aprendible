<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Photo extends Model
{
    public $timestamps = false;
    protected $guarded = [];

    protected static function boot(){
        parent::boot();
        static::deleting(function($photo){
            Storage::delete($photo->url);
        });
    }
}
