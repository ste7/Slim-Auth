<?php

namespace App\Controllers;

use App\Validation\Validation;
use Respect\Validation\Validator as v;
use Illuminate\Database\Capsule;
use App\Models\User;

class ProfileController extends Controller{


    public function getProfile($request, $response){
        $user = User::where('id', $_SESSION['user'])->first();
        
        return $this->_view->render($response, 'profile.twig', [
            'username' => $user->username,
            'first_name' => $user->first_name,
            'last_name' => $user->last_name
        ]);
    }


    public function postProfile($request, $response){
        if(isset($_POST['update-profile'])){
            $validate = Validation::validate($request, [
                'first_name' => v::alpha()->length(1, 50)->setName('First Name'),
                'last_name' => v::alpha()->length(1, 50)->setName('Last Name')
            ]);

            if($validate){
                User::where('id', $_SESSION['user'])->update([
                    'first_name' => $request->getParam('first_name'),
                    'last_name' => $request->getParam('last_name')
                ]);
                
                return $response->withRedirect('profile');
            }
        } elseif(isset($_POST['update-password'])){
            $validate = Validation::validate($request, [
                'old_password' => v::usersPassword(),
                'new_password' => v::noWhitespace()->length(6, 20)->setName('Password')
            ]);

            if($validate){
                User::where('id', $_SESSION['user'])->update([
                    'password' => password_hash($request->getParam('new_password'), PASSWORD_DEFAULT)
                ]);

                return $response->withRedirect('profile');
            }

            return $response->withRedirect('profile');
        }
    }
}