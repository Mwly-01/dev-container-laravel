<?php

namespace App\Providers;
use Laravel\Passport\Passport;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    
     protected $policies =[

     ];

    public function boot(): void
    {
        $this->registerPolicies();

        //Definir Tokens

        Passport::tokensExpireIn(now()->addHours(2));
        Passport::refreshTokensExpireIn(now()->addDay(30));
        Passport::personalAccessTokensExpireIn(now()->addMonth(6));

        
        //SCOPES
        //recurso.action
        Passport::tokensCan([
            'posts.read' => 'Leer posts',
            'posts.write' => 'Crear o editar post',
            'posts.delete' => 'eliminar',
            'posts.admin'=> 'Acceso VIP',
        ]);

        Passport::defaultScopes([
            'posts.read',
            
        ]);
 
    }
}
