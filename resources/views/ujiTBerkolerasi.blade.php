@extends('layout.master')

@section('title')
    Uji T Berkolerasi
@endsection

@section('alamat')
   Home
@endsection

@section('alamat-aktif')
    Statistik Deskriptif / Uji T Berkolerasi
@endsection

@section('content')

<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="d-flex justify-content-end">
            <a href="/exportbiserial" class="btn btn-danger mt-2 mb-2 mr-3">
                Export
            </a>
            <a href="#" class="btn btn-success mt-2 mb-2" data-toggle="modal" data-target="#ujitberkolerasi">
                Import Uji T Berkolerasi
            </a>
            <!-- Modal -->
            <div class="modal fade" id="ujitberkolerasi" tabindex="-1" role="dialog" aria-labelledby="ujitberkolerasi" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Import File Uji T Berkolerasi</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="/ujiTBerkolerasiImport" method="POST" enctype="multipart/form-data">                                    
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
                <p class="h3">Uji T Berkolerasi</p>                
            </div>
            <div class="card-body">                
                <table class="table text-center">                            
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>X1</th>
                            <th>X2</th>                                                                                                          
                        </tr>                        
                    </thead>            
                    <tbody>
                        @foreach ($ujiT as $t)
                            
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $t->x1 }}</td>                                         
                            <td>{{ $t->x2 }}</td>                                                                                                                                          
                        </tr>   
                        @endforeach
                        <tr>
                            <th>Rata-Rata: </th>   
                            <td>{{ number_format($rata2x1, 2) }}</td>        
                            <td>{{ number_format($rata2x2, 2) }}</td>                                                
                        </tr>             
                        <tr>
                            <th>Varians:</th>
                            <td>{{ number_format($variansX1, 2) }}</td>
                            <td>{{ number_format($variansX2, 2) }}</td>
                        </tr>
                        <tr>
                            <th>Standar Deviasi:</th>  
                            <td>{{ $sdX1 }}</td>   
                            <td>{{ $sdX2 }}</td>
                        </tr> 
                        <tr>
                            <th>Nilai Uji T: </th>    
                            <td> {{ $nilaiUjiT }}</td>
                        </tr>      
                    </tbody>
                </table>                                                               
            </div>
        </div>
    </div>
</div>
@endsection

