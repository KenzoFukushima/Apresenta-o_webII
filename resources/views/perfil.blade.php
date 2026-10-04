@extends('layouts.main_layout')

@section('title', 'Usuário cadastrado')

@section('content')

    <div class="row justify-content-center">

        <div class="col-md-6">

            <div class="card shadow">

                <div class="card-body text-center p-4">

                    @if (session('success'))

                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>

                    @endif


                    <h1 class="mb-4">
                        Usuário cadastrado
                    </h1>


                    @if ($user->foto)

                        <img src="{{ asset('storage/' . $user->foto) }}" alt="Foto de {{ $user->name }}" width="150"
                            height="150" class="rounded-circle mb-3">

                    @endif


                    <h2>
                        {{ $user->name }}
                    </h2>


                    <p class="text-muted">
                        {{ $user->email }}
                    </p>


                    <a href="{{ route('cadastro') }}" class="btn btn-primary">
                        Cadastrar outro usuário
                    </a>

                </div>

            </div>

        </div>

    </div>

@endsection