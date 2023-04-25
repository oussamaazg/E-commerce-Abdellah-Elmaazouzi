<?php

namespace App\Imports;

use App\Models\Product;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProductsImport implements ToCollection, ShouldAutoSize, WithHeadingRow
{
    use Importable;
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            $product = Product::create([
                'category_id' => $row['category_id'],
                'name' => $row['name'],
                'slug' => $row['slug'],
                'description' => $row['description'],
                'original_price' => $row['original_price'],
                'selling_price' => $row['selling_price'],
                'quantity' => $row['quantity'],
            ]);

            $product->category()->create([
                'name' => $row['category_name'],
                'description' => $row['category_description']
            ]);
        }
    }
}
