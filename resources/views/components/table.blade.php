<div class="p-4">
    <div class="card">
        <div class="card-header bg-secondary text-white">
            <h3 class="card-title text-bold">
                {{ $title }}
                @if($createModal)
                    <button
                        wire:click="createModal()"
                        title="Neu anlegen"
                        data-toggle="tooltip"
                        class="bg-primary text-white rounded-lg border-0 ml-2"
                    >
                        <i class="fas fa-plus text-2xl"></i>
                    </button>
                @endif
            </h3>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped table-sm">
                    <thead>
                        <tr>
                            <th style="width: 20px" class="pr-4">#</th>
                            @foreach ($tableHeadings as $th)
                                <th> {{ $th }} </th>
                            @endforeach
                            <th style="width: 125px">Aktionen</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{ $slot }}
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>