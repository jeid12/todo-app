<nav class="sticky top-0 z-20 border-b border-white/10 bg-slate-900/60 backdrop-blur">
    <div class="mx-auto flex h-16 w-full max-w-6xl items-center justify-between px-4 sm:px-6 lg:px-8">
        <a href="{{ auth()->check() ? route('todos.index') : route('landing') }}" class="flex items-center gap-3">
            <span class="inline-flex h-10 w-10 items-center justify-center rounded-2xl bg-gradient-to-br from-fuchsia-500 via-purple-500 to-sky-500 shadow-lg shadow-purple-900/40">
                <img src="https://cdn-icons-png.flaticon.com/512/3176/3176363.png" alt="Todo list icon by Freepik" class="h-6 w-6" loading="lazy">
            </span>
            <span class="text-lg font-semibold tracking-tight text-white">Flowlist</span>
        </a>

        <div class="flex items-center gap-3 text-sm font-medium">
            @auth
                <div class="hidden items-center gap-1 rounded-full border border-white/10 bg-white/5 px-1.5 py-1 text-slate-200 sm:flex">
                    <a href="{{ route('todos.index') }}" class="rounded-full px-3 py-1 transition @class([
                        'bg-white text-slate-900 shadow-sm shadow-white/40' => request()->routeIs('todos.index'),
                        'text-slate-200 hover:bg-white/10' => ! request()->routeIs('todos.index'),
                    ])">
                        My Todos
                    </a>
                    <a href="{{ route('todos.create') }}" class="rounded-full px-3 py-1 transition @class([
                        'bg-white text-slate-900 shadow-sm shadow-white/40' => request()->routeIs('todos.create'),
                        'text-slate-200 hover:bg-white/10' => ! request()->routeIs('todos.create'),
                    ])">
                        New Task
                    </a>
                </div>

                <div class="flex items-center gap-3">
                    <a href="{{ route('profile.edit') }}" class="hidden rounded-full border border-white/10 px-3 py-1.5 text-slate-200/80 transition hover:border-white/30 hover:text-white sm:inline-flex">
                        {{ \Illuminate\Support\Str::limit(Auth::user()->name, 18) }}
                    </a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="inline-flex items-center gap-2 rounded-full bg-blue-500 px-4 py-2 text-sm font-semibold text-white shadow-md hover:bg-blue-600">
                            <svg class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M3 4.5A1.5 1.5 0 0 1 4.5 3h5a1.5 1.5 0 0 1 0 3h-5A1.5 1.5 0 0 1 3 4.5Zm0 11a1.5 1.5 0 0 1 1.5-1.5h5a1.5 1.5 0 0 1 0 3h-5A1.5 1.5 0 0 1 3 15.5Zm13.53-9.03a.75.75 0 0 1 0 1.06L14.06 9l2.47 2.47a.75.75 0 1 1-1.06 1.06l-3-3a.75.75 0 0 1 0-1.06l3-3a.75.75 0 0 1 1.06 0Z" clip-rule="evenodd" />
                            </svg>
                            Log out
                        </button>
                    </form>
                </div>
            @else
                <a href="{{ route('login') }}" class="rounded-full border border-white/15 px-4 py-2 text-slate-200 transition hover:border-white/30 hover:text-white">Log in</a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="inline-flex items-center gap-2 rounded-full bg-white px-4 py-2 text-slate-900 shadow-lg shadow-purple-900/30 transition hover:bg-slate-100">
                        <svg class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 3a.75.75 0 0 1 .75.75v5.5h5.5a.75.75 0 0 1 0 1.5h-5.5v5.5a.75.75 0 0 1-1.5 0v-5.5h-5.5a.75.75 0 0 1 0-1.5h5.5v-5.5A.75.75 0 0 1 10 3Z" clip-rule="evenodd" />
                        </svg>
                        Join now
                    </a>
                @endif
            @endauth
        </div>
    </div>
</nav>
