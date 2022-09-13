@extends("layouts.customer.main")

@section("content")
    <div class="wrapper">
        <div class="container">
            <h3 class="third-heading">Pengaturan Akun</h3>

            <div class="flex w-full mt-[40px] rounded-[10px]" style="box-shadow: 1px 1px 7px rgba(0, 0, 0, 0.25);">
                <div class="py-[70px] px-[24px] md:px-[64px] border-r border-gray-4 ">
                    <div class="flex  items-center">
                        <a href="/akun/pengaturan-akun" class="flex items-center gap-[24px]">
                            <span class="mi text-primary">account_circle</span>
                            <p class="-mt-1 hidden md:block">Akun</p>
                        </a>
                    </div>
                    <div class="flex gap-[24px] items-center mt-[90px]">
                        <a href="/akun/pemesanan" class="flex items-center gap-[24px]">
                            <span class="mi text-gray-3">shopping_cart</span>
                            <p class="-mt-1 hidden md:block text-gray-3">Pemesanan</p>
                        </a>
                    </div>
                    <div class="flex gap-[24px] items-center mt-[90px]">
                        <a href="" class="flex items-center gap-[24px]">
                            <span class="mi text-gray-3">notifications</span>
                            <p class="-mt-1 hidden md:block text-gray-3">Notifikasi</p>
                        </a>
                    </div>
                    <div class="flex gap-[24px] items-center mt-[90px]">
                        <a href="" class="flex items-center gap-[24px]">
                            <span class="mi text-gray-3">help</span>
                            <p class="-mt-1 hidden md:block text-gray-3">Bantuan</p>
                        </a>
                    </div>
                    <div class="flex gap-[24px] items-center mt-[90px]">
                        <form action="/logout" method="post">
                            @csrf
                            <button class="flex items-center gap-[24px]">
                                <span class="mi text-gray-3">logout</span>
                                <p class="-mt-1 hidden md:block text-gray-3">Keluar</p>
                            </button>
                        </form>
                    </div>
                </div>
                <div class="py-[70px] px-[64px] w-full ">
                    <div class=" w-full flex-shrink-0">
                        <label for="" class="text-gray-2 text-lg">Nama Lengkap</label>
                        <input value="{{$profile->fullname}}"
                               class="rounded-[10px] border border-gray-4 text-lg p-2 mt-2 focus:outline-none hover:border-warning w-full"/>
                    </div>
                    <div class="mt-[40px] w-full flex-shrink-0">
                        <label for="" class="text-gray-2 text-lg">Username</label>
                        <input value="{{$profile->username}}"
                               class="rounded-[10px] border border-gray-4  text-lg p-2 mt-2 focus:outline-none hover:border-warning w-full"/>
                    </div>
                    <div class="mt-[40px] w-full flex-shrink-0">
                        <label for="" class="text-gray-2 text-lg">Password</label>
                        <input type="password"
                               class="rounded-[10px] border border-gray-4  text-lg p-2 mt-2 focus:outline-none hover:border-warning w-full"/>
                    </div>
                    <div class="mt-[40px] w-full flex-shrink-0">
                        <label for="" class="text-gray-2 text-lg">Email</label>
                        <input type="email" value="{{$profile->email}}"
                               class="rounded-[10px] border border-gray-4  text-lg p-2 mt-2 focus:outline-none hover:border-warning w-full"/>
                    </div>
                    <div class="mt-[40px] w-full flex-shrink-0">
                        <label for="" class="text-gray-2 text-lg">Alamat</label>
                        <input value="{{$profile->address}}"
                               class="rounded-[10px] border border-gray-4  text-lg p-2 mt-2 focus:outline-none hover:border-warning w-full"/>
                    </div>

                </div>
            </div>

        </div>
    </div>
@endsection
