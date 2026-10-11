@extends('layouts.app')

@section('title', 'Modifier un client')

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-8">

            <div class="mb-4">
                <a href="{{ route('clients.index') }}" class="text-decoration-none">
                    ← Retour à la liste
                </a>

                <h1 class="h3 mt-3">Modifier un client</h1>
                <p class="text-secondary">
                    Modifiez les informations de {{ $client->nom }}.
                </p>
            </div>

            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">

                    <form action="{{ route('clients.update', $client) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="nom" class="form-label">Nom complet *</label>
                            <input type="text" name="nom" id="nom"
                                class="form-control @error('nom') is-invalid @enderror"
                                value="{{ old('nom', $client->nom) }}" required>
                            @error('nom')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Adresse email *</label>
                            <input type="email" name="email" id="email"
                                class="form-control @error('email') is-invalid @enderror"
                                value="{{ old('email', $client->email) }}" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="telephone" class="form-label">Téléphone</label>
                            <input type="text" name="telephone" id="telephone" class="form-control"
                                value="{{ old('telephone', $client->telephone) }}">
                        </div>

                        <div class="mb-4">
                            <label for="entreprise" class="form-label">Entreprise</label>
                            <input type="text" name="entreprise" id="entreprise" class="form-control"
                                value="{{ old('entreprise', $client->entreprise) }}">
                        </div>

                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('clients.index') }}" class="btn btn-light border">
                                Annuler
                            </a>

                            <button type="submit" class="btn btn-primary">
                                Enregistrer les modifications
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
