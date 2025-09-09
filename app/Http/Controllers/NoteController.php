<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Note;
use App\Models\Trash;
use Illuminate\Support\Facades\Auth;

class NoteController extends Controller
{

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'importance' => 'required|in:high,medium,low',
        ]);

        Note::create([
            'title'     => $request->title,
            'body'      => $request->body,
            'importance'=> $request->importance,
            'users_id'  => Auth::id(),
        ]);

        return redirect('/home')->with('success', 'Note created successfully!');
    }
    public function home()
    {
        $notes = Note::where('users_id', Auth::id())
                ->latest()
                ->take(3)
                ->get();

        return view('front-end.home', compact('notes'));
    }

    public function getNote()
    {
        $notes = Note::where('users_id', Auth::id())
                ->latest()
                ->simplepaginate(5);

        return view('front-end.note', compact('notes'));
    }
    public function show($id)
    {
        $note = Note::where('id', $id)->where('users_id', Auth::id())->firstOrFail();
        return view('front-end.view', compact('note'));
    }
    public function edit($id)
    {
        $note = Note::where('id', $id)->where('users_id', Auth::id())->firstOrFail();
        return view('front-end.edit', compact('note'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'importance' => 'required|in:high,medium,low',
        ]);

        $note = Note::where('users_id', Auth::id())->findOrFail($id);

        $note->update([
            'title' => $request->title,
            'body' => $request->body,
            'importance' => $request->importance,
        ]);

        return redirect()->route('home')->with('success', 'Note updated successfully!');
    }
    public function destroy($id)
    {
        $note = Note::where('users_id', Auth::id())->findOrFail($id);

        Trash::create([
            'users_id' => $note->users_id,
            'title' => $note->title,
            'body' => $note->body,
            'importance' => $note->importance,
            'deleted_at' => now(),
        ]);

        $note->delete();

        return redirect()->back()->with('success', 'Note moved to trash successfully!');
    }
    public function deleteAll()
    {
    foreach (Note::where('users_id', Auth::id())->get() as $note) {
        Trash::create($note->toArray() + ['deleted_at' => now()]);
    }

    Note::where('users_id', Auth::id())->delete();

    return back()->with('success', 'All notes moved to trash successfully!');
    }
    
    public function search(Request $request)
    {
    $query = Note::where('users_id', Auth::id());

    if ($request->filled('q')) {
        $search = $request->q;
        $query->where(function($q) use ($search) {
            $q->where('title', 'LIKE', "%{$search}%")
              ->orWhere('body',  'LIKE', "%{$search}%");
        });
    }

    $notes = $query->latest()->simplepaginate(5);

    return view('front-end.note', compact('notes'));
    }
}
