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
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-sm-6">
            <div class="card">
                <div class="card-body">
                    <h1 class="card-title text-center mb-4">Annulation de réservation</h1>


                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">Réservation</th>
                                <th scope="col">Durée</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>  <?= $date ?>   </td>
                                <td>1h</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                    <form method="post" action="/reservation/annulation/<?= $token ?>">
                        @csrf
                        <div class="form-check mt-4">
                            <input class="form-check-input" type="checkbox" id="validate" name="validate">
                            <label class="form-check-label" for="validate">
                                Je souhaite annuler ma réservation
                            </label>
                            @error('validate')
                            <div>{{ $message }}</div>
                            @enderror
                        </div>

                        <div class=" d-grid gap-2 mt-4">
                            <button type="submit" class="btn btn-danger">Annuler ma réservation</button>
                            <a href="http://laravel-affluences.herokuapp.com" class="btn btn-light" type="button">Retour</a>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
