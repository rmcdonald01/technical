@component('mail::message')
# Update

Hello {{ $employee->first_name}}, This is to inform you that today you will not be hiting the streets due to the weather.

Thanks,<br>
{{ config('app.name') }}
@endcomponent
