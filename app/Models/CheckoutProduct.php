<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CheckoutProduct extends Model
{
    use HasFactory;
    protected $table = "checkout_product";
    protected $fillable = ["product_id","checkout_id","quantity"];
    public $timestamps = false;
}
