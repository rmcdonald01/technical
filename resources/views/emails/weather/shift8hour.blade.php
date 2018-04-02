@component('mail::message')
# Update

Hello {{ $employee->first_name}}, This email is infrom you that today you will doing your usual 8 hours shift.


Thanks,<br>
{{ config('app.name') }}
@endcomponent
