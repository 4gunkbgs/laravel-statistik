<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;          //facades DB
use Illuminate\Http\Request;

use App\Models\Anggota;                     //models anggota yang ngurusin tabel user
use App\Exports\AnggotaExport;
use App\Imports\AnggotaImport;
use Maatwebsite\Excel\Facades\Excel;

class HomeController extends Controller
{
   public function index()
   {
       //tabel statistik
       $anggota = Anggota::paginate(20);             
                    

       return view('/home', ['users' => $anggota]);    //tampilkan home.blade
   }

   public function edit($id)
   {
       $anggota = Anggota::find($id);           //ambil id yang diinputkan
       
       if(!$anggota){
           abort(404);
       }

       return view('edit', ['anggota' => $anggota]);  //tampilkan edit.blade.php
   }

   public function update($id, Request $request)            
   {
       $anggota = Anggota::find($id);
       
       if(!$anggota){
           abort(404);
       }

       $this->validate($request, 
        [         
            'skor'      =>  'required|numeric|min:0|max:100'
        ],
        [
            'skor.min'  =>  'Kolom Skor Hanya Bisa Diisi Angka 0-100',
            'skor.max'  =>  'Kolom Skor Hanya Bisa Diisi Angka 0-100'
        ]);

        $anggota->skor = $request->skor;        
        $anggota->save();

       return redirect('/')->with('status', 'Data Berhasil Edit');                //redirect lagi ke home
   }

   public function store(Request $request){     //untuk nyimpen
       
        $this->validate($request, 
        [            
            'skor'      =>  'required|numeric|min:1|max:100'
        ],
        [
            'skor.min'  =>  'Kolom Skor Hanya Bisa Diisi Angka 1-100',
            'skor.max'  =>  'Kolom Skor Hanya Bisa Diisi Angka 1-100',
            'skor.numeric' => 'Kolom Hanya Bisa Berisi Angka!'
        ]);
        
        $anggota = new Anggota;                 //buat objek baru        
        $anggota->skor = $request->skor;
        $anggota->save();

        return redirect('/')->with('status', 'Data Berhasil Tambah');               //redirect lagi ke home
   }

   public function delete($id)
   {
       $anggota = Anggota::find($id);       //cari id yang dipencet
       $anggota->delete();                  //delete id tersebut

       return redirect('/')->with('status', 'Data Berhasil Dihapus');                //redirect lagi ke home
   }

//    public function deleteAll()
//    {
//        $anggota = Anggota::all();           //cari id yang dipencet
//        $anggota->truncate();      

//        return redirect('/')->with('status', 'Data Berhasil Dihapus SEMUA');
//    }

    public function export(){

        return Excel::download(new AnggotaExport, time().'_'.'mahasiswa.xlsx');               
   }

   public function import(Request $request){

        $this->validate($request, 
        [            
            'file'      =>  'required|file|mimes:xlsx'
        ],
        [
            'file'      =>  'File Harus Berekstensi .xlsx',            
        ]);   

        $file = $request->file('file');       
        $namaFile = $file->getClientOriginalName();
        $file->move('Skor', $namaFile);
        
        $filexcel = Excel::import(new AnggotaImport, public_path('/Skor/'.$namaFile));               
        // try{
        // } catch (\Exception $ex){
        //     return back()->withErrors('HELO PEK');
        // }
        
        return redirect('/')->with('status', 'Data Berhasil Diimport!');
   }

   public function frekuensi(){                         
              
        //untuk tabel frekuensi
        $frekuensi = Anggota::select('skor', DB::raw('count(*) as frekuensi'))  //ambil skor, hitung banyak skor taruh di tabel frekuensi
                                    ->groupBy('skor')                              //urutkan sesuai skor
                                    ->get();             
        $totalfrekuensi = Anggota::count('skor'); 

         return view('frekuensi', ['frekuensi' => $frekuensi,
                                'totalfrekuensi' => $totalfrekuensi]);    //tampilkan frekuensi.blade
   }

   public function statistik(){

       $maxSkor = Anggota::max('skor');
       $minSkor = Anggota::min('skor');
       $rata2 = number_format(Anggota::average('skor'), 2) ;
       $totalskor = Anggota::sum('skor'); 
       
       return view ('statistik', ['max' => $maxSkor, 
                                'min' => $minSkor, 
                                'rata2' => $rata2,
                                'totalskor' => $totalskor]);
   }

   public function databergolong(){

        $maxSkor = Anggota::max('skor');
        $minSkor = Anggota::min('skor');
        $n = Anggota::count('skor');
        //mencari rentangan
        $rentangan = $maxSkor - $minSkor;

        //mencari kelas        
        $kelas = ceil(1 + 3.3 * log10 ($n));

        //menghitung interval
        $interval = ceil($rentangan/$kelas);        
        
        //set batas bawah dan batas atas
        $batasBawah = $minSkor;
        $batasAtas = 0;
        
        //data bergolong
        for($i = 0; $i < $kelas; $i++){
            $batasAtas = $batasBawah + $interval - 1;
            // $frekuensi[$i] = Anggota::where(function, $query){
            //     $query->select(DB::raw('SUM(frekuensi) as tabel1'))
            //             ->
            // }          
            $frekuensi[$i] = Anggota::select(DB::raw('count(*) as frekuensi, skor'))
                                    ->where([
                                        ['skor', '>=', $batasBawah],
                                        ['skor', '<=', $batasAtas],
                                    ])
                                    ->groupBy()                                                                                                    
                                    ->count();            
            $data[$i] = $batasBawah. " - ". $batasAtas;                                                          
            $batasBawah = $batasAtas + 1;
        }
                

        return view ('databergolong', ['data' => $data,
                                        'frekuensi' => $frekuensi,
                                        'batasAtas' => $batasAtas,
                                        'batasBawah' => $batasBawah,
                                        'kelas' => $kelas,
                                        'interval' => $interval,
                                        'rentangan' => $rentangan,                                        
                                        ]);
   }
}