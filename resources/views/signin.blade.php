<!DOCTYPE html>
<html lang="en">
<head>
    <title>Sign In</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
    <h2>Sign In</h2>
    @if(count($errors->all())>0)
        @foreach ($errors->all() as $error)
            <div class="alert alert-danger margiv-top-10">
                <button class="close" data-close="alert"></button>
                <span> {{ $error }} </span>
            </div>
        @endforeach
    @endif
    @if(Session::has('success'))
        <div class="alert alert-success margiv-top-10">
            <button class="close" data-close="alert"></button>
            <span> {!! Session::get('success') !!} </span>
        </div>
    @endif
    @if(Session::has('error'))
        <div class="alert alert-success margiv-top-10">
            <button class="close" data-close="alert"></button>
            <span> {!! Session::get('error') !!} </span>
        </div>
    @endif

    <form action="{{route('userauthenticate')}}" method="post">
        {{csrf_field()}}
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" placeholder="Enter email" name="email">
        </div>
        <div class="form-group">
            <label for="pwd">Password:</label>
            <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="password">
        </div>
        <button type="submit" class="btn btn-default">Submit</button>
    </form>
</div>

</body>
</html>
