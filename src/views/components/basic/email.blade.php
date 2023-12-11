<div>
    <label for="email" class="block text-sm font-medium leading-6 text-white">{{ $label  }}</label>
    <div class="mt-2">
        <input value="{{ $value ?? '' }}" id="{{ $name }}" name="{{ $name }}" type="email" autocomplete="{{ $autocomplete ?? '' }}" required class="block w-full rounded-md border-0 bg-white/5 py-1.5 text-white shadow-sm ring-1 ring-inset ring-white/10 focus:ring-2 focus:ring-inset focus:ring-indigo-500 sm:text-sm sm:leading-6">
    </div>
    @error($name)
    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
    @enderror
</div>
