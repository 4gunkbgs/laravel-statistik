@extends('layout.master')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-4 mr-auto">

                <div class="row">
                    <div class="col-12 bg-white form-container">
                        <h2>Tabel Frekuensi</h2>
                        <table class="table">
                            <thead>
                                <tr>
                                    <td scope="col">Skor</td>
                                    <td scope="col">Frekuensi</td>
                                </tr>
                           </thead>
                           <tbody>
                               @foreach ($frekuensi as $skor)
                               
                               <tr>
                                   <td> {{ $skor->skor }} </td>
                                   <td> {{ $skor->frekuensi }}</td>
                                </tr>
                                 
                                @endforeach
                                <tr>
                                    <td> <b>Total Skor:</b>  </td>
                                    <td> {{ $totalskor }}</td>
                                </tr>
                                <tr>
                                    <td> <b>Total Frekuensi:</b>  </td>
                                    <td> {{ $totalfrekuensi }}</td>
                                </tr>
                           </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-md-7 ml-auto bg-white form-container">
                <form method="post" action="/" id="forminput">    {{-- setelah di submit, form akan mengarah ke route home--}}
                    <h2>Silahkan Masukkan Skor</h2>
                    <br />
                    <div class="form-group">
                        <label for="input1">Nama Mahasiswa</label>
                        <input type="text" class="form-control"
                            placeholder="Masukkan Nama Mahasiswa" name="nama" value="{{ old('nama') }}">

                            @if ($errors->has('nama'))
                                <b>{{ $errors->first('nama') }}</b>
                            @endif

                    </div>
                    <div class="form-group">
                        <label for="input2">Skor</label>
                        <input type="number" class="form-control"
                            placeholder="Masukkan Skor" name="skor" value="{{ old('skor') }}">

                            @if ($errors->has('skor'))
                                <b>{{ $errors->first('skor') }}</b>
                            @endif

                    </div>
                    <input type="submit" class="btn btn-primary daftar-btn" name="submit" value="Input">  {{-- tombol submit--}}

                    @csrf
                    
                    <label for="max" class="ml-4">Skor Maks: <b>{{ $max }}</b></label>
                    <label for="min" class="ml-4">Skor Min: <b>{{ $min }}</b></label>
                    <label for="rata2" class="ml-4">Rata-Rata: <b>{{ $rata2 }}</b></label>
                    
                    @if (session('status'))
                        <p></p>
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                </form>
                <br>
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
            </div>
        </div>
    </div>
    <!-- Akhir Container -->

@endsection
