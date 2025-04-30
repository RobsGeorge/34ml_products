<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use App\Http\Resources\ProductResource;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        //
        $query = Product::with(['options', 'defaultVariant', 'variants']);

        // Apply filters if they exist
        if ($request->has('filter')) {
            $filters = $request->filter;
            
            // Filter by average_rating
            if (isset($filters['average_rating'])) {
                $query->where('average_rating', '>=', $filters['average_rating']);
            }
            
            // Filter by max_price
            if (isset($filters['max_price'])) {
                $query->whereHas('variants', function ($q) use ($filters) {
                    $q->where('price', '<=', $filters['max_price']);
                });
            }
            
            // Filter by options
            if (isset($filters['options'])) {
                $optionValues = explode(',', $filters['options']);
                
                foreach ($optionValues as $optionValue) {
                    $query->whereHas('variants', function ($q) use ($optionValue) {
                        $q->where('option1', $optionValue)
                          ->orWhere('option2', $optionValue);
                    });
                }
            }
        }
        
        $products = $query->get();
        
        return ProductResource::collection($products);
    }

}