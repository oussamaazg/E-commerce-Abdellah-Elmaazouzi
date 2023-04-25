<?php

namespace App\Http\Livewire\Admin\Category;

use App\Models\Category;
use Illuminate\Support\Facades\File;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';


    public function deleteCategory($category_id)
    {
        $category = Category::where('id', $category_id)->first();
        $path = $category->image;
        if (File::exists($path)) {
            File::delete($path);
        }
        $category->delete();
        session()->flash('message', 'Category Deleted Successfully..!');
        $this->dispatchBrowserEvent('close-modal'); 
    }

    public function render()
    {
        $categories = Category::orderBy('id', 'ASC')->paginate(10);
        return view('livewire.admin.category.index', ['categories' => $categories]);
    }
}
