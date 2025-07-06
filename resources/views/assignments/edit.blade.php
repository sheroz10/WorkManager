@extends('layouts.app')

@section('content')
<div class="container py-4 d-flex justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-lg border-0">
            <div class="card-body p-5">
                <h2 class="mb-4 fw-bold text-center">Edit Assignment</h2>
                <form action="{{ route('assignments.update', $assignment) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" name="title" class="form-control" value="{{ $assignment->title }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea name="description" class="form-control">{{ $assignment->description }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="category_id" class="form-label">Category</label>
                        <select name="category_id" class="form-select" required>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ $assignment->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="deadline" class="form-label">Deadline</label>
                        <input type="datetime-local" name="deadline" class="form-control" value="{{ $assignment->deadline ? date('Y-m-d\TH:i', strtotime($assignment->deadline)) : '' }}">
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" name="is_done" class="form-check-input" id="is_done" {{ $assignment->is_done ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_done">Mark as Done</label>
                    </div>
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('assignments.index') }}" class="btn btn-secondary">Back</a>
                        <button type="submit" class="btn btn-success">Update Assignment</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection 