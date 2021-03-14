<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use App\Models\Anggota;

class HomeController extends Controller
{
   public function index()
   {
       $anggota = Anggota::all();

       return view('/home', ['users' => $anggota]);
   }

   public function edit($id)
   {
       $anggota = Anggota::find($id);
       
       if(!$anggota){
           abort(404);
       }

       return view('/edit', ['anggota' => $anggota]);
   }

   public function update($id, Request $request)
   {
       $anggota = Anggota::find($id);
       
       if(!$anggota){
           abort(404);
       }

        $anggota->nama = $request->nama;
        $anggota->skor = $request->skor;
        $anggota->save();

       return redirect('/');
   }

   public function store(Request $request){
       
        $anggota = new Anggota;
        $anggota->nama = $request->nama;
        $anggota->skor = $request->skor;
        $anggota->save();

        return redirect('/');
   }

   public function delete($id)
   {
       $anggota = Anggota::find($id);
       $anggota->delete();
       return redirect('/');
   }

}