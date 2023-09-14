@extends('layout.main')

@section('content')
<h3> Data Mobil </h3>
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
                            <th>Merek</th>
                            <th>Model</th>
                            <th>No Plat</th>
                            <th>Harga/Hari</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $nomor = 1+(($mobil->currentPage()-1)*$mobil->perPage());
                        @endphp
                        @foreach ($mobil as $c)
                            <tr>
                                <th>{{ $nomor++}}</th>
                                <th>{{ $c->merek}}</th>
                                <th>{{ $c->model }}</th>
                                <th>{{ $c->no_plat}}</th>
                                <th>{{ $c->harga }}</th>
                                @php
                                    if($c->status == '0'){
                                        echo "<th>Tersedia</th>";
                                
                                    } else {
                                      
                                   echo "<th>Tidak Tersedia</th>";
                                    }
                                @endphp
                                <th>
                                    <button type="button" class="btn btn-sm btn-secondary" data-bs-toggle="modal" data-bs-target="#modalEdit{{ $c->id }}" >
                                        <i class='fas fa-edit'>Edit</i></button>
                                        <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#modalDetail{{ $c->id }}" >
                                            <i class='fas fa-pen-alt'>Detail</i></button>
                                </th>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
             </div>
            </div>
        </div>
        {{ $mobil->links() }}
 <!-- Modal Add -->
 <div class="modal fade" id="modalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Add </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
    
                </button>
            </div>
            <form method="POST" action="{{ url('mobil') }}" enctype="multipart/form-data" >
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="marek" class="col-form-label">Merek<small class="text-danger"><u>*</u></small></label>
                                <input class="form-control" type="text" name="merek" id="marek" required>
                            </div>
                            <div class="col-md-12">
                                <label for="model" class="col-form-label">Model<small class="text-danger"><u>*</u></small></label>
                                <input class="form-control" type="text" name="model" id="model" required></textarea>
                            </div>
                            <div class="col-md-12">
                                <label for="plat" class="col-form-label">No Plat<small class="text-danger"><u>*</u></small></label>
                                <input class="form-control" type="text" name="no_plat" id="plat" required>
                            </div>
                            <div class="col-md-12">
                                <label for="harga" class="col-form-label">Harga<small class="text-danger"><u>*</u></small></label>
                                <input class="form-control" type="text" name="harga" id="harga" required>
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
 @foreach ( $mobil as $c)
 <div class="modal fade" id="modalEdit{{$c->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title font-weight-bold text-primary">Edit Data</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <form method="POST" action="{{ url('mobil/'.$c->id) }}" 
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body">
                   <div class="form-group">
                       <div class="row">
                           <div class="col-md-12">
                               <label for="merek" class="col-form-label">Merek<small class="text-danger"><u>*</u></small></label>
                               <input class="form-control" type="text" name="merek" id="merek" value="{{ $c->merek}}">
                           </div>
                           <div class="col-md-12">
                           
                           <div class="col-md-12">
                               <label for="model" class="col-form-label">Model<small class="text-danger"><u>*</u></small></label>
                               <input   class="form-control" type="text" name="model" id="model" value="{{ $c->model }}"></textarea>
                           </div>
                           <div class="col-md-12">
                               <label for="plat" class="col-form-label">Nomor Plat<small class="text-danger"><u>*</u></small></label>
                               <input class="form-control" type="text" name="no_plat" id="plat" value="{{ $c->no_plat }}">
                           </div>
                           <div class="col-md-12">
                            <label for="harga" class="col-form-label">Harga<small class="text-danger"><u>*</u></small></label>
                            <input class="form-control" type="text" name="harga" id="harga" value="{{ $c->harga }}">
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
  @foreach ( $mobil as $c)
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
                                <th class="text-center"> Merek:</th>
                                <td class="text-center"> <h5>{{ $c->merek }}</h5></td>
                            </tr>
                            <tr>
                                <th class="text-center"> Model :</th>
                                <td class="text-center"> <h5>{{ $c->model }}</h5></td>
                            </tr>
                            <tr>
                                <th class="text-center"> Nomer Plat :</th>
                                <td class="text-center"> <h5>{{ $c->no_plat }}</h5></td>
                            </tr>
                            <tr>
                                <th class="text-center"> Harga:</th>
                                <td class="text-center"> <h5>{{ $c->harga}}</h5></td>
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