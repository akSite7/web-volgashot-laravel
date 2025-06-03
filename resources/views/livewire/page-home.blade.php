<div>
  <section class="w-full py-24">
    <div class="container px-8 mx-auto">
      <div>
        <ul class="flex justify-between">
          <li>
            <div class="">
              <span class="inline-flex p-2 text-sm rounded border border-border bg-action">🔨 У нас лучшее качество</span>
              <h1 class="mt-10 font-medium text-gray-50 text-6xl">Производство и продажа оружейной Дроби, Картечи свинцовой охотничьей.</h1>
              <p class="text-lg mt-10 text-gray-500 md:w-4/5">Наше производство специализируется на продаже оружейной дроби высокого качества для различных видов стрелкового оружия. Мы предлагаем широкий ассортимент дроби и картечи от производителя, что позволяет нашим клиентам выбрать подходящий вариант для своих нужд.</p>
              <ul class="flex flex-col mt-14 gap-5 flex-row">
                <li class="inline-flex">
                  <a href='#assortment' class="px-4 py-2 font-medium rounded bg-indigo-600 border border-border">Посмотреть ассортимент</a>
                </li>
                <li class="inline-flex"> 
                  <a target="blank" class="px-4 py-2 font-medium rounded bg-action border border-border" href="https://www.ozon.ru/product/drob-ohotnichya-svintsovaya-5-shot-12kg-volgashot-1711158382/?_bctx=CAQQkOeLAQ&at=08tYNzG1JcO8nXBZcPoxvm4S0oZvwjS6xKpArHMVo123&hs=1&tab=reviews">Отзывы</a>
                </li>
              </ul>
            </div>
          </li>
          <li >
            <img alt="Картинка оружия" class="w-[2000px]" src="{{ asset('/storage/main/gun.svg') }}"></img>
          </li>
        </ul>
      </div>
    </div>
  </section>
  @livewire('ui.category-tabs')
  @livewire('ui.about-block')
  @livewire('ui.feedback-form')
  @livewire('ui.yandex-map')
</div>
