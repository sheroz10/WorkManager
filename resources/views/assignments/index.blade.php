@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="fw-bold">Your Assignments</h1>
        <a href="{{ route('assignments.create') }}" class="btn btn-success btn-lg">+ Add Assignment</a>
    </div>
    @if($upcoming->count())
        <div class="alert alert-warning d-flex align-items-center" role="alert">
            <div>
                <strong>Upcoming Tasks (within 30 minutes):</strong>
                <ul class="mb-0">
                    @foreach($upcoming as $task)
                        <li>
                            <strong>{{ $task->title }}</strong> &mdash; Due at {{ \Carbon\Carbon::parse($task->deadline)->format('H:i, M d') }}
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif
    <!-- Search and Filter Form -->
    <form method="GET" action="{{ route('assignments.index') }}" class="row g-3 mb-4 align-items-end">
        <div class="col-md-5">
            <label for="search" class="form-label">Search by Task Name or Description</label>
            <input type="text" name="search" id="search" class="form-control" placeholder="Enter keyword..." value="{{ request('search') }}">
        </div>
        <div class="col-md-4">
            <label for="category" class="form-label">Filter by Category</label>
            <select name="category" id="category" class="form-select">
                <option value="">All Categories</option>
                @foreach(App\Models\Category::all() as $cat)
                    <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-3 d-grid">
            <button type="submit" class="btn btn-primary">Search & Filter</button>
        </div>
    </form>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Category</th>
                        <th>Deadline</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($assignments as $assignment)
                        <tr>
                            <td class="fw-semibold">{{ $assignment->title }}</td>
                            <td>{{ $assignment->description }}</td>
                            <td><span class="badge bg-primary">{{ $assignment->category->name ?? '-' }}</span></td>
                            <td>{{ $assignment->deadline }}</td>
                            <td>
                                @if($assignment->is_done)
                                    <span class="badge bg-success">Done</span>
                                @else
                                    <span class="badge bg-warning text-dark">Pending</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('assignments.edit', $assignment) }}" class="btn btn-sm btn-outline-warning me-1">Edit</a>
                                <form action="{{ route('assignments.destroy', $assignment) }}" method="POST" style="display:inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete this assignment?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="text-center text-muted">No assignments found.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection 