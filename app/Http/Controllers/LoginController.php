<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\User;
use Auth;
use DB;
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

       // Auth::loginUsingId(73, false); // Login administrator

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

        // Valida que el usuario tenga acceso al modulo de habeas data    
        $modulo_habeas =  $user->modulos()->where('idmodfunc_t20', 17)->get();

        if(count($modulo_habeas)){
            Auth::loginUsingId($user->id, false);
             //return redirect('registros');
             return redirect()->intended('registros');
        }else{
            return redirect()->back()->with('errorLogin', 'No tienes acceso a este módulo'); 
        }

    }




   /**
     * Store a new user.
     * @param  String  $email
     * @return \Illuminate\View\View
     */
    public function auth(){

        if(Auth::check()){
            return redirect('registros');
        }
        return view('login.auth');
    }

    /**
     * Login user.
     * @param  Request  $request
     * @return Response
     */
    public function postAuth(Request $request){

       // Auth::loginUsingId(73, false); // Login administrator

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

        // Valida que el usuario tenga acceso al modulo de habeas data    
        $modulo_habeas =  $user->modulos()->where('idmodfunc_t20', 17)->get();

        if(count($modulo_habeas)){
            Auth::loginUsingId($user->id, false);
             //return redirect('registros');
             return redirect()->intended('registros');
        }else{
            return redirect()->back()->with('errorLogin', 'No tienes acceso a este módulo'); 
        }

    }



    /**
     * Logout
     *
     * @return void
     */
     public function salir(){
         Auth::logout();
         return redirect('auth');
     }
    


}
