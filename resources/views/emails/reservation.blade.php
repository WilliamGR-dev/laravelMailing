@component('mail::message')
# Introduction

Confirmer votre reservation en cliquant ci-dessous

@component('mail::button', ['url' => env('APP_URL').'reservation/confirm/'.$information['token']])
Confirmer ma reservation
@endcomponent

# Recapitulatif de votre reservation

## Date

{{ $information['dateReservation'] }}

@component('mail::button', ['url' => env('APP_URL').'reservation/annulation/'.$information['token']])
    Annuler ma reservation
@endcomponent

Thanks,<br>
@endcomponent
