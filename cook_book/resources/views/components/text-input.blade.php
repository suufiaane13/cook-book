@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'border-2 border-gray-300 rounded-lg shadow-sm transition-all duration-200']) }} style="--tw-ring-color: #6A994E;" onfocus="this.style.borderColor='#6A994E'; this.style.boxShadow='0 0 0 2px rgba(106, 153, 78, 0.2)'" onblur="this.style.borderColor=''; this.style.boxShadow=''">
