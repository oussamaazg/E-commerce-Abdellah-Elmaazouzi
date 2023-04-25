<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SliderFormRequest;
use App\Models\Slider;
use Illuminate\Support\Facades\File;

class SliderController extends Controller
{
    public function index()
    {
        $sliders = Slider::all();
        return view('admin.slider.index', compact('sliders'));
    }

    public function create()
    {
        return view('admin.slider.create');
    }

    public function store(SliderFormRequest $request)
    {
        $validateData = $request->validated();
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time() . '.' . $ext;

            $file->move('uploads/sliders/', $filename);
            $validateData['image'] = "uploads/sliders/$filename";
        }
        $validateData['status'] = $request->status == true ? '1' : '0';

        Slider::create([
            'title' => $validateData['title'],
            'description' => $validateData['description'],
            'image' => $validateData['image'],
            'status' => $validateData['status'],
        ]);
        return redirect('/admin/sliders')->with('message', 'Slider Added Successfully..!');
    }

    public function edit(Slider $slider)
    {
        return view('admin.slider.edit', compact('slider'));
    }

    public function update(SliderFormRequest $request, Slider $slider)
    {
        $validatedData = $request->validated();

        if ($request->hasFile('image')) {
            $distination = $slider->image;
            if (File::exists($distination)) {
                File::delete($distination);
            }

            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time() . '.' . $ext;
            $file->move('uploads/sliders/', $filename);
            $validatedData['image'] = "uploads/sliders/$filename";
        }

        $validatedData['status'] = $request->status == true ? '1' : '0';
        Slider::where('id', $slider->id)->update([
            'title' => $validatedData['title'],
            'description' => $validatedData['description'],
            'image' => $validatedData['image'] ?? $slider->id,
            'status' => $validatedData['status'],
        ]);
        return redirect('admin/sliders')->with('message', 'Slider Updated Successfully..!');
    }

    public function destroy(Slider $slider)
    {
        if ($slider->count() > 0) {
            $path = $slider->image;
            if (File::exists($path)) {
                File::delete($path);
            }
            $slider->delete();
            return redirect('admin/sliders')->with('message', 'Slider Deleted Successfully..!');
        }
        return redirect('admin/sliders')->with('message', 'Somthing Went Wrong..!');
    }
}
