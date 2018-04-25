<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Mail\Email;
use Illuminate\Support\Facades\Mail;


class userController extends Controller
{

/********************************* Functions in Routes ***********************************************/

    public function copyHashUsers(Request $request){
        
      $this::copyUsers();
      $this::BcryptPasswords();
      return response()->json(array('Success'=>'Users Copied & Hashed')); 
    }
    public function userLogin(Request $request){
     
         $this::copyUsers();
         $this::BcryptPasswords();
         $loginTyped  = $request->login ;
         $passeTyped  = $request->password ;
         $passeTyped  = $this::dolibarrHashing($passeTyped) ;

        if (Auth::attempt(['name' => $loginTyped, 'password' => $passeTyped])){
            $user = Auth::user();
            $success['token'] = $user->createToken('MyApp')->accessToken ;
            $success['id']    = $user->id ;
            return response()->json(['success'=>$success],200);
          }else{
            return response()->json(array('Error'=>'Unauthorized access'));
          }
    }

  public function userDetails (Request $request){
    $user = Auth::user();

    return response()->json(array('success'=>$user));
  }
  
  public function userLogout(Request $request)
    {
      if(!Auth::check())
          return response()->json(array('Error'=>'Unauthenticated user'));
        
          $user = Auth::user();
          $res =  DB::table('oauth_access_tokens')
                  ->where('user_id', $user->id)
                  ->delete();
    
        return response()->json(array('Success'=>'Log out success'));
    }

  // Change password
  public function changePassword(Request $request){

    $currentPassword  = $request->currentPassword ;
    $newPassword      = $request->newPassword ;
    $repeatPassword   = $request->repeatPassword ;
    $user = Auth::user();

    if(!Hash::check($currentPassword, $user->password))
    return response()->json(array('Response'=>'incorrect_password','Msg' => 'password incorrecte')) ;

    if($newPassword !== $repeatPassword)
    return response()->json(array('Response'=>'not_match','Msg' => 'new passwords not match')) ;

    $user->password = bcrypt($request->newPassword) ;
    $user->save() ;
    return response()->json(array('Response'=>'password_changed','Msg' => 'Password changed')) ;
  }

    // Forgot Password
    public function forgotPassword(Request $request) {
        $email = $request->email ;
        $user = User::where('email', $email)->first();

        if(!$user)
            return response()->json(['Response'=> 'user_not_found']) ;

        $new_random_password = str_random(5);
        $user->password = bcrypt($new_random_password) ;
        $user->save();
        $objParam = new \stdClass();
        $objParam->new_random_password = $new_random_password;

        Mail::to($user->email)->send(new Email($objParam));
        return response()->json(['Response'=> 'success' ]) ;
    }


/********************************* Functions not in Routes ***********************************************/

  /*
  ** Author : Adev
  ** Encrypte & update All User's Password (If they doesn't crypted)
  ** -- Those users come from llx_user (dolibarr table) using mysql trigger
  */
  public function BcryptPasswords(){
    
    foreach (User::all() as $user) {
          if (Hash::needsRehash(($user->password))) {
                 $user->password = bcrypt($user->password) ;
                 $user->save();
          }
      }
  }
  
  //Copy users from Dolibarr's table (llx_user) To Laravel's Table (users)
  public function copyUsers(){
    
   if(User::count() < 0) return ;
   User::query()->delete();
   $getUsers = DB::table('user')->get() ;
   foreach ($getUsers as $user){
                 $newUser = new User ;
                 $newUser->name          = $user->login ;
                 $newUser->email         = $user->login ;
                 $newUser->password      = $user->pass_crypted ;
                 $newUser->save();          
          }
  }

  /*
  ** Author : Adev
  ** Encrypt Typed Pass as Dolibarr dol_hash()
  *
  ** NB : $MAIN_SECURITY_SALT is a Dolibarr Value 
  **      -> Localized in table : llx_const (name column)
  **      -> Used in Dolibarr file : /htdocs/core/lib/security.lib.php  function dol_hash()
  **      -> Inserted while Dolibarr installation 
  */
  public function dolibarrHashing($chain){
    
      $MAIN_SECURITY_SALT = DB::table('const')->where('name', 'MAIN_SECURITY_SALT')->first(); //'20171027005556' ;
      $password = $chain ;
      $password = $MAIN_SECURITY_SALT->value.$password ;
      $password = sha1(md5($password)) ; 
      return $password ;
    
  }
  
 
}