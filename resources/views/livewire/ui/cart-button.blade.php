<a href="/cart"
   class="fixed bottom-4 right-4 w-14 h-14 bg-action border border-border  rounded-lg flex items-center justify-center hover:bg-gray-800 z-50">
    <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
        d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-1.293 2.293a1 1 0 00.083 1.32l.094.083a1 1 0 001.32-.083L9 15h6l1.396 1.613a1 1 0 001.513-1.313L17 13M6 21a1 1 0 100-2 1 1 0 000 2zm12 0a1 1 0 100-2 1 1 0 000 2z" />
    </svg>
    @if($total_count > 0)
        <span
            class="absolute top-1 right-1 bg-accent text-white text-xs font-bold rounded-full w-5 h-5 flex items-center justify-center">
            {{ $total_count }}
        </span>
    @endif
</a>