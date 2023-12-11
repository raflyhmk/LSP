@extends('layout.admin.dashboard')

@section('content')
    <div class="container-fluid">
        <!-- insert form -->
        <div class="card shadow mb-4">
              <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                  Edit alat kesehatan - {{$alatKesehatan -> name}}
                </h6>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <form enctype="multipart/form-data" method="POST" action="" class="form-input" >
                    @method('put')
                    @csrf
                    <div class="mb-3">
                      <label for="inputNamaMobil" class="form-label">Nama alat kesehatan</label>
                      <input
                        type="text"
                        class="form-control"
                        placeholder="masukan nama paket..."
                        name="name"
                        value="{{$alatKesehatan -> name}}"
                        required
                      />
                    </div>
                    <div class="mb-3">
                      <label for="formFile" class="form-label">Foto alat kesehatan</label>
                      <input type="file" class="form-control-file" name="foto" value="{{$alatKesehatan -> foto}}"/>
                    </div>
                    <div class="mb-3">
                        <div class="form-group">
                        <label for="exampleFormControlTextarea1">Kategori alat kesehatan</label>
                        <select class="custom-select" name="kategori">
                            <option disabled selected>pilih status kategori alat kesehatan</option>
                            <option value="Alat Bantu Jalan" @if($alatKesehatan -> kategori == "Alat Bantu Jalan") selected @endif>Alat Bantu Jalan</option>
                            <option value="Alat Bantu Pendengaran" @if($alatKesehatan -> kategori == "Alat Bantu Pendengaran") selected @endif>Alat Bantu Pendengaran</option>
                            <option value="Alat Bantu Penglihatan" @if($alatKesehatan -> kategori == "Alat Bantu Penglihatan") selected @endif>lat Bantu Penglihatan</option>
                            <option value="Alat Bantu Pernapasan" @if($alatKesehatan -> kategori == "Alat Bantu Pernapasan") selected @endif>Alat Bantu Pernapasan</option>
                            <option value="Alat Pemeriksaan" @if($alatKesehatan -> kategori == "Alat Pemeriksaan") selected @endif>Alat Pemeriksaan</option>
                            <option value="Alat Bantu Tidur dan Posisi" @if($alatKesehatan -> kategori == "Alat Bantu Tidur dan Posisi") selected @endif>Alat Bantu Tidur dan Posisi</option>
                            <option value="Alat Pemantau Kesehatan" @if($alatKesehatan -> kategori == "Alat Pemantau Kesehatan") selected @endif>Alat Pemantau Kesehatan</option>
                            <option value="Alat Rehabilitasi" @if($alatKesehatan -> kategori == "Alat Rehabilitasi") selected @endif>Alat Rehabilitasi</option>
                            <option value="Alat Bantu Olahraga dan Kesehatan" @if($alatKesehatan -> kategori == "Alat Bantu Olahraga dan Kesehatan") selected @endif>Alat Bantu Olahraga dan Kesehatan</option>
                            <option value="Alat Sanitasi" @if($alatKesehatan -> kategori == "Alat Sanitasi") selected @endif>Alat Sanitasi</option>
                            <option value="Alat Bantu Keperawatan" @if($alatKesehatan -> kategori == "Alat Bantu Keperawatan") selected @endif>Alat Bantu Keperawatan</option>
                            <option value="Alat Pemberian Obat" @if($alatKesehatan -> kategori == "Alat Pemberian Obat") selected @endif>Alat Pemberian Obat</option>
                            <option value="Alat Pemberian Obat" @if($alatKesehatan -> kategori == "Alat Pemberian Obat") selected @endif>Alat Pemberian Obat</option>
                            <option value="Alat Bantu Kesehatan Mental" @if($alatKesehatan -> kategori == "Alat Bantu Kesehatan Mental") selected @endif>Alat Bantu Kesehatan Mental</option>
                      </select>
                    </div>   
                    <div class="mb-3">
                      <label for="inputMerk" class="form-label">Merk alat kesehatan</label>
                      <input
                        type="text"
                        class="form-control"
                        placeholder="Masukan series produk..."
                        name="merk"
                        value="{{$alatKesehatan -> merk}}"
                        required
                      />
                      </div> 
                    
                    <div class="mb-3">
                      <button type="submit" class="btn btn-primary" name="btn-insert">Tambahkan alat kesehatan</button>
                    </div>
                  </form>               
                </div>
              </div>
        </div>
    </div>
@endsection