<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Objective</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        body { 
            font-family: 'Plus Jakarta Sans', sans-serif; 
            background-color: #060a12; 
            color: #94a3b8;
        }
        .font-mono { font-family: 'JetBrains Mono', monospace; }

        .navy-card {
            background: #0d172e;
            border: 1px solid #1e293b;
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
<body class="min-h-screen p-6 md:p-12 flex items-center justify-center">

    <div class="max-w-xl w-full">
        
        <div class="mb-6 flex items-center justify-between">
            <div class="flex items-center space-x-2">
                <i class="fa-solid fa-sliders text-blue-500 text-sm"></i>
                <h1 class="text-base font-bold text-slate-100 uppercase tracking-wide">Edit Objective Record</h1>
            </div>
            <a href="{{ route('tasks.index') }}" class="text-xs font-mono text-slate-500 hover:text-slate-300 transition-colors">
                &larr; Return to dashboard
            </a>
        </div>

        <div class="navy-card p-6 md:p-8 rounded-2xl">
            <form action="{{ route('tasks.update', $task) }}" method="POST" class="space-y-5">
                @csrf
                @method('PUT')

                <div>
                    <label class="block text-[11px] font-mono text-slate-400 uppercase tracking-wider mb-2">Task Title</label>
                    <input type="text" name="task_name" value="{{ $task->task_name }}" required class="w-full px-4 py-3 rounded-xl navy-input text-sm">
                </div>

                <div>
                    <label class="block text-[11px] font-mono text-slate-400 uppercase tracking-wider mb-2">Description / Notes</label>
                    <textarea name="description" rows="3" class="w-full px-4 py-3 rounded-xl navy-input text-sm resize-none">{{ $task->description }}</textarea>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-[11px] font-mono text-slate-400 uppercase tracking-wider mb-2">Status</label>
                        <select name="status" class="w-full px-4 py-3 rounded-xl navy-input text-sm">
                            <option value="Pending" {{ $task->status === 'Pending' ? 'selected' : '' }}>Pending</option>
                            <option value="Completed" {{ $task->status === 'Completed' ? 'selected' : '' }}>Completed</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-[11px] font-mono text-slate-400 uppercase tracking-wider mb-2">Due Date</label>
                        <input type="date" name="due_date" value="{{ $task->due_date }}" class="w-full px-4 py-3 rounded-xl navy-input text-sm text-slate-300">
                    </div>
                </div>

                <div class="flex items-center justify-end space-x-3 pt-4 border-t border-slate-800/80">
                    <a href="{{ route('tasks.index') }}" class="px-4 py-2.5 rounded-xl text-xs text-slate-400 hover:text-slate-200 transition-colors">
                        Cancel
                    </a>
                    <button type="submit" class="btn-primary font-semibold px-6 py-2.5 rounded-xl text-xs tracking-wide">
                        Save Changes
                    </button>
                </div>
            </form>
        </div>

    </div>
</body>
</html>