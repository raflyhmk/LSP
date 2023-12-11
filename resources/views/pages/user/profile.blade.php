@extends('layout.user.master')
  @section('content')
  
      <!-- navbar -->
      <div class="container mt-4">
      @include('parts.user.navbar')
      </div>
      <!-- end  navbar -->

    <section id="insert">
        <div class="container insert">
            
            <h1 class="titleInsert" align="center">Profile</h1>
            <!-- alert success -->
            @if(Session::has('status') && Session::get('status') == 'success')
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{Session::get('message')}}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            <!-- alert failed -->
            @if(Session::has('status') && Session::get('status') == 'failed')
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{Session::get('message')}}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>    
            </div>
            @endif

            <form enctype="multipart/form-data" method="POST" action="" class="form-input">
                @method('put')
                @csrf
                <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                
            <div class="mb-3">
                <label for="inputEmail" class="form-label">Email</label>
                <input
                type="email"
                class="form-control"
                value="{{Auth::user()->email}}"
                name="email"
                />
            </div>
            <div class="mb-3">
                <label for="inputNamaPemilik" class="form-label"
                >Nama</label
                >
                <input
                type="text"
                class="form-control"
                value="{{Auth::user()->name}}"
                name="name"
                required
                />
            </div>
            <hr>
            <div class="mb-3">
                <label for="inputTanggalBeli" class="form-label"
                >Kata sandi</label
                >
                <input type="password" class="form-control" name="password" placeholder="masukan kata sandi..." required />
            </div>
            <div class="mb-3">
                <label for="inputMerk" class="form-label">Konfirmasi password</label>
            <input type="password" class="form-control" name="password_confirmation" placeholder="Ulangi kata sandi..." required />
            </div>
            <div class="mb-3 d-flex justify-content-center">
                <button type="submit" class="btn btn-primary" name="btn-update" >Update</button>
            </div>
            </form>
        </div>
    </section>

    <!-- footer -->
    <div class="mt-5">
    @include('parts.user.footer')
    </div>
    <!-- end  footer -->
    
@endsection