<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;          //facades DB
use Illuminate\Http\Request;

use App\Models\Anggota;                     //models anggota yang ngurusin tabel user

class HomeController extends Controller
{
   public function index()
   {
       $anggota = Anggota::all();             
       $maxSkor = Anggota::max('skor');
       $minSkor = Anggota::min('skor');
       $rata2 = number_format(Anggota::average('skor'),3);
       
       
       //untuk tabel frekuensi
       $frekuensi = Anggota::select('skor', DB::raw('count(*) as frekuensi'))  //ambil skor, hitung banyak skor taruh di tabel frekuensi
                                ->groupBy('skor')                              //urutkan sesuai skor
                                ->get();
       $totalskor = Anggota::sum('skor');              
       $totalfrekuensi = Anggota::count('skor');        //karena total frekuensi = banyaknya skor yang ada

       return view('/home', ['users' => $anggota,
                            'max' => $maxSkor, 
                            'min' => $minSkor, 
                            'rata2' => $rata2,
                            'frekuensi' => $frekuensi,
                            'totalskor' => $totalskor,
                            'totalfrekuensi' => $totalfrekuensi]);    //tampilkan home.blade
   }

   public function edit($id)
   {
       $anggota = Anggota::find($id);           //ambil id yang diinputkan
       
       if(!$anggota){
           abort(404);
       }

       return view('/edit', ['anggota' => $anggota]);  //tampilkan edit.blade.php
   }

   public function update($id, Request $request)            
   {
       $anggota = Anggota::find($id);
       
       if(!$anggota){
           abort(404);
       }

       $this->validate($request, 
        [
            'nama'      =>  'required|max:30',
            'skor'      =>  'required|numeric|min:0|max:100'
        ],
        [
            'skor.min'  =>  'Kolom Skor Hanya Bisa Diisi Angka 0-100',
            'skor.max'  =>  'Kolom Skor Hanya Bisa Diisi Angka 0-100'
        ]);

        $anggota->nama = $request->nama;    //tumpuk atribut tabel dengan yang diinput user
        $anggota->skor = $request->skor;        
        $anggota->save();

       return redirect('/');                //redirect lagi ke home
   }

   public function store(Request $request){     //untuk nyimpen
       
        $this->validate($request, 
        [
            'nama'      =>  'required|max:30',
            'skor'      =>  'required|numeric|min:0|max:100'
        ],
        [
            'skor.min'  =>  'Kolom Skor Hanya Bisa Diisi Angka 0-100',
            'skor.max'  =>  'Kolom Skor Hanya Bisa Diisi Angka 0-100'
        ]);
        
        $anggota = new Anggota;                 //buat objek baru
        $anggota->nama = $request->nama;        //simpen apa yang diinput user ke atribut tabel
        $anggota->skor = $request->skor;
        $anggota->save();

        return redirect('/');               //redirect lagi ke home
   }

   public function delete($id)
   {
       $anggota = Anggota::find($id);       //cari id yang dipencet
       $anggota->delete();                  //delete id tersebut

       return redirect('/');                //redirect lagi ke home
   }

}