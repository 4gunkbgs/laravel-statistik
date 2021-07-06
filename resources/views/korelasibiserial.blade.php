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
            <a href="#" class="btn btn-success mt-2 mb-2" data-toggle="modal" data-target="#biserialModal">
                Import Korelasi Biserial
            </a>
            <!-- Modal -->
            <div class="modal fade" id="biserialModal" tabindex="-1" role="dialog" aria-labelledby="biserialModal" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Import File Korelasi Biserial</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="/importbiserial" method="POST" enctype="multipart/form-data">                                    
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

