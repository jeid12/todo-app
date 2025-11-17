@extends('layouts.app')

@section('content')
<div class="mx-auto max-w-4xl">
    <div class="mb-8 flex items-start justify-between">
        <div class="flex-1">
            <div class="mb-3 flex items-center gap-3">
                <a href="{{ route('todos.index') }}" 
                   class="inline-flex items-center gap-1.5 rounded-xl bg-gray-200 px-3 py-1.5 text-sm font-medium text-gray-800 hover:bg-gray-300">
                    <svg class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M17 10a.75.75 0 0 1-.75.75H5.612l4.158 3.96a.75.75 0 1 1-1.04 1.08l-5.5-5.25a.75.75 0 0 1 0-1.08l5.5-5.25a.75.75 0 1 1 1.04 1.08L5.612 9.25H16.25A.75.75 0 0 1 17 10Z" clip-rule="evenodd" />
                    </svg>
                    Back to Tasks
                </a>
                @if($todo->is_completed)
                    <span class="inline-flex items-center gap-1 rounded-full bg-green-100 px-3 py-1 text-sm font-medium text-green-600">
                        <svg class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M16.704 4.29a1 1 0 0 1 .006 1.414l-6.667 6.75a1 1 0 0 1-1.436-.012L3.29 9.384a1 1 0 0 1 1.42-1.408l4.16 4.2 5.957-6.027a1 1 0 0 1 1.377-.858" clip-rule="evenodd" />
                        </svg>
                        Completed
                    </span>
                @else
                    <span class="inline-flex items-center gap-1 rounded-full bg-yellow-100 px-3 py-1 text-sm font-medium text-yellow-600">
                        <svg class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 1 0 0-16 8 8 0 0 0 0 16Zm.75-13a.75.75 0 0 0-1.5 0v5c0 .414.336.75.75.75h4a.75.75 0 0 0 0-1.5h-3.25V5Z" clip-rule="evenodd" />
                        </svg>
                        Pending
                    </span>
                @endif
            </div>
            <h1 class="text-3xl font-bold tracking-tight text-gray-800 @if($todo->is_completed) line-through text-gray-400 @endif">
                {{ $todo->title }}
            </h1>
        </div>
        <div class="flex gap-3">
            @if(!$todo->is_completed)
                <form action="{{ route('todos.complete', $todo->id) }}" method="POST">
                    @csrf
                    <button 
                        type="submit" 
                        class="inline-flex items-center gap-2 rounded-xl bg-green-100 px-4 py-2.5 text-sm font-medium text-green-600 hover:bg-green-200">
                        <svg class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M16.704 4.29a1 1 0 0 1 .006 1.414l-6.667 6.75a1 1 0 0 1-1.436-.012L3.29 9.384a1 1 0 0 1 1.42-1.408l4.16 4.2 5.957-6.027a1 1 0 0 1 1.377-.858" clip-rule="evenodd" />
                        </svg>
                        Complete
                    </button>
                </form>
            @endif
            <a href="{{ route('todos.edit', $todo->id) }}" 
               class="inline-flex items-center gap-2 rounded-xl bg-blue-100 px-4 py-2.5 text-sm font-medium text-blue-600 hover:bg-blue-200">
                <svg class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                    <path d="m2.695 14.762-1.262 3.155a.5.5 0 0 0 .65.65l3.155-1.262a4 4 0 0 0 1.343-.886L17.5 5.501a2.121 2.121 0 0 0-3-3L3.58 13.419a4 4 0 0 0-.885 1.343Z" />
                </svg>
                Edit
            </a>
        </div>
    </div>
    <div class="grid gap-8 lg:grid-cols-3">
        <div class="lg:col-span-2 space-y-6">
            @if($todo->description)
                <div class="rounded-2xl border border-gray-200 bg-white p-6">
                    <h2 class="mb-3 text-lg font-semibold text-gray-800">Description</h2>
                    <p class="text-gray-600">{{ $todo->description }}</p>
                </div>
            @endif

            <!-- Activity Timeline (Placeholder) -->
            <div class="rounded-2xl border border-gray-200 bg-white p-6">
                <h2 class="mb-4 text-lg font-semibold text-gray-800">Activity</h2>
                <div class="space-y-4">
                    <div class="flex items-start gap-3">
                        <div class="mt-1 flex h-6 w-6 items-center justify-center rounded-full bg-blue-100">
                            <svg class="h-3 w-3 text-blue-600" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 3a.75.75 0 0 1 .75.75v5.5h5.5a.75.75 0 0 1 0 1.5h-5.5v5.5a.75.75 0 0 1-1.5 0v-5.5h-5.5a.75.75 0 0 1 0-1.5h5.5v-5.5A.75.75 0 0 1 10 3Z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="flex-1">
                            <p class="text-sm font-medium text-gray-800">Task created</p>
                            <p class="text-xs text-gray-500">{{ $todo->created_at->format('M j, Y \a\t g:i A') }}</p>
                        </div>
                    </div>
                    
                    @if($todo->updated_at != $todo->created_at)
                        <div class="flex items-start gap-3">
                            <div class="mt-1 flex h-6 w-6 items-center justify-center rounded-full bg-yellow-100">
                                <svg class="h-3 w-3 text-yellow-600" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="m2.695 14.762-1.262 3.155a.5.5 0 0 0 .65.65l3.155-1.262a4 4 0 0 0 1.343-.886L17.5 5.501a2.121 2.121 0 0 0-3-3L3.58 13.419a4 4 0 0 0-.885 1.343Z" />
                                </svg>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm font-medium text-gray-800">Task updated</p>
                                <p class="text-xs text-gray-500">{{ $todo->updated_at->format('M j, Y \a\t g:i A') }}</p>
                            </div>
                        </div>
                    @endif
                    
                    @if($todo->is_completed)
                        <div class="flex items-start gap-3">
                            <div class="mt-1 flex h-6 w-6 items-center justify-center rounded-full bg-green-100">
                                <svg class="h-3 w-3 text-green-600" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M16.704 4.29a1 1 0 0 1 .006 1.414l-6.667 6.75a1 1 0 0 1-1.436-.012L3.29 9.384a1 1 0 0 1 1.42-1.408l4.16 4.2 5.957-6.027a1 1 0 0 1 1.377-.858" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm font-medium text-gray-800">Task completed</p>
                                <p class="text-xs text-gray-500">{{ $todo->updated_at->format('M j, Y \a\t g:i A') }}</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Task Information -->
            <div class="rounded-2xl border border-gray-200 bg-white p-6">
                <h2 class="mb-4 text-lg font-semibold text-gray-800">Task Details</h2>
                <div class="space-y-4">
                    <!-- Due Date -->
                    <div class="flex items-center gap-3">
                        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-blue-100">
                            <svg class="h-5 w-5 text-blue-600" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5.75 2a.75.75 0 0 1 .75.75V4h7V2.75a.75.75 0 0 1 1.5 0V4h.25A2.75 2.75 0 0 1 18 6.75v8.5A2.75 2.75 0 0 1 15.25 18H4.75A2.75 2.75 0 0 1 2 15.25v-8.5A2.75 2.75 0 0 1 4.75 4H5V2.75A.75.75 0 0 1 5.75 2Zm-1 5.5c-.69 0-1.25.56-1.25 1.25v6.5c0 .69.56 1.25 1.25 1.25h10.5c.69 0 1.25-.56 1.25-1.25v-6.5c0-.69-.56-1.25-1.25-1.25H4.75Z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="flex-1">
                            <p class="text-sm font-medium text-gray-800">Due Date</p>
                            <p class="text-sm @if($todo->due_date->isPast() && !$todo->is_completed) text-red-400 @else text-gray-500 @endif">
                                {{ $todo->due_date->format('l, F j, Y') }}
                                @if($todo->due_date->isToday())
                                    <span class="text-amber-400">(Today)</span>
                                @elseif($todo->due_date->isTomorrow())
                                    <span class="text-blue-400">(Tomorrow)</span>
                                @elseif($todo->due_date->isPast() && !$todo->is_completed)
                                    <span class="text-red-400">({{ $todo->due_date->diffForHumans() }})</span>
                                @else
                                    <span class="text-gray-500">({{ $todo->due_date->diffForHumans() }})</span>
                                @endif
                            </p>
                        </div>
                    </div>

                    <!-- Priority (if you want to add this feature later) -->
                    <div class="flex items-center gap-3">
                        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-purple-100">
                            <svg class="h-5 w-5 text-purple-600" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 3a.75.75 0 0 1 .75.75v1.5h1.5a.75.75 0 0 1 0 1.5h-1.5v1.5a.75.75 0 0 1-1.5 0v-1.5h-1.5a.75.75 0 0 1 0-1.5h1.5v-1.5A.75.75 0 0 1 10 3Z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="flex-1">
                            <p class="text-sm font-medium text-gray-800">Priority</p>
                            <p class="text-sm text-gray-500">Normal</p>
                        </div>
                    </div>

                    <!-- Created Date -->
                    <div class="flex items-center gap-3">
                        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-slate-100">
                            <svg class="h-5 w-5 text-slate-600" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 1 0 0-16 8 8 0 0 0 0 16Zm.75-13a.75.75 0 0 0-1.5 0v5c0 .414.336.75.75.75h4a.75.75 0 0 0 0-1.5h-3.25V5Z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="flex-1">
                            <p class="text-sm font-medium text-gray-800">Created</p>
                            <p class="text-sm text-gray-500">{{ $todo->created_at->format('M j, Y') }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Actions -->
            <div class="rounded-2xl border border-gray-200 bg-white p-6">
                <h2 class="mb-4 text-lg font-semibold text-gray-800">Actions</h2>
                <div class="space-y-3">
                    @if(!$todo->is_completed)
                        <form action="{{ route('todos.complete', $todo->id) }}" method="POST">
                            @csrf
                            <button 
                                type="submit" 
                                class="w-full inline-flex items-center justify-center gap-2 rounded-xl bg-green-100 px-4 py-3 text-sm font-medium text-green-600 hover:bg-green-200"
                            >
                                <svg class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M16.704 4.29a1 1 0 0 1 .006 1.414l-6.667 6.75a1 1 0 0 1-1.436-.012L3.29 9.384a1 1 0 0 1 1.42-1.408l4.16 4.2 5.957-6.027a1 1 0 0 1 1.377-.858" clip-rule="evenodd" />
                                </svg>
                                Mark as Complete
                            </button>
                        </form>
                    @endif
                    
                    <a href="{{ route('todos.edit', $todo->id) }}" 
                       class="w-full inline-flex items-center justify-center gap-2 rounded-xl bg-blue-100 px-4 py-3 text-sm font-medium text-blue-600 hover:bg-blue-200">
                        <svg class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                            <path d="m2.695 14.762-1.262 3.155a.5.5 0 0 0 .65.65l3.155-1.262a4 4 0 0 0 1.343-.886L17.5 5.501a2.121 2.121 0 0 0-3-3L3.58 13.419a4 4 0 0 0-.885 1.343Z" />
                        </svg>
                        Edit Task
                    </a>
                    
                    <form 
                        action="{{ route('todos.destroy', $todo->id) }}" 
                        method="POST" 
                        onsubmit="return confirm('Are you sure you want to delete this task? This action cannot be undone.')"
                    >
                        @csrf
                        @method('DELETE')
                        <button 
                            type="submit" 
                            class="w-full inline-flex items-center justify-center gap-2 rounded-xl bg-red-100 px-4 py-3 text-sm font-medium text-red-600 hover:bg-red-200"
                        >
                            <svg class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M8.75 1A2.75 2.75 0 0 0 6 3.75v.443c-.795.077-1.584.176-2.365.298a.75.75 0 1 0 .23 1.482l.149-.022.841 10.518A2.75 2.75 0 0 0 7.596 19h4.807a2.75 2.75 0 0 0 2.742-2.53l.841-10.52.149.023a.75.75 0 0 0 .23-1.482A41.03 41.03 0 0 0 14 4.193V3.75A2.75 2.75 0 0 0 11.25 1h-2.5ZM10 4c.84 0 1.673.025 2.5.075V3.75c0-.69-.56-1.25-1.25-1.25h-2.5c-.69 0-1.25.56-1.25 1.25v.325C8.327 4.025 9.16 4 10 4ZM8.58 7.72a.75.75 0 0 0-1.5.06l.3 7.5a.75.75 0 1 0 1.5-.06l-.3-7.5Zm4.34.06a.75.75 0 1 0-1.5-.06l-.3 7.5a.75.75 0 1 0 1.5.06l.3-7.5Z" clip-rule="evenodd" />
                            </svg>
                            Delete Task
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection