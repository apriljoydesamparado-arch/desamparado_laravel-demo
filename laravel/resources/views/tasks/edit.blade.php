@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto p-6 rounded-xl shadow-lg border border-red-950/40 text-white" style="background-color: #3b0800;">
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-white tracking-tight">Edit Task</h2>
        <p class="text-sm text-red-200/80 mt-0.5">Modify the task details below and save your changes.</p>
    </div>

    @if ($errors->any())
        <div class="bg-rose-950/60 border border-rose-800 text-rose-200 px-4 py-3 rounded-lg mb-6 text-sm">
            <div class="font-semibold mb-1 flex items-center gap-1.5">
                <svg class="w-4 h-4 text-rose-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                Please fix the following errors:
            </div>
            <ul class="list-disc pl-5 space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="/tasks/{{ $task->id }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label class="block text-red-100 font-semibold text-sm mb-1.5">Task Name <span class="text-rose-400">*</span></label>
            <input type="text" name="task_name" value="{{ old('task_name', $task->task_name) }}" required class="w-full bg-red-950/40 border border-red-800/60 p-2.5 text-sm rounded-lg text-white placeholder-red-300/50 focus:outline-none focus:ring-2 focus:ring-rose-500 focus:border-rose-500 transition-all">
        </div>

        <div>
            <label class="block text-red-100 font-semibold text-sm mb-1.5">Description</label>
            <textarea name="description" rows="3" class="w-full bg-red-950/40 border border-red-800/60 p-2.5 text-sm rounded-lg text-white placeholder-red-300/50 focus:outline-none focus:ring-2 focus:ring-rose-500 focus:border-rose-500 transition-all">{{ old('description', $task->description) }}</textarea>
        </div>

        <div>
            <label class="block text-red-100 font-semibold text-sm mb-1.5">Due Date</label>
            <input type="date" name="due_date" value="{{ old('due_date', $task->due_date) }}" class="w-full bg-red-950/40 border border-red-800/60 p-2.5 text-sm rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-rose-500 focus:border-rose-500 transition-all [color-scheme:dark]">
        </div>

        <div class="flex justify-between items-center pt-3 border-t border-red-900/50">
            <a href="/tasks" class="text-red-200 hover:text-white text-sm font-medium transition-colors">Cancel</a>
            <button type="submit" class="bg-rose-700 hover:bg-rose-600 text-white font-medium text-sm px-4 py-2.5 rounded-lg transition-all duration-200 shadow-sm hover:shadow">
                Update Task
            </button>
        </div>
    </form>
</div>
@endsection