<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;

use App\Models\User;

class ProfileController extends Controller
{
    public function index()
    {
        $loggedId = intval(Auth::id());

        $user = User::find($loggedId);
        if($user) {
            return view('admin.profile.index', [
                'user' => $user
            ]);
        }

        return redirect()->route('admin');
    }

    public function save(Request $request)
    {
        $loggedId = Auth::id();
        $user = User::find($loggedId);
        if($user)
        {
            $data = $request->only([
                'name',
                'email',
                'password',
                'password_confirmation'
            ]);

            $validator = Validator::make([
                'name' => $data['name'],
                'email' => $data['email']
            ], [
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255'
            ]);

            // Nome alterado
            $user->name = $data['name'];

            // Alteração do email, verificar se o email no banco de dados é diferente do email enviado pelo formulário.
            if($user->email != $data['email'])
            {
                // Verificar se o email enviado já está em uso por outro usuário
                $hasEmail = User::where('email', $data['email'])->get();
                if(count($hasEmail) === 0) {
                    $user->email = $data['email'];
                } else {
                    $validator->errors()->add('email', __('validation.unique', [
                        'attribute' => 'email'
                    ]));
                }
            }

            // Verificar se usuário mandou o campo senha
            if(!empty($data['password']))
            {
                if(strlen($data['password']) >= 4)
                {
                    // Verificar se o campo senha é igual ao campo confirmar senha
                    if($data['password'] === $data['password_confirmation']) {
                        $user->password = Hash::make($data['password']);
                    } else {
                        $validator->errors()->add('password', __('validation.confirmed', [
                            'attribute' => 'password'
                        ]));
                    }
                } else {
                    $validator->errors()->add('password', __('validation.min.string', [
                        'attribute' => 'password',
                        'min' => 4
                    ]));
                }
            }

            if( count($validator->errors() ) > 0) {
                return redirect()
                    ->route('profile', ['id' => $loggedId])
                    ->withErrors($validator)
                    ->withInput();
            }

            $user->save();

            return redirect()
                ->route('profile')
                ->with('warning', 'Informações alteradas com sucesso!');
        }

        return redirect()->route('profile');
    }

}
