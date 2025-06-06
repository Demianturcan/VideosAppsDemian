<div>
    <a href="{{ $href ?? '#' }}"
       class="bg-{{ $color }} text-gray-600 px-5 py-2 rounded-sm hover:bg-{{ $getHoverColor() }} transition duration-50 ease-in-out no-underline inline-flex items-center gap-2 {{ $class ?? '' }}"
        {{ $attributes }}>
        {{ $slot }}
    </a>
</div>
