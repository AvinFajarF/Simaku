@extends('layouts.admin')
@section('mata_pelajaran', 'active')

@section('title', 'Mata Pelajaran')

@section('content')
<div class="card mb-4">
  <div class="card-header row">
    <div class="col-12 col-sm-6 p-0 my-1">
      <div class="d-flex align-items-start">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalCreate">
          Tambah Mata Pelajaran
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
            <th scope="col">Code</th>
            <th scope="col">Name</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
          <?php $count = 1; ?>
          @foreach($subjects as $data)
          <tr>
            <td>
              <?= $count ?>
            </td>
            <td>{{ $data->code }}</td>
            <td>{{ $data->name }}</td>
            <td>
              <a href="#modalEdit" data-toggle="modal"
                onclick="$('#modalEdit #formEdit').attr('action', '{{route('admin.subjects.update', $data->id)}}'); $('#modalEdit #formEdit #name').attr('value', '{{$data->name}}'); $('#modalEdit #formEdit #code').attr('value', '{{$data->code}}');"
                class="btn btn-warning">Edit</a>
              <a href="#modalDelete" data-toggle="modal"
                onclick="$('#modalDelete #formDelete').attr('action', '{{route('admin.subjects.delete', $data->id)}}')"
                class="btn btn-danger ml-2">Delete</a>
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
        <h5 class="modal-title" id="staticBackdropLabel">Tambah Mata Pelajaran</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{route("admin.subjects.create")}}" method="post">
          @csrf
          <div class="form-group">
            <label for="code">code</label>
            <input type="text" required class="form-control @error('code') is-invalid @enderror" id="code" name="code">
            @error('code')
            <div class="invalid-feedback">
              {{ $message}}
            </div>
            @enderror
          </div>
          <div class="form-group">
            <label for="name">name</label>
            <input type="text" required class="form-control @error('name') is-invalid @enderror" id="name" name="name">
            @error('name')
            <div class="invalid-feedback">
              {{ $message}}
            </div>
            @enderror
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary mr-2" data-dismiss="modal">Kembali</button>
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
        <h5 class="modal-title" id="staticBackdropLabel">Import Excel Data Mata Pelajaran</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="/admin/mata-pelajaran/import" method="post" enctype="multipart/form-data">
          @csrf
          <div class="custom-file">
            <input type="file" class="custom-file-input" id="data_mata_pelajaran" name="data_mata_pelajaran"
              accept=".xlsx, .xls">
            <label class="custom-file-label" for="data_mata_pelajaran">Pilih File</label>
          </div>
          <div class="text-small text-danger mt-2">
            * Mohon masukkan data dengan benar sebelum dikirim
          </div>
          <a href="/admin/mata-pelajaran/format-export" class="btn btn-warning mt-4">Unduh
            Format
            Import</a>
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
        <h5 class="modal-title" id="staticBackdropLabel">Edit Mata Pelajaran</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="formEdit" action="" method="post">
          @csrf
          <div class="form-group">
            <label for="code">code</label>
            <input type="text" required class="form-control @error('code') is-invalid @enderror" id="code" name="code">
            @error('code')
            <div class="invalid-feedback">
              {{ $message}}
            </div>
            @enderror
          </div>
          <div class="form-group">
            <label for="name">name</label>
            <input type="text" required class="form-control @error('name') is-invalid @enderror" id="name" name="name">
            @error('name')
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
        <h5 class="modal-title" id="exampleModalLabel">Yakin menghapus mata pelajaran ?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-footer">
        <form id="formDelete" action="" method="POST">
            @csrf
            @method("DELETE")
          <button type="button" class="btn btn-secondary mr-2" data-dismiss="modal">Tidak</button>
          <button type="submit" class="btn btn-danger">Hapus</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
