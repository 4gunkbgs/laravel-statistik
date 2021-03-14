@extends('layout.master')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8">
                <form method="POST" action="/edit/{{ $anggota->id }}" class="bg-white form-container" id="forminput">
                @csrf 
                @method('PUT')
                    <h2>Edit Data {{ $anggota->nama }}</h2>
                    <br />
                    
                    <div class="form-group">
                        <label for="input1">Nama Mahasiswa</label>
                        <input type="text" class="form-control" value="{{ $anggota->nama }}" id="nama"
                            placeholder="Nama Mahasiswa" name="nama" required />
                    </div>  
                    <div class="form-group">
                        <label for="input2">Skor</label>
                        <input type="text" class="form-control" value="{{ $anggota->skor }}" id="skor"
                            placeholder="Skor" name="skor" required />
                    </div>                
                    
                    <input type="submit" class="btn btn-primary" name="submit" value="Edit">
                </form>
            </div>
        </div>
        
        <!-- Akhir Container -->
    </div>

@endsection
