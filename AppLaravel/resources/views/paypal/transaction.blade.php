<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Bootstrap cdn -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

    <title>Paypal index</title>
</head>
<body>

    <div class="container mt-5">
@if(Session::has('error'))
{{Session::get("error")}}
@endif
@if(Session::has('success'))
{{Session::get("success")}}
@endif

        <form action="{{route('processTransaction')}}" method="post">
            @csrf
            <label for="">Enter amount:</label>
            <input type="number" name="amount" class="form-control w-25 mt-2">
            <input type="submit" value="Pay With Paypal" class="btn btn-primary mt-3">
        </form>
    </div>






<script src="https://www.paypal.com/sdk/js?client-id=env('PAYPAL_SANDBOX_CLIENT_ID')"></script>





</body>
</html>