<section class="w-full">
  <div class="container mx-auto px-8 py-15">

    <h1 class="font-semibold text-3xl mb-10 ml-5">Оформление заказа</h1>
    <form wire:submit.prevent='placeOrder'>
      <div class=" mx-auto grid grid-cols-1 lg:grid-cols-3 gap-6">
      
      <!-- Блок для контактной информации -->
      <div class="bg-action border-border border p-6 rounded shadow col-span-2">
        <h2 class="text-2xl font-semibold mb-4">Контактная информация</h2>
        <div class="grid grid-cols-2 gap-4 mb-5">
          <input wire:model='first_name' type="text" placeholder="Имя" class="w-full bg-background p-4 focus:outline-none focus:ring-2 focus:ring-accent" />
          <input wire:model='last_name' type="text" placeholder="Фамилия" class="w-full bg-background p-4 focus:outline-none focus:ring-2 focus:ring-accent" />
          <input wire:model='phone' type="text" placeholder="Номер телефона" class="w-full bg-background p-4 focus:outline-none focus:ring-2 col-span-2 focus:ring-accent" />
        </div>
        <h3 class="text-2xl font-semibold mb-4">Данные для доставки</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
          <input wire:model='city' type="text" placeholder="Город" class="w-full bg-background p-4 focus:outline-none focus:ring-2 focus:ring-accent" />
          <input wire:model='address' type="text" placeholder="Адрес" class="w-full bg-background p-4 focus:outline-none focus:ring-2 focus:ring-accent" />
          <input wire:model='notes' type="text" placeholder="Комментарий" class="w-full bg-background p-4 focus:outline-none focus:ring-2 focus:ring-accent col-span-2" />
        </div>
      </div>

      <!-- Блок итоговых значений -->
      <div class="bg-action border border-border rounded-lg p-6 w-full ">
        <h2 class="text-2xl font-semibold mb-4">Итого</h2>
        <div class="space-y-2 ">
          <div class="flex justify-between">
            <span>Цена товаров</span>
            <span class="text-gray-400">{{ number_format($total_price, 0, '.', ' ') }} ₽</span>
          </div>
          <div class="flex justify-between">
            <span>Товара в кг</span>
            <span class="text-gray-400">{{ $total_quantity }} кг</span>
          </div>
          <div class="flex justify-between pb-3">
            <span>Цена доставки</span>
            <span class="text-gray-400">Индивидуальная</span>
          </div>
          <div class="border-t pt-7 mt-30 flex justify-between font-semibold">
            <span>Итого</span>
            <span>{{ number_format($total_price, 0, '.', ' ') }} ₽ / {{ $total_quantity }} кг</span>
          </div>
        </div>
        <button type="submit" class="cursor-pointer mt-4 w-full py-2 rounded bg-accent hover:bg-accent-hover disabled:bg-gray-400 disabled:cursor-not-allowed" @disabled(!$cart_items)>Оформить заказ</button>
      </div>

        <!-- Корзина с товарами -->
        <div class="bg-action border border-border rounded-lg p-7 col-span-3">
          <h2 class="text-2xl font-semibold mb-4">Корзина</h2>
          <ul class="grid grid-cols-6 border-b pb-4 text-sm font-medium text-gray-400">
            <li class="col-span-2">Товар</li>
            <li>Цена за 1кг</li>
            <li class="ml-1">Итого</li>
            <li class="ml-2">Килограмм</li>
            <li class="ml-3">Удаление</li>
          </ul>
          @forelse ($cart_items as $item)
            <div wire:key="{{ $item['product_id'] }}" class="grid grid-cols-6 items-center gap-4 pt-5">
              <div class="col-span-2 flex items-center gap-5">
                <img class="w-20 h-20" src="{{ url('storage', $item['image']) }}" alt="{{ $item['name'] }}" />
                <div>{{ $item['name'] }}</div>
              </div>
              <div>{{ number_format($item['unit_amount'], 0, '.', ' ') }} ₽</div>
              <div>{{ number_format($item['total_amount'], 0, '.', ' ') }} ₽</div>
              <div class="flex items-center gap-5">
                <button wire:click='decreasedQty({{ $item["product_id"] }})' class="px-3 bg-accent text-2xl rounded cursor-pointer hover:bg-accent-hover">-</button>
                <span>{{ $item["quantity"] }} кг</span>
                <button wire:click='increasedQty({{ $item["product_id"] }})' class="px-2 bg-accent text-2xl rounded cursor-pointer hover:bg-accent-hover">+</button>
              </div>
              <div>
                <button wire:click="removeItem({{ $item['product_id'] }})" wire:loading.attr="disabled" wire:target="removeItem({{ $item['product_id'] }})" class=" px-3 py-1 cursor-pointer bg-accent hover:bg-accent-hover disabled:bg-gray-500 disabled:cursor-not-allowed rounded">
                  <span wire:loading.remove wire:target="removeItem({{ $item['product_id'] }})">
                    Удалить
                  </span>
                  <span wire:loading wire:target="removeItem({{ $item['product_id'] }})">
                    Удаление...
                  </span>
                </button>
              </div>
            </div>
          @empty
            <div class="flex items-center justify-center h-48 text-gray-400 text-lg col-span-6">
              Добавьте товары в корзину
            </div>
          @endforelse
        </div>
      </div>
    </form>


  </div>
</section>