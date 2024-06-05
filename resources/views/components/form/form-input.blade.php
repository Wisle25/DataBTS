@props(['id', 'label', 'name', 'type' => 'text', 'step' => null, 'value' => ''])

<div class="mb-4">
    <label for="{{ $id }}" class="block mb-2 text-sm text-gray-700">{{ $label }}</label>
    <input type="{{ $type }}" step="{{ $step }}" id="{{ $id }}" name="{{ $name }}" value="{{ $value }}"
        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-500"
        required>
</div>
