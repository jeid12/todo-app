@extends('layouts.app')

@section('content')
<div class="space-y-8">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold tracking-tight text-[#0079bf]">My Tasks</h1>
            <p class="mt-2 text-[#5067c5]">Manage and track your daily tasks efficiently</p>
        </div>
        <a href="{{ route('todos.create') }}" class="inline-flex items-center gap-2 rounded-2xl bg-[#61bd4f] px-6 py-3 text-sm font-semibold text-white shadow-md hover:bg-[#519e3e]">
            New Task
        </a>
    </div>

    <!-- Stats Section -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
        <div class="rounded-2xl border border-gray-200 bg-white p-6">
            <div class="flex items-center gap-3">
                <div class="rounded-xl bg-blue-100 p-2">
                    <svg class="h-6 w-6 text-blue-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M9 11l3 3l8-8" />
                        <path d="M21 12c0 4.97-4.03 9-9 9s-9-4.03-9-9s4.03-9 9-9" />
                    </svg>
                </div>
                <div>
                    <p class="text-2xl font-bold text-gray-800">{{ $todos->where('is_completed', true)->count() }}</p>
                    <p class="text-sm text-gray-600">Completed</p>
                </div>
            </div>
        </div>
        <div class="rounded-2xl border border-gray-200 bg-white p-6">
            <div class="flex items-center gap-3">
                <div class="rounded-xl bg-amber-100 p-2">
                    <svg class="h-6 w-6 text-amber-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="10" />
                        <path d="M12 6v6l4 2" />
                    </svg>
                </div>
                <div>
                    <p class="text-2xl font-bold text-gray-800">{{ $todos->where('is_completed', false)->count() }}</p>
                    <p class="text-sm text-gray-600">Pending</p>
                </div>
            </div>
        </div>
        <div class="rounded-2xl border border-gray-200 bg-white p-6">
            <div class="flex items-center gap-3">
                <div class="rounded-xl bg-purple-100 p-2">
                    <svg class="h-6 w-6 text-purple-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />
                        <polyline points="14,2 14,8 20,8" />
                    </svg>
                </div>
                <div>
                    <p class="text-2xl font-bold text-gray-800">{{ $todos->total() }}</p>
                    <p class="text-sm text-gray-600">Total Tasks</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Tasks List -->
    <div class="rounded-2xl border border-gray-200 bg-white">
        <div class="border-b border-gray-200 p-6">
            <h2 class="text-xl font-semibold text-gray-800">All Tasks</h2>
        </div>
        
        @forelse($todos as $todo)
            <div class="border-b border-gray-200 p-6 last:border-b-0">
                <div class="flex items-start gap-4">
                    <!-- Status Indicator -->
                    <div class="mt-1">
                        @if($todo->is_completed)
                            <div class="flex h-6 w-6 items-center justify-center rounded-full bg-emerald-500/20">
                                <svg class="h-4 w-4 text-emerald-400" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M16.704 4.29a1 1 0 0 1 .006 1.414l-6.667 6.75a1 1 0 0 1-1.436-.012L3.29 9.384a1 1 0 0 1 1.42-1.408l4.16 4.2 5.957-6.027a1 1 0 0 1 1.377-.858" clip-rule="evenodd" />
                                </svg>
                            </div>
                        @else
                            <div class="h-6 w-6 rounded-full border-2 border-slate-600"></div>
                        @endif
                    </div>
                    
                    <!-- Task Content -->
                    <div class="flex-1">
                        <div class="flex items-start justify-between">
                            <div class="flex-1">
                                <h3 class="text-lg font-semibold @if($todo->is_completed) text-slate-400 line-through @else text-gray-800 @endif">
                                    {{ $todo->title }}
                                </h3>
                                @if($todo->description)
                                    <p class="mt-2 text-gray-600">{{ $todo->description }}</p>
                                @endif
                                
                                <div class="mt-3 flex items-center gap-4">
                                    <!-- Due Date -->
                                    <div class="flex items-center gap-1.5 text-sm">
                                        <svg class="h-4 w-4 text-gray-500" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M5.75 2a.75.75 0 0 1 .75.75V4h7V2.75a.75.75 0 0 1 1.5 0V4h.25A2.75 2.75 0 0 1 18 6.75v8.5A2.75 2.75 0 0 1 15.25 18H4.75A2.75 2.75 0 0 1 2 15.25v-8.5A2.75 2.75 0 0 1 4.75 4H5V2.75A.75.75 0 0 1 5.75 2Zm-1 5.5c-.69 0-1.25.56-1.25 1.25v6.5c0 .69.56 1.25 1.25 1.25h10.5c.69 0 1.25-.56 1.25-1.25v-6.5c0-.69-.56-1.25-1.25-1.25H4.75Z" clip-rule="evenodd" />
                                        </svg>
                                        <span class="@if($todo->due_date->isPast() && !$todo->is_completed) text-red-400 @else text-gray-600 @endif">
                                            Due {{ $todo->due_date->format('M j, Y') }}
                                            @if($todo->due_date->isToday())
                                                <span class="text-amber-400">(Today)</span>
                                            @elseif($todo->due_date->isTomorrow())
                                                <span class="text-blue-400">(Tomorrow)</span>
                                            @elseif($todo->due_date->isPast() && !$todo->is_completed)
                                                <span class="text-red-400">(Overdue)</span>
                                            @endif
                                        </span>
                                    </div>
                                    
                                    <!-- Status Badge -->
                                    @if($todo->is_completed)
                                        <span class="inline-flex items-center gap-1 rounded-full bg-emerald-500/20 px-2.5 py-0.5 text-xs font-medium text-emerald-400">
                                            <svg class="h-3 w-3" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M16.704 4.29a1 1 0 0 1 .006 1.414l-6.667 6.75a1 1 0 0 1-1.436-.012L3.29 9.384a1 1 0 0 1 1.42-1.408l4.16 4.2 5.957-6.027a1 1 0 0 1 1.377-.858" clip-rule="evenodd" />
                                            </svg>
                                            Completed
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1 rounded-full bg-amber-500/20 px-2.5 py-0.5 text-xs font-medium text-amber-400">
                                            <svg class="h-3 w-3" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 1 0 0-16 8 8 0 0 0 0 16Zm.75-13a.75.75 0 0 0-1.5 0v5c0 .414.336.75.75.75h4a.75.75 0 0 0 0-1.5h-3.25V5Z" clip-rule="evenodd" />
                                            </svg>
                                            Pending
                                        </span>
                                    @endif
                                </div>
                            </div>
                            
                            <!-- Actions -->
                            <div class="flex items-center gap-2">
                                @if(!$todo->is_completed)
                                    <form action="{{ route('todos.complete', $todo->id) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" class="inline-flex items-center gap-1.5 rounded-xl bg-emerald-500/20 px-3 py-1.5 text-sm font-medium text-emerald-400 transition hover:bg-emerald-500/30">
                                            <svg class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M16.704 4.29a1 1 0 0 1 .006 1.414l-6.667 6.75a1 1 0 0 1-1.436-.012L3.29 9.384a1 1 0 0 1 1.42-1.408l4.16 4.2 5.957-6.027a1 1 0 0 1 1.377-.858" clip-rule="evenodd" />
                                            </svg>
                                            Complete
                                        </button>
                                    </form>
                                @endif
                                
                                <a href="{{ route('todos.edit', $todo->id) }}" 
                                   class="inline-flex items-center gap-1.5 rounded-xl bg-blue-500/20 px-3 py-1.5 text-sm font-medium text-blue-400 transition hover:bg-blue-500/30">
                                    <svg class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="m2.695 14.762-1.262 3.155a.5.5 0 0 0 .65.65l3.155-1.262a4 4 0 0 0 1.343-.886L17.5 5.501a2.121 2.121 0 0 0-3-3L3.58 13.419a4 4 0 0 0-.885 1.343Z" />
                                    </svg>
                                    Edit
                                </a>
                                
                                <form action="{{ route('todos.destroy', $todo->id) }}" method="POST" class="inline" 
                                      onsubmit="return confirm('Are you sure you want to delete this task?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="inline-flex items-center gap-1.5 rounded-xl bg-red-500/20 px-3 py-1.5 text-sm font-medium text-red-400 transition hover:bg-red-500/30">
                                        <svg class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M8.75 1A2.75 2.75 0 0 0 6 3.75v.443c-.795.077-1.584.176-2.365.298a.75.75 0 1 0 .23 1.482l.149-.022.841 10.518A2.75 2.75 0 0 0 7.596 19h4.807a2.75 2.75 0 0 0 2.742-2.53l.841-10.52.149.023a.75.75 0 0 0 .23-1.482A41.03 41.03 0 0 0 14 4.193V3.75A2.75 2.75 0 0 0 11.25 1h-2.5ZM10 4c.84 0 1.673.025 2.5.075V3.75c0-.69-.56-1.25-1.25-1.25h-2.5c-.69 0-1.25.56-1.25 1.25v.325C8.327 4.025 9.16 4 10 4ZM8.58 7.72a.75.75 0 0 0-1.5.06l.3 7.5a.75.75 0 1 0 1.5-.06l-.3-7.5Zm4.34.06a.75.75 0 1 0-1.5-.06l-.3 7.5a.75.75 0 1 0 1.5.06l.3-7.5Z" clip-rule="evenodd" />
                                        </svg>
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="p-12 text-center">
                <svg class="mx-auto h-16 w-16 text-slate-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1">
                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />
                    <polyline points="14,2 14,8 20,8" />
                    <line x1="16" y1="13" x2="8" y2="13" />
                    <line x1="16" y1="17" x2="8" y2="17" />
                    <polyline points="10,9 9,9 8,9" />
                </svg>
                <h3 class="mt-4 text-xl font-semibold text-slate-300">No tasks yet</h3>
                <p class="mt-2 text-slate-400">Get started by creating your first task.</p>
                <a href="{{ route('todos.create') }}" 
                   class="mt-6 inline-flex items-center gap-2 rounded-2xl bg-gradient-to-r from-fuchsia-500 via-purple-500 to-sky-500 px-6 py-3 text-sm font-semibold text-white shadow-lg shadow-purple-900/30 transition hover:shadow-purple-900/40">
                    <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 3a.75.75 0 0 1 .75.75v5.5h5.5a.75.75 0 0 1 0 1.5h-5.5v5.5a.75.75 0 0 1-1.5 0v-5.5h-5.5a.75.75 0 0 1 0-1.5h5.5v-5.5A.75.75 0 0 1 10 3Z" clip-rule="evenodd" />
                    </svg>
                    Create your first task
                </a>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if($todos->hasPages())
        <div class="flex justify-center">
            <div class="rounded-2xl border border-slate-800/50 bg-slate-900/60 p-4 backdrop-blur">
                {{ $todos->links() }}
            </div>
        </div>
    @endif
</div>
@endsection
