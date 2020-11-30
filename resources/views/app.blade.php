<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    <link href="{{ mix('/css/app.css') }}" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="{{ mix('/js/app.js') }}" defer></script>
  </head>
  <body>
    <nav class="navbar navbar-expand-md navbar-light shadow-sm" style="background-color: #008080">
        <a class="navbar-brand text-light" href="{{ route('home') }}">SAMBA-STORE</a>
        <div class="dropdown pmd-dropdown pmd-user-info ml-auto">
            @if (Route::has('login'))
            <a href="" style="color:white" class="btn dropdown-toggle media align-items-center" data-toggle="dropdown" data-sidebar="true" aria-expanded="false">
                    @auth
                        @if(Auth::user()->avatar != null)
                            <img class="mr-2 rounded" src='{{ asset("uploads/avatar/".Auth::user()->avatar) }}' width="40" height="40" alt="avatar">
                            <span>{{ Auth::user()->name }}</span>
                        @else
                            <img class="mr-2" src="https://pro.propeller.in/assets/images/avatar-icon-40x40.png" width="40" height="40" alt="avatar" />
                            <span style="color: white">{{ Auth::user()->name }}</span>
                        @endif
                    @else
                        <a style="color:white" class="mr-2" href="{{ route('login') }}">Connexion</a>

                    @if (Route::has('register'))
                        <a style="color: white" href="{{ route('register') }}">Inscription</a>
                    @endif
                    @endauth
                </a>
                @endif

            @if(Auth::check())
            <ul class="dropdown-menu dropdown-menu-right" role="menu">
                @if(Auth::check() && Auth::user()->isActive == true)
                <a class="dropdown-item" href="{{ url('/home') }}">
                    Dashboard
                </a>
                <a class="dropdown-item" href="{{ url('/contact') }}">
                    Contact
                </a>
                @if(Auth::check() && Auth::user()->isAdmin == false)
                <a class="dropdown-item" href="{{ url('/message') }}">
                    Messagerie
                </a>
                @if(Auth::check())
                <a class="dropdown-item" href="{{ url('/updateUserProfile/'.Auth::user()->id) }}">
                    Modifier profil
                </a>
                @endif
                <a class="dropdown-item" href="{{ url('/userPost') }}">
                    poster une annonce
                </a>
                @endif
                @else
                <a class="dropdown-item" href="{{ url('/deactivate') }}">
                    Profile
                </a>
                @endif
                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    Deconnexion
                </a>
            </ul>
            @endif
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </div>
    </nav>
    <div>
        @inertia
    </div>
    <script>
        setTimeout(() => {
            console.log("recharger");
        }, 9000);
    </script>
  </body>
</html>
