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

@section('content')
    <div class="content mt-2">
        <div class="container-fluid">
            <div class="col-9 d-flex justify-content-end mb-2">
                <a href="/export" class="btn btn-danger mt-2 mb-2 mr-3">
                    Export
                </a>                
                <a href="#" class="btn btn-success mt-2 mb-2" data-toggle="modal" data-target="#exampleModal">
                    Import
                </a>                                                        
            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Import File</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <form action="/import" method="POST" enctype="multipart/form-data">                                    
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
            <div class="row justify-content-center">                              
                <div class="col-lg-7">
                    <div class="card">
                        <div class="card-header border-0">
                            <div class="d-flex justify-content-between">
                                <p class="h3">Silahkan Masukkan Skor</p>                  
                            </div>
                        </div>
                        <div class="card-body">                
                            <form method="post" action="/" id="forminput">    {{-- setelah di submit, form akan mengarah ke route home--}}                       
                                <div class="form-group">
                                    <label for="input2">Skor</label>
                                    <input type="text" class="form-control mb-2"
                                        placeholder="Masukkan Skor" name="skor" value="{{ old('skor') }}">

                                        @if ($errors->has('skor'))
                                            <div class="alert alert-danger">{{ $errors->first('skor') }}</div>
                                        @endif
                                        
                                        @if ($errors->has('file'))
                                            <div class="alert alert-danger">{{ $errors->first('file') }}</div>
                                        @endif

                                        @if (session('error'))
                                            <div class="alert alert-danger">{{ session('error') }} </div>
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
                        </div>
                    </div>                              
                </div>

                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-header border-0">
                            <div class="d-flex justify-content-between">
                                <p class="h3">Data Skor</p> 
                                {{-- <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#hapussemua">Hapus Semua</button>                  --}}
                            </div>
                        </div>
                        <div class="card-body">                
                            <table class="table">
                                <thead>
                                    <tr>
                                        <td scope="col">No</td>                
                                        <td scope="col">Skor</td>
                                        <td scope="col">Action</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                    <tr>                             
                                        <th scope="row">{{ ($users->currentpage()-1) * $users->perpage() + $loop->index + 1 }}</th>   {{--  --}}                  
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
                            <div class="mt-4 col-12 d-flex justify-content-center">
                                {{ $users->links("pagination::bootstrap-4") }}                       
                            </div>
                        </div>
                    </div>
                    <!-- /.card -->                
                </div>
                

                {{-- <!-- Modal -->
                <div class="modal fade" id="hapussemua" tabindex="-1" role="dialog" aria-labelledby="modalhapus" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Hapus File</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                        <form action="/delete" method="POST">
                        <div class="modal-body">
                            <p> Yakin hapus semua?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-danger">HAPUS</button>
                            @csrf
                            @method('DELETE')                        
                        </div> 
                        </form>                                                        
                    </div>
                    </div>
                </div> --}}                                                 
                
            </div>                                        
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
@endsection
                                       
