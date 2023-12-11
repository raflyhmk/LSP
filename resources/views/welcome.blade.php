@extends('layout.user.master')
  @section('content')
  
      <!-- navbar -->
      <div class="container mt-4">
      @include('parts.user.navbar')
      </div>
      <!-- end  navbar -->

      <!-- carousel header -->
      <section id="header" class="mb-5">
          <div
          id="carouselExampleInterval"
          class="carousel slide"
          data-bs-ride="carousel"
          >
          <div class="carousel-inner">
              <div class="carousel-item active" data-bs-interval="2000">
              <img
                  src="{{url('frontend/images/medica-equipment-1.jpg')}}"
                  class="d-block w-100"
                  height="780px"
                  alt="medica-equipment-1"
              />
              </div>
              <div class="carousel-item" data-bs-interval="2000">
              <img
                  src="{{url('frontend/images/medica-equipment-2.jpg')}}"
                  class="d-block w-100"
                  height="780px"
                  alt="medica-equipment-2"
              />
              </div>
              <div class="carousel-item" data-bs-interval="2000">
              <img
                  src="{{url('frontend/images/medica-equipment-3.jpg')}}"
                  class="d-block w-100"
                  height="780px"
                  alt="medica-equipment-3"
              />
              </div>
          </div>
          <button
              class="carousel-control-prev"
              type="button"
              data-bs-target="#carouselExampleInterval"
              data-bs-slide="prev"
          >
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Previous</span>
          </button>
          <button
              class="carousel-control-next"
              type="button"
              data-bs-target="#carouselExampleInterval"
              data-bs-slide="next"
          >
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Next</span>
          </button>
          </div>
      </section>
      <!-- end carousel header -->

      <!-- rekomendasi -->
      <section id="Recommendations" class="mt-5">
        <center>
          <h1 class="title fw-bold">Alat kesehatan yang bisa kamu pinjam</h1>
        </center>
        <div class="container mt-4 mb-5">
          <div class="row">
            @foreach($alatKesehatan as $ak)
            <div
              class="figure col-sm-12 col-md-6 col-lg-6 col-xl-3 d-flex justify-content-center mb-3 mt-5"
            >
              <a href="#" style="text-decoration: none"
                ><center>
                  <img src="{{asset ('storage/images/'.$ak -> foto)}}" alt="{{$ak -> name}}" />
                </center>
                <h1 class="namaFigure fw-medium mt-2">
                {{$ak -> name}}
                  <span
                    style="font-weight: 700; color: #2f7de1"
                    class="text-capitalize"
                  >
                    ({{$ak -> merk}})</span
                  >
                </h1>
                <h3 class="hargaFigure mt-3 fw-bold">
                 Kategori: {{$ak -> kategori}}
                </h3>
                <button type="button" class="btn btn-outline-primary mt-3">Ajukan peminjaman</button>
              </a>
            </div>
            @endforeach
          </div>
          <center>
            <a href="/alat-kesehatan"
              ><button
                type="button"
                class="btn btn-outline-primary btn-showAll mt-4"
              >
                Show All
              </button></a
            >
          </center>
        </div>
      </section>
      <!-- end rekomendasi -->

      <!-- google maps -->
      <div class="container maps">
          <center>
            <h1 class="title mt-5">Kunjungi kami secara langsung</h1>
            <p class="descTitle">
              Kamu bisa mengunjungi alamat kami secara langsung, lokasi kami bisa
              dilihat di maps yang ada di bawah ini.
            </p>
            <iframe
              src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15810.575997353662!2d110.3970178!3d-7.8274513!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xaad77b93e39dc1d2!2sAnigame!5e0!3m2!1sid!2sid!4v1666768849626!5m2!1sid!2sid"
              style="border: 0"
              allowfullscreen=""
              loading="lazy"
              referrerpolicy="no-referrer-when-downgrade"
              class="mb-4"
            ></iframe>
          </center>
      </div>
      <!-- end google maps -->



    <!-- footer -->
    <div class="mt-5">
    @include('parts.user.footer')
    </div>
    <!-- end  footer -->
    
@endsection