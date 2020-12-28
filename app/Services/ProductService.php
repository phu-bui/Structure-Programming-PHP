<?php


namespace App\Services;


use App\Entities\Product;

class ProductService
{
    public function getListProduct() {
        return Product::with('quantity')->where('status', 1)->paginate(PER_PAGE);
    }
}
