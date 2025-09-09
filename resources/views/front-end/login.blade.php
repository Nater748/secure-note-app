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
    </header>

    @if(session('error'))
    <div class="alert-danger">
        {{ session('error') }}
    </div>
    @endif
    @if(session('success'))
    <div class="alert-success">
        {{ session('success') }}
    </div>
    @endif

    <main class="main">
          <form action="{{route('login')}}" method="POST" class="form-box">
            @csrf
            <h2 class="form-title">Log in to NoteIt</h2>
            
            <div class="field">
              <label>
                <input type="text" name="email" placeholder=" enter your email" class="input" value="{{ old('email', Auth::check() ? Auth::user()->email : '') }}" />
              </label>
            </div>

            <div class="field">
              <label>
                <input type="password" name="password" placeholder="Password" class="input" />
              </label>
            </div>

            <div class="check">
              <input type="checkbox" name="remember" class="checkbox" />
              <p class="text">Remember Me</p>
            </div>

            <div class="actions">
              <button type="submit" class="btn-full">Log in</button>
            </div>

            <a href="{{url('/')}}" class="note">Don't have an account? Sign up</a>
          </form>
        </main>
</body>
</html>