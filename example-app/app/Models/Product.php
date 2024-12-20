<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    protected $table = 'product';

    public function tags() {
        return $this->belongsToMany(Tag::class, 'product_tags');
    }
}
