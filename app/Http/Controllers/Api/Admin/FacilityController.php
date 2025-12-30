<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\FacilityResource;
use App\Models\Facility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;


class FacilityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $facilities = Facility::when(request()->search, function ($facilities) {
            $facilities = $facilities->where('name', 'like', '%' . request()->search . '%');
        })->latest()->paginate(5);
        $facilities->appends(['search' => request()->search]);
        return new FacilityResource(true, 'List cities', $facilities);
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
        $photo->storeAs('facilities', $photo->hashName(), 'public');
        $Facility = Facility::create(
            [
                'name' => $request->name,
                'photo' => $photo->hashName(),
                'slug' => Str::slug($request->name, '-')
            ]
        );
        if ($Facility) {
            return new FacilityResource(true, 'Data berhasil disimpan', $Facility);
        }
        return new FacilityResource(false, 'Data fasilitas gagal di simpan', null);
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
    public function update(Request $request, Facility $Facility)
    {
        $validator = Validator::make($request->all(), [
            'name'  => 'required',
            // 'photo' => 'required' // Catatan: Biasanya update foto dibuat opsional
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $Facility->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name, '-'), // Tambahkan Str::slug di sini
            // 'photo' => $request->photo, // Hati-hati, update foto biasanya perlu logic upload file
        ]);

        return new FacilityResource(true, 'Perubahan data fasilitas berhasil dilakukan', $Facility);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Facility $Facility)
    {
         if($Facility->delete()){
            return new FacilityResource(true, 'Penghapusan data fasilitas berhasil dilakukan', $Facility);
        }
        return new FacilityResource(false, 'Perubahan data fasilitas gagal dilakukan', $Facility);
    }
}
