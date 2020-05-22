@component('mail::message')

Hi,{{$data['friend_name']}},{{$data['your_name']}} {{$data['your_email']}} has refered you this job.

@component('mail::button', ['url' => $data['job_url']])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
