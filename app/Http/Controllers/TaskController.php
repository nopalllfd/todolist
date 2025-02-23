<?php
// filepath: /d:/ukk/todolist/app/Http/Controllers/TaskController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

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
            'description' => 'required|string',
            'priority' => 'required|string',
            'due_date' => 'required|date|after_or_equal:today',
        ]);
dd($request->all());
        Task::create([
            'task_name' => $request->task_name,
            'description' => $request->description,
            'priority' => $request->priority,
            'due_date' => $request->due_date,
        ]);
    
        return redirect()->route('dashboard')->with('success', 'Task created successfully.');
    }

    public function edit(Task $task)
    {
        return view('tasks.edit', compact('task'));
    }

   

    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->route('dashboard');
    }

    public function done($id)
    {
        $task = Task::findOrFail($id);
        $task->status = 'done';
        $task->save();

        return redirect()->route('dashboard')->with('success', 'Task marked as done.');
    }

    public function update(Request $request, Task $task)
    {
        Log::info('Update Task Request:', $request->all());

        $request->validate([
            'task_name' => 'required|string|max:255',
            'description' => 'required|string',
            'priority' => 'required|string|in:low,medium,urgent',
            'due_date' => 'required|date|after_or_equal:today',
        ]);
    
        $task->update([
            'task_name' => $request->task_name,
            'description' => $request->description,
            'priority' => $request->priority,
            'due_date' => $request->due_date,
        ]);
    
        Log::info('Task Updated:', $task->toArray());
        return redirect()->route('dashboard')->with('success', 'Task updated successfully.');
    }
    public function tes(Request $request)
    {
        $priority = $request->input('priority');
        $task_name = $request->input('task_name');
        $description = $request->input('description');
        $due_date = $request->input('due_date');
        $status = $request->input('status');
        $created_at = Carbon::now();
        $updated_at = Carbon::now();    
        return view('tes', compact( 'task_name','priority', 'description', 'due_date', 'status', 'created_at', 'updated_at'));
    }
}