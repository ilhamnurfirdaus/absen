<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Absen;
use App\Rules\MatchOldPassword;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();
        $absens = Absen::select('*');

        $absens = $absens->where('user_id', '=', $user->id);

        $absens = $absens->orderBy("created_at", "DESC")->paginate(5);

        return view('home', compact('user', 'absens'));
        // return dd($absens);
    }

    // /**
    //  * Store a newly created resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @return \Illuminate\Http\Response
    // */

    public function store(Request $request)
    {
        $user = Auth::user();
        $absens = $request->all();
        
        // $user_id = $absens['user_id'];
        // $tanggal = $absens['tanggal'];
        // $waktu = $absens['waktu'];
        $description = $absens['description'];

        $data = new Absen;
        $data->user_id = $user->id;
        $data->tanggal = date("Y-m-d");
        $data->waktu = date("h:i:s");
        $data->description = $description;
        $data->save();

        Auth::logout();

        return back()->with('message', 'Data Created');
        // return dd($user->id);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'current_password' => ['required', new MatchOldPassword],
            'new_password' => ['required'],
            'new_confirm_password' => ['same:new_password'],
        ]);

        $user = $request->all();

        $new_password = $user['new_password'];

        $data = User::find($id);
        
        // if($password == null){
        //     $data->password = Hash::make('-');
        // } else {
        //     // $data->password = Hash::make($request->new_password);
        //     $data->password = Hash::make($password);
        // }

        // $data->password = Hash::make($request->new_password);
        $data->password = Hash::make($new_password);
        $data->save();

        return back()->with('message', 'Password successfully change');
    }

}
