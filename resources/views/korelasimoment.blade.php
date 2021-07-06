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
            <a href="#" class="btn btn-success mt-2 mb-2" data-toggle="modal" data-target="#korelasiModal">
                Import Korelasi Moment
            </a>
            <!-- Modal -->
            <div class="modal fade" id="korelasiModal" tabindex="-1" role="dialog" aria-labelledby="korelasiModal" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Import File Korelasi Moment</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="/importmoment" method="POST" enctype="multipart/form-data">                                    
                            <div class="modal-body">                                                                                     
                                <div class="form-group">                                
                                <input type="file" name="file" required>
                                <p class="mt-1"> <i>File yang disupport: .xlxs dan .csv</i> </p> 
                                </div>    
                                
                                <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                <button type="submit" class="btn btn-primary">Import</button>
                                @csrf 
                                
                                </div>  
                            </div>
                        </form>                                        
                    </div>
                </div>
            </div>
        </div>
        <div class="card">             
            <div class="card-header border-0">
                <p class="h3">Korelasi Point Moment</p>                
            </div>
            @if (session('status'))                                    
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
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

