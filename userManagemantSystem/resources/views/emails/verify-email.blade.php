@component('mail::message')
# Introduction

Thank you for registration . 

Click on below link to verify your Email.

@component('mail::button', ['url' => '$url'])
Verify
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
