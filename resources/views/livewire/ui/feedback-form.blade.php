<section class="py-16" id="feedback">
  <div class="container mx-auto px-6 grid md:grid-cols-2  items-start">
    <div class="ml-20 mt-6 w-130">
      <h2 class="text-5xl md:text-5xl font-medium mb-5 uppercase leading-tight">Хотите сделать заказ?</h2>
      <p class="text-gray-500 text-xl leading-7">
        Оставьте свои контактные данные для связи и обязательно укажите в комментарии номера дроби или картечи, которые вас интересуют их вес, а также город или населенный пункт, куда необходимо организовать доставку. Мы перезвоним в ближайшее время для уточнения деталей и расчета стоимости доставки. Благодарим за проявленный интерес к нашему ассортименту, ждем вашей заявки!
      </p>
    </div>
    <div class="p-10 pt-7 w-full border rounded border-border bg-action">
      <h3 class="text-2xl font-semibold mb-6">Заполните форму</h3>
      <form wire:submit.prevent="submit" wire:key="feedback-form-{{ now()->timestamp }}">
       
        <div class="grid md:grid-cols-2 gap-5">
          <div>
            <input wire:model.defer="name" maxlength="50"  type="text" placeholder="Ваше имя" class="w-full bg-background text-white p-4 focus:outline-none focus:ring-2 focus:ring-indigo-600" />
            @error('name')
              <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
          </div>
          <div>
            <input wire:model.defer="phone" type="text" placeholder="Телефон" class="w-full bg-background text-white p-4 focus:outline-none focus:ring-2 focus:ring-indigo-600" />
            @error('phone')
              <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
          </div>
        </div>
        <div class="mt-5">
          <textarea wire:model.defer="message" rows="6" placeholder="Комментарий" class="w-full bg-background text-white p-4 focus:outline-none focus:ring-2 focus:ring-indigo-600"></textarea>
          @error('message')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
          @enderror
        </div>
        <p class="text-xs text-gray-500 mt-2">Нажимая кнопку, вы соглашаетесь на обработку персональных данных и с политикой конфиденциальности</p>
        <button type="submit" class="mt-4 cursor-pointer bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2 px-6 rounded transition">Отправить</button>
          @if (session()->has('success'))
            <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 5000)" x-show="show" x-transition:leave="transition ease-in duration-500" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed top-6 right-6 border rounded border-border bg-action text-gray-500 px-4 py-3 shadow-lg flex items-center gap-2">
              <i class=' text-green-400 bx bx-check-circle text-xl'></i>
              <span>{{ session('success') }}</span>
            </div>
          @endif
      </form>
    </div>
  </div>
</section>