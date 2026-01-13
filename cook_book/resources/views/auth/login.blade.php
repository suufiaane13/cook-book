<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-6" :status="session('status')" />

    <div class="mb-6 text-center">
        <h2 class="text-3xl font-bold text-gray-900 mb-2">Connexion</h2>
        <p class="text-gray-600">Connectez-vous à votre compte</p>
    </div>

    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" value="Email" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div>
            <x-input-label for="password" value="Mot de passe" />
            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center justify-between">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 shadow-sm" style="accent-color: #6A994E;" name="remember">
                <span class="ms-2 text-sm text-gray-600">Se souvenir de moi</span>
            </label>

            @if (Route::has('password.request'))
                <a class="text-sm font-medium transition-colors" style="color: #6A994E;" onmouseover="this.style.color='#5a8840'" onmouseout="this.style.color='#6A994E'" href="{{ route('password.request') }}">
                    Mot de passe oublié ?
                </a>
            @endif
        </div>

        <div class="flex items-center justify-between pt-4">
            <a class="text-sm text-gray-600 hover:text-gray-900 font-medium transition-colors" href="{{ route('register') }}">
                Pas encore de compte ?
            </a>

            <x-primary-button class="px-6">
                Se connecter
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
