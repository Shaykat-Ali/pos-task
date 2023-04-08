<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = ['supplier_id','category_id','unit_id','product_name'];

    public function supplier(){
        return $this->belongsTo(Supplier::class);
   }
   public function category(){
        return $this->belongsTo(Category::class);
   }
   public function unit(){
        return $this->belongsTo(Unit::class);
   }
}
