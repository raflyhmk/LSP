@extends('layout.admin.dashboard')
@section('content')
<div class="container-fluid">
        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Daftar Admin</h1>
        <!-- alert success -->
         @if(Session::has('status') && Session::get('status') == 'success')
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{Session::get('message')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        @endif

        <!-- alert failed -->
        @if(Session::has('status') && Session::get('status') == 'failed')
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{Session::get('message')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        @endif

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
              <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                  <button type="button" class="btn btn-primary" onclick="event.preventDefault(); location.href='{{ url('admin/tambah-alat-kesehatan') }}';">
                    Tambah Admin
                  </button>
                </h6>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table
                    class="table table-bordered"
                    id="dataTable"
                    width="100%"
                    cellspacing="0"
                  >
                    <thead>
                      <tr>
                        <th>No. karyawan</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>opsi</th>
                      </tr>
                    </thead>
                    <tfoot>
                      <tr>
                        <th>No. karyawan</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>opsi</th>
                      </tr>
                    </tfoot>
                    <tbody>
                        @foreach($listAdmin as $la)
                      <tr>
                        <td class="text-capitalize align-middle">{{$la -> id}}</td>
                        <td class="text-capitalize align-middle">{{$la -> name}}</td>
                        <td class="text-capitalize align-middle">{{$la -> email}}</td>
                        <td class="align-middle">
                            <a href="/admin/edit-user/{{$la -> id}}"class="btn btn-warning btn-circle btn-sm button-edit mr-1 mb-1"><i class="fas fa-edit"></i></a>
                            <button type="button" class="btn btn-danger btn-circle btn-sm mr-1 mb-1" data-toggle="modal" data-target="#deleteModal"><i class="fas fa-trash"></i></button>
                        </td>  
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
        </div>
        <!-- delete modal -->       
    </div>
    @if(count($listAdmin) > 0)
        <form action="/admin/hapus-admin/{{$lm->id}}" method="post">
          @csrf
          @method('delete')
          <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
          aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Yakin ingin menghapus alat kesehatan ini ini?</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">Data yang terhapus tidak bisa dikembalikan lagi, mohon pertimbangkan sekali lagi.</div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <button class="btn btn-primary" type="submit">Hapus</button>
                    </div>
                </div>
            </div>
          </div>
        </form>
        @endif
@endsection
