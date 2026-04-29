<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    // GET /tasks - show all tasks
    public function index()
    {
        $tasks = Auth::user()->tasks()->latest()->paginate(10);
        return view('tasks.index', compact('tasks'));
    }

    // GET /tasks/create - show create form
    public function create()
    {
        return view('tasks.create');
    }

    // POST /tasks - save new task
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'       => 'required|max:255',
            'description' => 'nullable',
            'due_date'    => 'nullable|date|after_or_equal:today',
            'status'      => 'required|in:pending,completed',
        ]);

        $validated['user_id'] = Auth::id();
        Task::create($validated);

        return redirect()->route('tasks.index')
                         ->with('success', 'Task created!');
    }

    // GET /tasks/{task}/edit - show edit form
    public function edit(Task $task)
    {
        abort_if($task->user_id !== Auth::id(), 403);
        return view('tasks.edit', compact('task'));
    }

    // PUT /tasks/{task} - update task
    public function update(Request $request, Task $task)
    {
        abort_if($task->user_id !== Auth::id(), 403);

        $validated = $request->validate([
            'title'       => 'required|max:255',
            'description' => 'nullable',
            'due_date'    => 'nullable|date|after_or_equal:today',
            'status'      => 'required|in:pending,completed',
        ]);

        $task->update($validated);

        return redirect()->route('tasks.index')
                         ->with('success', 'Task updated!');
    }

    // DELETE /tasks/{task} - delete task
    public function destroy(Task $task)
    {
        abort_if($task->user_id !== Auth::id(), 403);
        $task->delete();

        return redirect()->route('tasks.index')
                         ->with('success', 'Task deleted!');
    }

    // PATCH /tasks/{task}/toggle - switch status
    public function toggle(Task $task)
    {
        abort_if($task->user_id !== Auth::id(), 403);

        $task->update([
            'status' => $task->status === 'pending' ? 'completed' : 'pending'
        ]);

        return redirect()->route('tasks.index');
    }
}