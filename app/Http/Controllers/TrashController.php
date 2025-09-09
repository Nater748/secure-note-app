<?php

namespace App\Http\Controllers;
use App\Models\Trash;
use Illuminate\Support\Facades\Auth;
use App\Models\Note;
use Illuminate\Http\Request;

class TrashController extends Controller
{
    public function index()
    {
        $trashedNotes = Trash::where('users_id', Auth::id())->simplepaginate(5);
        return view('front-end.trash', compact('trashedNotes'));
    }

    public function restore($id)
    {
    $trashedNote = Trash::where('id', $id)
        ->where('users_id', Auth::id())
        ->firstOrFail();

    Note::create([
        'users_id'   => $trashedNote->users_id,
        'title'      => $trashedNote->title,
        'body'       => $trashedNote->body,
        'importance' => $trashedNote->importance,
    ]);

    $trashedNote->delete();

    return redirect()->route('home')->with('success', 'Note restored successfully!');
    }

    public function destroy($id)
    {
    $trashedNote = Trash::where('id', $id)
        ->where('users_id', Auth::id())
        ->firstOrFail();

    $trashedNote->delete();

    return redirect()->route('home')->with('success', 'Note permanently deleted.');
    }

    public function show($id)
    {
        $trashedNote = Trash::where('id', $id)->where('users_id', Auth::id())->firstOrFail();
        return view('front-end.trash-view', compact('trashedNote'));
    }

    public function restoreAll()
    {
    $trashedNotes = Trash::where('users_id', Auth::id())->get();
    foreach ($trashedNotes as $trashedNote) {
        Note::create([
            'users_id'   => $trashedNote->users_id,
            'title'      => $trashedNote->title,
            'body'       => $trashedNote->body,
            'importance' => $trashedNote->importance,
        ]);
        $trashedNote->delete();
    }
    return redirect()->route('notes.index')->with('success', 'All notes restored successfully!');
    }

    public function emptyTrash()
    {
    Trash::where('users_id', Auth::id())->delete();
    return redirect()->route('notes.trash')->with('success', 'Trash emptied successfully!');
    }

    public function search(Request $request)
    {
    $query = Trash::where('users_id', Auth::id());

    if ($request->filled('q')) {
        $search = $request->q;
        $query->where(function($q) use ($search) {
            $q->where('title', 'LIKE', "%{$search}%")
              ->orWhere('body',  'LIKE', "%{$search}%");
        });
    }
    $trashedNotes = $query->orderBy('deleted_at', 'desc')->simplepaginate(5);
    return view('front-end.trash', compact('trashedNotes'));
    }
}
