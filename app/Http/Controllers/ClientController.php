<?php
namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{

// Exporter la liste des clients au format CSV
    public function export()
    {
        $clients = Client::orderBy('nom')->get();

        $filename = 'clients-' . now()->format('Y-m-d-His') . '.csv';

        return response()->streamDownload(function () use ($clients) {
            $output = fopen('php://output', 'w');

            // BOM UTF-8 pour une meilleure compatibilité avec Excel
            fwrite($output, "\xEF\xBB\xBF");

            fputcsv($output, [
                'Nom',
                'Email',
                'Téléphone',
                'Entreprise',
                'Date de création',
            ], ';');

            foreach ($clients as $client) {
                fputcsv($output, [
                    $client->nom,
                    $client->email,
                    $client->telephone,
                    $client->entreprise,
                    $client->created_at?->format('d/m/Y H:i'),
                ], ';');
            }

            fclose($output);
        }, $filename, [
            'Content-Type' => 'text/csv; charset=UTF-8',
        ]);
    }

    // Afficher la liste des clients

    public function index(Request $request)
    {
        $search     = trim($request->input('search', ''));
        $entreprise = $request->input('entreprise', '');
        $sort       = $request->input('sort', 'recent');

        $query = Client::query();

        // Recherche par nom, email ou entreprise
        if ($search !== '') {
            $query->where(function ($q) use ($search) {
                $q->where('nom', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('entreprise', 'like', "%{$search}%");
            });
        }

        // Filtre par entreprise
        if ($entreprise !== '') {
            $query->where('entreprise', $entreprise);
        }

        // Tri sécurisé : seules ces colonnes sont autorisées
        $sorts = [
            'recent' => ['created_at', 'desc'],
            'ancien' => ['created_at', 'asc'],
            'nom'    => ['nom', 'asc'],
            'email'  => ['email', 'asc'],
        ];

        if (! array_key_exists($sort, $sorts)) {
            $sort = 'recent';
        }

        [$column, $direction] = $sorts[$sort];

        $clients = $query
            ->orderBy($column, $direction)
            ->paginate(10)
            ->withQueryString();

        // Statistiques globales
        $totalClients = Client::count();

        $nouveauxClients = Client::where(
            'created_at',
            '>=',
            now()->startOfMonth()
        )->count();

        $totalEntreprises = Client::whereNotNull('entreprise')
            ->where('entreprise', '<>', '')
            ->distinct()
            ->count('entreprise');

        // Entreprises disponibles dans le filtre
        $entreprises = Client::whereNotNull('entreprise')
            ->where('entreprise', '<>', '')
            ->distinct()
            ->orderBy('entreprise')
            ->pluck('entreprise');

        return view('clients.index', compact(
            'clients',
            'search',
            'entreprise',
            'sort',
            'entreprises',
            'totalClients',
            'nouveauxClients',
            'totalEntreprises'
        ));
    }

    // Afficher le formulaire d'ajout
    public function create()
    {
        return view('clients.create');
    }

    // Enregistrer un nouveau client
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom'        => 'required|string|max:255',
            'email'      => 'required|email|max:255|unique:clients,email',
            'telephone'  => 'nullable|string|max:30',
            'entreprise' => 'nullable|string|max:255',
        ]);

        Client::create($validated);

        return redirect()
            ->route('clients.index')
            ->with('success', 'Client ajouté avec succès.');
    }

    // Afficher les détails d'un client
    public function show(Client $client)
    {
        return view('clients.show', compact('client'));
    }

    // Afficher le formulaire de modification
    public function edit(Client $client)
    {
        return view('clients.edit', compact('client'));
    }

    // Mettre à jour un client
    public function update(Request $request, Client $client)
    {
        $validated = $request->validate([
            'nom'        => 'required|string|max:255',
            'email'      => 'required|email|max:255|unique:clients,email,' . $client->id,
            'telephone'  => 'nullable|string|max:30',
            'entreprise' => 'nullable|string|max:255',
        ]);

        $client->update($validated);

        return redirect()
            ->route('clients.index')
            ->with('success', 'Client modifié avec succès.');
    }

    // Supprimer un client
    public function destroy(Client $client)
    {
        $client->delete();

        return redirect()
            ->route('clients.index')
            ->with('success', 'Client supprimé avec succès.');
    }
}
