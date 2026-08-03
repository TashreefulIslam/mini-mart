@extends('layouts.app')

@section('content')
    <div class="mx-auto max-w-4xl space-y-6">
        <div class="mm-surface p-6 sm:p-8">
            <p class="mm-subtitle">Profile</p>
            <h1 class="mt-2 mm-section-title">My profile</h1>
            <p class="mm-section-copy">Keep your contact and login details up to date.</p>
        </div>

        <div class="mm-surface p-6 sm:p-8">
            <form method="post" action="{{ route('profile.update') }}" class="space-y-5">@csrf
                <div class="grid gap-5 md:grid-cols-2">
                    <div>
                        <label class="mm-label" for="profile-name">Name</label>
                        <input id="profile-name" name="name" value="{{ old('name', $user->name) }}" class="mm-input mt-2">
                    </div>
                    <div>
                        <label class="mm-label" for="profile-email">Email</label>
                        <input id="profile-email" name="email" value="{{ old('email', $user->email) }}" class="mm-input mt-2">
                    </div>
                </div>
                <div class="grid gap-5 md:grid-cols-2">
                    <div>
                        <label class="mm-label" for="profile-phone">Phone</label>
                        <input id="profile-phone" name="phone" value="{{ old('phone', $user->phone) }}" class="mm-input mt-2">
                    </div>
                    <div>
                        <label class="mm-label" for="profile-address">Address</label>
                        <textarea id="profile-address" name="address" rows="4" class="mm-input mt-2">{{ old('address', $user->address) }}</textarea>
                    </div>
                </div>
                <div class="grid gap-5 md:grid-cols-2">
                    <div>
                        <label class="mm-label" for="profile-password">New password</label>
                        <input id="profile-password" type="password" name="password" class="mm-input mt-2">
                    </div>
                    <div>
                        <label class="mm-label" for="profile-password-confirmation">Confirm password</label>
                        <input id="profile-password-confirmation" type="password" name="password_confirmation" class="mm-input mt-2">
                    </div>
                </div>
                <button class="mm-btn-primary">Update profile</button>
            </form>
        </div>
    </div>
@endsection
