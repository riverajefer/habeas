<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\User;
use Auth;
class LoginController extends Controller
{


    /**
     * Instantiate a new LoginController instance.
     *
     * @return void
     */
     protected $email;

     public function __construct(){
         //$this->email = $email;
     }


    /**
     * Store a new user.
     * @param  String  $email
     * @return \Illuminate\View\View
     */
    public function index($email){
        $email = $email;
        $this->email = $email;
        return view('login.index',compact('email'));
    }

    /**
     * Login user.
     * @param  Request  $request
     * @return Response
     */
    public function login(Request $request){
        $email   = $request->input('email');
        $password = $request->input('password');

        $user = User::whereEmail_t4($email)->wherePassword(md5($password))->first();
        
        Auth::loginUsingId($user->id_user_t4, false);
        return redirect('/');
        
    }


}
