@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto py-12">
    <h2 class="text-2xl font-semibold mb-6">Вход в аккаунт</h2>

    @if (session('status'))
        <div class="mb-4 text-sm text-green-600">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email -->
        <div class="mb-4">
            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" />
            @error('email')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Password -->
        <div class="mb-4">
            <label for="password" class="block text-sm font-medium text-gray-700">Пароль</label>
            <input id="password" type="password" name="password" required
                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" />
            @error('password')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Remember -->
        <div class="mb-4 flex items-center">
            <input id="remember" type="checkbox" name="remember"
                class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" />
            <label for="remember" class="ml-2 text-sm text-gray-600">Запомнить меня</label>
        </div>

        <div class="flex items-center justify-between">
            <a href="{{ route('password.request') }}" class="text-sm text-gray-600 hover:text-gray-900">Забыли пароль?</a>
            <button type="submit" class="ml-3 inline-flex items-center px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-md">
                Войти
            </button>
        </div>
    </form>
</div>
@endsection
