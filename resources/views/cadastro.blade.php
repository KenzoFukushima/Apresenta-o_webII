@extends('layouts.main_layout')

@section('title', 'Cadastrar usuário')

@section('content')

    <div class="row justify-content-center">

        <div class="col-md-6">

            <div class="card shadow">

                <div class="card-body p-4">

                    <h1 class="text-center mb-4">
                        Cadastro de usuário
                    </h1>

                    @if ($errors->any())

                        <div class="alert alert-danger">

                            <strong>Corrija os seguintes erros:</strong>

                            <ul class="mb-0">

                                @foreach ($errors->all() as $erro)
                                    <li>{{ $erro }}</li>
                                @endforeach

                            </ul>

                        </div>

                    @endif


                    <form method="POST" action="{{ route('cadastroSubmit') }}" enctype="multipart/form-data">

                        @csrf


                        <div class="mb-3">

                            <label for="name" class="form-label">
                                Nome
                            </label>

                            <input type="text" id="name" name="name" value="{{ old('name') }}" class="form-control">

                        </div>


                        <div class="mb-3">

                            <label for="email" class="form-label">
                                E-mail
                            </label>

                            <input type="email" id="email" name="email" value="{{ old('email') }}" class="form-control">

                        </div>


                        <div class="mb-4">

                            <label for="foto" class="form-label">
                                Foto de perfil
                            </label>

                            <input type="file" id="foto" name="foto" accept="image/*" class="form-control">


                        </div>


                        <button type="submit" class="btn btn-primary w-100">
                            Cadastrar usuário
                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

@endsection