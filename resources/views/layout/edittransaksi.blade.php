@extends('layout.admin')
@section('judul', 'Halaman Transaksi')
@section('konten')
<!--begin::App Content Header-->
        <div class="app-content-header">
          <!--begin::Container-->
          <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
              <div class="col-sm-6">
                <h3 class="mb-0">Edit Data Transaksi</h3>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                  <li class="breadcrumb-item"><a href="#">Transaksi</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Edit Data Transaksi</li>
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
         
          <div class="card card-warning card-outline mb-4 col-md-6">
                  <!--begin::Header-->
                  <div class="card-header">
                    <div class="card-title">Silahkan Edit Transaksi</div>
                  </div>
                  <!--end::Header-->
                  <!--begin::Form-->
                  <form action="/updatetransaksi" method="POST">
                    @csrf
                    <input name="id" type="hidden" class="form-control" value={{ $data->id }} id="tanggaltransaksi" />
                    <!--begin::Body-->
                    <div class="card-body">
                      <div class="mb-3">
                        <label for="kodeproduk" class="form-label">Tanggal Transaksi</label>
                        <input name="tanggaltransaksi" type="date" class="form-control" value={{ $data->tanggal_transaksi }} id="tanggaltransaksi" />
                      </div>
                      <div class="mb-3">
                        <label for="kodetransaksi" class="form-label">Kode Transaksi</label>
                        <input name="kodetransaksi" value={{ $data->kode_transaksi }} type="text" class="form-control" id="namaproduk" />
                      </div>
                     
                      
                    </div>
                    <!--end::Body-->
                    <!--begin::Footer-->
                    <div class="card-footer">
                      <button type="submit" class="btn btn-primary">Update Data</button>
                       <a href="/transaksi" type="submit" class="btn btn-warning">Kembali</a>
                    </div>
                    <!--end::Footer-->
                  </form>
                  <!--end::Form-->
                </div>
        </div>

        @endsection