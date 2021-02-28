<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"><head>

    <link type="text/css" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Google+Sans:400,500,700">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Diteco</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <script src="{{ asset('js/googleMap.js') }}" rel="script"></script>
    <script async
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAiqvEhiIlFG_oqUWmc3Yx4BzN_0n68WDc&callback=initMap">
    </script>

<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="/">Diteco</a>
    </div>
</nav>
<div style=" background: url('https://diteco.fr/bg.jpg') center center no-repeat; background-size: cover;">
    <div class="position-relative overflow-hidden p-3 p-md-5 text-center" style="background-color: rgba(0,0,0,0.6)">
        <div class="col-md-12 p-lg-5 mx-auto my-5">
            <h1 class="display-4 fw-normal text-white">Reservation RDV</h1>
            <a class="btn btn-primary btn-lg mt-4" href="{{ url('/reservation') }}">Réserver</a>
        </div>
    </div>
</div>

<div class="container mt-5 text-center">

    <p>
        Diteco aide les particuliers à effectuer leur transition énergétique depuis 2 ans. Chaque particulier est accompagné du début et même après que l'installation est terminé. L'objectif de Diteco est toujours le même qui est de proposé une énergie qui respecte l'environnement.
    </p>
    <h2 class="mb-5">Horaires</h2>

    <div class="table-responsive">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">{{ $information['jours'][0] }}</th>
                <th scope="col">{{ $information['jours'][1] }}</th>
                <th scope="col">{{ $information['jours'][2] }}</th>
                <th scope="col">{{ $information['jours'][3] }}</th>
                <th scope="col">{{ $information['jours'][4] }}</th>
                <th scope="col">{{ $information['jours'][5] }}</th>
                <th scope="col">{{ $information['jours'][6] }}</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>{{ $information['hours_min'] }}h - {{ $information['hours_max'] }}h</td>
                <td>{{ $information['hours_min'] }}h - {{ $information['hours_max'] }}h</td>
                <td>{{ $information['hours_min'] }}h - {{ $information['hours_max'] }}h</td>
                <td>{{ $information['hours_min'] }}h - {{ $information['hours_max'] }}h</td>
                <td>{{ $information['hours_min'] }}h - {{ $information['hours_max'] }}h</td>
                <td class="text-muted"><em>Fermé</em></td>
                <td class="text-muted"><em>Fermé</em></td>
            </tr>
            </tbody>
        </table>
    </div>

    <h2 class="my-5">Informations pratiques</h2>

    <div id="map"></div>

</div>

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
                    <li><a class="link-secondary" href="#">Politique d utilisation des données</a></li>
                </ul>
            </div>
        </div>
    </div>
</footer>



</body>
</html>
