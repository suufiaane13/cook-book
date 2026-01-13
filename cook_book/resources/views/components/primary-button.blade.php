<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center justify-center px-6 py-3 border border-transparent rounded-lg font-semibold text-sm text-white shadow-lg focus:outline-none focus:ring-2 focus:ring-offset-2 transition-all duration-200 transform hover:scale-105 active:scale-95']) }} style="background: linear-gradient(to right, #6A994E, #A7C957);" onmouseover="this.style.background='linear-gradient(to right, #5a8840, #97b947)'" onmouseout="this.style.background='linear-gradient(to right, #6A994E, #A7C957)'">
    {{ $slot }}
</button>
