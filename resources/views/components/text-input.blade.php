@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'bg-base-100 border-2 border-base-200 p-2 focus:border-indigo-500 focus:ring-indigo-500 rounded-md']) }}>
