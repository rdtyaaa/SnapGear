@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'text-gray-400 border-gray-300 p-2 border focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm']) }}>
