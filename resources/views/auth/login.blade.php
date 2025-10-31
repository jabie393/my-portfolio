<x-layouts.auth>
    <div class="container">
      <div class="illustration">
        <div class="character char-orange">
          <div class="eyes-container">
            <div class="eye">
              <div class="pupil"></div>
            </div>
            <div class="eye">
              <div class="pupil"></div>
            </div>
          </div>
          <div class="mouth"></div>
        </div>
        <div class="character char-purple">
          <div class="eyes-container">
            <div class="eye">
              <div class="pupil"></div>
            </div>
            <div class="eye">
              <div class="pupil"></div>
            </div>
          </div>
          <div class="mouth"></div>
        </div>
        <div class="character char-black">
          <div class="eyes-container">
            <div class="eye">
              <div class="pupil"></div>
            </div>
            <div class="eye">
              <div class="pupil"></div>
            </div>
          </div>
          <div class="mouth"></div>
        </div>
        <div class="character char-yellow">
          <div class="eyes-container">
            <div class="eye">
              <div class="pupil"></div>
            </div>
            <div class="eye">
              <div class="pupil"></div>
            </div>
          </div>
          <div class="mouth"></div>
        </div>
      </div>

      <div class="login-form">
        <h1>{{ __('Welcome back!') }}</h1>
        <p>{{ __('Please enter your details') }}</p>

        <form method="POST" action="{{ route('login.store') }}">
          @csrf

          <div class="form-group">
            <label for="email">{{ __('Email') }}</label>
            <input type="email" id="email" name="email" required value="{{ old('email') }}" />
            @error('email')
                <div class="text-red-600 mt-1 text-sm">{{ $message }}</div>
            @enderror
          </div>

          <div class="form-group">
            <label for="password">{{ __('Password') }}</label>
            <div class="password-wrapper">
              <input type="password" id="password" name="password" required autocomplete="current-password" />
              <span class="toggle-password" role="button" aria-label="Toggle password visibility">
                <svg
                  id="eye-open"
                  xmlns="http://www.w3.org/2000/svg"
                  fill="currentColor"
                  viewBox="0 0 16 16"
                >
                  <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z" />
                  <path
                    d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"
                  />
                </svg>
                <svg
                  id="eye-closed"
                  xmlns="http://www.w3.org/2000/svg"
                  fill="currentColor"
                  viewBox="0 0 16 16"
                  style="display: none"
                >
                  <path
                    d="m10.79 12.912-1.614-1.615a3.5 3.5 0 0 1-4.474-4.474l-2.06-2.06C.938 6.278 0 8 0 8s3 5.5 8 5.5a7.029 7.029 0 0 0 2.79-.588zM5.21 3.088A7.028 7.028 0 0 1 8 2.5c5 0 8 5.5 8 5.5s-.939 1.721-2.641 3.238l-2.062-2.062a3.5 3.5 0 0 0-4.474-4.474L5.21 3.089z"
                  />
                  <path
                    d="M5.525 7.646a2.5 2.5 0 0 0 2.829 2.829l-2.83-2.829zm4.95.708-2.829-2.83a2.5 2.5 0 0 1 2.829 2.829zm3.171 6-12-12 .708-.708 12 12-.708.708z"
                  />
                </svg>
              </span>
            </div>
            @error('password')
                <div class="text-red-600 mt-1 text-sm">{{ $message }}</div>
            @enderror
          </div>

          <div class="checkbox-group">
            <label class="inline-flex items-center">
              <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }} />
              <span class="ml-2">{{ __('Remember me') }}</span>
            </label>
          </div>

          <button type="submit" class="btn btn-primary w-full" data-test="login-button">{{ __('Log in') }}</button>
        </form>

        @if (Route::has('register'))
            <div class="space-x-1 text-sm text-center rtl:space-x-reverse text-zinc-600 dark:text-zinc-400 mt-4">
                <span>{{ __('Don\'t have an account?') }}</span>
                <a href="{{ route('register') }}">{{ __('Sign up') }}</a>
            </div>
        @endif
      </div>
    </div>

    <!-- Include jQuery and the interaction script -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    @vite(['resources/css/auth.css', 'resources/js/auth.js'])

</x-layouts.auth>
