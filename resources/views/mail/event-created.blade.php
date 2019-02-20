@component('mail::message')
Cпасибо что зарегестировались на наше мероприятие№{{$eventer->event_numb}}!

@component('mail::button', ['url' => ''])
Жмак-жмак
@endcomponent

Збазибо,<br>
{{ config('app.name') }}
@endcomponent
