<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('TaskFlow Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <!-- Mensagem de Sucesso (Feedback Visual) -->
            @if(session('success'))
                <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Formulário para Criar Nova Tarefa (Módulo 07 - Validação) -->
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">Create New Task</h3>
                    
                    <form action="{{ route('tasks.store') }}" method="POST" class="space-y-4">
                        @csrf
                        
                        <!-- Título -->
                        <div>
                            <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Task Title</label>
                            <input type="text" name="title" id="title" value="{{ old('title') }}" 
                                   class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            <!-- Exibição de Erro campo a campo (Módulo 07) -->
                            @error('title')
                                <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Descrição -->
                        <div>
                            <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Description (Optional)</label>
                            <textarea name="description" id="description" rows="3" 
                                      class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('description') }}</textarea>
                        </div>

                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            Add Task
                        </button>
                    </form>
                </div>
            </div>

            <!-- Listagem de Tarefas (Módulo 05 - Loops e Condicionais) -->
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">Your Tasks</h3>

                <!-- Condicional Blade para verificar se há tarefas (Módulo 05) -->
                @if($tasks->isEmpty())
                    <p class="text-gray-500 dark:text-gray-400">No tasks found. Start by adding one above!</p>
                @else
                    <div class="space-y-4">
                        <!-- Loop Blade para iterar nas tarefas (Módulo 05) -->
                        @foreach($tasks as $task)
                            <div class="flex items-center justify-between p-4 bg-gray-50 dark:bg-gray-900 rounded-lg shadow-sm border-l-4 {{ $task->is_completed ? 'border-green-500' : 'border-amber-500' }}">
                                <div class="flex-1 min-w-0 pr-4">
                                    <!-- Classe condicional do Tailwind baseada no status (Módulo 06) -->
                                    <h4 class="text-md font-bold truncate {{ $task->is_completed ? 'line-through text-gray-400 dark:text-gray-500' : 'text-gray-900 dark:text-gray-100' }}">
                                        {{ $task->title }}
                                    </h4>
                                    @if($task->description)
                                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1 {{ $task->is_completed ? 'line-through opacity-50' : '' }}">
                                            {{ $task->description }}
                                        </p>
                                    @endif
                                </div>

                                <!-- Ações (Mudar status e Deletar) -->
                                <div class="flex items-center space-x-2">
                                    <!-- Botão Toggle Status (PATCH) -->
                                    <form action="{{ route('tasks.update', $task) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="px-3 py-1.5 text-xs font-semibold rounded-md border {{ $task->is_completed ? 'bg-amber-100 text-amber-800 border-amber-300 dark:bg-amber-900 dark:text-amber-200' : 'bg-green-100 text-green-800 border-green-300 dark:bg-green-900 dark:text-green-200' }}">
                                            {{ $task->is_completed ? 'Undo' : 'Complete' }}
                                        </button>
                                    </form>

                                    <!-- Botão Deletar (DELETE) -->
                                    <form action="{{ route('tasks.destroy', $task) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this task?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-3 py-1.5 text-xs font-semibold rounded-md bg-red-100 text-red-800 border border-red-300 dark:bg-red-900 dark:text-red-200">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>