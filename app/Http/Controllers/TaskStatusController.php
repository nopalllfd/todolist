<?php
namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskStatusController extends Controller
{
    public function markAsDone($id)
    {
        $task = Task::findOrFail($id);
        $task->status = 'done';
        $task->save();

        return redirect()->route('dashboard')->with('success', 'Task marked as done.');
    }
}