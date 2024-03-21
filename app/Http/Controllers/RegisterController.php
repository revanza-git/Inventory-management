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
            'email' => 'required|email|unique:users',
            'password' => ['required', Password::min(6)],
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

    public function editEmail($id){
        $user = User::findOrFail($id);
        $link = 'editEmail';
        return view($link, ['data' => $user]);
    }

    public function resetPassword(Request $request, $id){
        $user = User::findOrFail($id);

        $request->validate([
            'email' => 'sometimes|required|email|unique:users,email',
            'password' => ['sometimes', 'required', Password::min(6)],
            'confirmPassword' => ['sometimes', 'required', Password::min(6), 'same:password'],
        ]);

        if ($request->has('email')) {
            // Update email
            $user->email = $request->input('email');
            $user->save();
            return redirect()->back()->with('success', 'Berhasil Merubah Email');
        }

        if ($request->filled('password') && $request->filled('confirmPassword')) {
            // Reset password
            $validatedPassword = Hash::make($request->input('password'));
            $user->password = $validatedPassword;
            $user->save();
            return redirect()->back()->with('success', 'Berhasil Mereset Password');
        }

        return redirect()->back()->with('failed', 'Gagal Merubah Email atau Mereset Password');
    }

    public function deleteAccount($id){
        $deleteAccount = User::findOrFail($id);
        $deleteAccount->delete();
        return redirect()->back()->with('success', 'Berhasil Mendelete Akun');
    }
}
