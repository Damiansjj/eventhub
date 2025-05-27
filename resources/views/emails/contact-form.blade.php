@component('mail::message')
# Nieuw contactformulier bericht

**Van:** {{ $data->name }}  
**E-mail:** {{ $data->email }}  
**Onderwerp:** {{ $data->subject }}

@if($data->event)
**Gerelateerd Evenement:** {{ $data->event->name }} ({{ $data->event->start_date->format('d/m/Y') }})
@endif

**Bericht:**  
{{ $data->message }}

Met vriendelijke groet,  
{{ config('app.name') }}
@endcomponent 