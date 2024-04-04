<!DOCTYPE html>
<html>

<head>
    <title>GundFactory</title>
    <link rel="icon" type="image/x-icon" href="/logo.ico">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bungee+Hairline&family=Bungee+Shade&family=IM+Fell+Great+Primer+SC&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=MuseoModerno:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
</head>

<body>

    <nav class="navbar">
        <a class="navbar-brand" href="/home">
            <!-- GUND<span>FACTORY</span> -->
            <img class="gundam pulse" src="/gundfactory.png" style="width: 300px;">
        </a>


        @if(Auth::guard('admin')->check())

            <ul class="navbar-nav">
                <li class="nav-item grow1">
                    <a class="nav-link" href="/home">Home</a>
                </li>
                <li class="nav-item grow1">
                    <a class="nav-link" href="{{ route('items.index')}}">Inventory</a>
                </li>
                <li class="nav-item grow1">
                    <a class="nav-link" href="{{ route('order.orders')}}">Orders</a>
                </li>
                <li class="nav-item grow1">
                    <a class="nav-link" href="{{ route('user.users') }}">Users</a>
                </li>
            </ul>
            <div>


            <form method="POST" action="{{ route('admin.logout') }}">
                @csrf
                <button type="submit" class="logout-btn">Logout</button>
            </form>
        </div>
        @endif

    </nav>

    <div class="">
        @yield('content')
    </div>


</body>

</html>
