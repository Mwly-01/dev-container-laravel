<?php

namespace App\Providers;

use App\Models\User;
use App\Policies\PostPolicy;
use Laravel\Passport\Passport;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
class AuthServiceProvider extends ServiceProvider
{
    
     protected $policies =[
        PostPolicy::class,
     ];

    public function boot(): void
    {
        $this->registerPolicies();

        //Definir Tokens

        Passport::tokensExpireIn(now()->addHours(2));
        Passport::refreshTokensExpireIn(now()->addDay(30));
        Passport::personalAccessTokensExpireIn(now()->addMonth(6));

        
        //gates

        Gate::define('view-health', function(User $user){
            return $user->hasRole(['editor','viewer']);
        });

        Gate::define('view-health', function(User $user){
            return $user->hasRole(['editor','admin'])|| $user->tokenCan('posts.admin');
        });

        // //No recomendo 
        // Gate::before(function(User $user, string $ability){
        //     return $user->hasRole(['admin']) ? true : null; //true-> concede los permisos 
        // });



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
