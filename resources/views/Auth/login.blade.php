@include('Auth.components.header')
<!--================= Main Wrapper ==================-->
{{-- <div class="wrapper">

    <div class="login-form form-input-login">
        <form action="{{ route('tologin') }}" method="post">
            <div class="login-form-title">
                <h5 class="text-uppercase">selamat datang di aplikasi</h5>
                <h3 class="text-uppercase"><strong>sistem informasi hasil pemeriksaan</strong></h3>
                <h5 class="text-uppercase">inspektorat daerah kabupaten batang hari</h5>
                <img src="{{ url('assets/logo.png') }}" alt="" srcset="" class="mt-2"
                    style="width: 150px; height: auto;">
            </div>
            @csrf
            <div class="card-body">
                @if (session('errors'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        Something it's wrong:
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if (Session::has('success'))
                    <div class="alert alert-success">
                        {{ Session::get('success') }}
                    </div>
                @endif
                @if (Session::has('error'))
                    <div class="alert alert-danger">
                        {{ Session::get('error') }}
                    </div>
                @endif
                <div class="form__group">
                    <input type="text" class="form__field" placeholder="Username" name="username" required />
                    <label for="username" class="form__label">Username</label>
                </div>
                <div class="form__group">
                    <input type="password" class="form__field" placeholder="Password" name="password" required />
                    <label for="password" class="form__label">Password</label>
                </div>
            </div>
            <div class="card-footer cards-down mt-3">
                <button type="submit" class="btn btn-primary custom-btn">Log In</button>
            </div>
        </form>
    </div>

</div> --}}
<div id="app">
    <section class="section">
        <div class="d-flex flex-wrap align-items-stretch">
            <div class="col-lg-4 col-md-6 col-12 order-lg-1 min-vh-100 order-2 bg-white">
                <div class="p-4 m-3">
                    <img src="../assets/img/logo.jpeg" alt="logo" width="100" class="shadow-light  mb-3 mt-2">
                    <h5 class="text-dark font-weight-normal">Sistem Informasi Pencatatan Aset <span
                            class="font-weight-bold">Koperasi Kesejahteraan Karyawan Perkebunan Nusantara VI</span></h5>
                    <form method="POST" action="{{ route('tologin') }}" class="needs-validation" novalidate="">
                        @csrf
                        @if (Session::has('success'))
                            <div class="alert alert-success">
                                {{ Session::get('success') }}
                            </div>
                        @endif
                        @if (Session::has('error'))
                            <div class="alert alert-danger">
                                {{ Session::get('error') }}
                            </div>
                        @endif
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input id="email" type="email"
                                class="form-control @error('email') is-invalid @enderror" autocomplete="off"
                                name="email" tabindex="1" required autofocus>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <div class="d-block">
                                <label for="password" class="control-label">Password</label>
                            </div>
                            <input id="password" type="password" class="form-control @error('password') @enderror"
                                name="password" tabindex="2" required>
                            <div class="invalid-feedback">
                                Mohon masukkan password!
                            </div>

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group text-right">
                            <button type="submit" class="btn btn-primary btn-lg btn-icon icon-right" tabindex="4">
                                Login
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-8 col-12 order-lg-2 order-1 min-vh-100 background-walk-y position-relative overlay-gradient-bottom"
                data-background="../assets/img/unsplash/download.webp">
                <div class="absolute-bottom-left index-2">
                    <div class="text-light p-5 pb-2">
                        <div class="mb-5 pb-3">
                            <h1 class="mb-2 display-4 font-weight-bold" id="greetings"></h1>
                            <h5 class="font-weight-normal text-muted-transparent">Kota Jambi, Jambi, Indonesia</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@include('Auth.components.footer')
