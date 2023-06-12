<?php

namespace App\Http\Controllers;

use App\Models\projectTask;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectTaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $post_id = $request->post_id;
        $projectTasks = projectTask::where("id_post", $post_id)->get();
        return response()->json($projectTasks);
    }

    public function getByProjectId(Request $request){
        $project_id = $request->project_id;
        $projectTasks = projectTask::where("project_id", $project_id)->get();
        return response()->json($projectTasks);
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
        $data = [
            "user_id" => Auth::user()->id,
            "id_post" => $request->id_post,
            "project_id"=>$request->project_id,
            "task" => $request->task,
            "finish" => false,
            "deadline" => null
        ];
        $create = projectTask::create($data);
        if ($create) {
            return response()->json([
                "status" => true,
                "message" => "Tugas berhasil ditambahkan",
            ]);
        } else {
            return response()->json([
                "status" => false,
                "message" => "Tugas gagal ditambahkan",
            ]);
        }
    }

    public function check(Request $request)
    {
        $id = $request->id;
        $task = projectTask::find($id);
        if ($task->finish == false) {
            $task->finish = true;
        } else {
            $task->finish = false;
        }
        $result = $task->save();
        if ($result) {
            return response()->json([
                "status" => true,
                "message" => "Tugas selesai",
                "id_post" => $task->id_post
            ]);
        } else {
            return response()->json([
                "status" => false,
                "message" => "Gagal update data",
                "id_post" => $task->id_post
            ]);
        }

    }
    /**
     * Display the specified resource.
     */
    public function show(projectTask $projectTask)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(projectTask $projectTask)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, projectTask $projectTask)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $task = projectTask::find($request->id);
        $delete = $task->delete();
        if ($delete) {
            return response()->json([
                "status" => true,
                "message" => "Tugas berhasil dihapus"
            ]);
        } else {
            return response()->json([
                "status" => false,
                "message" => "Gagal hapus data"
            ]);
        }
    }
}