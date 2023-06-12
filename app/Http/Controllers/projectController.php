<?php

namespace App\Http\Controllers;

use App\Models\Postingan;
use App\Models\project;
use App\Models\projectTeams;
use App\Models\projectTask;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Crypt;


class projectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // menampilkan halaman daftar projek
        return view("pages.project");
    }

    public function MyProject()
    {
        // mengambil project kita
        $myProject = projectTeams::where("user_id", auth()->user()->id)->get();
        $data = project::whereIn("id", $myProject->pluck("project_id"))->get();
        
        $result = [];
        foreach($data as $project){
            $temp["project_hash"] = Crypt::encrypt($project->id);
            $temp["project_detail"] = $project;
            $team = projectTeams::where("project_id",$project->id)->limit(5)->get();
            $temp["project_task"] = projectTask::where("project_id",$project->id)->count();
            $temp["project_post"] = Postingan::where("id_project",$project->id)->count();
            $temp["team"] = [];
            foreach($team as $user){
                // get data id user
                $user_get = User::where("id",$user->user_id)->first();
                $temp["team"][] = [
                    "id"=>$user_get->id,
                    "name"=>$user_get->name,
                    "image"=>$user_get->photo,
                    "email"=>$user_get->email
                ];
                // user get data
            }
            $result[] = $temp;
        }
        
        return response()->json($result);
    }

    public function join(Request $request)
    {
        $data = $request->all();
        $project = project::where("invite_code", $data["projectcode"])->first();
        if ($project != null) {
            $userHasJoin = projectTeams::where("project_id", $project->id)->where("user_id", auth()->user()->id)->first();
            if ($userHasJoin) {
                return response()->json([
                    "status" => false,
                    "message" => "Anda sudah bergabung dengan projek ini",
                    "data" => null
                ]);
            } else {

                $join = projectTeams::create([
                    "project_id" => $project->id,
                    "user_id" => auth()->user()->id,
                    "is_stake_holder" => false,
                ]);


                if ($join) {
                    return response()->json([
                        "status" => true,
                        "message" => "Berhasil bergabung dengan projek",
                        "data" => $join
                    ]);
                } else {
                    return response()->json([
                        "status" => false,
                        "message" => "Gagal bergabung dengan projek",
                        "data" => null
                    ]);
                }
            }
        } else {
            return response()->json([
                "status" => false,
                "message" => "Projek tidak ditemukan",
                "data" => null
            ]);

        }
    }

    public function invite(Request $request)
    {
        $project = project::where("invite_code", $request->projectCode)->first();

        if ($project != null) {
            $userHasJoin = projectTeams::where("project_id", $project->id)->where("user_id", auth()->user()->id)->first();
            if ($userHasJoin) {
                return response()->json([
                    "status" => false,
                    "message" => "Anda sudah bergabung dengan projek ini",
                    "data" => null
                ]);
            } else {

                $join = projectTeams::create([
                    "project_id" => $project->id,
                    "user_id" => auth()->user()->id,
                    "is_stake_holder" => false,
                ]);


                if ($join) {
                    return response()->json([
                        "status" => true,
                        "message" => "Berhasil bergabung dengan projek",
                        "data" => $join
                    ]);
                } else {
                    return response()->json([
                        "status" => false,
                        "message" => "Gagal bergabung dengan projek",
                        "data" => null
                    ]);
                }
            }

        } else {
            return response()->json([
                "status" => false,
                "message" => "Projek tidak ditemukan",
                "data" => null
            ]);
        }


    }

    public function project_detail(String $id)
    {
        
        $id = decrypt($id);
        $projectData = project::where('id',$id)->first();
  
        return view("pages.detail_project",['project'=> $projectData]);
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
            "project_name" => "required|string|max:100",
            "project_description" => "nullable|string",
            "project_image" => "nullable|image|mimes:jpg,png,jpeg|max:2048"
        ]);

        $data = $request->all();
        $randomString = Str::random(4);
        while (project::where('invite_code', $randomString)->exists()) {
            $randomString = Str::random(4);
        }
        $data["invite_code"] = $randomString;
        $data["author"] = auth()->user()->id;


        if ($validator->fails()) {
            return response()->json([
                "status" => false,
                "message" => "Project gagal dibuat" + $validator->errors(),
                "data" => $validator->errors()
            ]);
        } else {
            $query = project::create($data);
            $projectTeams = projectTeams::create([
                "project_id" => $query->id,
                "user_id" => auth()->user()->id,
                "is_stake_holder" => true,
            ]);
            if ($query && $projectTeams) {
                return response()->json([
                    "status" => true,
                    "message" => "Project berhasil dibuat",
                    "data" => $query
                ]);
            } else {
                return response()->json([
                    "status" => false,
                    "message" => "Project gagal dibuat " + $query->errors(),
                    "data" => null
                ]);
            }
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(project $project)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(project $project)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, project $project)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(project $project)
    {
        //
    }
}