@extends('layout.master')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8 bg-white form-container">
                <form method="post" action="/" id="forminput" name="global">
                    <h2>Silahkan Masukkan Skor</h2>
                    <br />
                    <div class="form-group">
                        <label for="input1">Nama Mahasiswa</label>
                        <input type="text" class="form-control"
                            placeholder="Masukkan Nama Mahasiswa" name="nama" required />
                    </div>
                    <div class="form-group">
                        <label for="input2">Skor</label>
                        <input type="text" class="form-control"
                            placeholder="Masukkan Skor" name="skor" required />
                    </div>
                    <input type="submit" class="btn btn-primary daftar-btn" name="submit" value="Input">                    
                </form>
                <br>
                <table class="table">
                    <thead>
                        <tr>
                            <td scope="col">No</td>
                            <td scope="col">Nama</td>
                            <td scope="col">Skor</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                        <tr>                             
                            <th>{{ $loop->iteration }}</th>
                            <td>{{ $user->nama }}</td>
                            <td>{{ $user->skor }}</td>
                            <td>
                                <form name="delete" action="/delete/{{ $user->id }}" method="POST">
                                    <a href='/edit/{{ $user->id }}' class="btn btn-outline-success">Edit</a>
                                    @csrf
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
        
        <!-- Akhir Container -->
    </div>

@endsection
