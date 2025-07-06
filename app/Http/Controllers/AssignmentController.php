<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Models\Assignment;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AssignmentController extends Controller
{
    use AuthorizesRequests;

    public function index(Request $request)
    {
        $query = Assignment::where('user_id', Auth::id());

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%$search%")
                  ->orWhere('description', 'like', "%$search%");
            });
        }

        if ($request->filled('category')) {
            $query->where('category_id', $request->input('category'));
        }

        $assignments = $query->latest()->get();

        // Find assignments due in the next 30 minutes
        $now = now();
        $in30 = $now->copy()->addMinutes(30);
        $upcoming = Assignment::where('user_id', Auth::id())
            ->where('is_done', false)
            ->where('deadline', '>', $now)
            ->where('deadline', '<=', $in30)
            ->get();

        return view('assignments.index', compact('assignments', 'upcoming'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('assignments.create', compact('categories'));
    }

    public function edit(Assignment $assignment)
    {
        $this->authorize('update', $assignment);
        $categories = Category::all();
        return view('assignments.edit', compact('assignment', 'categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'category_id' => 'required|exists:categories,id',
            'deadline' => 'nullable|date',
        ]);

        Assignment::create([
            'title' => $request->title,
            'description' => $request->description,
            'deadline' => $request->deadline,
            'category_id' => $request->category_id,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('assignments.index')->with('success', 'Assignment created!');
    }

    public function update(Request $request, Assignment $assignment)
    {
        $this->authorize('update', $assignment);
    
        $assignment->update([
            'title' => $request->title,
            'description' => $request->description,
            'deadline' => $request->deadline,
            'category_id' => $request->category_id,
            'is_done' => $request->has('is_done'),
        ]);
    
        return redirect()->route('assignments.index')->with('success', 'Assignment updated!');
    }

    public function destroy(Assignment $assignment)
    {
        $this->authorize('delete', $assignment); // optional policy
        $assignment->delete();
        return redirect()->route('assignments.index')->with('success', 'Deleted!');
    }
    
}
