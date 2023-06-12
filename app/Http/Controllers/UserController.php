<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
class userController extends Controller
{
    public function index()
    {
        if ($user = Auth::user()) {
            if ($user->role == 'admin') {

            } elseif ($user->role == 'user') {
                return redirect()->route('dashboard');
            }
        }
        return view('Auth.login');
    }

    public function Authentication(Request $request)
    {
        $data = $request->validate(
            [
                'email' => 'required | email ',
                'password' => 'required'
            ],
            [
                'email.required' => 'Email tidak boleh kosong',
                'password.required' => 'Password tidak boleh kosong'
            ]
        );

        $remember = $request->has("remember") ? true : false;
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();
            $user = Auth::user();

            return response()->json([
                'status' => true,
                'message' => 'Login Berhasil',
                'data' => $user
            ]);

        } else {

            return response()->json([
                'status' => false,
                'message' => 'Username atau Password tidak terdaftar',
                'data' => null
            ]);
        }
    }

    public function register(Request $request)
    {


        $data = $request->validate(
            [
                "name" => "required",
                "email" => "required|email|unique:users,email",
                "phone" => "required|numeric|unique:users,phone",
                "address" => "required",
                "password" => "required|min:8",
                "password_confirm" => "required|same:password"
            ],
            [
                "name.required" => "Nama tidak boleh kosong",
                "email.required" => "Email tidak boleh kosong",
                "email.email" => "Email tidak valid",
                "email.unique" => "Email sudah terdaftar",
                "phone.required" => "Nomor telepon tidak boleh kosong",
                "phone.numeric" => "Nomor telepon tidak valid",
                "phone.unique" => "Nomor telepon sudah terdaftar",
                "address.required" => "Alamat tidak boleh kosong",
                "password.required" => "Password tidak boleh kosong",
                "password.min" => "Password minimal 8 karakter",
                "password_confirm.required" => "Konfirmasi password tidak boleh kosong",
                "password_confirm.same" => "Konfirmasi password tidak sama dengan password"
            ]
        );


        $data["password"] = bcrypt($data["password"]);
        $data["description"] = "";
        $data["photo"] = "";

        $user = User::create($data);
        if ($user) {
            return response()->json([
                "status" => true,
                "message" => "Registrasi berhasil",
                "data" => $user
            ]);
        } else {
            return response()->json([
                "status" => false,
                "message" => "Registrasi gagal",
                "data" => null
            ]);
        }

    }
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }


    public function upload_picture(Request $request)
    {
        $user = User::find(Auth::user()->id);
        $file = $request->file('photo');
        $new_image_name = Auth::user()->name . '_avatar' .".jpg";
        if(Storage::exists("public/profile_images/" . $new_image_name)){
            Storage::delete("public/profile_images/" . $new_image_name);
        }
        // $upload = $file->storeAs('public/profile_images', $new_image_name);
        $upload = $file->move(public_path("image_user/"), $new_image_name);
        $user->update([
            'photo' => $new_image_name
        ]);
        if ($upload) {
            return response()->json([
                'status' => true,
                'message' => 'Upload Berhasil',
                'data' => $user
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Upload Gagal',
                'data' => null
            ]);
        }
    }

    public function user_profile($id)
    {
        $user = User::find($id);
        return view('pages.profile',compact('user'));

    }

    public function updateUser(Request $request){
        $user = User::find(Auth::user()->id);
        
        $update = $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' =>$request->phone,
            'address' => $request->address,
            'description' => $request->deskripsi
        ]);
        return redirect()->route('profile',$user->id);
    }

    public function editpassword(Request $request){
        $user = User::find(Auth::user()->id);
        $validator = $request->validate(
            [
                "password_lama" => "required",
                "password_baru" => "required|min:8",
                "password_confirm" => "required|same:password_baru"
            ],
            [
                "password_lama.required" => "Password lama tidak boleh kosong",
                "password_baru.required" => "Password baru tidak boleh kosong",
                "password_baru.min" => "Password baru minimal 8 karakter",
                "password_confirm.required" => "Konfirmasi password tidak boleh kosong",
                "password_confirm.same" => "Konfirmasi password tidak sama dengan password baru"
            ]
        );
        $update = $user->update([
            'password' => bcrypt($request->password_baru),
            ]);
        return redirect()->route('profile',$user->id);

    }


}