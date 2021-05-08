@extends('layout.master')

@section('title')
    Edit Data 
@endsection

@section('alamat')
    Home
@endsection

@section('alamat-aktif')
    Edit Data
@endsection

@section('content')                      
    <div class="content">
        <div class="container-fluid">            
            <div class="row justify-content-center mt-4">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                        <form method="POST" action="/edit/{{ $anggota->id }} id="forminput">   {{-- form akan mengarah ke route edit dengan method put --}}
                        @csrf                   {{-- csrf token untuk tombol edit --}}
                        @method('PUT')              
                          
                            <div class="form-group">
                                <label for="input2">Skor</label>
                                <input type="text" class="form-control mb-2" value="{{ $anggota->skor }}" id="skor"
                                    placeholder="Skor" name="skor">

                                    @if ($errors->has('skor'))
                                        <div class="alert alert-danger">{{ $errors->first('skor') }}</div>
                                    @endif
                                    
                            </div>                
                                  
                            <div class="d-flex">
                                <a href='/' class="btn btn-danger">Batal Edit</a>
                                <input type="submit" class="btn btn-success ml-auto p-2" name="submit" value="Edit">                                        
                            </div>
                            
                        </form>
                        </div>
                    </div>                  
                </div>
            </div>
        </div>            
    </div>
          <!-- /.container-fluid -->                                       
@endsection
