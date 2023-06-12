<?php

namespace App\Http\Controllers;

use App\Models\Postingan;
use App\Models\file;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostinganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
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
        $data["konten"] = $request->konten;
        $data["id_project"] = $request->project_id;
        $data["id_user"] = Auth::user()->id;
        $fileList = json_decode($request->file_list);
        
        $create = Postingan::create($data);
        
        foreach ($fileList as $file) {
            file::create([
                "id_user" =>$data["id_user"],
                "id_postingan" =>$create->id,
                "file_name"=>$file
            ]);
        }

        if($create){
            return response()->json([
                "status" => true,
                "message" => "Berhasil Posting",
                "data" => null
            ]);
        }else{
            return response()->json([
                "status" => false,
                "message" => "PGagal Posting",
                "data" => null
            ]);
        }
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Postingan $postingan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Postingan $postingan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Postingan $postingan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $postingan = Postingan::destroy($id);
        return true;
    }
}
