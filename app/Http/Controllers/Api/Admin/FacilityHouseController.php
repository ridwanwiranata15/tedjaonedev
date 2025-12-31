<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\HouseResource;
use App\Models\Facility;
use Illuminate\Http\Request;
use App\Models\FacilityHouse;
use Illuminate\Support\Facades\Validator;

class FacilityHouseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    $facilityhouse = FacilityHouse::with(['house', 'facility'])
        ->when(request('search'), function ($q) {
            $q->where('house_id', request('search'));
        })
        ->latest()
        ->paginate(5)
        ->appends(request()->only('search'));

    return response()->json([
        'status' => true,
        'message' => 'List data fasilitas rumah',
        'data' => $facilityhouse
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
            "house_id" => 'required',
            "facility_id" => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $facilityhouse = FacilityHouse::create([
            'house_id' => $request->house_id,
            'facility_id' => $request->facility_id
        ]);
        if($facilityhouse){
            return new HouseResource(true, 'fasilitas baru berhasil di tambahkan', $facilityhouse);
        }
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
    public function update(FacilityHouse $facilityHouse, Request $request)
    {
        $validator = Validator::make($request->all(), [
            "house_id" => 'required',
            "facility_id" => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $facilityHouse->update([
            'house_id' => $request->house_id,
            'facility_id' => $request->facility_id
        ]);
        if($facilityHouse){
             return new HouseResource(true, 'fasilitas berhasil di ubah', $facilityHouse);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FacilityHouse $facilityHouse)
    {
        $facilityHouse->delete();
          return new HouseResource(true, 'fasilitas dari rumah ini berhasil di hapus', $facilityHouse);
    }
}
