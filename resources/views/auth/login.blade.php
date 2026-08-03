@extends('layouts.app')

@section('content')
<div class="mx-auto grid max-w-6xl gap-8 lg:grid-cols-[0.95fr_1.05fr] lg:items-center">
    <div class="hidden lg:block">
        <div class="mm-surface overflow-hidden bg-slate-950 p-8 text-white">
            <p class="mm-subtitle text-brand-200">Welcome back</p>
            <h1 class="mt-4 text-4xl font-black tracking-tight">Login to continue shopping with Mini-Mart.</h1>
            <p class="mt-4 max-w-md text-sm leading-7 text-slate-300">A cleaner, trustworthy storefront built for fast browsing, quick cart access, and smooth checkout.</p>
            <div class="mt-8 grid gap-4 sm:grid-cols-2">
                <div class="rounded-[1.25rem] bg-white/10 p-4">
                    <p class="text-sm text-slate-300">Fast checkout</p>
                    <p class="mt-2 text-xl font-semibold">Seamless flow</p>
                </div>
                <div class="rounded-[1.25rem] bg-white/10 p-4">
                    <p class="text-sm text-slate-300">Order tracking</p>
                    <p class="mt-2 text-xl font-semibold">Customer dashboard</p>
                </div>
            </div>
        </div>
    </div>

    <div class="mm-surface mx-auto w-full max-w-lg p-6 sm:p-8">
        <div class="flex items-center gap-3">
            <div class="inline-flex h-12 w-12 items-center justify-center rounded-2xl bg-brand-50 text-brand-700 font-black">MM</div>
            <div>
                <h2 class="text-3xl font-black text-slate-900">Login</h2>
                <p class="mt-1 text-slate-600">Access your Mini-Mart account.</p>
            </div>
        </div>

        <form method="post" action="/login" class="mt-8 space-y-5">@csrf
            <div>
                <label class="mm-label" for="login-email">Email</label>
                <input id="login-email" name="email" type="email" value="{{ old('email') }}" class="mm-input mt-2">
                @if($errors->has('email'))<div class="mt-2 text-sm text-rose-600">{{ $errors->first('email') }}</div>@endif
            </div>
            <div>
                <label class="mm-label" for="login-password">Password</label>
                <div class="relative mt-2">
                    <input id="login-password" type="password" name="password" class="mm-input pr-24">
                    <button type="button" data-password-toggle="login-password" aria-pressed="false" class="absolute inset-y-1.5 right-1.5 rounded-full bg-slate-100 px-4 text-sm font-semibold text-slate-700 transition hover:bg-slate-200">
                        <span data-password-toggle-label>Show</span>
                    </button>
                </div>
                @if($errors->has('password'))<div class="mt-2 text-sm text-rose-600">{{ $errors->first('password') }}</div>@endif
            </div>
            <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                <button class="mm-btn-primary w-full sm:w-auto">Login</button>
                <a href="/register" class="text-sm font-semibold text-brand-700 transition hover:text-brand-800">Need an account? Register</a>
            </div>
        </form>
    </div>
</div>
@endsection
