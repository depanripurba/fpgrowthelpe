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
                <h3 class="mb-0">Produk</h3>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                  <li class="breadcrumb-item"><a href="#">Produk</a></li>
                  <li class="breadcrumb-item active" aria-current="page">index</li>
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
         <div class="card mb-4">
                  <div class="card-header">
                    <h3 class="card-title">Data Produk</h3>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body">
                    <a class="btn btn-primary mb-3" href="/tambahproduk">Tambah Produk</a>
                    
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th style="width: 10px">No</th>
                          <th>Kode Produk</th>
                          <th>Nama Produk</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $nomor = 1; ?>
                        @foreach ($produks as $produk)
                      
                        <tr class="align-middle">
                          <td>{{$nomor}}</td>
                          <td width="20%">{{$produk->kode_produk}}</td>
                          <td>{{$produk->nama_produk}}</td>
                          <td width="20%">
                            <button class="btn btn-primary">Edit</button><button class="btn btn-danger">Hapus</button>
                        </td>
                        </tr>
                        <?php $nomor++; ?>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                  <!-- /.card-body -->
                  
                </div>
          </div>
          <!--end::Container-->
        </div>

        @endsection