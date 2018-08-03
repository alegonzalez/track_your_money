<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Auth extends Model
{
  public function createOrGetUser(ProviderUser $providerUser)
 {
   dd($providerUser);
     $account = SocialFacebookAccount::whereProvider('facebook')
         ->whereProviderUserId($providerUser->getId())
         ->first();

     if ($account) {
         return $account->user;
     } else {

         $account = new SocialFacebookAccount([
             'provider_user_id' => $providerUser->getId(),
             'provider' => 'facebook'
         ]);

         $user = User::whereEmail($providerUser->getEmail())->first();

         if (!$user) {

             $user = User::create([
                 'email' => $providerUser->getEmail(),
                 'name' => $providerUser->getName(),
                 'password' => md5(rand(1,10000)),
             ]);
         }

         $account->user()->associate($user);
         $account->save();

         return $user;
     }
 }
}
