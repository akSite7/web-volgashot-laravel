<div>
  <section class="w-full xl:pt-12 xl:pb-24 xxs:pt-6 xxs:pb-12">
    <div class="container px-8 mx-auto">
      <h1 class="font-medium xl:text-5xl md:text-4xl sm:text-3xl xs:text-2xl xxs:text-lg">Способ связи и юридическая информация</h1>
        @foreach($contacts as $contact)
            <div class="text-gray-400">
              <h2 class="xl:mt-12 md:text-3xl sm:text-2xl xs:text-xl xxs:text-lg xxs:mt-5">{{ $contact->title }}</h2>
              <h3 class="md:mt-4 md:text-3xl sm:text-2xl xs:text-xl xxs:text-lg xxs:mt-3">{{ $contact->name }}</h3>
              @if ($contact->spec)
                <ul class="mt-5 table sm:text-lg xs:text-base xxs:text-sm">
                  @foreach ($contact->spec as $item)
                    <li class="table-row align-top">
                      <span class="table-cell pb-2 w-32">{{ $item['name'] }}:</span>
                      <span class="table-cell pb-2">{{ $item['value'] }}</span>
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