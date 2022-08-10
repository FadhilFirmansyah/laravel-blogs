@extends('layout.main')

@section('container')

<div class="row justify-content-center">
    <div class="col-lg-4">
        <main class="form-signin w-100 m-auto">

          @if (session()->has("registered"))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
              {{ session("registered") }}
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
          @endif

          @if (session()->has("login-error"))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
              {{ session("login-error") }}
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
          @endif
            
            <h1 class="h3 mb-3 fw-normal text-center">Please Login</h1>
        
            <form action="/login" method="post">
              @csrf
              <div class="form-floating">
                <input type="email" name="email" class="form-control @error("email") is-invalid @enderror" id="email" placeholder="name@example.com" value="{{ old("email") }}" required autofocus>
                <label for="email">Email address</label>
                @error('email')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                @enderror
              </div>
              <div class="form-floating">
                <input type="password" name="password" class="form-control" id="password" placeholder="Password" required>
                <label for="password">Password</label>
              </div>
              <button class="w-100 btn btn-lg btn-primary mt-3" type="submit">Login</button>
            </form>
            <small class="d-block text-end mt-3">
              Doesn't have account yet? <a href="/register">create right now!</a>
            </small>
        </main>
    </div>
</div>

@endsection