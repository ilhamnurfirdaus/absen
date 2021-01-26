<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Absen;

class AbsenGuruController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('admin');
        // $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $absens = Absen::select('*');

        $search_filter = $request->search_filter;
        $search_tanggal = $request->search_tanggal;

        if($search_filter != null) {
            $absens = $absens->where('users.name', 'like', '%'.$search_filter.'%');
        }

        if($search_tanggal != null) {
            $absens = $absens->where('absens.tanggal', 'like', $search_tanggal);
        }

        $absens = $absens->leftJoin('users', 'absens.user_id', '=', 'users.id')
                        ->select('absens.*', 'users.name', 'users.description as users_description');

        $absens = $absens->where('users.role', '=', 'guru');

        $absens = $absens->orderBy("absens.created_at", "DESC")->paginate(5);

        return view('admin.absen.guru', compact('absens', 'search_filter'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
