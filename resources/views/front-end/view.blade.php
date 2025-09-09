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

    <div class="set">
        <h4>{{$note->title}}</h4>

        <div class="color-picker">
            <input type="radio" name="importance" id="color1" value="high" {{ $note->importance == 'high' ? 'checked' : '' }} hidden>
            <label for="color1" class="color-circle" style="background-color: tomato;"></label>

            <input type="radio" name="importance" id="color2" value="medium" {{ $note->importance == 'medium' ? 'checked' : '' }} hidden>
            <label for="color2" class="color-circle" style="background-color: lightsalmon;"></label>

            <input type="radio" name="importance" id="color3" value="low" {{ $note->importance == 'low' ? 'checked' : '' }}  hidden>
            <label for="color3" class="color-circle" style="background-color: lightyellow;"></label>
        </div>
        <br><br>
        <p>{{$note->body}}</p>
    </div>
</body>
</html>