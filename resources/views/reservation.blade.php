<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"><head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Diteco</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
</head>

<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="/">Diteco</a>
    </div>
</nav>
@if(session('message'))
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <h1 class="card-title text-center mb-4">Réservation confirmée ✌️</h1>

                        <p class="card-text text-center">Votre réservation à l'établissement Bibliothèque Sainte-Geneviève le <?= session('message')['dateReservation'] ?> a bien été confirmée !</p>

                        <p class="card-text text-center">Vous pouvez à tout moment annuler votre venue en utilisant le lien présent dans l'email que nous venons de vous envoyer.</p>

                        <div class="d-grid gap-2 mt-4">
                            <a href="/reservation/annulation/{{ session('message')['token'] }}" class="btn btn-outline-danger" type="button">Annuler la réservation</a>
                            <a href="{{ url('/') }}" class="btn btn-light" type="button">Retour</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@else
    <div class="container mt-5">
    <h1 class="text-center mb-5">Diteco RDV</h1>
    <h2 class="text-center">Réservation</h2>
    <p class="text-center">Réserver une place pour une heure <em>(2 places par heure disponibles)</em>.</p>
        @if(session('status'))
            <div class="alert alert-success text-center">{{ session('status') }}</div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger text-center">{{ session('error') }}</div>
        @endif


    <div class="row justify-content-center">
        <div class="col-sm-8">




            <div class="card">
                <div class="card-body">
                    <form method="post" action="{{ url('/reservation') }}">
                        @csrf
                        <input type="hidden" name="_token" value="sKrXKbQKB1tVGipW0S9eFoQasuylbVjmnrTwn1kF">
                        <label for="date" class="form-label">Date</label>
                        <input type="date" class="form-control" id="date" name="date" value="" min="2021-02-25" >
                        @error('date')
                        <div>{{ $message }}</div>
                        @enderror

                        <div class="my-3">
                            <label for="hour" class="form-label">Heure</label>
                            <input type="time" id="hour" class="form-control" name="hour" min="09:00" max="18:00" step="3600" >
                            @error('hour')
                            <div>{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="my-3">
                            <label for="email" class="form-label">Votre adresse e-mail</label>
                            <input class="form-control" id="email" name="email" placeholder="elon.musk@tesla.com" value="" >
                            @error('email')
                                <div>{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-check mt-4">
                            <input class="form-check-input" type="checkbox" id="cgu" name="cgu" >
                            <label class="form-check-label" for="cgu">
                                J'ai lu et accepté les <a href="#">conditions d'utilisation</a>
                            </label>
                            @error('cgu')
                            <div>{{ $message }}</div>
                            @enderror
                        </div>

                        <div class=" d-grid gap-2 mt-4">
                            <button type="submit" class="btn btn-primary">Réserver</button>
                            <a href="{{ url('/') }}" class="btn btn-light" type="button">Retour</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endif

<footer class="py-5 mt-5 bg-light">
    <div class="container">
        <div class="row">
            <div class="col-4">
                <h5>Diteco</h5>
                <small class="d-block mb-3 text-muted">© 2021</small>
            </div>
            <div class="col-8">
                <ul class="list-unstyled text-small">
                    <li></li>
                    <li><a class="link-secondary" href="#">FAQ</a></li>
                    <li><a class="link-secondary" href="#">Mentions légales</a></li>
                    <li><a class="link-secondary" href="#">Politique d'utilisation des données</a></li>
                </ul>
            </div>
        </div>
    </div>
</footer>



</body>
</html>
