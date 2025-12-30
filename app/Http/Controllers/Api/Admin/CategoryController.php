<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;


class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Categories = Category::when(request()->search, function ($Categories) {
        $Categories = $Categories->where('name', 'like', '%' . request()->search . '%');
        })->latest()->paginate(5);
        $Categories->appends(['search' => request()->search]);
        return new CategoryResource(true, 'List cities', $Categories);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'  => 'required',
            'photo' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $photo = $request->file('photo');
        $photo->storeAs('Categories', $photo->hashName(), 'public');
        $Category = Category::create(
            [
                'name' => $request->name,
                'photo' => $photo->hashName(),
                'slug' => Str::slug($request->name, '-')
            ]
        );
        if ($Category) {
            return new CategoryResource(true, 'Data berhasil disimpan', $Category);
        }
        return new CategoryResource(false, 'Data kategori gagal di simpan', null);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $Category)
    {
        $validator = Validator::make($request->all(), [
            'name'  => 'required',
            // 'photo' => 'required' // Catatan: Biasanya update foto dibuat opsional
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $Category->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name, '-'), // Tambahkan Str::slug di sini
            // 'photo' => $request->photo, // Hati-hati, update foto biasanya perlu logic upload file
        ]);

        return new CategoryResource(true, 'Perubahan data kategori berhasil dilakukan', $Category);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $Category)
    {
         if($Category->delete()){
            return new CategoryResource(true, 'Penghapusan data kategori berhasil dilakukan', $Category);
        }
        return new CategoryResource(false, 'Perubahan data kategori gagal dilakukan', $Category);
    }
}
