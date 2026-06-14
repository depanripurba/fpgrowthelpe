@extends('layout.admin')
@section('judul', 'Transaksi Lanjutan')
@section('konten')
<!--begin::App Content Header-->
        <div class="app-content-header">
          <!--begin::Container-->
          <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
              <div class="col-sm-6">
                <h3 class="mb-0">Item yang memenuhi Minimum support</h3>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                  <li class="breadcrumb-item"><a href="#">Tansaksi</a></li>
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
                    <h3 class="card-title">Data Transaksi</h3>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body">
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th style="width: 10px">No</th>
                          <th>Tanggal Transaksi</th>
                          <th>Kode Produk</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $nomor = 1; ?>
                        @foreach ($transaksi as $trans)
                      
                        <tr class="align-middle">
                          <td>{{$nomor}}</td>
                          <td width="40%">{{$trans['tanggal']}}</td>
                          <td>{{$trans['kode_transaksi']}}</td>
                          
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
        <script>
        function hapusData(id,namaproduk) {
            let cek = confirm('Apakah anda yakin hapus ' + namaproduk + '?');
            console.log(cek);
            if(cek){
              document.location.href="/hapusdatatransaksi/"+id
            }
        }
        </script>
       


        @endsection




      