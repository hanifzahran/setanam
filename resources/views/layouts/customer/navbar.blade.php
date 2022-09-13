<nav class="bg-white shadow-md h-[115px] w-full flex items-center">
    <div class="flex justify-between w-full ">
        <div class="flex gap-[24px] md:gap-[40px] lg:gap-[86px]  pl-[12px] lg:pl-[66px]  items-center">
            <div class="">
                <a href="/">
                    <img src="{{url('/core-images/logo.png')}}" alt="" class="w-full hidden md:block">
                    <img src="{{url('/core-images/logo-small.png')}}" alt="" class="w-full md:hidden">
                </a>
            </div>
            <div class="mr-[12px]">
                <div
                    class="border   border-[#828282] rounded-[10px] flex h-[40px] md:h-[63px] items-center px-[12px] py-[8px]">
                    <span class="mi mr-[8px]">
                        search
                    </span>
                    <input type="text"
                        class="focus:outline-none w-full md:w-[300px] lg:w-[450px] xl:w-[683px]  rounded-[10px] h-full text-lg">
                </div>
            </div>
        </div>
        <div class="flex gap-[16px] pr-[12px] md:pr-[34px] items-center">
            <a href="/product/keranjang">
                <span class="mi text-primary">shopping_cart</span>
            </a>
            <a href="/akun/pengaturan-akun">
                <span class="mi text-primary">account_circle</span>
            </a>
        </div>
    </div>
</nav>