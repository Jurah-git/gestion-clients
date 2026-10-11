@extends('layouts.app')

@section('title', 'Tableau de bord - Gestion des clients')

@section('content')

    {{-- En-tête du tableau de bord --}}

    <div class="d-flex flex-wrap gap-2">
        <a href="{{ route('clients.export') }}" class="btn btn-outline-success">
            <i class="bi bi-file-earmark-spreadsheet me-1"></i>
            Exporter CSV
        </a>

        <a href="{{ route('clients.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg me-1"></i>
            Ajouter un client
        </a>
    </div>


    {{-- Messages de confirmation et erreurs --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger" role="alert">
            <strong>Une erreur est survenue :</strong>
            <ul class="mb-0 mt-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Cartes statistiques --}}
    <div class="row g-3 mb-4">

        <div class="col-12 col-sm-6 col-xl-4">
            <div class="card shadow-sm h-100">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="bg-primary bg-opacity-10 text-primary rounded-3 p-3">
                        <i class="bi bi-people-fill fs-3"></i>
                    </div>
                    <div>
                        <div class="text-secondary small">Total des clients</div>
                        <div class="fs-3 fw-bold">{{ $totalClients }}</div>
                        <div class="small text-secondary">Clients enregistrés</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-xl-4">
            <div class="card shadow-sm h-100">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="bg-success bg-opacity-10 text-success rounded-3 p-3">
                        <i class="bi bi-person-plus-fill fs-3"></i>
                    </div>
                    <div>
                        <div class="text-secondary small">Nouveaux ce mois</div>
                        <div class="fs-3 fw-bold">{{ $nouveauxClients }}</div>
                        <div class="small text-secondary">Depuis le début du mois</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-xl-4">
            <div class="card shadow-sm h-100">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="bg-warning bg-opacity-10 text-warning rounded-3 p-3">
                        <i class="bi bi-building fs-3"></i>
                    </div>
                    <div>
                        <div class="text-secondary small">Entreprises</div>
                        <div class="fs-3 fw-bold">{{ $totalEntreprises }}</div>
                        <div class="small text-secondary">Entreprises distinctes</div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    {{-- En-tête de la liste --}}
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-3">
        <div>
            <h2 class="h5 fw-bold mb-1">Liste des clients</h2>
            <p class="text-secondary small mb-0">
                Retrouvez et gérez vos contacts professionnels.
            </p>
        </div>
    </div>

    {{-- Recherche, filtre et tri --}}
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <form action="{{ route('clients.index') }}" method="GET">
                <div class="row g-3 align-items-end">

                    <div class="col-12 col-lg-5">
                        <label for="search" class="form-label fw-semibold">
                            Rechercher
                        </label>

                        <div class="input-group">
                            <span class="input-group-text bg-white">
                                <i class="bi bi-search"></i>
                            </span>

                            <input type="search" name="search" id="search" class="form-control"
                                placeholder="Nom, email ou entreprise..." value="{{ $search }}">
                        </div>
                    </div>

                    <div class="col-12 col-md-6 col-lg-3">
                        <label for="entreprise" class="form-label fw-semibold">
                            Entreprise
                        </label>

                        <select name="entreprise" id="entreprise" class="form-select">
                            <option value="">Toutes les entreprises</option>

                            @foreach ($entreprises as $nomEntreprise)
                                <option value="{{ $nomEntreprise }}" @selected($entreprise === $nomEntreprise)>
                                    {{ $nomEntreprise }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-12 col-md-6 col-lg-2">
                        <label for="sort" class="form-label fw-semibold">
                            Trier par
                        </label>

                        <select name="sort" id="sort" class="form-select">
                            <option value="recent" @selected($sort === 'recent')>
                                Plus récents
                            </option>

                            <option value="ancien" @selected($sort === 'ancien')>
                                Plus anciens
                            </option>

                            <option value="nom" @selected($sort === 'nom')>
                                Nom A–Z
                            </option>

                            <option value="email" @selected($sort === 'email')>
                                Email A–Z
                            </option>
                        </select>
                    </div>

                    <div class="col-12 col-lg-2 d-flex gap-2">
                        <button type="submit" class="btn btn-primary grow">
                            <i class="bi bi-funnel me-1"></i>
                            Filtrer
                        </button>

                        <a href="{{ route('clients.index') }}" class="btn btn-outline-secondary"
                            title="Réinitialiser les filtres" aria-label="Réinitialiser les filtres">
                            <i class="bi bi-arrow-counterclockwise"></i>
                        </a>
                    </div>

                </div>
            </form>
        </div>
    </div>

    {{-- Résultats --}}
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white border-0 p-3">
            <div class="d-flex flex-wrap justify-content-between align-items-center gap-2">
                <div>
                    <h3 class="h6 fw-bold mb-1">Vos contacts</h3>
                    <span class="text-secondary small">
                        {{ $clients->total() }}
                        résultat(s) trouvé(s)
                    </span>
                </div>

                <span class="badge bg-primary bg-opacity-10 text-primary rounded-pill px-3 py-2">
                    Page {{ $clients->currentPage() }}
                    / {{ max(1, $clients->lastPage()) }}
                </span>
            </div>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">

                    <thead class="table-light">
                        <tr>
                            <th class="ps-3">Client</th>
                            <th>Email</th>
                            <th>Téléphone</th>
                            <th>Entreprise</th>
                            <th class="text-end pe-3">Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($clients as $client)
                            <tr>
                                {{-- Nom et avatar --}}
                                <td class="ps-3">
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="rounded-circle bg-primary bg-opacity-10
                                               text-primary fw-bold d-flex
                                               align-items-center justify-content-center
                                               shrink-0"
                                            style="width: 40px; height: 40px;">
                                            {{ strtoupper(substr(trim($client->nom), 0, 1)) }}
                                        </div>

                                        <div class="fw-semibold">
                                            {{ $client->nom }}
                                        </div>
                                    </div>
                                </td>

                                {{-- Email --}}
                                <td>
                                    <a href="mailto:{{ $client->email }}" class="text-decoration-none text-break">
                                        {{ $client->email }}
                                    </a>
                                </td>

                                {{-- Téléphone --}}
                                <td>
                                    @if ($client->telephone)
                                        <span class="text-nowrap">
                                            {{ $client->telephone }}
                                        </span>
                                    @else
                                        <span class="text-secondary">Non renseigné</span>
                                    @endif
                                </td>

                                {{-- Entreprise --}}
                                <td>
                                    @if ($client->entreprise)
                                        <span class="badge rounded-pill bg-primary bg-opacity-10 text-primary px-3 py-2">
                                            <i class="bi bi-building me-1"></i>
                                            {{ $client->entreprise }}
                                        </span>
                                    @else
                                        <span class="text-secondary">Non renseignée</span>
                                    @endif
                                </td>

                                {{-- Actions --}}
                                <td class="text-end pe-3 text-nowrap">
                                    <div class="d-inline-flex align-items-center gap-1">

                                        <a href="{{ route('clients.show', $client) }}"
                                            class="btn btn-sm btn-outline-secondary" title="Voir les détails"
                                            aria-label="Voir les détails de {{ $client->nom }}">
                                            <i class="bi bi-eye"></i>
                                        </a>

                                        <a href="{{ route('clients.edit', $client) }}"
                                            class="btn btn-sm btn-outline-primary" title="Modifier"
                                            aria-label="Modifier {{ $client->nom }}">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>

                                        <form action="{{ route('clients.destroy', $client) }}" method="POST"
                                            class="d-inline"
                                            onsubmit="return confirm('Voulez-vous vraiment supprimer ce client ? Cette action est définitive.')">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="btn btn-sm btn-outline-danger"
                                                title="Supprimer" aria-label="Supprimer {{ $client->nom }}">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>

                                    </div>
                                </td>
                            </tr>

                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-5">
                                    <div class="mb-3">
                                        <i class="bi bi-search display-5 text-secondary"></i>
                                    </div>

                                    <h4 class="h6 fw-bold">
                                        @if ($search !== '' || $entreprise !== '')
                                            Aucun résultat trouvé
                                        @else
                                            Aucun client enregistré
                                        @endif
                                    </h4>

                                    <p class="text-secondary mb-3">
                                        @if ($search !== '' || $entreprise !== '')
                                            Essaie de modifier ta recherche ou tes filtres.
                                        @else
                                            Ajoute ton premier client pour commencer.
                                        @endif
                                    </p>

                                    @if ($search !== '' || $entreprise !== '' || $sort !== 'recent')
                                        <a href="{{ route('clients.index') }}" class="btn btn-outline-primary">
                                            Réinitialiser les filtres
                                        </a>
                                    @else
                                        <a href="{{ route('clients.create') }}" class="btn btn-primary">
                                            <i class="bi bi-plus-lg me-1"></i>
                                            Ajouter un client
                                        </a>
                                    @endif
                                </td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>
        </div>

        {{-- Pagination --}}
        @if ($clients->hasPages())
            <div class="card-footer bg-white border-0 p-3">
                <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">
                    <small class="text-secondary">
                        Affichage de {{ $clients->firstItem() }}
                        à {{ $clients->lastItem() }}
                        sur {{ $clients->total() }} résultat(s)
                    </small>

                    <div>
                        {{ $clients->links() }}
                    </div>
                </div>
            </div>
        @endif
    </div>

@endsection
