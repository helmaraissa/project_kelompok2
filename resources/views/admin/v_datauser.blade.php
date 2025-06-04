@extends('layouts.v_template2')

@section('title')
Pengguna
@endsection

@section('page')
Halaman Pengguna
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Data Pengguna</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    @if (session('pesan'))
                        <div class="alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <h5><i class="icon fas fa-check"></i> Success</h5>
                            {{ session('pesan') }}
                        </div>
                    @endif
                    <div align="right">
                        <a href="/user/add" class="btn btn-sm btn-warning">Add Data</a><br>
                    </div>
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Pengguna</th>
                                <th>Username</th>
                                <th>Role</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no=1; ?>
                            @foreach ($users as $user)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->username }}</td>
                                <td>
                                    <form action="{{ route('user.update.role', $user->id) }}" method="POST">
                                        @csrf
                                        @method('POST')  <!-- Ubah ke POST jika menggunakan form biasa -->
                                        <select name="role" class="form-control form-control-sm" onchange="this.form.submit()">
                                            <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                                            <option value="siswa" {{ $user->role == 'siswa' ? 'selected' : '' }}>Siswa</option>
                                            <option value="pembina" {{ $user->role == 'pembina' ? 'selected' : '' }}>Pembina</option>
                                        </select>
                                    </form>
                                </td>
                                
                                <td>
                                    <a href="/user/edit/{{ $user->id }}" class="btn btn-sm btn-warning">Edit</a>
                                    <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#delete{{ $user->id }}">
                                        Delete
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    @foreach ($users as $user)
                    <div class="modal fade" id="delete{{ $user->id }}">
                        <div class="modal-dialog modal-sm">
                            <div class="modal-content bg-danger">
                                <div class="modal-header">
                                    <h6 class="modal-title">{{ $user->name }}</h6>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p>Apakah anda ingin menghapus data ini?</p>
                                </div>
                                <div class="modal-footer justify-content-between">
                                    <a href="/user/delete/{{ $user->id }}" class="btn btn-outline-light">Yes</a>
                                    <button type="button" class="btn btn-outline-light" data-dismiss="modal">No</button>
                                </div>
                            </div>
                            <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                    </div>
                    @endforeach

                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
</div>
@endsection
