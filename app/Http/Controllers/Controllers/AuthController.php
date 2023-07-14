<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function SignIn(){
        $Tittle = 'SolarisTech - SignIn';

        return view('Auth.SignIn', compact('Tittle'));
    }

    public function validateLogin(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ], [
            'username.required' => 'Username wajib diisi.',
            'password.required' => 'Password wajib diisi.',
        ]);
    }

    public function login(Request $request)
    {
        $this->validateLogin($request);

        $credentials = $request->only('username', 'password');

        $user = Member::where('email_user', $credentials['username'])->first();

        if ($user) {
            if ($credentials['password'] === $user->pw_user) {

                if ($user->role === 'User'){
                    Auth::login($user);
                    $request->session()->regenerate();
                    return redirect()->route('Home');

                } elseif ( $user->role === 'Admin'){
                    Auth::login($user);
                    return redirect()->route('Admin');

                }

            } else {

                throw ValidationException::withMessages([
                    'password' => 'Password salah.',
                ]);

            }

        } else {

            throw ValidationException::withMessages([
                'username' => 'Username salah.',
            ]);

        }


        // if ($credentials['username'] === 'yanuar' && $credentials['password'] === 'boboho567') {
        //     return redirect()->route('Home');
        // } elseif ($credentials['username'] === 'yanuar') {
        //     throw ValidationException::withMessages([
        //         'password' => 'Password salah.',
        //     ]);
        // } elseif ($credentials['password'] === 'boboho567') {
        //     throw ValidationException::withMessages([
        //         'username' => 'Username salah.',
        //     ]);
        // } else {
        //     throw ValidationException::withMessages([
        //         'username' => 'Username salah.',
        //         'password' => 'Password salah.',
        //     ]);
        // }
    }

    // public function login(Request $request)
    // {
    //     $this->validateLogin($request);

    //     $credentials = $request->only('username', 'password');

    //     $user = User::where('username', $credentials['username'])->first();

    //     if ($user) {
    //         if (Hash::check($credentials['password'], $user->password)) {
    //             Auth::login($user);
    //             return redirect()->route('index');
    //         } else {
    //             throw ValidationException::withMessages([
    //                 'password' => 'Password salah.',
    //             ]);
    //         }
    //     } else {
    //         throw ValidationException::withMessages([
    //             'username' => 'Username salah.',
    //         ]);
    //     }
    // }

}
