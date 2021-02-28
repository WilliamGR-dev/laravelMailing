@component('mail::message')
# Introduction

Confirmer votre reservation en cliquant ci-dessous

@component('mail::button', ['url' => 'http://127.0.0.1:8000/reservation/confirm/'.$information['token']])
Confirmer ma reservation
@endcomponent

# Recapitulatif de votre reservation

## Date

{{ $information['dateReservation'] }}

@component('mail::button', ['url' => 'http://127.0.0.1:8000/reservation/annulation/'.$information['token']])
    Annuler ma reservation
@endcomponent

Thanks,<br>
@endcomponent
