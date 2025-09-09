<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <title>NoteIt</title>
</head>
<body>
    <header class="header">
        <div class="logo">
            <h2 class="title">NoteIt</h2>
        </div>
        <div class="nav">
            <a href="{{url('/home')}}">Home</a>
            <a href="{{ route('notes.index') }}">Notes</a>
            <a href="{{ route('notes.trash') }}">Trash</a>
        </div>
        <div class="search-profile">
            <div class="search-box">
                <form method="GET" action="{{ route('trash.search') }}">
                    <input type="text" name="q" placeholder="Search" value="{{ request('q') }}">
                </form>
            </div>
            <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                @csrf
                <button type="submit" class="btn-link">Log-out</button>
            </form>   
        </div>
    </header>

    @if(session('success'))
    <div class=" alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <main class="main-content">
        <h1 class="page-title">Deleted Notes</h1>
        @foreach($trashedNotes as $note)
        <div class="note-item">
            <div class="note-info">
                <div class="note-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 256 256">
                        <path d="M88,96a8,8,0,0,1,8-8h64a8,8,0,0,1,0,16H96A8,8,0,0,1,88,96Zm8,40h64a8,8,0,0,0,0-16H96a8,8,0,0,0,0,16Zm32,16H96a8,8,0,0,0,0,16h32a8,8,0,0,0,0-16ZM224,48V156.69A15.86,15.86,0,0,1,219.31,168L168,219.31A15.86,15.86,0,0,1,156.69,224H48a16,16,0,0,1-16-16V48A16,16,0,0,1,48,32H208A16,16,0,0,1,224,48Z"></path>
                    </svg>
                </div>
                <div>
                    <a href="{{ route('trash.show', $note->id) }}" class="note-details">
                        <p class="note-title">{{$note->title}}</p>
                    </a>
                    <p class="note-date">{{$note->deleted_at}}</p>
                    <p class="note-date">{{ Str::words($note->body, 20) }}...</p>
                </div>
            </div>
            <div class="btn-group">
                <form action="{{ route('trash.restore', $note->id) }}" method="POST" style="display:inline">
                    @csrf
                    <button type="submit" class="btn-restore">Restore</button>
                </form>

                <form action="{{ route('trash.destroy', $note->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-link delete">Delete</button>
                </form>
            </div>
        </div>
        @endforeach

        <div class="pagination">
            {{ $trashedNotes->links() }}
        </div>

        <div class="trash-actions">
            <form action="{{ route('trash.restoreAll') }}" method="POST" style="display:inline;">
                @csrf
                <button type="submit" class="btn-align">Restore All</button>
            </form>

            <form action="{{ route('trash.empty') }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-empty">Empty Trash</button>
            </form>
        </div>
    </main>
</body>
</html>