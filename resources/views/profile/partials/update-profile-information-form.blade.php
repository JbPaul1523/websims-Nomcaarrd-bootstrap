<section>
    <header>
        <h2 class="text-lg font-medium text-dark">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-muted">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>
{{--
    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form> --}}

    {{-- <form method="post" action="{{ route('profile.update') }}" class="mt-6">
        @csrf
        @method('patch') --}}

        <div class="mb-3">
            <label for="name" class="form-label">{{ __('Name') }}</label>
            <input id="name" name="name" type="text" class="form-control" value="" required autofocus autocomplete="name" />
            @error('name')
                <div class="text-danger"></div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">{{ __('Email') }}</label>
            <input id="email" name="email" type="email" class="form-control" value="" required autocomplete="username" />
            @error('email')
                <div class="text-danger"></div>
            @enderror

            {{-- @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-muted mt-2">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="btn btn-link">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-success">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif --}}
        </div>

        <div class="mb-3">
            <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>

            @if (session('status') === 'profile-updated')
                <p class="text-muted mt-2">{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
