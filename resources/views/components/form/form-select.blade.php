@props(['id', 'label', 'name', 'options' => []])

<div class="mb-4">
    <label for="{{ $id }}" class="block mb-2 text-sm font-bold text-gray-700">{{ $label }}</label>
    <select id="{{ $id }}" name="{{ $name }}"
        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-500"
        required>
        @foreach($options as $value => $text)
            <option value="{{ $value }}">{{ $text }}</option>
        @endforeach
    </select>
</div>

