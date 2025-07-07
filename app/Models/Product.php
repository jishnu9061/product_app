<?php

/**
 * Created By: JISHNU T K
 * Date: 2025/07/07
 * Time: 09:57:09
 * Description: Product.php
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = ['name', 'price', 'brand_id'];

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public static function getTableName()
    {
        return with(new static)->getTable();
    }
}
