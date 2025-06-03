<div>
  <section class="w-full pt-12 pb-24">
    <div class="container px-8 mx-auto">
      <h1 class="text-5xl font-medium">Способ связи и юридическая информация</h1>
        @foreach($contacts as $contact)
            <div class="text-gray-400">
              <h2 class="text-3xl mt-12">{{ $contact->title }}</h2>
              <h3 class="text-3xl mt-4">{{ $contact->name }}</h3>
              @if ($contact->spec)
                <ul class="mt-5">
                    @foreach ($contact->spec as $item)
                      <li class="flex text-lg leading-loose">
                        <span class="w-28">{{ $item['name'] }}:</span>
                        <span>{{ $item['value'] }}</span>
                      </li>
                    @endforeach
                </ul>
              @endif
          </div>
        @endforeach
    </div>
  </section>
  @livewire('ui.yandex-map')
  @livewire('ui.feedback-form')
</div>