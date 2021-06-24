@extends('layout.master')

@section('title')
    Korelasi Point Biserial
@endsection

@section('alamat')
   Home
@endsection

@section('alamat-aktif')
    Statistik Deskriptif / Korelasi Point Biserial
@endsection

@section('content')

<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="d-flex justify-content-end">
            <a href="/exportbiserial" class="btn btn-danger mt-2 mb-2 mr-3">
                Export
            </a>
            <a href="/importbiserial" class="btn btn-success mt-2 mb-2">
                Import
            </a>
        </div>
        <div class="card">             
            <div class="card-header border-0">
                <p class="h3">Korelasi Point Biserial</p>                
            </div>
            <div class="card-body">                
                <table class="table text-center">                            
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kecerdasan</th>
                            <th>Keaktifan</th> 
                            <th>Nilai Korelasi Biserial</th>                                                    
                        </tr>                        
                    </thead>            
                    <tbody>
                        @foreach ($biserials as $biserial)
                            
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $biserial->kecerdasan}}</td>                                         
                            <td>{{ $biserial->keaktifan}}</td>  
                            <td></td>                                                                                                            
                        </tr>
                        @endforeach
                    </tbody>
                </table>                                                               
            </div>
        </div>
    </div>
</div>
@endsection

