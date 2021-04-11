@extends('layout.master')

@section('title')
    Statistik Deskriptif
@endsection

@section('alamat')
    Home
@endsection

@section('alamat-aktif')
    Statistik Deskriptif
@endsection
    
@section('frekuensi')
    
        {{-- <thead>
            <tr>
                <td scope="col">Skor</td>
                <td scope="col">Frekuensi</td>
            </tr>
        </thead> --}}
        <tbody>
            @foreach ($frekuensi as $skor)
            
            <tr>
                <td> {{ $skor->skor }} </td>
                <td> {{ $skor->frekuensi }}</td>
            </tr>
                
            @endforeach
        </tbody>
@endsection         

@section('statistik')
    
    <table class="table">            
        <tbody>        
            <tr>
                <td scope="col"> <b>Total Skor:</b>  </td>                
                <td> {{ $totalskor }}</td> 
            </tr>
            <tr>
                <td scope="col"> <b>Total Frekuensi:</b>  </td>
                <td> {{ $totalfrekuensi }}</td>  
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

@endsection

@section('input')    
    <form method="post" action="/" id="forminput">    {{-- setelah di submit, form akan mengarah ke route home--}}                
        <div class="form-group">
            <label for="input1">Nama Mahasiswa</label>
            <input type="text" class="form-control mb-2"
                placeholder="Masukkan Nama Mahasiswa" name="nama" value="{{ old('nama') }}">

                @if ($errors->has('nama'))                    
                    <div class="alert alert-danger">{{ $errors->first('nama') }}</div>
                @endif

        </div>
        <div class="form-group">
            <label for="input2">Skor</label>
            <input type="number" class="form-control mb-2"
                placeholder="Masukkan Skor" name="skor" value="{{ old('skor') }}">

                @if ($errors->has('skor'))
                    <div class="alert alert-danger">{{ $errors->first('skor') }}</div>
                @endif

        </div>
        <input type="submit" class="btn btn-primary daftar-btn mt-4" name="submit" value="Input">  {{-- tombol submit--}}

        @csrf
        
        @if (session('status'))
            <p></p>
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

    </form>
@endsection    
@section('data')    
    <table class="table">
        <thead>
            <tr>
                <td scope="col">No</td>
                <td scope="col">Nama</td>
                <td scope="col">Skor</td>
                <td scope="col">Action</td>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr>                             
                <th scope="row">{{ $loop->iteration }}</th>     
                <td>{{ $user->nama }}</td>
                <td>{{ $user->skor }}</td>
                <td>
                    <form name="delete" action="/delete/{{ $user->id }}" method="POST">     {{-- setelah klik hapus, form akan mengarah ke route delete--}}
                        <a href='/edit/{{ $user->id }}' class="btn btn-outline-success">Edit</a> {{-- setelah klik edit, maka akan di href ke route edit/{id} (edit.blade)--}}
                        @csrf               {{-- csrf token untuk tombol hapus--}}
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach                          
        </tbody>
    </table>   
@endsection                                    
