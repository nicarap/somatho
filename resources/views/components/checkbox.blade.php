@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'rounded-sm text-primary-500 shadow outline-none border-primary-500 bg-white focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 disabled:bg-gray-200 disabled:opacity-25 transition ease-in-out duration-150']) !!}>
