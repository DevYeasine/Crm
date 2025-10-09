@extends("layouts")

@section("content")
<div class="container mt-4">
    <h3>Projects</h3>
    <a href="{{ route('projects.create') }}" class="btn btn-success mb-3">+ Add New Project</a>

    <table class="table table-bordered table-hover">
        <thead class="table-light">
            <tr>
                <th>Project Name</th>
                <th>Client</th>
                <th>Deal</th>
                <th>Budget</th>
                <th>Actual Cost</th>
                <th>Status</th>
                <th>Progress</th>
                <th>Priority</th>
                <th>Manager</th>
                <th>Start</th>
                <th>End</th>
                <th>Created By</th>
            </tr>
        </thead>
        <tbody>
            @foreach($projects as $project)
            <tr>
                <td>
                    {{ $project->project_name }}
                    @if($project->description)
                        <br><small class="text-muted" title="{{ $project->description }}">
                            {{ Str::limit($project->description, 40) }}
                        </small>
                    @endif
                </td>
                <td>{{ $project->client?->name ?? '-' }}</td>
                <td>{{ $project->deal?->deal_name ?? '-' }}</td>
                <td>${{ number_format($project->budget ?? 0, 2) }}</td>
                <td>${{ number_format($project->actual_cost ?? 0, 2) }}</td>
                <td>
                    <span class="badge bg-info text-dark">{{ ucfirst($project->status) }}</span>
                </td>
                <td style="min-width: 140px;">
                    <div class="progress">
                        <div class="progress-bar bg-success" role="progressbar"
                             style="width: {{ $project->progress }}%;">
                            {{ $project->progress }}%
                        </div>
                    </div>
                </td>
                <td>
                    <span class="badge bg-{{ $project->priority === 'high' ? 'danger' : ($project->priority === 'low' ? 'secondary' : 'warning') }}">
                        {{ ucfirst($project->priority) }}
                    </span>
                </td>
                <td>{{ $project->manager?->name ?? '-' }}</td>
                <td>{{ $project->start_date?->format('Y-m-d') ?? '-' }}</td>
                <td>{{ $project->end_date?->format('Y-m-d') ?? '-' }}</td>
                <td>{{ $project->creator?->name ?? '-' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
