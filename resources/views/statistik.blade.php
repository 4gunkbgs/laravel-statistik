@extends('layout.master')

@section('title')
    Data Statistik
@endsection

@section('alamat')
    Home
@endsection

@section('alamat-aktif')
    Statistik Deskriptif / Data Statistik
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header border-0">
                <p class="h3">Tabel Statistik</p>                
            </div>
            <div class="card-body">                
                <table class="table">            
                    <tbody>        
                        <tr>
                            <td scope="col"> <b>Total Skor:</b>  </td>                
                            <td> {{ $totalskor }}</td> 
                        </tr>                                   
                        <tr>
                            <td scope="col"> <b>Skor Maksimal:</b>  </td>
                            <td> {{ $max }}</td>  
                        </tr>          
                        <tr>
                            <td scope="col"> <b>Skor Minimal:</b>  </td>
                            <td> {{ $min }}</td>   
                        </tr>
                            <td scope="col"> <b>Rata-Rata:</b>  </td>         
                            <td> {{ $rata2 }}</td>
                        </tr>
                    </tbody>
                </table>               
            </div>
        </div>
    </div>
</div>
@endsection

