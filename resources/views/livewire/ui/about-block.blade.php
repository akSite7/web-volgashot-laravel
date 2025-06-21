<section class="w-full">
  <div class="container mx-auto pb-10 xxs:pb-10 md:pb-16 xl:pb-24 xxs:px-5">
    @foreach($abouts as $about)
      <h3 class="text-3xl text-gray-50 font-medium text-center xxs:text-xl md:text-4xl xxs:pt-0">
          {!! $about->title !!}
      </h3>
      <p class="pt-5 text-gray-500 text-center xxs:text-base xs:text-lg">
          {!! $about->name !!}
      </p>
    <div class="flex justify-center">
      @if ($about->spec)
      <ul class="pt-10 grid gap-10 sm:grid-cols-2">
        @foreach ($about->spec as $item)
        <li class="flex flex-col items-center p-5 border rounded border-border bg-action xs:h-64 xxs:h-auto">
          <img src="{{ asset('storage/' . $item['image']) }}" alt="Информация" class="xs:w-[95px] xxs:w-[80px]" />
          <div class="text-xl pt-5 font-medium text-white lg:text-xl xs:pt-5 xxs:text-base xxs:pt-0 xxs:pb-2">{{ $item['name'] }}</div>
          <div class="text-center max-w-96 text-gray-400 xs:text-base xxs:text-sm">{!! $item['value'] !!}</div>
        </li>
        @endforeach
      </ul>
      @endif
    </div>
    @endforeach
  </div>
</section>