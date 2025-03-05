@extends('layouts.main')

@section('title', 'Test Bootstrap & jQuery')

@section('content')
    <h1 class="text-center text-primary">Test Bootstrap & jQuery</h1>

    <!-- TEST JQUERY -->
    <button id="test-btn" class="btn btn-success">Clique-moi</button>
    <p id="message" class="mt-3 text-muted">Attends un clic...</p>

    <!-- TEST AJAX -->
    <input type="text" id="text-input" class="form-control mb-3" placeholder="Entrez du texte...">

    <button id="ajax-submit" class="btn btn-warning">Envoyer AJAX</button>

    <p id="response-message" class="mt-3 text-muted"></p>

    <!-- TEST MODALE -->
    <button type="button" class="btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Ouvrir la modale
    </button>

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modale Dynamique</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Ma modale</p>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            if (typeof $ !== 'undefined') {
                console.log("jQuery chargé !");

                /* TEST JQUERY */
                $("#test-btn").click(function() {
                    $("#message").text("jQuery OK")
                        .removeClass("text-muted")
                        .addClass("text-success fw-bold");
                });

                $("#change-text").click(function() {
                    $("#modal-message").text("Le texte modifié");
                });

                /* TEST AJAX */
                $("#ajax-submit").click(function() {
                    let textValue = $("#text-input").val();

                    $.ajax({
                        url: "{{ route('test.ajax') }}",
                        type: "POST",
                        data: {
                            text: textValue,
                            _token: "{{ csrf_token() }}"
                        },
                        success: function(response) {
                            console.log("Réponse reçue :", response);
                            $("#response-message").text(response.message)
                                .removeClass("text-danger text-muted")
                                .addClass("text-success fw-bold");
                        },
                        error: function(xhr) {
                            let response = xhr.responseJSON;
                            console.error("Erreur AJAX :", response);
                            $("#response-message").text(response.message)
                                .removeClass("text-success text-muted")
                                .addClass("text-danger fw-bold");
                        }
                    });
                });

            } else {
                console.error("jQuery n'est pas chargé !");
            }
        });
    </script>
@endsection
