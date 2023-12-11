<div>
    <div class="flex items-center justify-between">
        <label for="password" class="block text-sm font-medium leading-6 text-white">{{ $label }}</label>
        @if(!empty($forgot))
        <div class="text-sm">
            <a href="{{ route('password.request') }}" class="font-semibold text-indigo-400 hover:text-indigo-300">Forgot password?</a>
        </div>
        @error($name)
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
        @endif
    </div>
    <div class="mt-2">
        <input id="{{ $name }}" name="{{ $name }}" type="password" autocomplete="current-password" required class="block w-full rounded-md border-0 bg-white/5 py-1.5 text-white shadow-sm ring-1 ring-inset ring-white/10 focus:ring-2 focus:ring-inset focus:ring-indigo-500 sm:text-sm sm:leading-6">
    </div>
</div>
