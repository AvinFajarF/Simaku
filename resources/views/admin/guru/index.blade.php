@extends('layouts.admin')
@section('guru', 'active')

@section('title', 'Guru')

@section('content')
<div class="card mb-4">
    <div class="card-header row">
        <div class="col-12 col-sm-6 p-0 my-1">
            <div class="d-flex align-items-start">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalCreate">
                    Tambah Guru
                </button>
                <button type="button" class="btn btn-warning ml-2" data-toggle="modal" data-target="#modalImport">
                    Import Excel
                </button>
            </div>
        </div>
        <div class="col-12 col-sm-6 p-0 my-1">
            <div class="d-flex align-items-end flex-column">
                <div>
                    @if(session('success'))
                    <div class="alert alert-success p-1 px-4 m-0">
                        {{ session('success') }}
                    </div>
                    @elseif(session('error'))
                    <div class="alert alert-danger p-1 px-4 m-0">
                        {{ session('error') }}
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-bordered data">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Username</th>
                        <th scope="col">Number</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $count = 1; ?>
                    @foreach($teachers as $data)
                    <tr>
                        <td><?= $count ?></td>
                        <td>{{ $data->user->username}}</td>
                        <td>{{ $data->number }}</td>
                        <td>{{ $data->status }}</td>
                        <td>
                            <a href="#modalEdit" data-toggle="modal"
                                onclick="$('#modalEdit #formEdit').attr('action', '{{route('admin.teacher.update', $data->id)}}'); $('#modalEdit #formEdit #username').attr('value', '{{$data->user->username}}'); $('#modalEdit #formEdit #nama').attr('value', '{{$data->nama}}'); $('#modalEdit #formEdit #number').attr('value', '{{$data->number}}'); $('#modalEdit #formEdit #status').attr('value', '{{$data->status}}');"
                                class="btn btn-warning">Edit</a>
                                <a href="#modalDelete" data-toggle="modal" onclick="$('#modalDelete #formDelete').attr('action', '{{ route('admin.teacher.delete', $data->id) }}')" class="btn btn-danger ml-2">Delete</a>

                        </td>
                    </tr>
                    <?php $count++; ?>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection

@section('modal')
<!-- Modal Create -->
<div class="modal fade" id="modalCreate" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Tambah Guru</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route("admin.teacher.create")}}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="name">name</label>
                        <input type="text" required class="form-control @error('name') is-invalid @enderror"
                            id="name" name="name">
                        @error('name')
                        <div class="invalid-feedback">
                            {{ $message}}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="number">Number</label>
                        <input type="text" required class="form-control @error('number') is-invalid @enderror" id="number"
                            name="number">
                        @error('number')
                        <div class="invalid-feedback">
                            {{ $message}}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select name="status" class="form-control" autocomplete="off" name="tipe" required>
                            <option>on</option>
                            <option>off</option>
                        </select>


                        @error('status')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="text" required class="form-control @error('password') is-invalid @enderror" id="password"
                            name="password">
                        @error('password')
                        <div class="invalid-feedback">
                            {{ $message}}
                        </div>
                        @enderror
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Import -->
<div class="modal fade" id="modalImport" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Import Excel Data Guru</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/admin/guru/import" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="nama">File</label>
                        <input type="file" class="form-control" required id="excel" name="data_guru"
                            accept=".xlsx, .xls">
                        <div class="text-small text-danger mt-2">
                            * Mohon masukkan data dengan benar sebelum dikirim
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit -->
<div class="modal fade" id="modalEdit" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Edit Guru</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formEdit" action="" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" required class="form-control @error('username') is-invalid @enderror"
                            id="username" name="username" value="">
                        @error('username')
                        <div class="invalid-feedback">
                            {{ $message}}
                        </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="number">Number</label>
                        <input type="text" required class="form-control @error('number') is-invalid @enderror" id="number"
                            name="number">
                        @error('number')
                        <div class="invalid-feedback">
                            {{ $message}}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select name="status" class="form-control" autocomplete="off" name="tipe" required>
                            <option>on</option>
                            <option>off</option>
                        </select>


                        @error('status')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="text" required class="form-control @error('password') is-invalid @enderror" id="password"
                            name="password">
                        @error('password')
                        <div class="invalid-feedback">
                            {{ $message}}
                        </div>
                        @enderror
                    </div>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Delete -->
<div class="modal fade" id="modalDelete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Yakin menghapus data ?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-footer">
                <form id="formDelete" action="" method="POST">
                    @method("DELETE")
                    @csrf
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
