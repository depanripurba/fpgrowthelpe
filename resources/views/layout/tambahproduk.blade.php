@extends('layout.admin')
@section('judul', 'Halaman Produk')
@section('konten')
<!--begin::App Content Header-->
        <div class="app-content-header">
          <!--begin::Container-->
          <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
              <div class="col-sm-6">
                <h3 class="mb-0">Tambah Produk</h3>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                  <li class="breadcrumb-item"><a href="#">Produk</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Tambah Produk</li>
                </ol>
              </div>
            </div>
            <!--end::Row-->
          </div>
          <!--end::Container-->
        </div>
        <!--end::App Content Header-->
        <!--begin::App Content-->
        <div class="app-content">
          <!--begin::Container-->
        <div class="container-fluid">
         
          <div class="card card-primary card-outline mb-4 col-md-6">
                  <!--begin::Header-->
                  <div class="card-header">
                    <div class="card-title">Silahkan Tambah Produk</div>
                  </div>
                  <!--end::Header-->
                  <!--begin::Form-->
                  <form action="/tambahkankedb" method="POST">
                    @csrf
                    <!--begin::Body-->
                    <div class="card-body">
                      <div class="mb-3">
                        <label for="kodeproduk" class="form-label">Kode Produk</label>
                        <input name="kodeproduk" type="text" class="form-control" id="kodeproduk" />
                      </div>
                      <div class="mb-3">
                        <label for="namaproduk" class="form-label">Nama Produk</label>
                        <input name="namaproduk" type="text" class="form-control" id="namaproduk" />
                      </div>
                     
                      
                    </div>
                    <!--end::Body-->
                    <!--begin::Footer-->
                    <div class="card-footer">
                      <button type="submit" class="btn btn-primary">Tambahkan</button>
                    </div>
                    <!--end::Footer-->
                  </form>
                  <!--end::Form-->
                </div>
        </div>

        @endsection