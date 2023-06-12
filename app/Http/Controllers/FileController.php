<?php

namespace App\Http\Controllers;

use App\Models\file;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function uploadFile(Request $request)
    {
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = $file->getClientOriginalName();
            $file->storeAs("public/attaches",Auth::user()->id."_".$fileName);
            return Auth::user()->id."_".$fileName;
        }

        // return response()->json(['message' => 'File berhasil diunggah.']);

    }

    public function deleteFile(Request $request){
        $filePath = 'public/attaches/' .Auth::user()->id."_".$request->fileName;
        Storage::delete($filePath);

        return "FIle berhasil dihapus!";
    }

    public function download($fileName){
        $filePath =  'storage/attaches/'.$fileName;
        $headers = [
            'Content-Type' => 'application/octet-stream',
        ];
        return response()->file($filePath, $headers);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(file $file)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(file $file)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, file $file)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(file $file)
    {
        //
    }
}