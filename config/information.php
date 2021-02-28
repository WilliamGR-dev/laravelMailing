<?php

return [

    'name' => env('APP_NAME', 'Laravel'),

    'reservation' => [

        'jours' => ['lundi','mardi','mercredi','jeudi','vendredi','samedi','dimanche'],
        'hours_min' => 9,
        'hours_max' => 18,
        'reservation_min' => 1,
        'reservation_max' => 2,
    ],

];
