@extends('layouts.app')

@section('content')
<div class="mx-auto max-w-2xl">
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold tracking-tight text-[#0079bf]">Edit Task</h1>
        <p class="mt-2 text-[#5067c5]">Update your task details and manage its completion status</p>
    </div>

    <!-- Form Card -->
    <div class="rounded-2xl border border-gray-200 bg-white p-8">
        @if ($errors->any())
            <div class="mb-6 rounded-2xl border border-red-200 bg-red-50 p-4">
                <h3 class="font-semibold text-red-600">Please fix the following errors:</h3>
                <ul class="mt-2 space-y-1 text-sm text-red-500">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('todos.update', $todo->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')
            
            <!-- Title Field -->
            <div class="space-y-2">
                <label for="title" class="block text-sm font-semibold text-gray-800">
                    Task Title
                </label>
                <input 
                    id="title"
                    name="title" 
                    type="text"
                    value="{{ old('title', $todo->title) }}" 
                    class="w-full rounded-lg border-gray-300 p-3 text-gray-800"
                    autocomplete="off"
                />
            </div>

            <!-- Description Field -->
            <div class="space-y-2">
                <label for="description" class="block text-sm font-semibold text-gray-800">
                    Description
                </label>
                <textarea 
                    id="description"
                    name="description" 
                    rows="4"
                    class="w-full rounded-lg border-gray-300 p-3 text-gray-800"
                >{{ old('description', $todo->description) }}</textarea>
            </div>

            <!-- Due Date Field -->
            <div class="space-y-2">
                <label for="due_date" class="block text-sm font-semibold text-gray-800">
                    Due Date
                </label>
                <input 
                    id="due_date"
                    type="date" 
                    name="due_date" 
                    value="{{ old('due_date', $todo->due_date->format('Y-m-d')) }}" 
                    class="w-full rounded-lg border-gray-300 p-3 text-gray-800"
                />
            </div>

            <!-- Completion Status -->
            <div class="space-y-3">
                <label class="block text-sm font-semibold text-gray-800">Task Status</label>
                <div class="rounded-lg border border-gray-300 bg-gray-50 p-4">
                    <label class="flex items-start gap-3">
                        <input 
                            type="checkbox" 
                            name="is_completed" 
                            value="1" 
                            {{ old('is_completed', $todo->is_completed) ? 'checked' : '' }}
                            class="rounded border-gray-300 text-indigo-500"
                        /> 
                        <span class="text-gray-800">Mark as completed</span>
                    </label>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex gap-3">
                <button 
                    type="submit" 
                    class="flex-1 rounded-lg bg-[#61bd4f] px-6 py-3 text-white hover:bg-[#519e3e]"
                >
                    Update Task
                </button>
                
                <a 
                    href="{{ route('todos.index') }}" 
                    class="rounded-lg bg-gray-200 px-6 py-3 text-gray-800 hover:bg-gray-300"
                >
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
