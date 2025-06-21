<!-- Футер и контейнер -->
<footer class="w-full py-10 border-t border-border">
  <div class="container px-8 mx-auto space-y-7">

    <!-- Контент -->
    <div class="w-full flex flex-col justify-between items-start gap-10 lg:flex-row">
      <div class="space-y-5 w-3/12 xl:w-3/12 lg:w-6/12 xxs:w-12/12">
        <a wire:navigate href="{{ route('page.home') }}" class="text-2xl font-semibold">VOLGASHOT</a>
        <p class="text-gray-400 mt-5">Мы надеемся что после приобретения нашей продукции у вас останутся только положительные эмоции. Мы работаем над тем, чтобы наши товары были высокого качества. В случае каких-либо проблем или вопросов, пожалуйста, не стесняйтесь обращаться к нам.</p>
      </div>
      <div class="grid gap-5 grid-cols-3 w-9/12 lg:grid-cols-3 md:grid-cols-2 xxs:grid-cols-1">
        <div class="w-full space-y-5">
          <h3 class="text-lg font-medium">Основные разделы</h3>
          <ul class="w-full space-y-3 text-gray-400">
            <li>
              <a href="/category/fraction" class="hover:underline">Дробь</a>
            </li>
            <li>
              <a href='/category/buckshot' class="hover:underline">Картечь</a>
            </li>
            <li>
              <a href='/contact' class="hover:underline">Контакты</a>
            </li>
          </ul>
        </div>
        <div class="w-full space-y-5">
          <h3 class="text-lg font-medium">Дополнительно</h3>
          <ul class="w-full space-y-3 text-gray-400">
            <li>
              <a target="blank" href='https://www.ozon.ru/seller/volgashot-2290576/' class="hover:underline">OZON</a>
            </li>
            <li>
              <a target="blank" href='https://www.wildberries.ru/seller/4306216#c287942850' class="hover:underline">Wildberries</a>
            </li>
          </ul>
        </div>
      </div>
    </div>
    <div class="flex items-center justify-between gap-2 flex-col flex-row">
      <p class="text-sm text-gray-500">&copy; {{ now()->format('Y') }} VOLGASHOT</p>
    </div>
    <!-- Конец контента -->

  </div>
</footer>
<!-- Конец футера и контейнера -->