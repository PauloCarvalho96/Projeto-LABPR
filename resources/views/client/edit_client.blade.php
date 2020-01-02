<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('css/app.css')}}"> {{-- <- your css --}}
    <title>@yield('title','Edit Profile')</title>
</head>
<body>
    @include('inc.navbar_client')
    <main class="container mt-4">
        <h3 class="text-center">Edit Profile</h3>
            <form action="" method="post">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" name="name" id="title" class="form-control"  placeholder="Enter the name">
                </div>
                <div class="form-group">
                    <label for="email">email</label>
                    <input type="text" name="email" id="title" class="form-control"  placeholder="Enter email">
                </div>
                <div class="form-group">
                    <label for="password">password</label>
                    <input type="password" name="password" id="title" class="form-control"  placeholder="Enter password">
                </div>
                <div class="form-group">
                    <label for="confirm_password">confirm password</label>
                    <input type="password" name="confirm_password" id="title" class="form-control"  placeholder="Enter password confirm">
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
    </main>
    
    
    @include('inc.footer')
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="{{asset('js/app.js')}}"></script> {{-- your js --}}
</body>
</html>
