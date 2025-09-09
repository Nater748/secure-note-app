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

    <form action="{{ route('note.store') }}" method="post" class="note-form">
        @csrf
        <div class="heading">
            <p class="page-title">Create New Note</p>
        </div>

        <div class="input-group">
            <label>
                <input type="text" name="title" placeholder="Note Title" class="input" />
            </label>
        </div>

        <div class="input-group">
            <label>
                <textarea name="body" placeholder="Write your note here..." class="textarea"></textarea>
            </label>
        </div>

        <div class="color-picker">
            <input type="radio" name="importance" id="color1" value="high" hidden>
            <label for="color1" class="color-circle" style="background-color: tomato;"></label>

            <input type="radio" name="importance" id="color2" value="medium" hidden>
            <label for="color2" class="color-circle" style="background-color: lightsalmon;"></label>

            <input type="radio" name="importance" id="color3" value="low" hidden checked>
            <label for="color3" class="color-circle" style="background-color: lightyellow;"></label>
        </div>

        <div class="actions">
            <button type="submit" class="btn">Save Note</button>
        </div>
    </form>

    <div class="notes-wrapper">
        <h2 class="sub-title">Your Notes</h2>

        <div class="table-container">
            <table class="table">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Importance</th>
                        <th>Creation Time</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($notes as $note)
                    <tr>
                        <td> <a href="{{ route('notes.show', $note->id) }}" class="rot">{{$note->title}}</a></td>
                        <td>{{$note->importance}}</td>
                        <td>{{$note->created_at}}</td>
                        <td>
                            <a href="{{ route('note.edit', $note->id) }}" class="btn-link edit">Edit</a>
                            <form action="{{ route('note.destroy', $note->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-link delete">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</body>