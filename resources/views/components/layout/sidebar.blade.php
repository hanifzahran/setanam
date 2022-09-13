<div>
    @foreach ($sidebarData as $data)
    <div class="@if ($loop->index > 0 ) mt-[110px] @endif">
        <h6 class="font-2xl-responsive w-full">{{$data['name']}}</h6>
        <div class="w-[212px]  mt-[34px] flex flex-col gap-[32px]">
            @foreach ($data['data'] as $child)
            <button data-filter="{{$data['key']}}={{$child}}" onclick="reloadPage(this)"
                class="btn-center @if($child === request()[$data['key']]) bg-primary text-white @endif">{{$child}}
            </button>
            @endforeach
        </div>
    </div>
    @endforeach
</div>