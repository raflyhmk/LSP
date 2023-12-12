<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Alat Kesehatan</title>
    <!-- Tambahkan referensi ke CSS dan JavaScript yang diperlukan di sini -->
</head>

<body>
    @extends('layout.user.master')
    @section('content')

        <!-- navbar -->
        <div class="container mt-4">
            @include('parts.user.navbar')
        </div>
        <!-- end  navbar -->

        <!-- Notifikasi -->
        <div class="container">
            @if (session('error'))
                <div class="alert alert-danger mt-3">
                    {{ session('error') }}
                </div>
            @endif
    
            @if (session('success'))
                <div class="alert alert-success mt-3">
                    {{ session('success') }}
                </div>
            @endif
        </div>

        <section id="Recommendations" class="mt-3">
            <div class="container">
                <div class="headline mt-4">
                    <div class="row">
                        <div class="col-lg-8">
                            <h1 class="title-article">Daftar Alat Kesehatan</h1>
                            <hr align="left">
                        </div>
                        <div class="col-lg-4">
                            <form class="form-inline search-form d-flex justify-content-end " action="" method="get">
                                <input class="form-control mr-sm-2" type="search" name="cari" placeholder="Search"
                                    aria-label="Search">
                                <button class="btn btn-outline-primary my-2 my-sm-0" type="submit">Search</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container">
                <div class="row">
                    @foreach ($medicalSupplies as $ms)
                        <div class="figure col-sm-12 col-md-6 col-lg-6 col-xl-3 d-flex justify-content-center mb-3 mt-5">
                            <a href="#" style="text-decoration: none">
                                <center>
                                    <img src="{{ asset('storage/images/' . $ms->foto) }}" alt="{{ $ms->name }}" />
                                </center>
                                <h1 class="namaFigure fw-medium mt-2">
                                    {{ $ms->name }}
                                    <span style="font-weight: 700; color: #2f7de1" class="text-capitalize">
                                        ({{ $ms->merk }})
                                    </span>
                                </h1>
                                <h3 class="hargaFigure mt-3 fw-bold">
                                    Kategori: {{ $ms->kategori }}
                                </h3>
                                <button type="button" class="btn btn-outline-primary mt-3"
                                    onclick="event.preventDefault(); document.getElementById('borrow-form-{{ $ms->id }}').submit();">
                                    Ajukan Peminjaman
                                </button>
                                <form id="borrow-form-{{ $ms->id }}" action="{{ route('borrow.item') }}"
                                    method="POST" style="display: none;">
                                    @csrf
                                    <input type="hidden" name="medic_id" value="{{ $ms->id }}">
                                </form>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
            </div>
        </section>

        <!-- footer -->
        <div class="mt-5">
            @include('parts.user.footer')
        </div>
        <!-- end  footer -->

        <!-- JavaScript -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    </body>

    </html>
