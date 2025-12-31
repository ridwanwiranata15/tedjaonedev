<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\ImagesHouse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ImagesHouseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $imagehouse = ImagesHouse::with(['house'])
            ->when(
                request('search'),
                fn($q) =>
                $q->where('name', 'like', '%' . request('search') . '%')
            )
            ->latest()
            ->paginate(5)
            ->appends(request()->only('search'));
             return response()->json([
                'status' => true,
                'message' => 'tambah gambar berhasil di lakukan',
                'data' => $imagehouse
            ]);
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
            'house_id' => 'required',
            'image' => 'image'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $image = $request->file('image');
        $image->storeAs('houses', $image->hashName(), 'public');
        $imagehouse = ImagesHouse::create([
            'house_id' => $request->house_id,
            'image' => $image->hashName(),
        ]);
        if ($imagehouse) {
            return response()->json([
                'status' => true,
                'message' => 'tambah gambar berhasil di lakukan',
                'data' => $imagehouse
            ]);
        }
        return response()->json([
            'status' => false,
            'message' => 'tambah gambar gagal di lakukan',
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(ImagesHouse $imagesHouse)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ImagesHouse $imagesHouse) {}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ImagesHouse $imagesHouse)
    {
        $validator = Validator::make($request->all(), [
            'house_id' => 'required',
            'image' => 'image'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $image = $request->file('image');
        $image->storeAs('houses', $image->hashName(), 'public');
        $imagesHouse->update([
            'house_id' => $request->house_id,
            'image' => $image->hashName(),
        ]);
        return response()->json([
            'status' => true,
            'message' => 'data gambar rumah berhasil di ubah',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ImagesHouse $imagesHouse)
    {
        $imagesHouse->delete();
        return response()->json([
            'status' => true,
            'message' => 'data gambar rumah berhasil di hapus',
        ]);
    }
}
