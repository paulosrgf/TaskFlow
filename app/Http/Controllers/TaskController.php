<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    // Listar as tarefas do usuário logado
    public function index()
    {
        // Puxa apenas as tarefas que pertencem ao usuário autenticado (Módulo 09)
        $tasks = auth()->user()->tasks()->latest()->get();

        // Retorna a view passandp a lista de tarefas (Módulo 05)
        return view('dashboard', compact('tasks'));
    }

    // Salvar uma nova tarefa
    public function store(StoreTaskRequest $request)
    {
        // Os dados já chegam aqui validados pelo StoreTaskRequest (Módulo 07)
        auth()->user()->tasks()->create($request->validated());

        return redirect()->route('dashboard')->with('success', 'Tarefa criada com sucesso!');
    }

    // Alternar o status de concluída
    public function update(Task $task)
    {
        // Garante que o usuário só mude as tarefas dele
        if ($task->user_id !== auth()->id()) {
            abort(403);
        }

        $task->update([
            'is_completed' => !$task->is_completed
        ]);

        return redirect()->route('dashboard');
    }

    // Deletar uma tarefa
    public function destroy(Task $task)
    {
        if ($task->user_id !== auth()->id()) {
            abort(403);
        }

        $task->delete();

        return redirect()->route('dashboard')->with('success', 'Tarefa excluída!');
    }
}