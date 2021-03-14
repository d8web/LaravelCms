<?php
// Continuar da aula: Frente: Páginas.
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\HomeController as AdminHome;
use App\Http\Controllers\Site\HomeController as SiteHome;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Site\PageController as Site;

Route::get('/', [SiteHome::class, 'index']); // Rota Página inicial

Route::get('/login', [AuthController::class, 'login'])
    ->name('login'); // Rota da view de login

Route::post('/login', [AuthController::class, 'loginAuthenticate']); // Rota para autenticar os dados de login

Route::get('/register', [AuthController::class, 'register'])
    ->name('register'); // Rota da view do registro do novo usuário

Route::post('/register', [AuthController::class, 'registerAutenticate']); // Rota de autenticação do registro do novo usuário

// Grupo de rotas do Administrador, com middleware de autenticação e prefixo painel.
Route::middleware('auth')->prefix('painel')->group( function() {

    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('logout'); // Rota de logout

    Route::get('/', [AdminHome::class, 'index'])
        ->name('admin'); // Rota página inicial do painel

    Route::get('/users', [UserController::class, 'allUsers'])
        ->name('users'); // Rota que lista os usuários

    Route::get('/users/create', [UserController::class, 'create'])
        ->name('create'); // Rota do view para adicionar usuário

    Route::post('/user/store', [UserController::class, 'store'])
        ->name('store'); // Rota para validar e adicionar novo usuário

    Route::get('/edit/{id}', [UserController::class, 'edit'])
        ->name('edit'); // Rota da view do form p/ usuário

    Route::put('/user/edit/{id}', [UserController::class, 'update'])
        ->name('update'); // Rota que valida e edita usuário

    Route::delete('/user/{id}/delete', [UserController::class, 'delete'])
        ->name('destroy'); // Rota de delete usuário

    // Rotas do perfil do usuário logado!
    Route::get('/profile', [ProfileController::class, 'index'])
        ->name('profile'); // Página inicial do perfil do usuário logado

    Route::put('/profile/update', [ProfileController::class, 'save'])
        ->name('profile.save'); // Rota de alterar os dados do usuário logado

    // Rotas de configurações do site
    Route::get('/settings', [SettingController::class, 'index'])
        ->name('settings'); // Rota exibe uma lista das configurações do usuário

    Route::put('/settings/save', [SettingController::class, 'save'])
        ->name('settings.save'); // Rota para validar e salvar as configurações

    Route::get('/pages', [PageController::class, 'index'])
        ->name('pages'); // Rota para view de Paginas.

    Route::get('/pages/add', [PageController::class, 'createPage'])
        ->name('pages.create'); // Rota da view para adicionar nova página

    Route::post('/pages/create', [PageController::class, 'storePage'])
        ->name('pages.store'); // Rota que valida e adiciona página ao banco de dados

    Route::get('/pages/{page}/edit', [PageController::class, 'edit'])
        ->name('page.edit'); // Rota para da view para editar a página

    Route::put('/pages/{id}/update', [PageController::class, 'update'])
        ->name('page.update'); // Rota que valida e edita a página

    Route::delete('pages/{page}/destroy', [PageController::class, 'destroy'])
        ->name('page.destroy'); // Rota que deleta a página
});

// Rota quando nenhuma das rotas acima bateu
Route::fallback([Site::class, 'index']);
