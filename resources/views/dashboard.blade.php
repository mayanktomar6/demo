<!DOCTYPE html>
<html lang="en">
<head>
    <title>Dashboard</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
 <style>
     .border
     {
         border:1px solid black;
     }

     .mb
     {
         margin-bottom: 10px;
     }
     a
     {
         float: right;
     }
 </style>
</head>
<body>

<div class="container">
    <div class="row">
        <div class="col-lg-6"><h2>Dashboard</h2></div>
        <div class="col-lg-6"><a href="{{route("signout")}}">SignOut</a></div>

    </div>
    <div class="row">
        @if(count($errors->all())>0)
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger margiv-top-10">
                    <button class="close" data-close="alert"></button>
                    <span> {{ $error }} </span>
                </div>
            @endforeach
        @endif
    </div>
    <div class="row mb">
        <form class="form-inline" action="{{route('dashboard')}}">
            <div class="form-group">
                <label for="email">Date</label>
                <input type="text" class="form-control" placeholder="mm/dd/yyyy" id="date" name="date">
            </div>
            <button type="submit" class="btn btn-default">Submit</button>
        </form>
    </div>
    <div class="row border">
        <div class="col-lg-6"><strong>USER NAME</strong></div>
        <div class="col-lg-6"><storng>COUNTS</storng></div>
    </div>
    <?php $total_count = 0; ?>
    @foreach($user_info as $user_info_val)
    <div class="row border">
        <div class="col-lg-6">{{ $user_info_val->name }}</div>
        <div class="col-lg-6">{{ $user_info_val->user_count }}</div>
    </div>
    <?php $total_count = $total_count+ $user_info_val->user_count; ?>
    @endforeach
    <div class="row border">
        <div class="col-lg-6"><strong>TOTAL COUNT</strong></div>
        <div class="col-lg-6"><storng>{{ $total_count  }}</storng></div>
    </div>
</div>

</body>
</html>
