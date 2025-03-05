@extends('layouts.main')

@section('title', 'Dashboard')

@section('content')
    <!-- Affichage des messages Flash -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif


    <!-- Tableau -->
    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead class="table-dark">
            <tr>
                <th>Nom</th>
                <th>URL</th>
                <th>Lien court</th>
                <th>Clics</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($shortLinks as $link)
                <tr id="row-{{ $link->id }}">
                    <td class="name text-truncate" style="max-width: 150px;">{{ $link->name }}</td>
                    <td class="text-truncate" style="max-width: 200px;">
                        <a href="{{ $link->url }}" target="_blank"
                           title="{{ $link->url }}">{{ Str::limit($link->url, 30) }}</a>
                    </td>
                    <td class="text-truncate" style="max-width: 150px;">
                        <a href="{{ $link->shortLink }}" target="_blank">{{ Str::limit($link->shortLink, 20) }}</a>
                    </td>
                    <td class="clicks">{{ $link->clicks }}</td>
                    <td class="d-flex gap-2">
                        <button class="btn btn-secondary btn-sm copy-link" data-id="{{ $link->id }}"
                                data-link="{{ $link->shortLink }}">
                            📋
                        </button>
                        <button class="btn btn-warning btn-sm edit-link" data-bs-toggle="modal"
                                data-bs-target="#editModal"
                                data-id="{{ $link->id }}" data-name="{{ $link->name }}">
                            ✏️
                        </button>
                        <form action="{{ route('dashboard.delete-link', $link->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">🗑️</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <!-- Pagination Bootstrap -->
    <form method="GET" action="{{ route('dashboard') }}" class="mb-3">
        <label for="perPage">Liens par page :</label>
        <select id="perPage" name="per_page" onchange="this.form.submit()">
            <option value="5" {{ request('per_page') == 5 ? 'selected' : '' }}>5</option>
            <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>10</option>
            <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25</option>
            <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
        </select>
    </form>

    <div class="d-flex justify-content-center mt-3">
        {{ $shortLinks->links('pagination::bootstrap-5') }}
    </div>

    <!-- Formulaire -->
    <form action="{{ route('dashboard.create-link') }}" method="POST" class="mb-4">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Nom</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" required>
            @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="url" class="form-label">URL</label>
            <input type="url" class="form-control @error('url') is-invalid @enderror" id="url" name="url" required>
            @error('url')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Créer</button>
    </form>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            $(document).on('click', '.copy-link', function () {
                let button = $(this);
                let linkId = button.data('id');
                let linkUrl = button.data('link');
                let clickCountCell = $("#row-" + linkId + " .clicks"); // Sélectionne la bonne cellule
                let originalButtonText = button.html();
                let copyIncrementUrl = "{{ route('short-link.copy-increment', '') }}/" + linkId;

                // Copier dans le presse-papiers
                navigator.clipboard.writeText(linkUrl)
                    .then(() => {
                        button.html('✅');
                        button.prop('disabled', true);
                        return $.post(copyIncrementUrl);
                    })
                    .then(newCount => {
                        clickCountCell.text(newCount); // Mettre à jour la cellule des clics
                    })
                    .finally(() => {
                        setTimeout(() => {
                            button.html(originalButtonText);
                            button.prop('disabled', false);
                        }, 1000);
                    })
                    .catch(error => console.error("Erreur :", error));
            });
        });
    </script>

@endsection
