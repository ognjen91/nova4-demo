@component('mail::message')
# {{$salute}}, {{$user->name}}

## Mnogo je aktivnosti u tvom gradu. Na primer:
@foreach ($user->city->activities as $activity)
### {{$activity->title}}
@endforeach

@component('mail::button', ['url' => ''])
Dodji i zabavi se 
@endcomponent

Pozdrav,<br>
Php Srbija
@endcomponent
