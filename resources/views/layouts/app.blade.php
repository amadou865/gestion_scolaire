{{-- 
    CE FICHIER EST LE GABARIT COMMUN À TOUTES LES PAGES
    Il contient le menu, l'en-tête et le pied de page
    Les autres pages viendront se glisser dans @yield('content')
--}}

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion Scolaire - @yield('title')</title>
    
    {{-- BOOTSTRAP 5 POUR LE DESIGN --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    {{-- FONT AWESOME POUR LES ICÔNES --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        body {
            background-color: #f8f9fa;
        }
        .navbar-brand {
            font-weight: bold;
        }
        .card {
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .btn {
            border-radius: 5px;
        }
    </style>
</head>
<body>
    {{-- 
        BARRE DE NAVIGATION PRINCIPALE
        Elle apparaît sur toutes les pages
    --}}
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            {{-- Logo / Nom du site --}}
            <a class="navbar-brand" href="{{ route('dashboard') }}">
                <i class="fas fa-school me-2"></i>
                Gestion Scolaire
            </a>
            
            {{-- Bouton pour mobile --}}
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            {{-- Menu de navigation --}}
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    
                    {{-- MENU CATÉGORIES & NIVEAUX (avec sous-menu) --}}
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-layer-group me-1"></i>
                            Catégories & Niveaux
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a class="dropdown-item" href="{{ route('categorie-niveaux.index') }}">
                                    <i class="fas fa-tags me-2"></i>Catégories
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('niveaux.index') }}">
                                    <i class="fas fa-level-up-alt me-2"></i>Niveaux
                                </a>
                            </li>
                        </ul>
                    </li>
                    
                    {{-- MENU FILIÈRES --}}
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('filieres.index') }}">
                            <i class="fas fa-graduation-cap me-1"></i>
                            Filières
                        </a>
                    </li>
                    
                    {{-- MENU ANNÉES ACADÉMIQUES --}}
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('annee-academiques.index') }}">
                            <i class="fas fa-calendar-alt me-1"></i>
                            Années
                        </a>
                    </li>
                    
                    {{-- MENU CLASSES --}}
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('classes.index') }}">
                            <i class="fas fa-door-open me-1"></i>
                            Classes
                        </a>
                    </li>
                    
                    {{-- MENU TARIFS --}}
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('tarifs.index') }}">
                            <i class="fas fa-money-bill-wave me-1"></i>
                            Tarifs
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    {{-- 
        CONTENU PRINCIPAL DE LA PAGE
        C'est ICI que chaque page va insérer son contenu
    --}}
    <main class="py-4">
        <div class="container">
            {{-- 
                AFFICHAGE DES MESSAGES DE SUCCÈS
                Exemple: "Catégorie créée avec succès !"
            --}}
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i>
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            {{-- 
                AFFICHAGE DES MESSAGES D'ERREUR
                Exemple: "Impossible de supprimer cette catégorie"
            --}}
            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            {{-- 
                ZONE DE CONTENU SPÉCIFIQUE À CHAQUE PAGE
                Les vues individuelles viendront se placer ici
            --}}
            @yield('content')
        </div>
    </main>

    {{-- SCRIPTS BOOTSTRAP --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>