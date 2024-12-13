<?php

use Illuminate\Support\Facades\Route;


use App\Http\Controllers\TaskController;

Route::get('/', [TaskController::class, 'index'])->name('task_index'); // Afficher la liste des tâches
Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store'); // Ajouter une nouvelle tâche
Route::put('/tasks/{task}/complete', [TaskController::class, 'markAsComplete'])->name('tasks.complete'); // Marquer une tâche comme terminée
Route::delete('/tasks/{task}', [TaskController::class, 'destroy'])->name('tasks.destroy'); // Supprimer une tâche
