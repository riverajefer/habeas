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
        //return $user;
        $perfil = DB::table('perfusr_t21')->where('idmodfunc_t21', '21')->first();
        //return $perfil->idusr_t21;

        if($perfil->idusr_t21 != $user->id){
            return redirect()->back()->with('errorLogin', 'No tienes acceso a este módulo'); 
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
