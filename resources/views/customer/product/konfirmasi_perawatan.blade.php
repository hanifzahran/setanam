@extends("layouts.customer.main")

@section("content")
<div class="wrapper">
    <div class="container">
        <h3 class="third-heading">Konfirmasi Perawatan</h3>
        <p class="font-lg-responsive text-gray-2 mt-[8px]">Konfirmasi bahwa perawat datang ke rumahmu dan memberikan
            pelayanan terbaik.</p>

        <form action="/product/konfirmasi-perawatan/" method="post">
            @csrf
            <div x-data="{checklist: false}">
                <div
                    class="mt-[40px] md:mt-[100px] p-[24px] rounded-[10px] bg-gray-4 w-[300px] flex gap-[54px] text-white items-center">
                    <input type="checkbox" class="hidden" name="checklist" x-model="checklist" required>
                    <div class="w-[42px] h-[42px] rounded-[10px] bg-white cursor-pointer"
                        style="box-shadow: 1px 1px 7px rgba(0, 0, 0, 0.25);" x-on:click="checklist = !checklist">
                        <svg xmlns="http://www.w3.org/2000/svg" width="49" height="40" viewBox="0 0 49 40" fill="none"
                            :class="checklist ? '' : 'hidden'">
                            <path d="M16.3333 40L0 23.638L7.26325 16.362L16.3333 25.4737L41.7367 0L49 7.276L16.3333 40Z"
                                fill="#28B67E" />
                        </svg>
                    </div>
                    <p class="font-lg">Checklist</p>
                </div>
            </div>
            <div class="mt-8">
                <p class="text-gray-2">Kedatangan ke {{$id}} dari {{$od}} kali perawatan</p>
            </div>
            <div class="mt-[60px]  md:mt-[120px] max-w-[940px]">
                <label for="" class="text-gray-2">Bagaimana ulasan Anda mengenai perawat kami dalam merawat tanaman
                    Anda?</label>
                <div class="mt-[24px]">
                    <textarea name="catatan" id="" cols="30" rows="10"
                        class="rounded-[10px] border border-gray-4 w-full text-lg p-2 mt-2 focus:outline-none hover:border-warning"
                        rows="5"></textarea>
                </div>
                <input type="hidden" name="id" value="{{$id}}">
                <input type="hidden" name="od" value="{{$od}}">
                <input type="hidden" name="ed" value="{{$ed}}">
                <div class="mt-[80px] flex justify-end">
                    <button type="submit"
                        class="button font-lg-responsive bg-primary  text-white rounded-[10px] py-[10px] w-full md:w-[511px]">
                        Konfirmasi
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
