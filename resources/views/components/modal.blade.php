<div x-data="{ show: false }">

    {{$trigger}}
    <div class="relative z-10  modal" aria-labelledby="modal-title" role="dialog" aria-modal="true" x-show="show">

        <div class="fixed inset-0 bg-gray-5 bg-opacity-75 transition-opacity"></div>

        <div class="fixed z-10 inset-0 overflow-y-auto">
            <div class="flex items-end sm:items-center   min-h-full p-4 w-full text-center sm:p-0">
                <div @click.away="show = false">
                    {{$content}}
                </div>
            </div>
        </div>
    </div>
</div>