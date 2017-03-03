<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\User;
use Auth;
class LoginController extends Controller
{

    /**
     * Store a new user.
     * @param  String  $email
     * @return \Illuminate\View\View
     */
    public function index($id=null){

        if(Auth::check()){
            return redirect('registros');
        }


        $user = User::findOrFail($id);
        $email = $user->email;
        return view('login.index',compact('email'));
    }

    /**
     * Login user.
     * @param  Request  $request
     * @return Response
     */
    public function login(Request $request){

        $this->validate($request,[
            'email'=>'required|email',
            'password'=>'required',
        ]);

        $email   = $request->input('email');
        $password = $request->input('password');

        $user = User::whereEmail_t4($email)->wherePassword(md5($password))->first();
        if(!$user){
            return redirect()->back()->with('errorLogin', 'Datos de acceso incorrectos'); 
        }
        
        Auth::loginUsingId($user->id, false);
        return redirect('registros');
    }


    /**
     * Logout
     *
     * @return void
     */
     public function salir(){
         Auth::logout();
         return redirect('/');
     }
    


}
