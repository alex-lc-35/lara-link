@extends('layouts.main')

@section('title', 'Test Bootstrap & jQuery')

@section('content')
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#testModal">
        Ouvrir la Modale (HTML)
    </button>

    <button id="open-modal-js" class="btn btn-secondary">Ouvrir la Modale (JS)</button>

    <!-- Modale Bootstrap -->
    <div class="modal fade" id="testModal" tabindex="-1" aria-labelledby="testModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="testModalLabel">Modale de Test</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Ceci est une modale de test.
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            console.log("Bootstrap JS est-il chargé ?", typeof bootstrap !== "undefined" ? "Oui" : "Non");

            // Ouvrir la modale en JS
            document.getElementById("open-modal-js").addEventListener("click", function () {
                let modal = new bootstrap.Modal(document.getElementById("testModal"));
                modal.show();
            });
        });
    </script>
@endsection
