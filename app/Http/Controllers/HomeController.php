<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;          //facades DB
use Illuminate\Http\Request;

use App\Models\Anggota;                     //models anggota yang ngurusin tabel user
use App\Models\ZTabel;
use App\Models\Moment;
use App\Models\Biserial;
use App\Exports\AnggotaExport;
use App\Exports\MomentExport;
use App\Exports\BiserialExport;
use App\Imports\AnggotaImport;
use App\Imports\MomentImport;
use App\Imports\BiserialImport;

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
            'file'      =>  'required|file|mimes:xlsx,csv'
        ],
        [
            'file'      =>  'File Harus Berekstensi .xlsx atau .csv',            
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
       $rata2 = number_format(Anggota::average('skor'), 2);
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
    

   public function chikuadrat(){

        $maxSkor = Anggota::max('skor');
        $minSkor = Anggota::min('skor');
        //$n = f0 = banyak skor/total frekuensi
        $n = Anggota::count('skor');
        $rata2 = number_format(Anggota::average('skor'), 2);

        //function standar deviasi
        function std_deviation($my_arr){
            $no_element = count($my_arr);
            $var = 0.0;
            $avg = array_sum($my_arr)/$no_element;
            foreach($my_arr as $i)
                {
                    $var += pow(($i - $avg), 2);
                }
            return (float)sqrt($var/$no_element);
        }

        //function desimal
        function desimal($nilai){
            if($nilai<0){
                $des = substr($nilai,0,4);
            } else {
                $des = substr($nilai,0,3);
            }
            return $des;
        }

        //function label
        function label($nilai){
            if($nilai<0){
                $str1 = substr($nilai,4,1);
            } else {
                $str1 = substr($nilai,3,1);
            }

            switch($str1){
                case '0': 
                    $sLabel = 'nol';
                    break;
                case '1': 
                    $sLabel = 'satu';
                    break;
                case '2': 
                    $sLabel = 'dua';
                    break;
                case '3': 
                    $sLabel = 'tiga';
                    break;
                case '4': 
                    $sLabel = 'empat';
                    break;
                case '5': 
                    $sLabel = 'lima';
                    break;
                case '6': 
                    $sLabel = 'enam';
                    break;
                case '7': 
                    $sLabel = 'tujuh';
                    break;
                case '8': 
                    $sLabel = 'delapan';
                    break;
                case '9': 
                    $sLabel = 'sembilan';
                    break;
                default: $sLabel = 'Tidak ada field';
            }
            
            return $sLabel;
        }

        //ambil nilai skor
        $anggota = Anggota::select('skor')->get();

        //masukin skor ke dalam array biar bsa dipakek sama functionnya
        $i = 0;
        foreach ($anggota as $a){
            $arraySkor[$i] = $a->skor;
            $i++;            
        }                         
           
        //standar deviasi dari seluruh skor
        $SD = number_format(std_deviation($arraySkor), 2);                            
        
        //mencari rentangan
        $rentangan = $maxSkor - $minSkor;

        //mencari kelas        
        $kelas = ceil(1 + 3.3 * log10 ($n));

        //menghitung interval
        $interval = ceil($rentangan/$kelas);        
        
        //set batas bawah dan batas atas
        $batasBawah = $minSkor;
        $batasAtas = 0;
        
        //data chi
        $totalchi = 0;
        for($i = 0; $i < $kelas; $i++){
            //menghitung batas bawah
            $batasBawahBaru[$i] = $batasBawah - 0.5;            
            
            $batasAtas = $batasBawah + $interval - 1;

            //menghitung batas atas
            $batasAtasBaru[$i] = $batasAtas + 0.5;
                                    
            //menghitung atas dan bawah z
            $zBawah[$i] = number_format(($batasBawahBaru[$i]- $rata2)/$SD, 2);
            $zAtas[$i] = number_format(($batasAtasBaru[$i]- $rata2)/$SD, 2);                       

            //menghitung z tabel atas dan bawah
            $cariDesimalBawah = desimal($zBawah[$i]);
            $cariDesimalAtas = desimal($zAtas[$i]);

            $labelDesimalBawah = label($zBawah[$i]);            
            $labelDesimalAtas= label($zAtas[$i]);                                                           

            $zTabelBawah = ZTabel::where('z', '=', $cariDesimalBawah)->get(); 
            $zTabelAtas = ZTabel::where('z', '=', $cariDesimalAtas)->get();                     
            $zTabelBawahFix[$i] = $zTabelBawah[0]->$labelDesimalBawah;
            $zTabelAtasFix[$i] = $zTabelAtas[0]->$labelDesimalAtas;            
            
            //menghitung l/proporsi
            $lprop[$i] = abs($zTabelBawahFix[$i] - $zTabelAtasFix[$i]);

            //menghitung fe(L*N)
            $fe[$i] = $lprop[$i]*$n;              

            //menghitung f0
            $frekuensi[$i] = Anggota::select(DB::raw('count(*) as frekuensi, skor'))
                                    ->where([
                                        ['skor', '>=', $batasBawah],
                                        ['skor', '<=', $batasAtas],
                                    ])
                                    ->groupBy()                                                                                                    
                                    ->count();            
            $data[$i] = $batasBawah. " - ". $batasAtas;                                                          
            $batasBawah = $batasAtas + 1;
            
            //menghitung (f0-fe)^2/fe
            $kai[$i] = number_format(pow(($frekuensi[$i] - $fe[$i]),2)/$fe[$i], 7);
            $totalchi += $kai[$i];                        
        }
       
                

        return view ('chi-normalisasi', ['data' => $data,
                                        'frekuensi' => $frekuensi,
                                        'batasAtas' => $batasAtas,
                                        'batasBawah' => $batasBawah,
                                        'kelas' => $kelas,
                                        'interval' => $interval,
                                        'rentangan' => $rentangan,
                                        'batasBawahBaru' => $batasBawahBaru,    
                                        'batasAtasBaru' => $batasAtasBaru,
                                        'zBawah' => $zBawah, 
                                        'zAtas' => $zAtas, 
                                        'zTabelBawahFix' => $zTabelBawahFix,
                                        'zTabelAtasFix' => $zTabelAtasFix,
                                        'lprop' => $lprop,
                                        'fe' => $fe,
                                        'kai' => $kai,
                                        'totalchi' => $totalchi,                                                                        
                                        ]);
   }

   public function lilliefors(){               
       
        //ngambil banyak skor
        $n = Anggota::count('skor');
        $rata2 = number_format(Anggota::average('skor'), 2);

        //function standar deviasi
        function std_deviation($my_arr){
            $no_element = count($my_arr);
            $var = 0.0;
            $avg = array_sum($my_arr)/$no_element;
            foreach($my_arr as $i)
                {
                    $var += pow(($i - $avg), 2);
                }
            return (float)sqrt($var/$no_element);
        }

        //function desimal
        function desimal($nilai){
            if($nilai<0){
                $des = substr($nilai,0,4);
            } else {
                $des = substr($nilai,0,3);
            }
            return $des;
        }

        //function label
        function label($nilai){
            if($nilai<0){
                $str1 = substr($nilai,4,1);
            } else {
                $str1 = substr($nilai,3,1);
            }

            switch($str1){
                case '0': 
                    $sLabel = 'nol';
                    break;
                case '1': 
                    $sLabel = 'satu';
                    break;
                case '2': 
                    $sLabel = 'dua';
                    break;
                case '3': 
                    $sLabel = 'tiga';
                    break;
                case '4': 
                    $sLabel = 'empat';
                    break;
                case '5': 
                    $sLabel = 'lima';
                    break;
                case '6': 
                    $sLabel = 'enam';
                    break;
                case '7': 
                    $sLabel = 'tujuh';
                    break;
                case '8': 
                    $sLabel = 'delapan';
                    break;
                case '9': 
                    $sLabel = 'sembilan';
                    break;
                default: $sLabel = 'Tidak ada field';
            }
            
            return $sLabel;
        }

        //ambil nilai skor
        $anggota = Anggota::select('skor')->get();

        //masukin skor ke dalam array biar bsa dipakek sama functionnya
        $i = 0;
        foreach ($anggota as $a){
            $arraySkor[$i] = $a->skor;
            $i++;            
        }                         
           
        //standar deviasi dari seluruh skor
        $SD = number_format(std_deviation($arraySkor), 2);    

        //ngambil data dan frekuensinya
        for($i = 0; $i < $n; $i++){
            $frekuensi[$i] = Anggota::select('skor', DB::raw('count(*) as frekuensi'))  //ambil skor, hitung banyak skor taruh di tabel frekuensi
                                ->groupBy('skor')    //urutkan sesuai skor
                                ->get();     
            //ngambil banyak data setelah diambil frekuensinya     
            $banyakData = count($frekuensi[$i]);            
        } 

        //mencari f(zi) dari tabel z
        $fkum = 0;
        $totalLillie = 0;
        for ($i = 0; $i < $banyakData; $i++){
            
            //frekuensi komulatif
            $fkum += $frekuensi[0][$i]->frekuensi;
            $fkum2[$i] = $fkum;         

            //mencari nilai Zi
            $Zi[$i] = number_format(($frekuensi[0][$i]->skor - $rata2)/$SD, 2);
            
            //mencari F(zi)dari tabel z
            $cariDesimalZi = desimal($Zi[$i]);
            $labelZi = label($Zi[$i]);
            $zTabel = ZTabel::where('z', '=', $cariDesimalZi)->get();
            $fZi[$i] = $zTabel[0]->$labelZi; 
            
            //mencari S(Zi)
            $sZi[$i] = $fkum2[$i]/$n;
            
            //mencari |F(Zi)-S(Zi)|
            $lilliefors[$i] = abs($fZi[$i]-$sZi[$i]);
            
            //total
            $totalLillie += $lilliefors[$i];
        }
                             

        return view('/lilliefors', ['frekuensi' => $frekuensi, 
                                    'banyakData' => $banyakData,                                 
                                    'fkum2' => $fkum2,
                                    'Zi' => $Zi,
                                    'fZi' => $fZi,
                                    'sZi' => $sZi,
                                    'lilliefors' => $lilliefors,
                                    'totalLillie' => $totalLillie,
                                    'n' => $n,
                                 ]);
   }

    public function korelasiMoment(){
       $moments = Moment::all(); 
       $jumlahXY = Moment::count();       
       $jumlahX = Moment::count('x');   
       $jumlahY = Moment::count('y');

       for ($i=0; $i < $jumlahX; $i++) { 
           $xKuadrat[$i] = $moments[$i]->x * $moments[$i]->x;          
           $yKuadrat[$i] = $moments[$i]->y * $moments[$i]->y;   
       }
       return view('/korelasimoment', ['moments' => $moments,
                                        'jumlahXY' => $jumlahXY,
                                        'xKuadrat' => $xKuadrat,
                                        'yKuadrat' => $yKuadrat,
                                    ]);
    }

    public function exportmoment(){

        return Excel::download(new MomentExport, time().'_'.'korpointmoment.xlsx');               
    }

    public function importmoment(Request $request){

        $this->validate($request, 
        [            
            'file'      =>  'required|file|mimes:xlsx,csv'
        ],
        [
            'file'      =>  'File Harus Berekstensi .xlsx atau .csv',            
        ]);          

        $file = $request->file('file');       
        $namaFile = $file->getClientOriginalName();
        $file->move('Moment', $namaFile);
        
        $filexcel = Excel::import(new MomentImport, public_path('/Moment/'.$namaFile));                         
        
        return redirect('/')->with('status', 'Data Korelasi Moment Berhasil Diimport!');
   }

    public function korelasiBiserial(){
        $biserials = Biserial::all();
        return view('/korelasibiserial', ['biserials' => $biserials,

                                    ]);
    }

    public function exportbiserial(){

        return Excel::download(new BiserialExport, time().'_'.'korpointbiserial.xlsx');               
    }

    public function importbiserial(Request $request){

        $this->validate($request, 
        [            
            'file'      =>  'required|file|mimes:xlsx,csv'
        ],
        [
            'file'      =>  'File Harus Berekstensi .xlsx atau .csv',            
        ]);          

        $file = $request->file('file');       
        $namaFile = $file->getClientOriginalName();
        $file->move('Biserial', $namaFile);
        
        $filexcel = Excel::import(new BiserialImport, public_path('/Biserial/'.$namaFile));                         
        
        return redirect('/')->with('status', 'Data Korelasi Biserial Berhasil Diimport!');
    }

    public function ujiTBerkolerasi(){

        $t = 30;

        return view('/ujiTBerkolerasi', ['ujiT' => $t,

                                    ]);
    }

}