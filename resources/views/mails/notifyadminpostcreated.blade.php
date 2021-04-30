@component('mail::message')
# Introduction

New Post Created {{ $post->post_title }}

@component('mail::button', ['url' => config('app.url').'/horizon'])
Open Horizon
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
