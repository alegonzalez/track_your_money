<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use Auth;
use App\User;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use File;
class UserController extends Controller
{
  /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function index()
  {
    $result = explode(":", Auth::user()->image_profile);
    if($result[0] != "https" && $result[0] != "http"){
      return view('user.profile');
    }else{
      return redirect()->to('/index');
    }

  }

  /**
  * Display the specified resource.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function show($id)
  {
    return redirect()->to('/index');
  }

  /**
  * Update the specified resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function update(Request $request, $id)
  {
    Validator::make($request->all(), [
      'email' => [
        'required',
        'string',
        'email',
        'max:255',
        Rule::unique('users')->ignore($id)
      ],
      ])->validate();
      $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'password' => 'required|string|min:6|confirmed',
        'upload_image_profile' => 'image|mimes:jpg,png,jpeg',
      ]);
      if ($request->isMethod('PATCH')) {
        $user = User::find($id);
        if(Hash::check($request->input('password'),$user->password)){
          $user->name = $request->input('name');
          $user->email =$request->input('email');
          $user->password = Hash::make($request->input('password'));
          if($request->hasFile('fileImageProfile')){
            $image_path = "uploads"."/".$user->image_profile;
            if(File::exists($image_path)) {
              File::delete($image_path);
            }
            $nameImage = $request->file('fileImageProfile')->getClientOriginalName();
            $nameImage = $this->removeSpecialCharacter($nameImage);
            $result = explode(".", $nameImage);
            $nameImage = $result[0] . "_".$user->id .".". $result[1];
            $request->file('fileImageProfile')->move(public_path('uploads'), $nameImage);
            $user->image_profile = $nameImage;
          }
          $user->save();
          return redirect()->to('/user')->with('success_message', 'The user has been successfully updated!');
        }else{
          return redirect()->action('UserController@index')->with('error_message', 'Password is incorrect!');
        }
      }
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function destroy($id)
    {
      //
    }
    /**
    * remove accent mark of string
    *@param string $nameImage
    *@return $result
    */
    public function removeSpecialCharacter($nameImage){
      $notAllowed= array ("á","é","í","ó","ú","Á","É","Í","Ó","Ú","ñ","À","Ã","Ì","Ò","Ù","Ã™","Ã ","Ã¨","Ã¬","Ã²","Ã¹","ç","Ç","Ã¢","ê","Ã®","Ã´","Ã»","Ã‚","ÃŠ","ÃŽ","Ã”","Ã›","ü","Ã¶","Ã–","Ã¯","Ã¤","«","Ò","Ã","Ã„","Ã‹");
      $allowed= array ("a","e","i","o","u","A","E","I","O","U","n","N","A","E","I","O","U","a","e","i","o","u","c","C","a","e","i","o","u","A","E","I","O","U","u","o","O","i","a","e","U","I","A","E");
      $text = str_replace($notAllowed, $allowed ,$nameImage);
      $result = str_replace(' ', '', $text);
      return $result;
    }
  }
