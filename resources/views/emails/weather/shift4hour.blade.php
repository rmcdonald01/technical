@component('mail::message')
# Update

Hello {{ $employee->first_name }}, Due to the current weather your schedule as been change to 4 hours and not the usual 8.



Thanks,<br>
{{ config('app.name') }}
@endcomponent
