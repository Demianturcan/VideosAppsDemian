<div>
    @if($type)
        <button type="{{ $type }}"
                class="bg-{{ $color }} text-white px-5 py-2 rounded-sm hover:bg-{{ $getHoverColor() }} transition duration-50 ease-in-out inline-flex items-center gap-2 {{ $class ?? '' }}"
            {{ $attributes }}>
            @if($icon ?? false)
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                </svg>
            @endif
            {{ $slot }}
        </button>
    @else
        <a href="{{ $href ?? '#' }}"
           class="bg-{{ $color }} text-white px-5 py-2 rounded-sm hover:bg-{{ $getHoverColor() }} transition duration-50 ease-in-out no-underline inline-flex items-center gap-2 {{ $class ?? '' }}"
            {{ $attributes }}>
            @if($icon ?? false)
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                </svg>
            @endif
            {{ $slot }}
        </a>
    @endif
</div>


