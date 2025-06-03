<div>
  <section class="w-full">
    <div class="container px-8 mx-auto">
      <div class="mt-5 mb-20">
        <div>
          <h1 class="pt-8 font-medium text-6xl">{{ $category->name }}</h1>
          <div class="text-lg  text-gray-500 pt-8">{!! $category->description !!}</div>
          <ul class="grid pt-8 grid-cols-4 gap-y-14 gap-8">
            @foreach ($products as $product)
              <li>
                <article>
                  <img class="rounded-md" src="{{ url('storage', $product->image) }}" alt="Изображение товара">
                  <h1 class="pt-3 text-2xl">{{ $product->name }}</h1>
                  <p class="pt-2 text-gray-400 text-sm">{{ $product->description }}</p>
                  <p class="text-xl text-gray-400 pb-5 pt-2">{{ $product->price }} ₽<span class="text-sm text-gray-400"> за 1кг</span></p>
                  <a href="#feedback" class="px-4 pb-2 pt-2 rounded font-medium border border-border bg-indigo-600">Заказать</a>
                </article>
              </li>
            @endforeach
          </ul>
        </div>
      </div>
    </div>
  </section>
  @livewire('ui.feedback-form')
</div>