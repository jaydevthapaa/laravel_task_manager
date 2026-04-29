@extends('layouts.app')

@section('content')

<div class="page-header">
    <h1>My Tasks</h1>
    <a href="{{ route('tasks.create') }}" class="btn btn-primary">+ New Task</a>
</div>

<div class="card">
    @if($tasks->count())

        <table>
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Due Date</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tasks as $task)
                <tr>
                    <td>{{ $task->title }}</td>
                    <td>{{ $task->description ?? '—' }}</td>
                    <td>{{ $task->due_date ?? '—' }}</td>
                    <td>
                        <span class="badge badge-{{ $task->status }}">
                            {{ ucfirst($task->status) }}
                        </span>
                    </td>
                    <td>
                        <div class="actions">

                            <form method="POST" action="{{ route('tasks.toggle', $task) }}">
                                @csrf @method('PATCH')
                                <button class="btn btn-success">Toggle</button>
                            </form>

                            <a href="{{ route('tasks.edit', $task) }}" class="btn btn-warning">
                                Edit
                            </a>

                            <form method="POST" action="{{ route('tasks.destroy', $task) }}"
                                  onsubmit="return confirm('Are you sure?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-danger">Delete</button>
                            </form>

                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div style="margin-top:20px">{{ $tasks->links() }}</div>

    @else
        <div class="empty-state">
            <p>You have no tasks yet.</p>
            <a href="{{ route('tasks.create') }}">Create your first task</a>
        </div>
    @endif
</div>

@endsection
