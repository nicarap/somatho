@props(['url'])

<a href="{{ $url }}"
   class="bg-primary-900 text-gray-100 hover:bg-primary-500 active:bg-primary-500 text-sm font-bold uppercase px-6 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 transition-all duration-300">
    {{ $label }}
</a>
