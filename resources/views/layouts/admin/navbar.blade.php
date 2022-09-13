<div>
    <nav class="bg-white shadow-md h-[115px] w-full flex items-center">
        <div class="flex justify-between w-full items-center">
            <div class=" pl-[12px] lg:pl-[66px] flex gap-[24px] items-center ">

                <div class="lg:hidden">
                    <x-modal>
                        <x-slot name="trigger">
                            <span class="mi font-bold text-primary cursor-pointer " x-on:click="show=true">
                                menu
                            </span>

                        </x-slot>
                        <x-slot name="content">

                            <div class=" bg-white  w-full ">
                                <div class="flex justify-between p-4 cursor-pointer" x-on:click="show=false">
                                    <div>
                                        <img src="{{url('/core-images/logo-small.png')}}" alt=""
                                            class="w-full md:hidden">
                                    </div>
                                    <span class="mi">close</span>
                                </div>
                                <div class="px-4 py-8 flex flex-col gap-[24px] w-[300px] h-screen">
                                    <a href="/admin"
                                        class="p-4 @if($active == 'Beranda') bg-primary text-white @else text-primary @endif font-bold rounded-[10px]">
                                        Beranda
                                    </a>
                                    <a href="/admin/pemesanan"
                                        class="p-4 rounded-[10px]  font-bold @if($active == 'Pemesanan') bg-primary text-white @else text-primary @endif">Pemesanan</a>
                                    <a href="/admin/perawatan"
                                        class="p-4 rounded-[10px] font-bold @if($active == 'Perawatan') bg-primary text-white @else text-primary @endif">Perawatan</a>

                                </div>
                            </div>
                        </x-slot>
                    </x-modal>

                </div>
                <img src="{{url('/example-images/profile.png')}}" alt="" class="w-full  rounded-full">
            </div>
            <div class="hidden lg:flex items-center gap-[32px]">
                <a href="/admin" class="p-4 @if($active == 'Beranda') bg-primary text-white @else text-primary @endif
                    font-bold rounded-[10px]">
                    Beranda
                </a>
                <a href="/admin/pemesanan"
                    class="p-4  rounded-[10px]  font-bold @if($active == 'Pemesanan') bg-primary text-white @else text-primary @endif">Pemesanan</a>
                <a href="/admin/perawatan"
                    class="p-4  rounded-[10px] font-bold @if($active == 'Perawatan') bg-primary text-white @else text-primary @endif">Perawatan</a>
            </div>
            <div class="mr-[12px]">

            </div>
        </div>
    </nav>

</div>
