@extends('layouts')

@section('content')
<div class="container mt-4">
    <h3>Tasks</h3>
    <a href="{{ route('tasks.create') }}" class="btn btn-success mb-3">+ Add New Task</a>

    <table class="table table-bordered table-hover">
        <thead class="table-light">
            <tr>
                <th>Title</th>
                <th>Project</th>
                <th>Lead</th>
                <th>Deal</th>
                <th>Contact</th>
                <th>Assigned To</th>
                <th>Due Date</th>
                <th>Status</th>
                <th>Priority</th>
                <th>Created By</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tasks as $task)
            <tr>
                <td>
                    {{ $task->title }}
                    @if($task->description)
                        <br><small class="text-muted">{{ Str::limit($task->description, 40) }}</small>
                    @endif
                </td>
                <td>{{ $task->project?->project_name ?? '-' }}</td>
                <td>{{ $task->lead?->name ?? '-' }}</td>
                <td>{{ $task->deal?->deal_name ?? '-' }}</td>
                <td>{{ $task->contact?->name ?? '-' }}</td>
                <td>{{ $task->assignee?->name ?? '-' }}</td>
                <td>{{ $task->due_date ? \Carbon\Carbon::parse($task->due_date)->format('Y-m-d') : '-' }}</td>
                <td><span class="badge bg-info text-dark">{{ ucfirst($task->status) }}</span></td>
                <td>
                    <span class="badge bg-{{ $task->priority === 'high' ? 'danger' : ($task->priority === 'low' ? 'secondary' : 'warning') }}">
                        {{ ucfirst($task->priority) }}
                    </span>
                </td>
                <td>{{ $task->creator?->name ?? '-' }}</td>
                <td>
                    <a href="{{ route('tasks.edit', $task) }}" class="btn btn-sm btn-primary">Edit</a>
                    <form action="{{ route('tasks.destroy', $task) }}" method="POST" class="d-inline"
                          onsubmit="return confirm('Are you sure you want to delete this task?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

</div>
@endsection
