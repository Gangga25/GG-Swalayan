@extends('template.index')

@section('title', 'Home')

@section('content')

<div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Customer</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Data Customer</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Data Customer</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>Alamat</th>
                        <th>Jenis Kelamin</th>
                        <th>Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($data as $item)
                        <tr>
                            <td>{{ $item->id}}</td>
                            <td>{{ $item->name}}</td>
                            <td>{{ $item->address}}</td>
                            <td>{{ $item->gender == 1 ? 'Laki-Laki' : 'Perempuan'}}</td>
                            <td>{{ $item->status == 1 ? 'Aktif' : 'Tidak'}}</td>
                            <td>
                              <a href="/customers/{{ $item->id }}">
                                <button type="button" class="btn btn-warning btn-sm"><i
                                  class="far fa-edit"></i></button>
                                </a>

                                <form action="/customers/{{ $item->id}}" method="GET">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"><i
                                        class="far fa-trash-alt"></i></button>
                                </form>
                            </td>
                        </tr>    
                    @endforeach
                  
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
    
@endsection