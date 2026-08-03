@extends('layouts.app')

@section('content')
<div class="mx-auto grid max-w-6xl gap-8 lg:grid-cols-[1.05fr_0.95fr] lg:items-center">
    <div class="mm-surface overflow-hidden bg-slate-950 p-6 text-white sm:p-8">
        <p class="mm-subtitle text-brand-200">Create account</p>
        <h1 class="mt-4 text-4xl font-black tracking-tight">Join Mini-Mart and keep orders in one place.</h1>
        <p class="mt-4 max-w-lg text-sm leading-7 text-slate-300">Register once, then use the same account for shopping, profile updates, and order history.</p>
        <div class="mt-8 grid gap-4 sm:grid-cols-2">
            <div class="rounded-[1.25rem] bg-white/10 p-4">
                <p class="text-sm text-slate-300">Profile</p>
                <p class="mt-2 text-xl font-semibold">Save your details</p>
            </div>
            <div class="rounded-[1.25rem] bg-white/10 p-4">
                <p class="text-sm text-slate-300">Orders</p>
                <p class="mt-2 text-xl font-semibold">Track purchases easily</p>
            </div>
        </div>
    </div>

    <div class="mm-surface mx-auto w-full max-w-lg p-6 sm:p-8">
        <div class="flex items-center gap-3">
            <div class="inline-flex h-12 w-12 items-center justify-center rounded-2xl bg-brand-50 text-brand-700 font-black">MM</div>
            <div>
                <h2 class="text-3xl font-black text-slate-900">Create account</h2>
                <p class="mt-1 text-slate-600">Register to start shopping with Mini-Mart.</p>
            </div>
        </div>

        <form method="post" action="/register" class="mt-8 space-y-5">@csrf
            <div>
                <label class="mm-label" for="register-name">Name</label>
                <input id="register-name" name="name" value="{{ old('name') }}" class="mm-input mt-2">
                @if($errors->has('name'))<div class="mt-2 text-sm text-rose-600">{{ $errors->first('name') }}</div>@endif
            </div>
            <div>
                <label class="mm-label" for="register-email">Email</label>
                <input id="register-email" name="email" type="email" value="{{ old('email') }}" class="mm-input mt-2">
                @if($errors->has('email'))<div class="mt-2 text-sm text-rose-600">{{ $errors->first('email') }}</div>@endif
            </div>
            <div>
                <label class="mm-label" for="register-phone">Phone</label>
                <input id="register-phone" name="phone" value="{{ old('phone') }}" class="mm-input mt-2">
            </div>
            <div>
                <label class="mm-label" for="register-address">Address</label>
                <textarea id="register-address" name="address" rows="4" class="mm-input mt-2">{{ old('address') }}</textarea>
            </div>
            <div>
                <label class="mm-label" for="register-password">Password</label>
                <div class="relative mt-2">
                    <input id="register-password" type="password" name="password" class="mm-input pr-24">
                    <button type="button" data-password-toggle="register-password" aria-pressed="false" class="absolute inset-y-1.5 right-1.5 rounded-full bg-slate-100 px-4 text-sm font-semibold text-slate-700 transition hover:bg-slate-200">
                        <span data-password-toggle-label>Show</span>
                    </button>
                </div>
                @if($errors->has('password'))<div class="mt-2 text-sm text-rose-600">{{ $errors->first('password') }}</div>@endif
            </div>
            <div>
                <label class="mm-label" for="register-password-confirmation">Confirm password</label>
                <input id="register-password-confirmation" type="password" name="password_confirmation" class="mm-input mt-2">
                @if($errors->has('password_confirmation'))<div class="mt-2 text-sm text-rose-600">{{ $errors->first('password_confirmation') }}</div>@endif
            </div>
            <button class="mm-btn-primary w-full">Register</button>
        </form>
    </div>
</div>
@endsection
