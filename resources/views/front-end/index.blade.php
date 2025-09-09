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
    @if ($errors->any())
      <div class="alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
      </div>
    @endif
    <main class="main">
        <form class="form-box" method="post" action="{{ route('register') }}">
            @csrf
          <h2 class="form-title">Create your account</h2>

          <div class="field">
            <label>
              <input type="text" name="email" placeholder="Email" class="input" />
            </label>
          </div>

          <div class="field">
            <label>
              <input type="password" name="password" placeholder="Password" class="input" />
            </label>
          </div>

          <div class="field">
            <label>
              <input type="text" name="name" placeholder="Name" class="input" />
            </label>
          </div>

          <div class="actions">
            <button type="submit" class="btn-full">Sign Up</button>
          </div>

          <a href="{{url('/login')}}" class="note">Already have an account? Sign in</a>
        </form>
    </main>
</body>
</html>