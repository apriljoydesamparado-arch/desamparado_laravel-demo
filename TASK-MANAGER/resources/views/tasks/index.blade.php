@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto p-6 rounded-xl shadow-lg border border-teal-950/40 text-white" style="background-color:#8b1700;">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-white tracking-tight">Personal Task Manager</h1>        
        </div>

       <a href="/tasks/create" class="hover:opacity-90 text-white font-medium text-sm px-4 py-2.5 rounded-lg transition-all duration-200 shadow-sm hover:shadow flex items-center gap-1.5" style="background-color: #008989;">
    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
    Add New Task
</a>
    </div>

    @if(session('success'))
        <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-3 rounded-lg mb-6 flex items-center justify-between text-sm">
            <div class="flex items-center gap-2">
                <svg class="w-5 h-5 text-emerald-600" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                <span>{{ session('success') }}</span>
            </div>
        </div>
    @endif

    <div class="overflow-x-auto rounded-lg border border-slate-200">
        <table class="w-full text-left border-collapse text-sm">
            <thead>
                <tr class="bg-slate-50 text-slate-600 font-semibold border-b border-slate-200">
                    <th class="p-3.5 pl-4">Task Name</th>
                    <th class="p-3.5">Description</th>
                    <th class="p-3.5">Due Date</th>
                    <th class="p-3.5">Status</th>
                    <th class="p-3.5 text-center">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($tasks as $task)
                    <tr class="hover:bg-slate-50/80 transition-colors">
                        <td class="p-3.5 pl-4 font-medium text-slate-900">{{ $task->task_name }}</td>
                        <td class="p-3.5 text-slate-600 max-w-xs truncate">{{ $task->description ?? 'No description' }}</td>
                        <td class="p-3.5 text-slate-500 font-mono text-xs">{{ $task->due_date ?? 'N/A' }}</td>
                        <td class="p-3.5">
                            <form action="/tasks/{{ $task->id }}/status" method="POST" class="inline">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="px-2.5 py-1 rounded-full text-xs font-semibold tracking-wide transition-colors {{ $task->status === 'Completed' ? 'bg-emerald-100 text-emerald-800 hover:bg-emerald-200' : 'bg-amber-100 text-amber-800 hover:bg-amber-200' }}">
                                    {{ $task->status }}
                                </button>
                            </form>
                        </td>
                        <td class="p-3.5 text-center space-x-1.5">
                            <a href="/tasks/{{ $task->id }}/edit" class="bg-slate-200 hover:bg-slate-200 text-slate-700 text-xs font-medium px-3 py-1.5 rounded-md transition-colors inline-block border border-slate-200">
                                Edit
                            </a>
                            
                            <form action="/tasks/{{ $task->id }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Are you sure you want to delete this task?')" class="bg-rose-50 hover:bg-rose-100 text-rose-700 hover:text-rose-800 text-xs font-medium px-3 py-1.5 rounded-md transition-colors border border-rose-200">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="p-8 text-center text-slate-400">
                            <div class="flex flex-col items-center justify-center gap-2">
                                <svg class="w-8 h-8 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                                <span>No tasks found. Click <strong class="text-slate-600">"+ Add New Task"</strong> above to get started!</span>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection