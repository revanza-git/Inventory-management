<?php

namespace App\Http\Controllers;

use App\Models\SecretCode;
use App\Models\User;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class RegisterController extends Controller
{
    public function index()
    {
        return view('register');
    }

    public function store(Request $request){
        $data = DB::table('secret_code')
                ->select('secretCode')
                ->first();
        $secretCode = $data->secretCode;            
        $requestSecretCode = $request->secPassword;
        $signatureFileName = NULL;
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email:dns|unique:users',
            'password' => ['required', Password::min(8)->mixedCase()->numbers()->symbols()],
            'role' => 'required',
            'departement' => 'required',
            'signature'=> 'required|mimes:png'
        ]);
       
        if (isset($validatedData['signature'])) {
            $signatureFile = $request->file('signature');;
            $extension = $signatureFile->getClientOriginalExtension();
            $user = $validatedData['name'];
            $signatureFileName = 'signature' . '_' . $user . '.' . $extension;
            $signatureFile->storeAs('data', $signatureFileName);
        }

        $validatedData['password'] = Hash::make($validatedData['password']);
        $validatedData['signature'] = $signatureFileName;

        if (Hash::check($requestSecretCode, $secretCode)) {
            User::create($validatedData);
            return redirect()->back()->with('success', 'Berhasil Membuat Akun ');    
        }
        else{
            return redirect()->back()->with('failed', 'Gagal Membuat Akun :( ');
        }
    }

    public function getAccount(){
        $queryAllAccount = User::select('id', 'name', 'email', 'role', 'departement')
                            ->get();
        return view('resetPassword', ['accountlList' => $queryAllAccount]);
    }
    public function showAccount($id){
        $user = User::findOrFail($id);
        $link = 'detailUser';
        return view($link, ['data' => $user]);
    } 
    public function resetPassword(Request $request,$id){
       $user = User::findOrFail($id);
       $validatedData = $request->validate([
            'password' => ['required', Password::min(8)->mixedCase()->numbers()->symbols()],
            'confirmPassword' => ['required', Password::min(8)->mixedCase()->numbers()->symbols()]
       ]);
        if($validatedData['password']== $validatedData['confirmPassword']){
            $validatedData['password'] = Hash::make($validatedData['password']);
            $user->password = $validatedData['password'];
            $user->save();
            return redirect()->back()->with('success', 'Berhasil Mereset Password');
        }
        else{
            return redirect()->back()->with('failed', 'Gagal Mereset Password');
        }  
    }

    public function deleteAccount($id){
        $deleteAccount = User::findOrFail($id);
        $deleteAccount->delete();
        return redirect()->back()->with('success', 'Berhasil Mendelete Akun');
    }
}
