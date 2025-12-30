<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\BankResource;
use App\Models\Bank;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;


class BankController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $banks = Bank::when(request()->search, function ($banks) {
            $banks = $banks->where('name', 'like', '%' . request()->search . '%');
        })->latest()->paginate(5);
        $banks->appends(['search' => request()->search]);
        return new BankResource(true, 'List cities', $banks);
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
        $photo->storeAs('banks', $photo->hashName(), 'public');
        $bank = Bank::create(
            [
                'name' => $request->name,
                'photo' => $photo->hashName(),
                'slug' => Str::slug($request->name, '-')
            ]
        );
        if ($bank) {
            return new BankResource(true, 'Data berhasil disimpan', $bank);
        }
        return new BankResource(false, 'Data Kota gagal di simpan', null);
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
    public function update(Request $request, Bank $bank)
    {
        $validator = Validator::make($request->all(), [
            'name'  => 'required',
            // 'photo' => 'required' // Catatan: Biasanya update foto dibuat opsional
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $bank->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name, '-'), // Tambahkan Str::slug di sini
            // 'photo' => $request->photo, // Hati-hati, update foto biasanya perlu logic upload file
        ]);

        return new BankResource(true, 'Perubahan data kota berhasil dilakukan', $bank);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Bank $bank)
    {
         if($bank->delete()){
            return new BankResource(true, 'Penghapusan data kota berhasil dilakukan', $bank);
        }
        return new BankResource(false, 'Perubahan data kota gagal dilakukan', $bank);
    }
}
