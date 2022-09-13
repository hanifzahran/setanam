@extends("layouts.admin.main",["active" => "Beranda"])

@section("content")
<div class="px-[24px]">
    <div class=" ">
        <div>
            <h4 class="h4 text-primary font-semibold">Form edit</h4>
        </div>

    </div>
    <form action="{{url('/admin/ubah-tanaman/'.$product->id.'/update')}}" method="post" enctype="multipart/form-data" class="mt-[32px] max-w-[1175px]">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-[32px]">
            <div>
                <label class="text-lg text-gray-3">Kategori</label>
                <input type="text" value="Tanaman" name="kategori" readonly
                    class="rounded-[10px] border border-gray-4 bg-gray-5  text-lg p-2 mt-2 focus:outline-none hover:border-warning w-full" />
            </div>
            <div>
                <label class="text-lg text-gray-3">Nama Item</label>
                <input type="text" name="nama" value="{{$product->nama}}"
                    class="rounded-[10px] border border-gray-4  text-lg p-2 mt-2 focus:outline-none hover:border-warning w-full" />
            </div>
        </div>
        <div class="grid grid-cols-1 mt-[32px]">
            <div>
                <label class="text-lg text-gray-3">Deskripsi item</label>
                <input type="text" name="deskripsi" value="{{$product->deskripsi}}"
                    class="rounded-[10px] border border-gray-4  text-lg p-2 mt-2 focus:outline-none hover:border-warning w-full" />
            </div>
        </div>

        <div class="mt-[32px] flex flex-col md:flex-row gap-[32px] md:gap-[100px] ">
            <div class="flex flex-col sm:flex-row gap-[32px] md:gap-[100px]">
                <div>
                    <label class="text-lg text-gray-3">Input jumlah</label>
                    <div class=" flex gap-2 items-center input-with-button">
                        <div class="mt-2  items-center py-2 px-1 rounded-[8px] w-[134px] flex justify-between"
                            style="box-shadow: 1px 1px 7px rgba(0, 0, 0, 0.25);">
                            <button type="button"
                                class="mi text-gray-3 cursor-pointer hover:opacity-80 tblPlusJumlah  ">add</button>
                            <input type="number" readonly name="jumlah" value="{{$product->jumlah}}"
                                class="focus:outline-none w-[60px] text-center font-lg hide-arrow jumlah-input"
                                />
                            <button type="button"
                                class="mi text-gray-3 cursor-pointer hover:opacity-80 tblMinJumlah ">remove</button>
                        </div>
                        <span>pcs</span>
                    </div>
                </div>
                <div>
                    <label class="text-lg text-gray-3">Input berat</label>
                    <div class=" flex gap-2 items-center input-with-button">
                        <div class="mt-2  items-center py-2 px-1 rounded-[8px] w-[134px] flex justify-between"
                            style="box-shadow: 1px 1px 7px rgba(0, 0, 0, 0.25);">
                            <button type="button"
                                class="mi text-gray-3 cursor-pointer hover:opacity-80 tblPlusJumlah  ">add</button>
                            <input type="number" readonly name="berat" value="{{$product->berat}}"
                                class="focus:outline-none w-[60px] text-center font-lg hide-arrow jumlah-input"
                                />
                            <button type="button"
                                class="mi text-gray-3 cursor-pointer hover:opacity-80 tblMinJumlah ">remove</button>
                        </div>
                        <span>kg</span>
                    </div>
                </div>
            </div>
            <div class="w-full ">
                <label class="text-lg text-gray-3">Input harga</label>
                <div class=" flex gap-2 items-center w-full input-with-button">
                    <div class="mt-2  items-center py-2 px-1 rounded-[8px]  flex justify-between w-full "
                        style="box-shadow: 1px 1px 7px rgba(0, 0, 0, 0.25);">
                        <button type="button"
                            class="mi text-gray-3 cursor-pointer hover:opacity-80 tblPlusJumlah  ">add</button>
                        <div class="flex items-center">
                            <span class="text-gray-3 ml-2">Rp</span>
                            <input type="number"
                                class="focus:outline-none  text-center font-lg hide-arrow jumlah-input w-full "
                                   name="harga" value="{{$product->harga}}"/>
                        </div>
                        <button type="button"
                            class="mi text-gray-3 cursor-pointer hover:opacity-80 tblMinJumlah ">remove</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-[32px] grid grid-cols-2 md:grid-cols-3 gap-[32px]">
            <div>
                <label class="text-lg text-gray-3">Jenis pot</label>
                <select name="jenis_pot" id=""
                    class="rounded-[10px] border border-gray-4  text-lg p-2 mt-2 focus:outline-none hover:border-warning w-full">
                    <option value="Kaleng" {{$product->jenis_pot == "Kaleng" ? 'selected' : ''}}>Kaleng</option>
                    <option value="Plastik" {{$product->jenis_pot == "Plastik" ? 'selected' : ''}}>Plastik</option>
                    <option value="Kayu" {{$product->jenis_pot == "Kayu" ? 'selected' : ''}}>Kayu</option>
                    <option value="Porselen" {{$product->jenis_pot == "Porselen" ? 'selected' : ''}}>Porselen</option>
                    <option value="Sabut Kelapa" {{$product->jenis_pot == "Sabut Kelapa" ? 'selected' : ''}}>Sabut Kelapa</option>
                    <option value="Semen" {{$product->jenis_pot == "Semen" ? 'selected' : ''}}>Semen</option>
                    <option value="Tanah Liat" {{$product->jenis_pot == "Tanah Liat" ? 'selected' : ''}}>Tanah Liat</option>
                </select>
            </div>
            <div>
                <label class="text-lg text-gray-3">Intensitas cahaya</label>
                <select name="intensitas_cahaya" id=""
                    class="rounded-[10px] border border-gray-4  text-lg p-2 mt-2 focus:outline-none hover:border-warning w-full">
                    <option value="Rendah" {{$product->intensitas_cahaya == "Rendah" ? 'selected' : ''}}>Rendah</option>
                    <option value="Sedang" {{$product->intensitas_cahaya == "Sedang" ? 'selected' : ''}}>Sedang</option>
                    <option value="Tinggi" {{$product->intensitas_cahaya == "Tinggi" ? 'selected' : ''}}>Tinggi</option>
                </select>
            </div>
            <div>
                <label class="text-lg text-gray-3">Kebutuhan air</label>
                <select name="kebutuhan_air" id=""
                    class="rounded-[10px] border border-gray-4  text-lg p-2 mt-2 focus:outline-none hover:border-warning w-full">
                    <option value="Rendah" {{$product->kebutuhan_air == "Rendah" ? 'selected' : ''}}>Rendah</option>
                    <option value="Sedang" {{$product->kebutuhan_air == "Sedang" ? 'selected' : ''}}>Sedang</option>
                    <option value="Tinggi" {{$product->kebutuhan_air == "Tinggi" ? 'selected' : ''}}>Tinggi</option>
                </select>
            </div>
        </div>

        <div class="mt-[32px] grid grid-cols-2 md:grid-cols-3 gap-[32px]">
            <div>
                <label class="text-lg text-gray-3">Upload gambar</label>
                <div
                    class="rounded-[10px] border border-gray-4  text-lg p-2 mt-2 focus:outline-none hover:border-warning w-full flex justify-between items-center input-file-group">
                    <span class="file-name truncate"> No file selected</span>

                    <button type="button"
                        class="bg-primary py-1 px-2 text-white rounded-[10px] cursor-pointer hover:opacity-80 input-file-button">Browse</button>
                    <input type="file" name="gambar"
                        class="rounded-[10px] border border-gray-4  text-lg p-2 mt-2 focus:outline-none hover:border-warning w-full hidden input-file" />
                </div>
            </div>
            <div>
                <label class="text-lg text-gray-3">Input lokasi</label>
                <select name="lokasi" id=""
                    class="rounded-[10px] border border-gray-4  h-[50px] text-lg p-2 mt-2 focus:outline-none hover:border-warning w-full">
                    <option value="Jakarta" {{$product->lokasi == "Jakarta" ? 'selected' : ''}}>Jakarta</option>
                    <option value="Bandung" {{$product->lokasi == "Bandung" ? 'selected' : ''}}>Bandung</option>
                    <option value="Surabaya" {{$product->lokasi == "Surabaya" ? 'selected' : ''}}>Surabaya</option>
                </select>
            </div>
            <div></div>
        </div>

        <div class="mt-[32px] flex flex-col md:flex-row justify-end gap-[32px]">
            <button class="btn-center bg-primary md:w-[348px] text-white" type="submit">Ubah</button>
            <a href="/admin/ubah" class="flex items-center">
                <button class="font-xl-responsive  md:w-[348px]" type="button">Batal</button>
            </a>
        </div>
    </form>
</div>

@section("script")
<script>
    $(".tblPlusJumlah").on('click',function (e) {
        let parent =  $(this).parents(".input-with-button");
        let input =parent.find("input");

        input.val(parseInt(input.val()) + 1);
    });
    $(".tblMinJumlah").on('click',function (e) {
        let parent =  $(this).parents(".input-with-button");
        let input =parent.find("input");
        if(parseInt(input.val()) > 0 ){

            input.val(parseInt(input.val()) - 1);
        }
    });

    $(".input-file-button").on('click',function(){
        let parent =  $(this).parents(".input-file-group");
        parent.find("input").click();
    })

    $(".input-file").on("input",function(e){
        let parent =  $(this).parents(".input-file-group");
        parent.find(".file-name").text(e.target.files[0].name);
    })


</script>
@endsection

@endsection
