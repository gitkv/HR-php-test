<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductPriceUpdateRequest;
use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Http\Response;
use Illuminate\View\View;

class ProductController extends Controller
{
    /**
     * @var ProductService
     */
    protected $service;

    /**
     * ProductController constructor.
     * @param ProductService $service
     */
    public function __construct(ProductService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        $products = Product::orderByRaw('LENGTH(name) asc')->with('vendor')->paginate(config('app.paginate_size'));

        return view('products.index', compact('products'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ProductPriceUpdateRequest $request
     * @param Product $product
     * @return Response
     */
    public function update(ProductPriceUpdateRequest $request, Product $product)
    {
        $product = $this->service->update($product, $request->validated());

        return $product;
    }
}
