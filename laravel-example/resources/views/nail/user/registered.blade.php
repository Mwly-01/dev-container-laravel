@component('mail:message')
    # !Hola,{{$user->name}}!
    tu registro a sido exitosamente guardado 
    ya puedes utilizar nuestra api
    @component('mail::button',['url'=> config('app.url')])
    Ir la app
    @endcomponent

    gracias por visitar nuestra app

    {{ config{'app.name'}}}
@endcomponent    

