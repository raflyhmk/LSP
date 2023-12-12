@extends('layout.admin.dashboard')
@section('content')
<div class="container-fluid">
        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Daftar Peminjaman</h1>
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
                        <th>Nama User</th>
                        <th>Nama Alat Kesehatan</th>
                        <th>Tanggal Pinjam</th>
                        <th>Tanggal Kembali</th>
                        <th>Status</th>
                        <th>Request Pengembalian</th>
                      </tr>
                    </thead>
                    <tfoot>
                      <tr>
                        <th>Nama User</th>
                        <th>Nama Alat Kesehatan</th>
                        <th>Tanggal Pinjam</th>
                        <th>Tanggal Kembali</th>
                        <th>Status</th>
                        <th>Request Pengembalian</th>
                      </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($borrows as $borrow)
                      <tr>
                        <td class="text-capitalize align-middle">{{ $borrow->user->name }}</td>
                        <td class="text-capitalize align-middle">{{ $borrow->medic->name }}</td>
                        <td class="text-capitalize align-middle">{{ $borrow->borrow_date }}</td>
                        <td class="text-capitalize align-middle">{{ $borrow->return_date }}</td>
                        <td class="align-middle">
                            @php
                                $today = \Carbon\Carbon::now();
                                $returnDate = \Carbon\Carbon::parse($borrow->return_date);
                                $diffInDays = $today->diffInDays($returnDate, false);
                            @endphp
                            @if ($diffInDays < 0)
                                <span class="text-danger">Terlambat</span>
                            @else
                                <span class="text-success">{{ $diffInDays }} hari lagi</span>
                            @endif
                        </td>
                        <td class="align-middle">
                            @if ($borrow->is_return_requested && !$borrow->is_return_approved)
                                <form action="{{ route('approve.return', $borrow->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-success">ACC Pengembalian</button>
                                </form>
                            @elseif ($borrow->is_return_approved)
                                <span class="text-success">Disetujui</span>
                            @else
                                <span class="text-secondary">No Request</span>
                            @endif
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
@endsection
