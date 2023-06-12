<?php

namespace App\Http\Controllers;

use App\Models\chat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data = chat::with(["user"=>function($query){
            $query->select("id","name","photo");
        }])->where("post_id",$request->id)->get();
        return response()->json($data);
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

        $chat = $request->all();
        $data = [
            "user_id" => Auth::user()->id,
            "post_id" => $chat["id_post"],
            "chat" => $chat["chat"],
        ];
        $create = chat::create($data);
        if ($create) {
            return response()->json([
                "status" => true,
                "message" => "Chat terkirim",
            ]);
        } else {
            return response()->json([
                "status" => true,
                "message" => "Chat terkirim",
            ]);
        }




    }

    /**
     * Display the specified resource.
     */
    public function show(chat $chat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(chat $chat)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, chat $chat)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(chat $chat)
    {
        //
    }
}