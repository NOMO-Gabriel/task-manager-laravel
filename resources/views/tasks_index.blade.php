<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Tâches</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .success {
            color: green;
        }
        .error {
            color: red;
        }
        ul {
            list-style-type: none;
            padding: 0;
        }
        li {
            margin: 10px 0;
        }
        form {
            display: inline;
        }
        button {
            margin-left: 5px;
        }
    </style>
</head>
<body>
    <h1>Liste des Tâches</h1>

    <!-- Message de succès -->
    @if (session('success'))
        <p class="success">{{ session('success') }}</p>
    @endif

    <!-- Message d'erreur -->
    @if ($errors->any())
        <div class="error">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Formulaire pour ajouter une nouvelle tâche -->
    <form action="{{ route('tasks.store') }}" method="POST">
        @csrf
        <input type="text" name="title" placeholder="Titre de la tâche" required>
        <button type="submit">Ajouter</button>
    </form>

    <!-- Liste des tâches -->
    <ul>
        @foreach ($tasks as $task)
            <li>
                <strong>{{ $task->title }}</strong> - {{ $task->status }}
                @if ($task->status === 'En cours')
                    <!-- Bouton pour marquer comme terminée -->
                    <form action="{{ route('tasks.complete', $task->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <button type="submit">Terminer</button>
                    </form>
                @endif
                <!-- Bouton pour supprimer une tâche -->
                <form action="{{ route('tasks.destroy', $task->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Supprimer</button>
                </form>
            </li>
        @endforeach
    </ul>
</body>
</html>
