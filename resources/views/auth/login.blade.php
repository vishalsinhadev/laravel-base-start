@extends('layouts.front')

@section('content')

<section id="contact-section" class="contact-simple">
    <div class="contact-section-inner full-height-vh"> <!-- add/remove class "tt-wrap" to enable/disable element boxed layout (class "tt-boxed" is required in <body> tag! ) -->

        <div class="full-cover bg-image" style="background-image: url(assets/img/misc/contact-bg-2.jpg); background-position: 50% 50%;"></div>

        <!-- Element cover -->
        <div class="cover bg-transparent-1-dark"></div>

        <!-- Begin contact info -->
        <div class="contact-info-wrap">

            <!-- Begin tt-heading 
            ====================== 
            * Use class "padding-on" to enable heading paddings (useful if you use tt-heading as stand alone element).
            * Use class "text-center" or "text-right" to align tt-heading.
            * Use classes "tt-heading-xs", "tt-heading-sm", "tt-heading-lg", "tt-heading-xlg" or "tt-heading-xxlg" to set tt-heading size.
            -->
            <div class="tt-heading">
                <div class="tt-heading-inner">
                    <h1 class="tt-heading-title">Login</h1>
                    <!-- <div class="tt-heading-subtitle">Subtitle Here</div> -->
                    <hr class="hr-short">
                </div> <!-- /.tt-heading-inner -->
            </div>
            <!-- End tt-heading -->

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="form-group row">
                    <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                    <div class="col-md-6">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                    <div class="col-md-6">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-6 offset-md-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                            <label class="form-check-label" for="remember">
                                {{ __('Remember Me') }}
                            </label>
                        </div>
                    </div>
                </div>

                <div class="form-group row mb-0">
                    <div class="col-md-8 offset-md-4">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Login') }}
                        </button>

                        @if (Route::has('password.request'))
                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                        @endif
                    </div>
                </div>
            </form>
            <!-- End social buttons -->

        </div>
        <!-- End contact info -->
    </div> <!-- /.contact-section-inner -->
</section>
@endsection