@extends('layout.main')

@section('content')
<h3> Data Pesanan </h3>
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-4 ">
                    <button type="button" class="btn btn-sm btn-primary " data-bs-toggle="modal" data-bs-target="#modalCenter" >
                        <i class='fas fa-plus-circle'></i> Add</button>
                    </div>
                  
            </div>
            <div class="card-body">
                @if (session('msg'))
                <div class="alert alert-success alert-dismissible fade show " role="alert">
                   {{ session('msg') }}<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
                  
                    </div>
                @endif
                <form action="" method="get">
                    <div class="row mb-3">
                       <label type="date" class="col-sm-2 "></label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control form-control-sm" value="{{ $search }}" placeholder="Input untuk Mencari Data"
                            name="search" autofokus>
                        </div>
                    </div>
                </form>
             <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Alamat</th>
                            <th>No Telphone</th>
                            <th>Tanggal Registerasi</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $nomor = 1+(($customer->currentPage()-1)*$customer->perPage());
                        @endphp
                        @foreach ($customer as $c)
                            <tr>
                                <th>{{ $nomor++}}</th>
                                <th>{{ $c->id}}</th>
                                <th>{{ $c->name}}</th>
                                <th>{{ $c->alamat }}</th>
                                <th>{{ $c->no_tlp }}</th>
                                <th>{{ $c->created_at }}</th>
                                <th>
                                    <button type="button" class="btn btn-sm btn-secondary" data-bs-toggle="modal" data-bs-target="#modalEdit{{ $c->id }}" >
                                        <i class='fas fa-edit'></i></button>
                                        <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#modalDetail{{ $c->id }}" >
                                            <i class='fas fa-pen-alt'></i></button>
                                </th>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
             </div>
            </div>
        </div>
        {{ $customer->links() }}
 <!-- Modal Add -->
 <div class="modal fade" id="modalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Add </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
    
                </button>
            </div>
            <form method="POST" action="{{ url('customer') }}" enctype="multipart/form-data" >
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="name" class="col-form-label">Nama Customer<small class="text-danger"><u>*</u></small></label>
                                <input class="form-control" type="text" name="name" id="name" required>
                            </div>
                            <div class="col-md-12">
                                <label for="address" class="col-form-label">Alamat<small class="text-danger"><u>*</u></small></label>
                                <textarea class="form-control" type="text" name="address" id="address" required></textarea>
                            </div>
                            <div class="col-md-12">
                                <label for="phone" class="col-form-label">No Telephone<small class="text-danger"><u>*</u></small></label>
                                <input class="form-control" type="text" name="phone" id="phone" required>
                            </div>
                        </div>
                    </div>

                </div>
                <div class=" modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn  btn-sm btn-primary"> <i class="fas fa-save"></i> Save</button>
                </div>

            </form>
        </div>
    </div>
</div>

 <!-- Modal Edit Employee -->
 @foreach ( $customer as $c)
 <div class="modal fade" id="modalEdit{{$c->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title font-weight-bold text-primary">Edit Data</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <form method="POST" action="{{ url('customer/'.$c->id) }}" 
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body">
                   <div class="form-group">
                       <div class="row">
                           <div class="col-md-12">
                               <label for="name" class="col-form-label">Nama<small class="text-danger"><u>*</u></small></label>
                               <input class="form-control" type="text" name="name" id="name" value="{{ $c->name}}">
                           </div>
                           <div class="col-md-12">
                           
                           <div class="col-md-12">
                               <label for="address" class="col-form-label">Alamat<small class="text-danger"><u>*</u></small></label>
                               <textarea class="form-control" type="text" name="address" id="address" value="{{ $c->alamat }}"></textarea>
                           </div>
                           <div class="col-md-12">
                               <label for="phone" class="col-form-label">Nomor Telephone<small class="text-danger"><u>*</u></small></label>
                               <input class="form-control" type="text" name="phone" id="phone" value="{{ $c->no_tlp }}">
                           </div>
                       </div>
                   </div>
                </div>
               <div class=" modal-footer">
                   <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
                   <button type="submit" class="btn btn-sm btn-primary"> <i class="fas fa-save"></i> Save</button>
               </div>
           </form>
        </div>
    </div>
</div>   
</div>
 @endforeach
  <!-- Modal Edit Employee -->
  @foreach ( $customer as $c)
  <div class="modal fade" id="modalDetail{{$c->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
     <div class="modal-dialog modal-dialog-centered" role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <h6 class="modal-title font-weight-bold text-primary">Detail Data</h6>
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                 </button>
             </div>
                 <div class="modal-body">
                    <table class="table table-borderless">
                        <tbody>
                            <tr>
                                <th class="text-center"> ID :</th>
                                <td class="text-center"> <h5>{{ $c->id }}</h5></td>
                            </tr>
                            <tr>
                                <th class="text-center"> Nama :</th>
                                <td class="text-center"> <h5>{{ $c->name }}</h5></td>
                            </tr>
                            <tr>
                                <th class="text-center"> Alamat :</th>
                                <td class="text-center"> <h5>{{ $c->alamat }}</h5></td>
                            </tr>
                            <tr>
                                <th class="text-center"> Nomer Telephone :</th>
                                <td class="text-center"> <h5>{{ $c->no_tlp }}</h5></td>
                            </tr>
                            <tr>
                                <th class="text-center"> Tanggal Register :</th>
                                <td class="text-center"> <h5>{{ $c->created_at }}</h5></td>
                            </tr>
                        </tbody>
                    </table>
                 </div>
                
         </div>
     </div>
 </div>   
 </div>
  @endforeach
@endsection