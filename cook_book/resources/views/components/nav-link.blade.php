@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center px-3 py-2 text-sm font-semibold leading-5 focus:outline-none transition-all duration-200'
            : 'inline-flex items-center px-3 py-2 text-sm font-semibold leading-5 text-gray-700 focus:outline-none transition-all duration-200';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }} style="{{ ($active ?? false) ? 'color: #6A994E;' : '' }}" onmouseover="{{ ($active ?? false) ? '' : "this.style.color='#6A994E'" }}" onmouseout="{{ ($active ?? false) ? '' : "this.style.color=''" }}">
    {{ $slot }}
</a>
