<?php

namespace App\Controllers;

use App\Validation\Validation;
use Respect\Validation\Validator as v;
use Illuminate\Database\Capsule;
use App\Models\User;

class AuthController extends Controller{
    
    public function getSignUp($request, $response){
        return $this->_view->render($response, 'auth/signup.twig');
    }

    public function postSignUp($request, $response){
        $validate = Validation::validate($request, [
            'username' => v::alpha()->length(6, 20)->uniqueUsername(),
            'password' => v::noWhitespace()->length(6, 20)->setName('Password'),
            'first_name' => v::alpha()->length(1, 50)->setName('First Name'),
            'last_name' => v::alpha()->length(1, 50)->setName('Last Name')
        ]);
        
        
        if($validate){
            User::create([
                'username' => $request->getParam('username'),
                'password' => password_hash($request->getParam('password'), PASSWORD_DEFAULT),
                'first_name' => $request->getParam('first_name'),
                'last_name' => $request->getParam('last_name')
            ]);

            return $response->withRedirect('signin');
        }
        return $response->withRedirect('signup');
    }


    public function getSignIn($request, $response){

        return $this->_view->render($response, 'auth/signin.twig');
    }

    public function postSignIn($request, $response){
        $user = User::where('username', $request->getParam('username'))->first();

        if($user){
            $ps = password_verify($request->getParam('password'), $user->password);
            if($ps){
                $_SESSION['user'] = $user->id;

                if(isset($_SESSION['user'])){
                    return $response->withRedirect('home');
                }
            }
        }

        return $response->withRedirect('signin');
    }
    
    
    public function signOut($request, $response){
        unset($_SESSION['user']);
        
        return $response->withRedirect('home');
    }
    
    
    public static function isLoggedIn(){
        return isset($_SESSION['user']) ? true : false;
    }
    
    public static function username(){
        return isset($_SESSION['user']) ? User::where('id', $_SESSION['user'])->first()->username : false;
    }
}