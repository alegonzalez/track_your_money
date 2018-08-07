<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Auth;
use Socialite;
use App\User;
use DB;
class SocialAuthController extends Controller
{
  /**
  * Create a redirect method to facebook api.
  *
  * @return void
  */
  public function redirect($provider)
  {
    return Socialite::driver($provider)->redirect();
  }

  /**
  * Return a callback method from facebook api.
  *
  * @return callback URL from facebook
  */
  public function callback(Auth $service)
  {
    $socialite = Socialite::driver('facebook')->user();
    $result =   User::where('email', $socialite->email)->get();
    $user = new User();
    if(count($result) <= 0){
      $user->name =  $socialite->name;
      $user->email =  $socialite->email;
      $user->password = md5(rand(1,10000));
      $user->image_profile = $socialite->avatar_original;
      if($user->save()){
        $auth = new Auth();
        $auth->id = $socialite->id;
        $auth->service = 'facebook';
        $auth->token = $socialite->token;
        $auth->id_user = DB::select('select id from users where email = :email', ['email' => $user->email]);
        $auth->id_user = $auth->id_user[0]->id;
        $auth->save();
      }
    }else{
      $user->id = $result[0]->id;
      $user->name =  $result[0]->name;
      $user->email =  $result[0]->email;
      $user->password = $result[0]->password;
      $user->image_profile = $result[0]->image_profile;
    }
    auth()->login($user);
    return redirect()->to('/index');
  }
  /**
  * Return a callback method from twitter api.
  *
  * @return callback URL from facebook
  */
  public function callbackTwitter(Auth $service,$provider)
  {
    $socialite = Socialite::driver($provider)->user();
    $result = DB::table('auths')
            ->join('users', 'auths.id_user', '=', 'users.id')
            ->select('users.*')
            ->where('auths.id', '=',$socialite->id)
            ->get();
     $user = new User();
     if(count($result) <=0 ){
       $user->name =  $socialite->name;
       $user->email =  $socialite->nickname . "@track.com";
       $user->password = md5(rand(1,10000));
       $user->image_profile = $socialite->avatar_original;
       if($user->save()){
         $auth = new Auth();
         $auth->id = $socialite->id;
         $auth->service = 'twitter';
         $auth->token = $socialite->token;
         $auth->id_user = DB::select('select id from users where email = :email', ['email' => $user->email]);
         $auth->id_user = $auth->id_user[0]->id;
         $auth->save();
       }
     }else{
       $user->id = $result[0]->id;
       $user->name =  $result[0]->name;
       $user->email =  $result[0]->email;
       $user->password = $result[0]->password;
       $user->image_profile = $result[0]->image_profile;
     }
     auth()->login($user);
     return redirect()->to('/index');
  }
}
