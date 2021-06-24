@extends('layout.master')

@section('title')
    Korelasi Point Moment
@endsection

@section('alamat')
   Home
@endsection

@section('alamat-aktif')
    Statistik Deskriptif / Korelasi Point Moment
@endsection

@section('content')

<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="d-flex justify-content-end">
            <a href="/exportmoment" class="btn btn-danger mt-2 mb-2 mr-3">
                Export
            </a>
            <a href="/importmoment" class="btn btn-success mt-2 mb-2">
                Import
            </a>
        </div>
        <div class="card">             
            <div class="card-header border-0">
                <p class="h3">Korelasi Point Moment</p>                
            </div>
            <div class="card-body">                
                <table class="table text-center">                            
                    <thead>
                        <tr>
                            <th>X</th>
                            <th>Y</th>
                            <th>x</th>                           
                            <th>y</th>
                            <th>x^2</th> 
                            <th>y^2</th>
                            <th>xy</th>  
                            <th>Nilai Korelasi Point Moment</th>
                        </tr>                        
                    </thead>            
                    <tbody>
                        @foreach ($moments as $moment) 
                        <tr>                                                                                               
                            <td>{{ $moment->x}}</td>
                            <td>{{ $moment->y}}</td>                                         
                            <td></td>                                         
                            <td></td>                                         
                            <td></td>                                         
                            <td></td>                                         
                            <td></td>  
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

