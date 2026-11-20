<!doctype html><html lang="id">
    <head><meta charset="utf-8">
<meta name="viewport"
 content="width=device-width, 
initial-scale=1">
<title>Login Aplikasi Parkir</title><link
 href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
  rel="stylesheet"></head>
<body style="background-color: #613918;">
    <div class="container">
    <div class="row justify-content-center align-items-center" 
style="min-height:100vh">
    <div class="col-md-4">
    <div class="card shadow-sm">
    <div class="card-body p-4">
    <h4 class="text-center mb-4">Aplikasi Parkir</h4>
@if(session('error'))
<div class="alert alert-danger">
    {{ session('error') }}

</div>@endif @if($errors->any())
<div class="alert alert-danger">
    {{ $errors->first() }}
</div>
@endif
<form method=
"POST" action="
{{ route('login.post') }}">
    @csrf
<div class="mb-3">
<label class="form-label">Username</label>
<input name="username"
 class="form-control"
 value="{{ old('username') }}"
 required autofocus>
</div>
<div class="mb-3">
<label class="form-label">
Password</label><input
 type="password"
 name="password" 
class="form-control" required>
</div>
<button class="btn btn-primary w-100">Login</button>
</form>
</div></div>
</div>
</div>
</div>
</body>
</html>
