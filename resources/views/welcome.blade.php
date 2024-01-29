<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>SILACUT</title>
    <!-- MDB icon -->
    <link rel="icon" href="{{ asset('/img/brand/favicon.png') }}" type="image/png">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <!-- Google Fonts Roboto -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" />
    <!-- MDB -->
    <link rel="stylesheet" href="{{ asset('') }}login_res/css/mdb.min.css" />

    <style>
        body,
        html {
            height: 100%;
            margin: 0;
        }

        .divider:after,
        .divider:before {
            content: "";
            flex: 1;
            height: 1px;
            background: #eee;
        }

        .h-custom {
            height: calc(100% - 73px);
        }

        @media (max-width: 450px) {
            .h-custom {
                height: 100%;
            }
        }

        .bg {
            /* The image used */
            background-image: url("{{ asset('/login_res/img/bg.jpeg') }}");

            /* Full height */
            height: 100%;

            /* Center and scale the image nicely */
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }
    </style>
</head>

<body>

    <div class="bg">
        <!-- Start your project here-->
        <section class="vh-100">
            <div class="container py-5 h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col col-xl-10">
                        <div class="card" style="border-radius: 1rem;">
                            <div class="row g-0">
                                <div class="col-md-6 col-lg-5 d-none d-md-block">
                                    <img src="{{ asset('login_res/img/img1.webp') }}"
                                        alt="login form" class="img-fluid" style="border-radius: 1rem 0 0 1rem;" />
                                </div>
                                <div class="col-md-6 col-lg-7 d-flex align-items-center">
                                    <div class="card-body p-4 p-lg-5 text-black text-center">

                                        <form role="form" action="{{ route('login') }}" method="POST">
                                            {{ csrf_field() }}
                                            <img src="{{ asset('login_res/img/si_rek.png') }}" alt="Image"
                                                width="400px" class="img-fluid">
                                            <div class="d-flex flex-row align-items-center justify-content-center justify-content-lg-start"
                                                style="margin-bottom: -30px;">
                                                <p class="mb-4 text-dark" style="text-align: justify"><br>SILACUT
                                                    adalah sebuah
                                                    aplikasi berbasis website untuk
                                                    melakukan pengajuan cuti untuk pegawai negeri sipil di lingkungan
                                                    Pemerintahan
                                                    Kabupaten Morowali.</p>
                                            </div>

                                            <div class="divider d-flex align-items-center my-4">
                                            </div>

                                            <!-- Email input -->
                                            <div class="form-outline mb-4">
                                                <input type="text" id="form3Example3"name="username" id="username"
                                                    class="form-control form-control-lg" placeholder="" />
                                                <label class="form-label" for="form3Example3">Username</label>
                                            </div>

                                            <!-- Password input -->
                                            <div class="form-outline mb-3">
                                                <input type="password" id="form3Example4" name="password" id="password"
                                                    class="form-control form-control-lg" placeholder="" />
                                                <label class="form-label" for="form3Example4">Password</label>
                                            </div>


                                            <div class="text-center text-lg-center mt-4 pt-2">
                                                <button type="submit" class="btn btn-primary btn-lg"
                                                    style="padding-left: 2.5rem; padding-right: 2.5rem; width: 100%;">Masuk</button>
                                            </div>
                                            <br>
                                            <a href="http://bkpsdmd.morowalikab.go.id" class="small text-muted"
                                                target="_blank"> BKPSDMD
                                                <b>@</b>
                                                Kabupaten Morowali &mdash; 2022</a>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <!-- End your project here-->
    <!-- MDB -->
    <script type="text/javascript" src="{{ asset('') }}login_res/js/mdb.min.js"></script>
    <!-- Custom scripts -->
    <script type="text/javascript"></script>
</body>

</html>
