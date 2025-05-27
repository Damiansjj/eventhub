@component('mail::message')
# Nieuw contactformulier bericht

**Van:** {{ $data['name'] }}  
**E-mail:** {{ $data['email'] }}  
**Onderwerp:** {{ $data['subject'] }}

**Bericht:**  
{{ $data['message'] }}

@component('mail::button', ['url' => route('admin.contact.index')])
Bekijk alle berichten
@endcomponent

Met vriendelijke groet,  
{{ config('app.name') }}
@endcomponent 