<section class="xl:pb-24 xxs:py-12" id="feedback">
  <div class="container mx-auto px-8 grid lg:grid-cols-2">
    <div class="2xl:mt-20 2xl:ml-20 xl:w-140 lg:w-110 lg:mt-15 xxs:ml-0">
      <h2 class="font-medium mb-5 uppercase leading-tight md:text-5xl sm:text-3xl xs:text-2xl xxs:text-xl">Хотите сделать заказ?</h2>
      <p class="text-gray-500 text-xl leading-7 md:text-xl sm:text-xl 5 xxs:w-full xxs:text-lg">
        Оставьте свои контактные данные для связи и обязательно укажите в комментарии номера дроби или картечи, которые вас интересуют их вес, а также город или населенный пункт, куда необходимо организовать доставку. Мы перезвоним в ближайшее время для уточнения деталей и расчета стоимости доставки. Благодарим за проявленный интерес к нашему ассортименту, ждем вашей заявки!
      </p>
    </div>
    <div class="p-10 pt-7 border rounded border-border bg-action lg:mt-0 md:w-full md:mt-10 xxs:mt-5">
      <h3 class="text-3xl font-semibold mb-6 sm:text-left xxs:text-center xxs:text-2xl">Заполните форму</h3>
      <form wire:submit.prevent="submit" wire:key="feedback-form-{{ now()->timestamp }}">
      
        <div class="grid sm:grid-cols-2 gap-5">
          <div>
            <input wire:model.defer="name" maxlength="50"  type="text" placeholder="Ваше имя" class=" w-full bg-background p-4 focus:outline-none focus:ring-2 focus:ring-accent sm:text-left xxs:text-center" />
            @error('name')
              <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
          </div>
          <div>
            <input wire:model.defer="phone" type="text" placeholder="Телефон" class="w-full bg-background p-4 focus:outline-none focus:ring-2 focus:ring-accent sm:text-left xxs:text-center" />
            @error('phone')
              <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
          </div>
        </div>
        <div class="mt-5">
          <textarea wire:model.defer="message" maxlength="400" rows="6" placeholder="Комментарий" class="w-full bg-background p-4 focus:outline-none focus:ring-2 focus:ring-accent sm:text-left xxs:text-center "></textarea>
          @error('message')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
          @enderror
        </div>
        <p class="text-xs text-gray-500 mt-2">Нажимая кнопку, вы соглашаетесь на обработку персональных данных и с политикой конфиденциальности</p>
        <button type="submit" class="mt-4 cursor-pointer bg-accent hover:bg-accent-hover  font-medium py-2 px-6 rounded transition sm:w-33 sm:text-left xxs:w-full">Отправить</button>
          @if (session()->has('success'))
            <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 5000)" x-show="show" x-transition:leave="transition ease-in duration-500" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed top-6 right-6 border rounded border-border bg-action text-gray-500 px-4 py-3 shadow-lg flex items-center gap-2 sm:w-115 xs:w-90 xxs:w-70">
              <i class=' text-green-400 bx bx-check-circle text-xl'></i>
              <span>{{ session('success') }}</span>
            </div>
          @endif
      </form>
    </div>
  </div>
</section>