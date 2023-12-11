@extends('layout.admin.dashboard')

@section('content')
    <div class="container-fluid">
        <!-- insert form -->
        <div class="card shadow mb-4">
              <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                  Tambah alat kesehatan
                </h6>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <form enctype="multipart/form-data" method="POST" action="" class="form-input" >
                    @csrf
                    <div class="mb-3">
                      <label for="inputNamaMobil" class="form-label">Nama alat kesehatan</label>
                      <input
                        type="text"
                        class="form-control"
                        placeholder="masukan nama paket..."
                        name="name"
                        required
                      />
                    </div>
                    <div class="mb-3">
                      <label for="formFile" class="form-label">Foto alat kesehatan</label>
                      <input type="file" class="form-control-file" name="foto" required/>
                    </div>
                    <div class="mb-3">
                        <div class="form-group">
                        <label for="exampleFormControlTextarea1">Kategori alat kesehatan</label>
                        <select class="custom-select" name="kategori">
                            <option disabled selected>pilih status kategori alat kesehatan</option>
                            <option value="Alat Bantu Jalan">Alat Bantu Jalan</option>
                            <option value="Alat Bantu Pendengaran">Alat Bantu Pendengaran</option>
                            <option value="Alat Bantu Penglihatan">lat Bantu Penglihatan</option>
                            <option value="Alat Bantu Pernapasan">Alat Bantu Pernapasan</option>
                            <option value="Alat Pemeriksaan">Alat Pemeriksaan</option>
                            <option value="Alat Bantu Tidur dan Posisi">Alat Bantu Tidur dan Posisi</option>
                            <option value="Alat Pemantau Kesehatan">Alat Pemantau Kesehatan</option>
                            <option value="Alat Rehabilitasi">Alat Rehabilitasi</option>
                            <option value="Alat Bantu Olahraga dan Kesehatan">Alat Bantu Olahraga dan Kesehatan</option>
                            <option value="Alat Sanitasi">Alat Sanitasi</option>
                            <option value="Alat Bantu Keperawatan">Alat Bantu Keperawatan</option>
                            <option value="Alat Pemberian Obat">Alat Pemberian Obat</option>
                            <option value="Alat Pemberian Obat">Alat Pemberian Obat</option>
                            <option value="Alat Bantu Kesehatan Mental">Alat Bantu Kesehatan Mental</option>
                      </select>
                    </div>   
                    <div class="mb-3">
                      <label for="inputMerk" class="form-label">Merk alat kesehatan</label>
                      <input
                        type="text"
                        class="form-control"
                        placeholder="Masukan series produk..."
                        name="merk"
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