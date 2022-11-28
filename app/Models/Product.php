<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    protected $primaryKey = 'product_code';
    public $incrementing = false;
    protected $fillable =[
        'product_code',
        'description',
        'qty_on_hand',
        'unit_price',
        'created_by'
    ];
    public function getPriceAttribute(){
        return "$ ".number_format($this->unit_price, 2);
    }
}
