@extends('layouts.app')

@section('content')

<div class="page-header">
    <h1>New Task</h1>
    <a href="{{ route('tasks.index') }}" class="btn btn-secondary">Back</a>
</div>

<div class="card">
    <form method="POST" action="{{ route('tasks.store') }}">
        @csrf

        <div class="form-group">
            <label>Title</label>
            <input type="text" name="title" value="{{ old('title') }}"
                   class="{{ $errors->has('title') ? 'input-error' : '' }}">
            @error('title') <p class="error">{{ $message }}</p> @enderror
        </div>

        <div class="form-group">
            <label>Description (optional)</label>
            <textarea name="description" rows="3">{{ old('description') }}</textarea>
        </div>

        <div class="form-group">
        <label>Due Date (optional)</label>
        <input type="date" name="due_date" 
            value="{{ old('due_date') }}"
            min="{{ date('Y-m-d') }}">
        @error('due_date')
            <p class="error">You are not allowed to enter past days. Please enter a new date.</p>
        @enderror
        </div>

        <div class="form-group">
            <label>Status</label>
            <select name="status">
                <option value="pending"   {{ old('status') == 'pending'   ? 'selected' : '' }}>Pending</option>
                <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>Completed</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Create Task</button>
        <a href="{{ route('tasks.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>

@endsection