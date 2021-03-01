<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use App\Models\User;

class AuthController extends Controller
{
    public function login()
    {
        return view('admin.login');
    }

    public function register()
    {
        return view('admin.register');
    }

    public function loginAuthenticate(Request $request)
    {
        $data = $request->only([
            'email',
            'password'
        ]);

        $validator = Validator::make($data, [
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:4|max:255'
        ]);

        // remember string on, caso não enviado remember = false
        $remeber = $request->input('remember', false);

        if($validator->fails()) {
            return redirect()->route('login')
                ->withErrors($validator)
            ->withInput();
        }

        // Mandamos o array data e o remember, salva o token no banco de dados e tambem um cookie com o mesmo token.
        if(Auth::attempt($data, $remeber)){
            return redirect()->route('admin');
        } else {
            // Add erro no validator
            $validator->errors()->add('password', 'Email e/ou senha incorretos!');

            // Redireciona user p/login caso a senha ou usuário estejam incorretos
            return redirect()->route('login')
                ->withErrors($validator)
            ->withInput();
        }

    }

    public function registerAutenticate(Request $request)
    {
        $data = $request->only([
            'name', 'email', 'password', 'password_confirmation'
        ]);

        $validator = Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email|max:255',
            'password' => 'required|string|min:4|confirmed',
        ]);

        if($validator->fails()) {
            return redirect()
                ->route('register')
                ->withErrors($validator)
            ->withInput();
        }

        $user = new User();
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = Hash::make($data['password']);
        $user->save();

        Auth::login($user);
        return redirect()->route('admin');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
