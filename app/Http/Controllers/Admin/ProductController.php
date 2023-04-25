<?php

namespace App\Http\Controllers\Admin;

use App\Exports\ProductsExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductFormRequest;
use App\Imports\ProductsImport;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImages;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('admin.products.index', compact('products'));
    }
    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }
    public function store(ProductFormRequest $request)
    {
        $validateData = $request->validated();
        $category = Category::findOrFail($validateData['category_id']);
        $product = $category->products()->create([
            'category_id' => $validateData['category_id'],
            'name' => $validateData['name'],
            'slug' => Str::slug($validateData['slug']),
            'description' => $validateData['description'],
            'original_price' => $validateData['original_price'],
            'selling_price' => $validateData['selling_price'],
            'status' => $request->status == true ? '1' : '0',
            'quantity' => $validateData['quantity'],
        ]);
        if ($request->hasFile('image')) {
            $uploadPath = 'uploads/products/';
            $counter = 1;
            foreach ($request->file('image') as $imageFile) {
                $extention = $imageFile->getClientOriginalExtension();
                $filename = time().$counter++.'.'.$extention;
                $imageFile->move($uploadPath, $filename);
                $imagePathName = $uploadPath . $filename;

                $product->productImages()->create([
                    'product_id' => $product->id,
                    'image' => $imagePathName
                ]);
            }
        }
        return redirect('/admin/products')->with('message', 'Product Added Successfully..!');
    }
    public function edit(int $product_id)
    {
        $product = Product::findOrFail($product_id);
        $categories = Category::all();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(ProductFormRequest $request, int $product_id)
    {
        $validateData = $request->validated();
        $product = Category::findOrFail($validateData['category_id'])
            ->products()->where('id', $product_id)->first();
        if ($product) {
            $product->update([
                'category_id' => $validateData['category_id'],
                'name' => $validateData['name'],
                'slug' => Str::slug($validateData['slug']),
                'description' => $validateData['description'],
                'original_price' => $validateData['original_price'],
                'selling_price' => $validateData['selling_price'],
                'status' => $request->status == true ? '1' : '0',
                'quantity' => $validateData['quantity'],
            ]);
            if ($request->hasFile('image')) {
                $uploadPath = 'uploads/products/';
                $counter = 1;
                foreach ($request->file('image') as $imageFile) {
                    $extention = $imageFile->getClientOriginalExtension();
                    $filename = time() . $counter++ . '.' . $extention;
                    $imageFile->move($uploadPath, $filename);
                    $imagePathName = $uploadPath . $filename;

                    $product->productImages()->create([
                        'product_id' => $product->id,
                        'image' => $imagePathName
                    ]);
                }
            }

            return redirect('admin/products')->with('message', 'Product Updated successfully..!');

        } else {
            return redirect('admin/products')->with('message', 'No such Product Found..!');
        }
    }

    public function deleteImage(int $product_image_id)
    {
        $productImage = ProductImages::findOrFail($product_image_id);
        if(File::exists($productImage->image)) {
            File::delete($productImage->image);
        }
        $productImage->delete();
        return redirect()->back()->with('message', 'Product Image Deleted..!');
    }

    public function destroy(int $product_id)
    {
        $product = Product::findOrFail($product_id);
        if ($product->productImages) {
            foreach ($product->productImages as $image) {
                if (File::exists($image->image)) {
                    File::delete($image->image);
                }
            }
        }
        $product->delete();
        return redirect()->back()->with('message', 'Product Deleted Successfully..!');
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function export() 
    {
        return Excel::download(new ProductsExport, 'products.xlsx');
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function import() 
    {
        Excel::import(new ProductsImport,request()->file('file'));
        return back();
    }
}
