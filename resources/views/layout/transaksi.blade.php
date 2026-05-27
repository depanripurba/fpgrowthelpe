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
                <h3 class="mb-0">Transaksi</h3>
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
                    <a class="btn btn-primary mb-3" href="/tambahtransaksi">Tambah Transaksi</a>
                    
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th style="width: 10px">No</th>
                          <th>Tanggal Transaksi</th>
                          <th>Kode Produk</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $nomor = 1; ?>
                        @foreach ($transaksi as $trans)
                      
                        <tr class="align-middle">
                          <td>{{$nomor}}</td>
                          <td width="20%">{{$trans->tanggal_transaksi}}</td>
                          <td>{{$trans->kode_transaksi}}</td>
                          <td width="20%">
                            <a href="/editdatatransaksi/{{ $trans->id }}" class="btn btn-primary">Edit</a>
                            <button onclick="hapusData({{ $trans->id }},'{{ $trans->kode_transaksi  }}')" class="btn btn-danger">Hapus</button>
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




      