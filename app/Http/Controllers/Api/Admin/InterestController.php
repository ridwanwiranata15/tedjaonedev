<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Interest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use phpDocumentor\Reflection\Types\Intersection;

class InterestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         $imagehouse = Interest::with(['houses', 'banks'])
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
                'message' => 'list interest',
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
        $interest = Interest::create([
            'house_id' => $request->house_id,
            'bank_id' => $request->bank_id,
            'interest' => $request->interest,
            'duration' => $request->duration
        ]);
        if ($interest) {
            return response()->json([
                'status' => true,
                'message' => 'tambah gambar berhasil di lakukan',
            ]);
        }
        return response()->json([
            'status' => false,
            'message' => 'tambah gambar berhasil di lakukan',
        ]);
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
    public function update(Request $request, Interest $interest)
    {
         $validator = Validator::make($request->all(), [
            'house_id' => 'required',
            'image' => 'image'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $interest->update([
            'house_id' => $request->house_id,
            'bank_id' => $request->bank_id,
            'interest' => $request->interest,
            'duration' => $request->duration
        ]);
        if ($interest) {
            return response()->json([
                'status' => true,
                'message' => 'tambah gambar berhasil di lakukan',
            ]);
        }
        return response()->json([
            'status' => false,
            'message' => 'tambah gambar berhasil di lakukan',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Interest $interest)
    {
        $interest->delete();
         return response()->json([
            'status' => false,
            'message' => 'interest berhasil di hapus',
        ]);
    }
}
