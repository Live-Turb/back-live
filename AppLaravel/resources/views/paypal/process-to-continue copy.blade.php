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

    <style>
        :root {
            --primary-color: #a7a7a7;
            --neavy-blue-color: #080e35;
            --blue-color: #312df4;
            --light-blue-color: #0054d3;
            --light-color: #ffffff;
            --gray-color: #ffffff80;
            --hex-color: #0a1369;
            --dark-gray-color: #1e1e1e;
            --dark-neavy-blue-color: #0d0c22;
            --light-sky-blue-color: #c5c3d0;
            --green-color: #4ee48a;
            --sky-blue-clor: #0d397f;
        }

        .proceed-to-continue-page .boxes li {
            color: var(--light-color);
        }

        .proceed-to-continue-page .boxes li::before {
            content: "✓";
            margin-right: 15px;
            color: var(--green-color) !important;
            font-size: 18px;
            font-weight: bold;
        }

        .proceed-to-continue-page .boxes .hr {
            background-color: var(--gray-color);
            height: 2px;
        }

/* HTML: <div class="loader"></div> */
.loader {
  width: 50px;
  --b: 8px; 
  aspect-ratio: 1;
  border-radius: 50%;
  padding: 1px;
  background: conic-gradient(#0000 10%,#f03355) content-box;
  -webkit-mask:
    repeating-conic-gradient(#0000 0deg,#000 1deg 20deg,#0000 21deg 36deg),
    radial-gradient(farthest-side,#0000 calc(100% - var(--b) - 1px),#000 calc(100% - var(--b)));
  -webkit-mask-composite: destination-in;
          mask-composite: intersect;
  animation:l4 1s infinite steps(10);
}
@keyframes l4 {to{transform: rotate(1turn)}}



    </style>
    <title>Process to continue</title>
</head>

<body>
    <div id="myloader" class='myloader d-none' style="    width: 100%;
    min-height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;">
    <div class="loader"></div>
    </div>
    <div class="container proceed-to-continue-page mt-5   text-center" >


        <div class="row  mt-5 boxes">

            
            @if (isset($plan_type))
            
                @if ($plan_type == 'Basic')
                    <div class="col-12 col-lg-4 mx-auto">

                        {{-- Card start --}}
                        <div class="card p-2" style="background-color: #080e35;border-radius:10px;">

                            <!-- Nested row start -->
                            <div class="row box-header">


                                <div class="col-3 ">
                                    <img src="{{ asset('storage/landingpage/basic.png') }}"
                                        class="card-img-top img-fluid images" style="height: 5rem">
                                </div>
                                <div class="col-4 text-light">
                                    <h5 class="box-title">Basic</h5>
                                    <span class="dollar">$</span>
                                    <b>24</b>
                                    /
                                    <span class="dollar">year</span>
                                </div>

                                <div class="col-5 text-end text-light">
                                    <button class="btn popular-btn mt-0 rounded-pill py-0 bg-primary">Popular</button>
                                </div>

                            </div>
                            <!-- Nested row end-->

                            <div class="card-body px-0 text-whit">
                                <ul class="px-5 py-0">
                                    <li class="list-unstyled mt-0">Access to ultra-definition content.</li>
                                    <li class="list-unstyled mt-4">Stream on 2 Screens simultaneously</li>
                                    <li class="list-unstyled mt-4">Offline downloads for select content</li>
                                </ul>
                                <form action="{{ route('processTransaction') }}" method="post" id="mypaypalformm">
                                    @csrf
                                    {{-- <label for="">Enter amount:</label> --}}
                                    {{-- @if (isset($amount)) {{$amount}} @endif --}}
                                    <input type="hidden" name="amount"
                                        @if (isset($amount)) value="{{ $amount }}" @endif
                                        class="form-control  mt-2">
                                    <button type="submit" class="btn btn-primary mt-3">Proceed to continue</button>
                                    <a href="{{ route('cancelTransaction') }}" class="btn btn-warning mt-3">Cancel</a>
                                </form>
                            </div>





                        </div>
                        {{-- Card end --}}
                    </div>
                    {{-- col end --}}
                @endif
                @if ($plan_type == 'Standard')
                    <div class="col-12 col-lg-4 mx-auto">

                        {{-- Card start --}}
                        <div class="card p-2" style="background-color: #080e35;border-radius:10px;">

                            <!-- Nested row start -->
                            <div class="row box-header">


                                <div class="col-3 ">
                                    <img src="{{ asset('storage/landingpage/standard.png') }}"
                                        class="card-img-top img-fluid images" style="height: 5rem">
                                </div>
                                <div class="col-4 text-light">
                                    <h5 class="box-title">Standard</h5>
                                    <span class="dollar">$</span>
                                    <b>46</b>
                                    /
                                    <span class="dollar">year</span>
                                </div>

                                <div class="col-5 text-end text-light">
                                    <button class="btn popular-btn mt-0 rounded-pill py-0 bg-primary">Popular</button>
                                </div>

                            </div>
                            <!-- Nested row end-->

                            <div class="card-body px-0 text-whit">
                                <ul class="px-5 py-0">
                                    <li class="list-unstyled mt-0">Access to ultra-definition content.</li>
                                    <li class="list-unstyled mt-4">Stream on 2 Screens simultaneously</li>
                                    <li class="list-unstyled mt-4">Offline downloads for select content</li>
                                </ul>
                                <form action="{{ route('processTransaction') }}" method="post" id="mypaypalformm">
                                    @csrf
                                    {{-- <label for="">Enter amount:</label> --}}
                                    {{-- @if (isset($amount)) {{$amount}} @endif --}}
                                    <input type="hidden" name="amount"
                                        @if (isset($amount)) value="{{ $amount }}" @endif
                                        class="form-control  mt-2">
                                    <button type="submit" class="btn btn-primary mt-3">Proceed to continue</button>
                                    <a href="{{ route('cancelTransaction') }}" class="btn btn-warning mt-3">Cancel</a>
                                </form>
                            </div>





                        </div>
                        {{-- Card end --}}
                    </div>
                    {{-- col end --}}
                @endif


                @if ($plan_type == 'Premium')
                    <div class="col-12 col-lg-4 mx-auto">

                        {{-- Card start --}}
                        <div class="card p-2" style="background-color: #080e35;border-radius:10px;">

                            <!-- Nested row start -->
                            <div class="row box-header">


                                <div class="col-3 ">
                                    <img src="{{ asset('storage/landingpage/premium.png') }}"
                                        class="card-img-top img-fluid images" style="height: 5rem">
                                </div>
                                <div class="col-4 text-light">
                                    <h5 class="box-title">Premium</h5>
                                    <span class="dollar">$</span>
                                    <b>60</b>
                                    /
                                    <span class="dollar">year</span>
                                </div>

                                <div class="col-5 text-end text-light">
                                    <button class="btn popular-btn mt-0 rounded-pill py-0 bg-primary">Popular</button>
                                </div>

                            </div>
                            <!-- Nested row end-->

                            <div class="card-body px-0 text-whit">
                                <ul class="px-5 py-0">
                                    <li class="list-unstyled mt-0">Access to ultra-definition content.</li>
                                    <li class="list-unstyled mt-4">Stream on 3 screen simultaneously</li>
                                    <li class="list-unstyled mt-4">Offline downloads for select content</li>
                                </ul>
                                <form action="{{ route('processTransaction') }}" method="post" id="mypaypalformm">
                                    @csrf
                                    {{-- <label for="">Enter amount:</label> --}}
                                    {{-- @if (isset($amount)) {{$amount}} @endif --}}
                                    <input type="hidden" name="amount"
                                        @if (isset($amount)) value="{{ $amount }}" @endif
                                        class="form-control  mt-2">
                                    <button type="submit" class="btn btn-primary mt-3">Proceed to continue</button>
                                    <a href="{{ route('cancelTransaction') }}" class="btn btn-warning mt-3">Cancel</a>
                                </form>
                            </div>





                        </div>
                        {{-- Card end --}}
                    </div>
                    {{-- col end --}}
                @endif



            @endif
        </div>
        {{-- Row end --}}
    </div>
    {{-- Container end --}}


    <script src="https://www.paypal.com/sdk/js?client-id=env('PAYPAL_SANDBOX_CLIENT_ID')"></script>


    {{-- Script for paypal loader --}}
<script>
let myloader=document.getElementById("myloader");
let mypaypalform=document.getElementById("mypaypalformm");

mypaypalform.addEventListener("submit",function(event){
event.preventDefault();
myloader.classList.remove("d-none");
mypaypalform.submit();
});
</script>


</body>

</html>