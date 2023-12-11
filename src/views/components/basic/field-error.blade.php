@if(isset($errors) && $errors->any())
    @error($name)
    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
    @enderror
@endif