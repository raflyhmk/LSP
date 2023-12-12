@extends('layout.admin.dashboard')

@section('content')
<div class="container-fluid">
        <!-- insert form -->
        <div class="card shadow mb-4">
              <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                  Edit alat kesehatan - {{$editUser -> name}}
                </h6>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <form enctype="multipart/form-data" method="POST" action="" class="form-input" >
                    @method('put')
                    @csrf
                    <div class="mb-3">
                      <label for="inputNamaMobil" class="form-label">Nama</label>
                      <input
                        type="text"
                        class="form-control"
                        placeholder="masukan nama paket..."
                        name="name"
                        value="{{$editUser -> name}}"
                        required
                      />
                    </div>
                    <div class="mb-3">
                      <label for="inputNamaMobil" class="form-label">Email</label>
                      <input
                        type="text"
                        class="form-control"
                        placeholder="masukan email..."
                        name="email"
                        value="{{$editUser -> email}}"
                        required
                      />
                    </div>
                      
                    <div class="mb-3">
                      <label for="inputMerk" class="form-label">Password</label>
                      <input
                        type="password"
                        class="form-control"
                        placeholder="Masukan password..."
                        name="password"
                      />
                      </div> 
                    
                    <div class="mb-3">
                      <button type="submit" class="btn btn-primary" name="btn-insert">Update user</button>
                    </div>
                  </form>               
                </div>
              </div>
        </div>
    </div>
@endsection