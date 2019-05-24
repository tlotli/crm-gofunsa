@component('mail::message')
    Good day,

    You have been assigned to a task. Click on the button below to view the details.

@component('mail::button', ['url' => route('overdue_visitations_with_tasks')])
    View Detail
@endcomponent

    Thanks,<br>
    {{ config('app.name') }}
@endcomponent



