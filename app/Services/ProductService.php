<?php

/**
 * Created By: JISHNU T K
 * Date: 2025/07/07
 * Time: 11:18:11
 * Description: ProductService.php
 */

namespace App\Services;

use App\Models\Brand;
use App\Models\Product;

class ProductService
{
    /**
     * get all brands
     * @return [type]
     */
    public function getAllBrands()
    {
        return Brand::pluck('name', 'id');
    }

    /**
     * get all products with brands
     * @return [type]
     */
    public function getAllProducts()
    {
        return Product::with('brand')->get();
    }
}
