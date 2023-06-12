<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\project;
use App\Models\Postingan;
use App\Models\projectTeams;
use App\Models\projectTask;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Auth;

class dashboardController extends Controller
{
    public function index()
    {
        $myProject = projectTeams::where("user_id", auth()->user()->id)->get();
        $data = project::whereIn("id", $myProject->pluck("project_id"))->get();
        $projectTasks = projectTask::with([
            "project" => function ($query) {
                $query->select("id", "project_name");
            }
        ])->where("user_id",Auth::user()->id )->get();
        $meta["project_count"] = count($data);
        $meta["task"] = $projectTasks;
        $meta["proses"] = projectTask::where("user_id",Auth::user()->id)->where("finish",0)->get();
        $meta["taskSelesai"] = projectTask::where("user_id",Auth::user()->id)->where("finish",1)->get();

        if(count($meta["task"]) == 0  ){
            $meta["persentasi_selesai"] = 0;
        }else{
            $meta["persentasi_selesai"] = round((count($meta["taskSelesai"]) / count($meta["task"]) * 100),1);
        }
        return view('pages.dashboard',compact("meta"));
    }
}