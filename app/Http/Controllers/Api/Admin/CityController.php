<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Resources\Admin\CityResource;
use App\Models\City;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use Illuminate\Support\Facades\Validator;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Routing\Controllers\HasMiddleware;


class CityController extends Controller
{
    public static function middleware(): array
    {
        return [
            new Middleware(['permission:city.index'], only: ['index']),
            new Middleware(['permission:city.create'], only: ['store']),
            new Middleware(['permission:city.edit'], only: ['update']),
            new Middleware(['permission:city.delete'], only: ['destroy']),
        ];
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $cities = City::when(request()->search, function($cities) {
        //     $cities = $cities->where('name', 'like', '%' . request()->search . '%');
        // })->latest()->paginate(5);
        // $cities->appends(['search' => request()->search]);
        $city = City::with(['houses'])
        ->when(request('search'), function ($q) {
            $q->where('house_id', request('search'));
        })
        ->latest()
        ->paginate(5)
        ->appends(request()->only('search'));

    return response()->json([
        'status' => true,
        'message' => 'List data fasilitas rumah',
        'data' => $city
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
            'name'  => 'required',
            'photo' => 'required'
        ]);
        if($validator->fails()){
            return response()->json($validator->errors(), 422);
        }

        $photo = $request->file('photo');
        $photo->storeAs('cities', $photo->hashName(), 'public');
        $city = City::create(
            [
            'name' => $request->name,
            'photo' => $photo->hashName(),
            'slug' => Str::slug($request->name, '-')]
        );
        if($city){
            return new CityResource(true, 'Data berhasil disimpan', $city);
        }
        return new CityResource(false, 'Data Kota gagal di simpan', null);
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
    public function update(Request $request, City $city)
{
    $validator = Validator::make($request->all(), [
        'name'  => 'required',
        // 'photo' => 'required' // Catatan: Biasanya update foto dibuat opsional
    ]);

    if($validator->fails()){
        return response()->json($validator->errors(), 422);
    }

    $city->update([
        'name' => $request->name,
        'slug' => Str::slug($request->name, '-'), // Tambahkan Str::slug di sini
        // 'photo' => $request->photo, // Hati-hati, update foto biasanya perlu logic upload file
    ]);

    return new CityResource(true, 'Perubahan data kota berhasil dilakukan', $city);
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(City $city)
    {
        if($city->delete()){
            return new CityResource(true, 'Penghapusan data kota berhasil dilakukan', $city);
        }
        return new CityResource(false, 'Perubahan data kota gagal dilakukan', $city);
    }
}
