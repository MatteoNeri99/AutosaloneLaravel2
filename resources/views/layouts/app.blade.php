

<!DOCTYPE html>
<html lang="it">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>{{ config('app.name', 'Autosalone') }}</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200..700&display=swap" rel="stylesheet">
        @vite(['resources/sass/general.scss'])

    </head>
    <body>

        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
                <a class="navbar-brand titolo" href="{{ url('/home') }}">Autosalone Di Fulvio Giacomo</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('auto.index') }}">Auto</a>
                        </li>
                        @auth
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('auto.create') }}">Aggiungi Auto</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('messages') }}">Messaggi</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('auto.cestino') }}">Cestino</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin.logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                                <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </li>
                        @else
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin.login') }}">Login</a>
                            </li>

                        @endauth
                    </ul>
                </div>
            </div>
        </nav>
        @auth

        @endauth

        @guest

        @endguest

        @yield('content')

        <footer class="bg-dark text-white mt-5">
            <div class="container py-4">
                <div class="row">
                    <div class="col text-center">
                        <p>&copy; {{ date('Y') }} Autosalone. Tutti i diritti riservati.</p>
                    </div>
                </div>
            </div>
        </footer>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    </body>
</html>

