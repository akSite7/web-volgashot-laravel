<a href="/cart"
   class="fixed bottom-4 right-4 w-14 h-14 bg-action border border-border  rounded-lg flex items-center justify-center hover:bg-gray-800 z-50">
    <box-icon name='cart' color='white' size='md'></box-icon>
    @if($total_count > 0)
        <span
            class="absolute top-1 right-1 bg-accent text-white text-xs font-bold rounded-full w-5 h-5 flex items-center justify-center">
            {{ $total_count }}
        </span>
    @endif
</a>