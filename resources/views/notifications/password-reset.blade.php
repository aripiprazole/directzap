@component('mail::message')
Olá, {{ $user->name }}

Esse email foi enviado para mudança da sua senha.

@component('mail::button', compact('url'))
  Mudar senha
@endcomponent

Se você não requisitou isso, apenas ignore.
@endcomponent
