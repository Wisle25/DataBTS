<!-- resources/views/components/form-input.blade.php -->
@props(['id', 'label', 'name', 'type' => 'text', 'value' => ''])

<div class="mb-4">
    <label for="{{ $id }}" class="block text-gray-700 font-bold mb-2">{{ $label }}</label>
    <input id="{{ $id }}" name="{{ $name }}" type="{{ $type }}" value="{{ $value }}" {{ $attributes->merge(['class' => 'shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline']) }}>
    @error($name)
        <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
    @enderror
</div>
