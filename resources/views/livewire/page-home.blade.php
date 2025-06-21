<div>

  <!-- Секция и контейнер -->
  <section class="w-full xl:py-24 md:py-12 xxs:pt-5 xxs:py-12">
    <div class="container mx-auto px-8">

      <!-- Контент -->
      <ul class="flex justify-between">
        <li>
          <div>
            <span class="inline-flex p-2 text-sm rounded border border-border bg-action">🔨 У нас лучшее качество</span>
            <h1 class="mt-10 font-medium text-gray-50 text-6xl 2xl:text-6xl xl:text-5xl sm:text-3xl xs:text-2xl xxs:text-xl ">Производство и продажа оружейной Дроби, Картечи свинцовой охотничьей.</h1>
            <p class="text-lg text-gray-500 xl:mt-10 md:w-4/5 xxs:mt-5">Наше производство специализируется на продаже оружейной дроби высокого качества для различных видов стрелкового оружия. Мы предлагаем широкий ассортимент дроби и картечи от производителя, что позволяет нашим клиентам выбрать подходящий вариант для своих нужд.</p>
            <ul class="flex gap-5 2xl:mt-14 md:mt-10 md:flex-row xxs:flex-col xxs:mt-5">
              <li class="inline-flex">
                <a href='#assortment' class="px-4 py-2 font-medium rounded bg-accent hover:bg-accent-hover border border-border w-full xxs:text-center">Посмотреть ассортимент</a>
              </li>
              <li class="inline-flex"> 
                <a target="blank" class="px-4 py-2 font-medium rounded bg-action border border-border xxs:w-full xxs:text-center" href="https://www.ozon.ru/product/drob-ohotnichya-svintsovaya-5-shot-12kg-volgashot-1711158382/?_bctx=CAQQkOeLAQ&at=08tYNzG1JcO8nXBZcPoxvm4S0oZvwjS6xKpArHMVo123&hs=1&tab=reviews">Отзывы</a>
              </li>
            </ul>
          </div>
        </li>
        <li >
          <img alt="Картинка оружия" class="w-[2000px] xl:mt-0 lg:mt-12 lg:inline xxs:hidden" src="{{ asset('/storage/main/gun.svg') }}"></img>
        </li>
      </ul>
      <!-- Конец контента -->

    </div>
  </section>
  <!-- Конец секции и контейнера -->
   
  <!-- Подключенные блоки -->
  @livewire('ui.category-tabs')
  @livewire('ui.about-block')
  @livewire('ui.feedback-form')
  @livewire('ui.yandex-map')
  @livewire('ui.cart-button')

</div>
