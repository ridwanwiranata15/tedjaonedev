<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\HouseResource;
use App\Models\House;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class HouseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $houses = House::with(['categories', 'cities'])
            ->when(
                request('search'),
                fn($q) =>
                $q->where('name', 'like', '%' . request('search') . '%')
            )
            ->latest()
            ->paginate(5)
            ->appends(request()->only('search'));
        return new HouseResource(true, 'List data rumah', $houses);
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
            "name" => 'required',
            "thumbnail" => 'required',
            "about" => 'required',
            "price" => 'required',
            "bedroom" => 'required',
            "bathroom" => 'required',
            "certificate" => 'required',
            "electric" => 'required',
            "building_area" => 'required',
            "land_area" => 'required',
            "category_id" => 'required',
            "city_id" => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $thumbnail = $request->file('thumbnail');
        $thumbnail->storeAs('houses', $thumbnail->hashName(), 'public');
        $house = House::create([
            "name" => $request->name,
            "slug" => Str::slug($request->name, '-'),
            "thumbnail" => $thumbnail->hashName(),
            "about" => $request->about,
            "price" => $request->price,
            "bedroom" => $request->bedroom,
            "bathroom" => $request->bathroom,
            "certificate" => $request->certificate,
            "electric" => $request->electric,
            "building_area" => $request->building_area,
            "land_area" => $request->land_area,
            "category_id" => $request->category_id,
            "city_id" => $request->city_id
        ]);
        if ($house) {
            return new HouseResource(true, 'Data rumah baru berhasil di tambahkan', $house);
        }
        return new HouseResource(false, 'Data rumah baru gagal di tambahkan', $house);
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
    public function update(House $house, Request $request)
    {
        $validator = Validator::make($request->all(), [
            "name" => 'required',
            "slug" => 'required',
            "thumbnail" => 'required',
            "about" => 'required',
            "price" => 'required',
            "bedroom" => 'required',
            "bathroom" => 'required',
            "certificate" => 'required',
            "electric" => 'required',
            "building_area" => 'required',
            "land_area" => 'required',
            "category_id" => 'required',
            "city_id" => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $thumbnail = $request->file('thumbnail');
        $thumbnail->storeAs('houses', $thumbnail->hashName(), 'public');
        $house->update([
            "name" => $request->name,
            "slug" => Str::slug($request->name, '-'),
            "thumbnail" => $thumbnail->hashName(),
            "about" => $request->about,
            "price" => $request->price,
            "bedroom" => $request->bedroom,
            "bathroom" => $request->bathroom,
            "certificate" => $request->certificate,
            "electric" => $request->electric,
            "building_area" => $request->building_area,
            "land_area" => $request->land_area,
            "category_id" => $request->category_id,
            "city_id" => $request->city_id
        ]);
        return new HouseResource(true, 'Data rumah baru berhasil di ubah', $house);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(House $house)
    {
        $house->delete();
        return new HouseResource(true, 'Data rumah baru berhasil di hapus', $house);
    }
}
