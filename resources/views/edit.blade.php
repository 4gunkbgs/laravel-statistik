@extends('layout.masteredit')

@section('title')
    Edit Data 
@endsection

@section('alamat')
    Home
@endsection

@section('alamat-aktif')
    Edit Data {{ $anggota->nama }}
@endsection

@section('edit')                      
    <form method="POST" action="/edit/{{ $anggota->id }} id="forminput">   {{-- form akan mengarah ke route edit dengan method put --}}
    @csrf                   {{-- csrf token untuk tombol edit --}}
    @method('PUT')              
        <div class="form-group">
            <label for="input1">Nama Mahasiswa</label>
            <input type="text" class="form-control mb-2" value="{{ $anggota->nama }}" id="nama"
                placeholder="Nama Mahasiswa" name="nama">
                @if ($errors->has('nama'))
                    <div class="alert alert-danger">{{ $errors->first('nama') }}</div>
                @endif
        </div>  
        <div class="form-group">
            <label for="input2">Skor</label>
            <input type="number" class="form-control mb-2" value="{{ $anggota->skor }}" id="skor"
                placeholder="Skor" name="skor">

                @if ($errors->has('skor'))
                    <div class="alert alert-danger">{{ $errors->first('skor') }}</div>
                @endif
                
        </div>                
              
        <div class="d-flex">
            <input type="submit" class="btn btn-primary" name="submit" value="Edit">        
            <a href='/' class="btn btn-primary ml-auto p-2">Batal Edit</a>
        </div>
        
    </form>                                        
@endsection
