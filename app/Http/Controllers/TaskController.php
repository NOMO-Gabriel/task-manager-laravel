<?php

namespace App\Http\Controllers;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
     // Afficher la liste des tâches
     public function index()
     {      
         $tasks = Task::all();
         return view('tasks_index', compact('tasks'));
     }
 
     // Ajouter une nouvelle tâche
     public function store(Request $request)
     {
         $request->validate([
             'title' => 'required|string|max:255',
         ]);
 
         Task::create([
             'title' => $request->title,
             'status' => 'En cours',
             
         ]);
 
         return redirect()->route('task_index')->with('success', 'Tâche ajoutée avec succès.');
     }
 
     // Marquer une tâche comme terminée
     public function markAsComplete(Task $task)
     {
         $task->update(['status' => 'Terminée']);
         return redirect()->route('task_index')->with('success', 'Tâche marquée comme terminée.');
     }
 
     // Supprimer une tâche
     public function destroy(Task $task)
     {
         $task->delete();
         return redirect()->route('task_index')->with('success', 'Tâche supprimée avec succès.');
     }
}
