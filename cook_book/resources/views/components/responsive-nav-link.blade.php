@props(['active'])

@php
$classes = ($active ?? false)
            ? 'block w-full ps-3 pe-4 py-2.5 text-start text-base font-semibold focus:outline-none transition-all duration-200'
            : 'block w-full ps-3 pe-4 py-2.5 text-start text-base font-semibold text-gray-700 focus:outline-none transition-all duration-200';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }} style="{{ ($active ?? false) ? 'color: #6A994E;' : '' }}" onmouseover="{{ ($active ?? false) ? '' : "this.style.color='#6A994E'" }}" onmouseout="{{ ($active ?? false) ? '' : "this.style.color=''" }}">
    {{ $slot }}
</a>
