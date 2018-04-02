@component('mail::message')
# Weather update

Hello {{ $employee->first_name}}, The weather for today is {{$weather->description}}.


Thanks,<br>
{{ config('app.name') }}
@endcomponent
