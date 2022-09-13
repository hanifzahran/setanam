<div class="rounded-[10px] w-full shadow-lg ">
    <div class="flex flex-col justify-between h-full">
        <div>
            <img src="{{$images}}" alt="" class="w-full aspect-square object-cover rounded-[10px]">
            <div class="pt-[24px] px-[16px] ">
                <div>
                    <p class=" text-black-1 font-lg-responsive">{{$title}}</p>
                    <p class="mt-[10px]  font-lg-responsive">{{$harga}}</p>
                </div>

            </div>
        </div>
        <div class="w-full mt-[24px] pb-[24px] px-[16px] ">
            <a href="{{$link}}">
                <button class="bg-orange w-full py-[8px] text-white rounded-[10px]  font-lg-responsive">Sewa</button>
            </a>
        </div>
    </div>
</div>