<?php
// filepath: /d:/ukk/todolist/app/Http/Controllers/TaskController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use Carbon\Carbon;

class TaskController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $tasks = Task::query();

        if ($request->has('filter_date') && $request->filter_date != '') {
            $tasks->whereDate('due_date', $request->filter_date);
        }

        // Filter berdasarkan prioritas
        if ($request->has('filter_priority') && $request->filter_priority != '') {
            $tasks->where('priority', $request->filter_priority);
        }

        // Filter berdasarkan nama tugas
        if ($request->has('filter_name') && $request->filter_name != '') {
            $tasks->where('task_name', 'like', '%' . $request->filter_name . '%');
        }

        // Mengurutkan task berdasarkan tanggal deadline
        $tasks = $tasks->orderBy('due_date', 'asc')->get();

        // Jika permintaan adalah AJAX, kembalikan partial view
        if ($request->ajax()) {
            return view('partials.task-list', compact('tasks'))->render();
        }
        return view('dashboard', compact('tasks'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'task_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'priority' => 'required|in:low,medium,urgent',
            'due_date' => 'required|date',
        ]);

        Task::create([
            'user_id' => auth()->id(),
            'task_name' => $request->task_name,
            'description' => $request->description,
            'status' => 'pending', // Default status
            'priority' => $request->priority,
            'due_date' => $request->due_date,
        ]);

        return redirect()->route('dashboard');
    }

    public function edit(Task $task)
    {
        return view('tasks.edit', compact('task'));
    }

    public function update(Request $request, Task $task)
    {
        $request->validate([
            'status' => 'required|in:done,pending',
        ]);

        $task->update([
            'status' => $request->status,
        ]);

        return redirect()->route('dashboard');
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->route('dashboard');
    }

    public function markAsDone($id)
    {
        $task = Task::findOrFail($id);
        $task->status = 'done';
        $task->save();

        return redirect()->route('dashboard')->with('success', 'Task marked as done.');
    }
}