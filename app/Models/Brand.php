<?php

/**
 * Created By: JISHNU T K
 * Date: 2025/07/07
 * Time: 09:54:16
 * Description: Brand.php
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;

    protected $table = 'brands';

    protected $fillable = ['name'];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public static function getTableName()
    {
        return with(new static)->getTable();
    }
}
