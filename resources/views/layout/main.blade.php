<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>APP Persewaan Mobil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">{{-- <link href="{{asset('/')}}assets/plugins/fontawesome/css/all.min.css" rel="stylesheet" > --}}
    <script src="https://kit.fontawesome.com/yourcode.js" crossorigin="anonymous"></script>
  </head>
  <body>
   {{-- navbar --}}
    <nav class="navbar navbar-expand-lg bg-primary navbar-dark">
        <div class="container">
          <h4 class="navbar-brand" href="#"></h4>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link {{ (request()->segment('1')==''||request()->segment('1')=='home') ?
                 'active':'' }}" aria-current="page" href="{{ url('home') }}">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link {{ (request()->segment('1')=='pesanan') ? 'active':'' }}" 
                    href="{{ url('pesanan') }}">Pesanan</a>
              </li>
              <li class="nav-item">
                <a class="nav-link {{ (request()->segment('1')=='pengembalian') ? 'active':'' }}" 
                    href="{{ url('pengambilan') }}">Pengembalian</a>
              </li>
            
              <li class="nav-item">
                <a class="nav-link {{ (request()->segment('1')=='mobil') ? 'active':'' }}" 
                    href="{{ url('mobil') }}">Mobil Master Data</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ route('logout') }}">Logout</a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
      {{-- end --}}
    <div class="mt-2">
        <div class="container">
            @yield('content')
        </div>
    </div>   
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
  </body>
</html>