<x-guest-layout>
    <div class="mb-6 text-center">
        <h2 class="text-3xl font-bold text-gray-900 mb-2">Mot de passe oublié</h2>
        <p class="text-gray-600">Entrez votre adresse email et nous vous enverrons un lien de réinitialisation</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-6" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" value="Email" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-between pt-4">
            <a class="text-sm text-gray-600 hover:text-gray-900 font-medium transition-colors" href="{{ route('login') }}">
                Retour à la connexion
            </a>

            <x-primary-button class="px-6">
                Envoyer le lien de réinitialisation
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
