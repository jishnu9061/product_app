<?php

/**
 * Created By: JISHNU T K
 * Date: 2025/07/07
 * Time: 10:11:53
 * Description: ProductController.php
 */

namespace App\Http\Controllers;

use App\Services\ProductService;

use App\Models\Product;

use App\Exports\ProductsExport;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ProductController extends Controller
{
    /**
     * List all products
     * @return [type]
     */
    public function index(ProductService $productService)
    {
        $products = $productService->getAllProducts();
        return view('pages.product.index', compact('products'));
    }

    /**
     * Create a new product
     * @return [type]
     */
    public function create(ProductService $productService)
    {
        $brands = $productService->getAllBrands();
        return view('pages.product.create', compact('brands'));
    }

    /**
     * Store a new product
     * @return [type]
     */
    public function store(StoreProductRequest $request)
    {
        Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'brand_id' => $request->brand_id,
        ]);

        return redirect()->route('products.index');
    }

    /**
     * Edit a product
     * @param Product $product
     *
     * @return [type]
     */
    public function edit(Product $product, ProductService $productService)
    {
        $brands = $productService->getAllBrands();
        return view('pages.product.edit', compact('product', 'brands'));
    }

    /**
     * Update a product
     * @param UpdateProductRequest $request
     *
     * @return [type]
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        $product->update(['name' => $request->name, 'price' => $request->price, 'brand_id' => $request->brand_id]);
        return redirect()->route('products.index');
    }

    /**
     * product details
     * @param Product $product
     *
     * @return [type]
     */
    public function show(Product $product)
    {
        return view('pages.product.show', compact('product'));
    }

    public function exportExcel()
    {
        return Excel::download(new ProductsExport, 'products.xlsx');
    }

    /**
     * Delete a product
     * @param Product $product
     *
     * @return [type]
     */
    public function delete(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index');
    }
}
