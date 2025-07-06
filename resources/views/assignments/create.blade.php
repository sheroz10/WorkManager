@extends('layouts.app')

@section('content')
<div class="container py-4 d-flex justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-lg border-0">
            <div class="card-body p-5">
                <h2 class="mb-4 fw-bold text-center">Add New Assignment</h2>
                <form action="{{ route('assignments.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" name="title" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea name="description" class="form-control"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="category_id" class="form-label">Category</label>
                        <select name="category_id" class="form-select" required>
                            <option value="">Select Category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="deadline" class="form-label">Deadline</label>
                        <input type="datetime-local" name="deadline" class="form-control">
                    </div>
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('assignments.index') }}" class="btn btn-secondary">Back</a>
                        <button type="submit" class="btn btn-success">Create Assignment</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection 