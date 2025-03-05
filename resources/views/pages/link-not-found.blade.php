<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lien introuvable</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            text-align: center;
            background-color: #f8f9fa;
        }
        .container {
            max-width: 400px;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .logo {
            max-width: 150px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
<div class="container">
    <img src="{{ asset('images/logo.png') }}" alt="Logo" class="logo">
    <h2 class="text-danger">Oups !</h2>
    <p>Le lien que vous avez suivi n'existe plus ou est invalide.</p>
    <a href="{{ url('/') }}" class="btn btn-primary">Visiter notre site</a>
</div>
</body>
</html>
