@component('mail::message')
# Introduction

Thank you for registration . 

Click on below link to verify your Email.

<!-- @component('mail::button', ['url' => $url]) -->
<!-- Verify -->
<a href="{{ route('user.verify', $url) }}">Verify </a>

@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent

