@extends('layout.masteredit')

@section('title')
    Edit Data {{ $anggota->nama }}
@endsection

@section('alamat')
    Home
@endsection

@section('alamat-aktif')
    Statistik Deskriptif / Edit Data
@endsection

@section('edit')                      
    <form method="POST" action="/edit/{{ $anggota->id }} id="forminput">   {{-- form akan mengarah ke route edit dengan method put --}}
    @csrf                   {{-- csrf token untuk tombol edit --}}
    @method('PUT')              
        <div class="form-group">
            <label for="input1">Nama Mahasiswa</label>
            <input type="text" class="form-control" value="{{ $anggota->nama }}" id="nama"
                placeholder="Nama Mahasiswa" name="nama">

                @if ($errors->has('nama'))
                    <b>{{ $errors->first('nama') }}</b>
                @endif

        </div>  
        <div class="form-group">
            <label for="input2">Skor</label>
            <input type="number" class="form-control" value="{{ $anggota->skor }}" id="skor"
                placeholder="Skor" name="skor">

                @if ($errors->has('skor'))
                    <b>{{ $errors->first('skor') }}</b>
                @endif
                
        </div>                
        
        <input type="submit" class="btn btn-primary" name="submit" value="Edit">
    </form>                                        
@endsection
