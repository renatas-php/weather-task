<div x-data="{ tempType: 'C' }"> 
    <div class="flex flex-col items-center justify-center border-2 border-[#000] rounded-button lg:w-[500px] m-[16px] lg:m-[64px] px-[32px] py-[64px] gap-[32px]">
        <input type="text" wire:model.live="city" placeholder="Įveskite miestą" class="border-2 border-[#000] rounded-button p-[16px] h-[50px] w-full" wire:keyup="goSearch">
        <div class="text-[30px]" wire:loading wire:target="city">
            Ieškoma
        </div>
            @if($errorMessage)
            <div class="text-[18px]">{{ $errorMessage }}</div>
            @elseif($results && isset($results['current']))
            <div class="flex flex-col items-center w-full" x-data="{ temp: '{{ $results['current']['temp_c'] }}' }">
                <div class="flex flex-col gap-[30px] w-full">
                    <div class="flex justify-center items-center gap-[32px] leading-10 text-center">
                        <div class="flex flex-col">
                            <h1 class="text-[50px] font-medium">{{ $results['location']['name'] }}</h1>
                            <p class="text-[24px]">{{ $results['location']['country'] }}</p>
                        </div>
                    </div>
                    <span class="text-[16px] text-center">{{ $results['current']['condition']['text'] }}</span>
                </div>
                <img src="{{ $results['current']['condition']['icon'] }}" width="100px" height="100px" alt="">
                <div class="text-[50px] font-medium flex gap-[16px]">
                    <p class="transition-all" x-text="temp"></p>
                    <div class="text-[18px] flex jsutify-center leading-60px"><span class="mt-[-6px]">o</span><span class="text-[30px]" x-text="tempType"></span></div>    
                </div>
                <div class="flex gap-[8px]" x-data="{ active: 1 }">
                    <button type="button" @click="active = 1; temp = '{{ $results['current']['temp_c'] }}'; tempType = 'C'" class="transition-all rounded-full h-[40px] w-[40px] flex justify-center border-2" :class="active == 1 ? 'border-2 border-[#000]' : ''"><span class="text-[16px] mt-[-2px]">o</span><span class="text-[22px]">C</span></button>
                    <button type="button" @click="active = 2; temp = '{{ $results['current']['temp_f'] }}'; tempType = 'F'" class="transition-all rounded-full h-[40px] w-[40px] flex justify-center border-2" :class="active == 2 ? 'border-2 border-[#000]' : ''"><span class="text-[16px] mt-[-2px]">o</span><span class="text-[22px]">F</span></button>
                </div>
            </div>
            <div class="text-[30px] flex flex-col">
                @forelse(\App\Helpers\WeatherAPIHelper::getClothesRecomendationByTemp($results['current']['temp_c']) as $recomend) 
                <p class="text-[20px]">{{ ucfirst($recomend) }}</p>  
                @empty 
                @endforelse
                <p class="text-[20px]">{{ ucfirst(\App\Helpers\WeatherAPIHelper::isRaining($results['current']['condition']['text'])) }}</p> 
            </div>
            @endif
    </div>
    @if(isset($results['forecast']))
    <div class="grid grid-cols-2 md:grid-cols-4 gap-[32px] p-[16px]">
        @forelse($results['forecast']['forecastday'] as $key => $result)
            @if($key > 0)
                <div class="flex flex-col items-center justify-center gap-[8px]">
                    <p class="font-medium">{{ $result['date'] }}</p>
                    <p class="text-[16px] text-center">{{ $result['day']['condition']['text'] }}</p>
                    <img src="{{ $result['day']['condition']['icon'] }}" width="50px" height="50px" alt="">
                    <template x-if="tempType == 'C'">
                        <div class="flex jsutify-center leading-60px text-[24px] font-medium">{{ $result['day']['avgtemp_c'] }} <span class="mt-[-6px] text-[12px]">o</span><span class="text-[18px]">C</span></div>
                    </template>
                    <template x-if="tempType == 'F'">
                        <div class="flex jsutify-center leading-60px text-[24px] font-medium">{{ $result['day']['avgtemp_f'] }} <span class="mt-[-6px] text-[12px]">o</span><span class="text-[18px]">F</span></div>
                    </template>
                </div>
            @endif
        @empty 
        @endforelse
    </div>    
    @endif
</div>
