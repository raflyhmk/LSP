<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Peminjaman</title>
    <!-- Tambahkan referensi CSS di sini jika diperlukan -->
</head>

<body>
    @extends('layout.user.master')
    @section('content')
        <div class="container mt-4">
            @include('parts.user.navbar')

            <div class="mt-3">
                <h2>Riwayat Peminjaman</h2>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nama Item</th>
                            <th>Tanggal Pinjam</th>
                            <th>Tanggal Kembali</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($borrows as $borrow)
                            <tr>
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
                                    @if (!$borrow->is_return_requested)
                                        <form action="{{ route('request.return', $borrow->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-primary">Request Pengembalian</button>
                                        </form>
                                    @elseif ($borrow->is_return_approved)
                                        <span class="text-success">Request Dikonfirmasi</span>
                                    @else
                                        <span>Request Dikirim</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endsection
</body>

</html>
