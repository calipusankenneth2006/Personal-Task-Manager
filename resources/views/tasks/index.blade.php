<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navy Workspace</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.6.0/dist/confetti.browser.min.js"></script>

    <style>
        body { 
            font-family: 'Plus Jakarta Sans', sans-serif; 
            background-color: #060a12; 
            color: #94a3b8;
        }
        .font-mono { font-family: 'JetBrains Mono', monospace; }
        
        .navy-sidebar {
            background: #0b1326;
            border-right: 1px solid #1e293b;
        }
        .navy-card {
            background: #0d172e;
            border: 1px solid #1e293b;
            transition: all 0.2s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .navy-card:hover {
            border-color: #334155;
            background: #101c38;
        }
        .navy-input {
            background: #070e1e;
            border: 1px solid #1e293b;
            color: #f8fafc;
            transition: all 0.15s ease;
        }
        .navy-input:focus {
            border-color: #38bdf8;
            box-shadow: 0 0 0 2px rgba(56, 189, 248, 0.2);
            outline: none;
        }
        .btn-primary {
            background: #2563eb;
            color: #ffffff;
            transition: all 0.2s ease;
        }
        .btn-primary:hover {
            background: #1d4ed8;
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3);
        }
        ::-webkit-calendar-picker-indicator {
            filter: invert(0.8);
            cursor: pointer;
        }
    </style>
</head>
<body class="min-h-screen flex flex-col lg:flex-row">

    <!-- Left Navigation & Stats Panel -->
    <aside class="w-full lg:w-80 navy-sidebar p-6 flex flex-col justify-between shrink-0">
        <div>
            <!-- Header / Brand -->
            <div class="flex items-center space-x-3 pb-6 border-b border-slate-800">
                <div class="w-9 h-9 rounded-xl bg-blue-600 flex items-center justify-center text-white shadow-lg shadow-blue-600/30">
                    <i class="fa-solid fa-layer-group text-sm"></i>
                </div>
                <div>
                    <h1 class="text-sm font-bold text-slate-100 tracking-wide uppercase">Command Center</h1>
                    <p class="text-[11px] font-mono text-slate-500">v2.4 • Active Ops</p>
                </div>
            </div>

            <!-- Stats Widget -->
            <div class="mt-8 space-y-3">
                <span class="text-[10px] font-mono uppercase tracking-wider text-slate-500 block">Overview</span>
                
                <div class="navy-card p-4 rounded-xl flex items-center justify-between">
                    <div>
                        <p class="text-xs text-slate-400">Total Tasks</p>
                        <p class="text-xl font-bold text-slate-100 mt-0.5">{{ $tasks->count() }}</p>
                    </div>
                    <div class="w-10 h-10 rounded-lg bg-slate-800/60 flex items-center justify-center text-slate-400">
                        <i class="fa-solid fa-list-check"></i>
                    </div>
                </div>

                <div class="navy-card p-4 rounded-xl flex items-center justify-between">
                    <div>
                        <p class="text-xs text-slate-400">Completed</p>
                        <p class="text-xl font-bold text-emerald-400 mt-0.5">{{ $tasks->where('status', 'Completed')->count() }}</p>
                    </div>
                    <div class="w-10 h-10 rounded-lg bg-emerald-950/40 text-emerald-400 flex items-center justify-center">
                        <i class="fa-solid fa-circle-check"></i>
                    </div>
                </div>

                <div class="navy-card p-4 rounded-xl flex items-center justify-between">
                    <div>
                        <p class="text-xs text-slate-400">Pending</p>
                        <p class="text-xl font-bold text-amber-400 mt-0.5">{{ $tasks->where('status', 'Pending')->count() }}</p>
                    </div>
                    <div class="w-10 h-10 rounded-lg bg-amber-950/40 text-amber-400 flex items-center justify-center">
                        <i class="fa-solid fa-clock"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- System Footer Info -->
        <div class="pt-6 border-t border-slate-800 mt-8">
            <div class="flex items-center space-x-2">
                <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                <span class="text-xs font-mono text-slate-400">System Operational</span>
            </div>
        </div>
    </aside>

    <!-- Main Content Area -->
    <main class="flex-1 p-6 lg:p-10 max-w-5xl">
        
        <!-- Flash Alert -->
        @if(session('success'))
            <div class="mb-6 p-4 rounded-xl bg-blue-950/60 border border-blue-800/80 text-xs text-blue-200 flex items-center justify-between">
                <div class="flex items-center space-x-2.5">
                    <i class="fa-solid fa-circle-info text-blue-400"></i>
                    <span>{{ session('success') }}</span>
                </div>
                <button onclick="this.parentElement.remove()" class="text-blue-400 hover:text-blue-200">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
        @endif

        <!-- Creation Bar -->
        <section class="navy-card p-6 rounded-2xl mb-8">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-xs font-mono uppercase tracking-wider text-slate-400 flex items-center">
                    <i class="fa-solid fa-plus text-blue-500 mr-2"></i> Quick Task Entry
                </h2>
            </div>
            
            <form action="{{ route('tasks.store') }}" method="POST" class="space-y-4">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                    <div class="md:col-span-2">
                        <input type="text" name="task_name" required class="w-full px-4 py-3 rounded-xl navy-input text-sm placeholder-slate-600" placeholder="Enter objective title...">
                    </div>
                    <div>
                        <input type="date" name="due_date" class="w-full px-4 py-3 rounded-xl navy-input text-sm text-slate-400">
                    </div>
                </div>
                
                <div class="flex flex-col md:flex-row gap-3 items-center justify-between">
                    <input type="text" name="description" class="w-full px-4 py-2.5 rounded-xl navy-input text-xs placeholder-slate-600" placeholder="Optional brief or details...">
                    <button type="submit" class="w-full md:w-auto px-6 py-2.5 rounded-xl btn-primary text-xs font-semibold whitespace-nowrap shrink-0">
                        Add Task
                    </button>
                </div>
            </form>
        </section>

        <!-- Tasks Feed -->
        <section>
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-sm font-bold text-slate-200 tracking-tight">Active Workload</h2>
                <span class="text-xs font-mono text-slate-500">{{ $tasks->count() }} items listed</span>
            </div>

            <div class="space-y-3">
                @forelse($tasks as $task)
                    <div class="navy-card p-4 rounded-xl flex flex-col md:flex-row md:items-center justify-between gap-4 border-l-4 {{ $task->status === 'Completed' ? 'border-l-emerald-500' : 'border-l-blue-500' }}">
                        
                        <div class="flex-1 space-y-1">
                            <div class="flex items-center space-x-3">
                                <h3 class="text-sm font-semibold {{ $task->status === 'Completed' ? 'line-through text-slate-500' : 'text-slate-100' }}">
                                    {{ $task->task_name }}
                                </h3>

                                <span class="px-2 py-0.5 rounded text-[10px] font-mono uppercase tracking-wider {{ $task->status === 'Completed' ? 'bg-emerald-950/60 text-emerald-400 border border-emerald-800/50' : 'bg-amber-950/40 text-amber-400 border border-amber-800/40' }}">
                                    {{ $task->status }}
                                </span>
                            </div>

                            @if($task->description)
                                <p class="text-xs text-slate-400 line-clamp-1">
                                    {{ $task->description }}
                                </p>
                            @endif
                        </div>

                        <!-- Meta & Actions -->
                        <div class="flex items-center justify-between md:justify-end space-x-4 pt-3 md:pt-0 border-t md:border-t-0 border-slate-800">
                            <span class="text-xs font-mono text-slate-500 flex items-center">
                                <i class="fa-regular fa-calendar-check mr-1.5 text-slate-400"></i>
                                {{ $task->due_date ? \Carbon\Carbon::parse($task->due_date)->format('Y-m-d') : 'No deadline' }}
                            </span>

                            <div class="flex items-center space-x-1">
                                <form action="{{ route('tasks.toggleStatus', $task) }}" method="POST" 
                                      onsubmit="{{ $task->status === 'Pending' ? 'triggerConfetti(event, this)' : '' }}">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="w-8 h-8 rounded-lg bg-slate-900 hover:bg-slate-800 text-slate-400 hover:text-emerald-400 border border-slate-800 flex items-center justify-center transition-colors" title="Toggle Status">
                                        <i class="fa-solid fa-check text-xs"></i>
                                    </button>
                                </form>

                                <a href="{{ route('tasks.edit', $task) }}" class="w-8 h-8 rounded-lg bg-slate-900 hover:bg-slate-800 text-slate-400 hover:text-blue-400 border border-slate-800 flex items-center justify-center transition-colors" title="Edit Task">
                                    <i class="fa-solid fa-pen-to-square text-xs"></i>
                                </a>

                                <form action="{{ route('tasks.destroy', $task) }}" method="POST" onsubmit="return confirm('Delete this record?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="w-8 h-8 rounded-lg bg-slate-900 hover:bg-slate-800 text-slate-400 hover:text-rose-400 border border-slate-800 flex items-center justify-center transition-colors" title="Delete Task">
                                        <i class="fa-solid fa-trash-can text-xs"></i>
                                    </button>
                                </form>
                            </div>
                        </div>

                    </div>
                @empty
                    <div class="text-center py-12 navy-card rounded-xl border-dashed">
                        <i class="fa-solid fa-inbox text-3xl text-slate-700 mb-2 block"></i>
                        <p class="text-xs font-mono text-slate-500">No active tasks in queue.</p>
                    </div>
                @endforelse
            </div>
        </section>

    </main>

    <script>
        function triggerConfetti(e, form) {
            e.preventDefault(); 
            confetti({
                particleCount: 50,
                spread: 60,
                origin: { y: 0.7 },
                colors: ['#2563eb', '#38bdf8', '#34d399'],
                disableForReducedMotion: true
            });
            setTimeout(() => { form.submit(); }, 300); 
        }
    </script>
</body>
</html>