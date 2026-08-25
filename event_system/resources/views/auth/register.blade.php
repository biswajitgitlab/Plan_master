<x-guest-layout>
    <div class="mb-6 text-center">
        <h1 class="text-2xl font-bold text-on-surface mb-1">Create Account</h1>
        <p class="text-xs text-on-surface-variant">Join EventCentral to register for corporate events</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-4">
        @csrf

        <!-- Full Name -->
        <div>
            <label for="name" class="block text-xs font-semibold text-on-surface mb-1">Full Name</label>
            <input id="name" 
                   type="text" 
                   name="name" 
                   value="{{ old('name') }}" 
                   required 
                   autofocus 
                   autocomplete="name"
                   placeholder="John Doe"
                   class="w-full bg-surface-container-lowest border border-outline-variant rounded-xl px-3.5 py-2.5 text-sm text-on-surface focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary-fixed transition-all" />
            <x-input-error :messages="$errors->get('name')" class="mt-1 text-xs text-error" />
        </div>

        <!-- Email Address -->
        <div>
            <label for="email" class="block text-xs font-semibold text-on-surface mb-1">Email Address</label>
            <input id="email" 
                   type="email" 
                   name="email" 
                   value="{{ old('email') }}" 
                   required 
                   autocomplete="username"
                   placeholder="name@company.com"
                   class="w-full bg-surface-container-lowest border border-outline-variant rounded-xl px-3.5 py-2.5 text-sm text-on-surface focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary-fixed transition-all" />
            <x-input-error :messages="$errors->get('email')" class="mt-1 text-xs text-error" />
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="block text-xs font-semibold text-on-surface mb-1">Password</label>
            <input id="password" 
                   type="password" 
                   name="password" 
                   required 
                   autocomplete="new-password"
                   placeholder="At least 8 characters"
                   class="w-full bg-surface-container-lowest border border-outline-variant rounded-xl px-3.5 py-2.5 text-sm text-on-surface focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary-fixed transition-all" />
            <x-input-error :messages="$errors->get('password')" class="mt-1 text-xs text-error" />
        </div>

        <!-- Confirm Password -->
        <div>
            <label for="password_confirmation" class="block text-xs font-semibold text-on-surface mb-1">Confirm Password</label>
            <input id="password_confirmation" 
                   type="password" 
                   name="password_confirmation" 
                   required 
                   autocomplete="new-password"
                   placeholder="Re-enter password"
                   class="w-full bg-surface-container-lowest border border-outline-variant rounded-xl px-3.5 py-2.5 text-sm text-on-surface focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary-fixed transition-all" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1 text-xs text-error" />
        </div>

        <!-- Submit Button -->
        <div class="pt-2">
            <button type="submit" 
                    class="w-full py-3 bg-primary text-white font-semibold text-sm rounded-xl hover:bg-primary/90 active:scale-[0.99] transition-all shadow-sm flex items-center justify-center gap-2">
                <span>Create Account</span>
                <span class="material-symbols-outlined text-[18px]">person_add</span>
            </button>
        </div>
    </form>

    <!-- Login Link -->
    <div class="mt-6 pt-6 border-t border-outline-variant/60 text-center">
        <p class="text-xs text-on-surface-variant">
            Already registered? 
            <a href="{{ route('login') }}" class="text-primary font-bold hover:underline ms-1">
                Sign In Instead
            </a>
        </p>
    </div>
</x-guest-layout>

