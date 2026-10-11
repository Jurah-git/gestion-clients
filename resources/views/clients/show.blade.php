@extends('layouts.app')

@section('title', 'Détails du client')

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-8">

            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <a href="{{ route('clients.index') }}" class="text-decoration-none">
                        ← Retour à la liste
                    </a>

                    <h1 class="h3 mt-3 mb-1">Détails du client</h1>
                    <p class="text-secondary mb-0">
                        Consultez toutes les informations de ce client.
                    </p>
                </div>

                <a href="{{ route('clients.edit', $client) }}" class="btn btn-primary">
                    Modifier
                </a>
            </div>

            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">

                    <div class="d-flex align-items-center gap-3 mb-4">
                        <div class="rounded-circle bg-primary text-white d-flex
                                align-items-center justify-content-center"
                            style="width: 64px; height: 64px; font-size: 24px;">
                            {{ strtoupper(substr($client->nom, 0, 1)) }}
                        </div>

                        <div>
                            <h2 class="h4 mb-1">{{ $client->nom }}</h2>
                            <span class="text-secondary">
                                {{ $client->entreprise ?: 'Aucune entreprise renseignée' }}
                            </span>
                        </div>
                    </div>

                    <hr>

                    <h3 class="h6 text-secondary mb-3">
                        INFORMATIONS DU CLIENT
                    </h3>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="border rounded p-3 h-100">
                                <div class="text-secondary small mb-1">
                                    Adresse email
                                </div>
                                <div class="fw-semibold text-break">
                                    {{ $client->email }}
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="border rounded p-3 h-100">
                                <div class="text-secondary small mb-1">
                                    Téléphone
                                </div>
                                <div class="fw-semibold">
                                    {{ $client->telephone ?: 'Non renseigné' }}
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="border rounded p-3 h-100">
                                <div class="text-secondary small mb-1">
                                    Entreprise
                                </div>
                                <div class="fw-semibold">
                                    {{ $client->entreprise ?: 'Non renseignée' }}
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="border rounded p-3 h-100">
                                <div class="text-secondary small mb-1">
                                    Client enregistré le
                                </div>
                                <div class="fw-semibold">
                                    {{ $client->created_at->format('d/m/Y à H:i') }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr class="my-4">

                    <div class="d-flex justify-content-between align-items-center">
                        <span class="text-secondary small">
                            Identifiant du client : #{{ $client->id }}
                        </span>

                        <a href="{{ route('clients.edit', $client) }}" class="btn btn-outline-primary">
                            Modifier les informations
                        </a>
                    </div>

                </div>
            </div>

        </div>
    </div>
@endsection
