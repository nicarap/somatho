@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'w-full border-1 rounded-lg shadow-sm outline-none border-gray-300 bg-white focus:ring-2 focus:border-primary-500 focus:ring-primary-500 focus:ring-inset disabled:opacity-25 transition ease-in-out duration-150']) !!}>
