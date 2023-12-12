@extends('layout.admin.dashboard')

@section('content')
    <div class="container">
        <h2>Daftar Riwayat Peminjaman</h2>
        <table class="table">
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
            <tbody>
                @foreach ($borrows as $borrow)
                    <tr>
                        <td>{{ $borrow->user->name }}</td>
                        <td>{{ $borrow->medic->name }}</td>
                        <td>{{ $borrow->borrow_date }}</td>
                        <td>{{ $borrow->return_date }}</td>
                        <td>
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
                        <td>
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
@endsection
