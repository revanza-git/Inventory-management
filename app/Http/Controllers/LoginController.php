<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
   public function index(){
        return view('login');
   }
   public function authenticate(Request $request){

      $credentials = $request->validate([
         'email'=>'required',
         'password'=>'required'
      ]);

      if (Auth::attempt($credentials)) {

         $request->session()->regenerate();

         if (Auth::user()->role == 'superadmin') {
            return redirect()->intended('/register');
         }

         if (Auth::user()->role == 'master') {
            return redirect()->intended('/flowInPendingMaster');
         }

         if(Auth::user()->role== 'user' || Auth::user()->role == 'head'){
            $role = Auth::user()->departement;
            if($role == 'reliability'){
               return redirect()->intended('/electrical');
            }
            if ($role == 'technology') {
               return redirect()->intended('/technology');
            }
            if ($role == 'layum') {
               return redirect()->intended('/tiyum');
            }
            if ($role == 'sekper') {
               return redirect()->intended('/sekper');
            }
            if ($role == 'hsse') {
               return redirect()->intended('/hsse');
            }
            if ($role == 'migas') {
               return redirect()->intended('/gasorf');
            }
            if ($role == 'transportasi') {
               return redirect()->intended('/transportasi');
            }
            if ($role == 'bisnis') {
               return redirect()->intended('/bisnis');
            }
         }
         if (Auth::user()->role == 'admin') {
            return redirect()->intended('/flowInPendingApprovalDate');
         }
      }
      return back()->with('loginError','Gagal Masuk Sistem');
   }

   public function logout(Request $request){
      Auth::logout();

      $request->session()->invalidate();

      $request->session()->regenerateToken();

      return redirect('/login');
   }
}
