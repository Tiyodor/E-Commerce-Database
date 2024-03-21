<!DOCTYPE html>
<html>
<head>
    <title>GundFactory</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="/home">GundFactory</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="/home">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('index')}}">Inventory</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Orders</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('users') }}">Users</a>
        </li>
      </ul>
      
      <!-- Check if admin is logged in -->
      @if(Auth::guard('admin')->check())
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <form method="POST" action="{{ route('admin.logout') }}">
            @csrf
            <button type="submit" class="btn btn-link nav-link">Logout</button>
          </form>
        </li>
      </ul>
      @endif
      <!-- End of check -->
    </div>
  </div>
</nav>

<div class="container">
    @yield('content')
</div>

</body>
</html>
