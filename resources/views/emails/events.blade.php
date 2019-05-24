@component('mail::message')
Good day,

You have been assigned to an event. Click on the button below to view the details.

@component('mail::button', ['url' => route('calendar_detail' , $id)])
    View Detail
@endcomponent

Thanks,<br>
    {{ config('app.name') }}
@endcomponent



