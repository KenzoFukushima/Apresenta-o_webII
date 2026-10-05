<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Laravel\Facades\Image;

class UserController extends Controller
{
    public function cadastro()
    {
        return view('cadastro');
    }

    public function cadastroSubmit(Request $request)
    {
        $request->validate(
    [
        'name'  => 'required|max:255',
        'email' => 'required|email|max:255|unique:users,email',
        'foto'  => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
    ],
    [
        'name.required' => 'O campo nome é obrigatório.',
        'name.max'      => 'O nome pode ter no máximo 255 caracteres.',

        'email.required' => 'O campo e-mail é obrigatório.',
        'email.email'    => 'E-mail inválido.',
        'email.max'      => 'O e-mail pode ter no máximo 255 caracteres.',
        'email.unique'   => 'Este e-mail já está cadastrado.',

        'foto.required' => 'Envie uma foto de perfil.',
        'foto.image'    => 'O arquivo deve ser uma imagem.',
        'foto.mimes'    => 'A foto deve ser jpg, jpeg, png ou webp.',
        'foto.max'      => 'A foto pode ter no máximo 2 MB.',
    ]
);

        $foto = $request->file('foto');
        
        $caminhoOriginal = $foto->storePublicly('avatars', 'public');

        $caminhoThumbnail = 'avatars/thumbs/' . pathinfo($caminhoOriginal, PATHINFO_FILENAME) . '.webp';

        $imagem = Image::read($foto)->cover(150, 150)->toWebp();

        Storage::disk('public')->put($caminhoThumbnail, (string) $imagem);

        $user = User::create([
            'name'      => $request->name,
            'email'     => $request->email,
            'password'  => bcrypt('12345678'),
            'foto'      => $caminhoOriginal,
            'thumbnail' => $caminhoThumbnail,
        ]);

        return redirect()
            ->route('perfil', $user)
            ->with('success', 'Usuário cadastrado com sucesso!');
    }

    public function perfil(User $user)
    {
        return view('perfil', compact('user'));
    }
}