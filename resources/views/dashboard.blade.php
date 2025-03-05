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
                        <a href="{{ $link->url }}" target="_blank" title="{{ $link->url }}">{{ Str::limit($link->url, 30) }}</a>
                    </td>
                    <td class="text-truncate" style="max-width: 150px;">
                        <a href="{{ $link->shortLink }}" target="_blank">{{ Str::limit($link->shortLink, 20) }}</a>
                    </td>
                    <td class="clicks">{{ $link->clicks }}</td>
                    <td class="d-flex gap-2">
                        <button class="btn btn-secondary btn-sm copy-link" data-id="{{ $link->id }}" data-link="{{ $link->shortLink }}">
                            📋
                        </button>
                        <button class="btn btn-warning btn-sm edit-link"
                                data-id="{{ $link->id }}"
                                data-name="{{ $link->name }}"
                                data-url="{{ $link->url }}">
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

    <!-- Formulaire de création/mise à jour -->
    @if ($errors->any())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form id="link-form" action="{{ route('dashboard.create-link') }}" method="POST" class="mb-4">
        @csrf
        <input type="hidden" id="link-id" name="id">

        <div class="d-flex justify-content-between">
            <h4 id="form-title">Créer un lien</h4>
            <button type="button" class="btn btn-secondary btn-sm d-none" id="reset-form">Ajouter un nouveau</button>
        </div>

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
            // Gestion du bouton "Copier"
            $(document).on('click', '.copy-link', function () {
                let button = $(this);
                let linkId = button.data('id');
                let linkUrl = button.data('link');
                let clickCountCell = $("#row-" + linkId + " .clicks");
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
                        clickCountCell.text(newCount);
                    })
                    .finally(() => {
                        setTimeout(() => {
                            button.html(originalButtonText);
                            button.prop('disabled', false);
                        }, 1000);
                    })
                    .catch(error => console.error("Erreur :", error));
            });

            // Gestion du bouton "Éditer"
            $(document).on('click', '.edit-link', function () {
                let linkId = $(this).data('id');
                let linkName = $(this).data('name');
                let linkUrl = $(this).data('url');

                // Modifier le formulaire
                $("#link-id").val(linkId);
                $("#name").val(linkName);
                $("#url").val(linkUrl);

                // Modifier l'action du formulaire
                let updateUrl = "{{ route('dashboard.create-link') }}".replace('create-link', 'update-link/') + linkId;
                $("#link-form").attr("action", updateUrl);

                // Modifier le texte du formulaire
                $("#form-title").text("Modifier un lien");
                $("#link-form button[type='submit']").text("Modifier");

                // Afficher le bouton "Ajouter un nouveau"
                $("#reset-form").removeClass("d-none");
            });

            // Réinitialiser le formulaire en mode "Créer"
            $("#reset-form").click(function () {
                $("#link-form").attr("action", "{{ route('dashboard.create-link') }}");
                $("#link-id").val("");
                $("#name").val("");
                $("#url").val("");
                $("#form-title").text("Créer un lien");
                $("#link-form button[type='submit']").text("Créer");
                $("#reset-form").addClass("d-none");
            });
        });
    </script>

@endsection
