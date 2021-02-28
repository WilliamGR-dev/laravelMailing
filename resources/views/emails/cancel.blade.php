@component('mail::message')
    # Votre reservation a etait annuler

    # Recapitulatif de votre reservation

    ##  Date

    {{ $information['date']  }}

    Thanks,<br>
@endcomponent
