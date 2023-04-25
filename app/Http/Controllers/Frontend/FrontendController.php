<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Slider;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index()
    {
        $sliders = Slider::where('status', 1)->get();
        $trendingProducts = Product::where('status', '1')->latest()->take(15)->get();
        return view('frontend.index', compact('sliders', 'trendingProducts'));
    }

    public function categories()
    {
        $categories = Category::where('status', '1')->get();
        return view('frontend.collections.category.index', compact('categories'));
    }

    public function products($category_name)
    {
        $category = Category::where('name', $category_name)->first();
        if ($category) {
            $products = $category->products()->get();
            return view('frontend.collections.products.index', compact('products', 'category'));
        } else {
            redirect()->back();
        }
    }

    public function productsView(string $category_name, string $product_slug)
    {
        $category = Category::where('name', $category_name)->first();
        if ($category) {
            $product = $category->products()->where('slug', $product_slug)->where('status', '1')->first();
            if ($product) {
                return view('frontend.collections.products.view', compact('category', 'product'));
            } else {
                redirect()->back();
            }
        } else {
            redirect()->back();
        }
    }

    public function searchProducts(Request $request)
    {
        if ($request->search) {
            $searchProducts = Product::where('name', 'LIKE', '%' . $request->search . '%')->latest()->paginate(2);
            if ($searchProducts) {
                return view('frontend.pages.search', compact('searchProducts'));
            } else {
                return $this->dispatchBrowserEvent('message', [
                    'text' => 'No Products Match..!',
                    'type' => 'warning',
                    'status' => 301,
                ]);
            }
        } else {
            return redirect()->back()->with('message', 'No Products Match..!');
        }
    }

}
