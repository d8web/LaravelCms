<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

use App\Models\User;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:edit_users');
    }

    public function allUsers()
    {
        $users = User::paginate(5);
        $loggedId = intval(Auth::id());

        return view('admin.users.index', [
            'users' => $users,
            'loggedId' => $loggedId
        ]);
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $data = $request->only(['name', 'email', 'password', 'password_confirmation']);
        $validator = Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email|max:255',
            'password' => 'required|string|min:4|max:255|confirmed'
        ]);

        if($validator->fails()) {
            return redirect()->route('create')->withErrors($validator)->withInput();
        }

        $data['password'] = Hash::make($data['password']);
        $user = User::create($data);

        return redirect()->route('users');
    }

    public function edit($id)
    {
        $user = User::find($id);
        if($user)
        {
            return view('admin.users.edit', [
                'user' => $user
            ]);
        }

        return redirect()->route('users');
    }

    public function update($id, Request $request)
    {
        $user = User::find($id);
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
                    ->route('edit', ['id' => $id])
                    ->withErrors($validator)
                    ->withInput();
            }

            $user->save();
        }

        return redirect()->route('users');
    }

    public function delete($id)
    {
        $loggedId = intval(Auth::id());

        if($loggedId !== intval($id)) {
            $user = User::find($id);
            $user->delete();
        }

        return redirect()->route('users');
    }

}
