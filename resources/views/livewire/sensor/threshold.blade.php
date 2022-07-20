<div>
    <x-table title="Sensoren und deren Warnschwellen" tableHeadings="Name,Server,Kunde,Typ,Offen/Abgeschlossen,Anfang der Überschreitung,Letztes Match, Warnschwelle in Stunden">
        @foreach ($sensors['active'] as $s)
            @foreach($s->thresholds()->where('progressed', 0)->get() AS $threshold)
                <x-table-row>
                    <x-table-body-id id="{{ $s->id }}" />
                    <x-table-body-attribute value="{{ $s->name }}" />
                    <x-table-body-attribute value="{{ $s->server->name }}" />
                    <x-table-body-attribute value="{{ $s->server->customer->name }}" />
                    <x-table-body-attribute value="{{ $s->device->name }}" />
                    @if($threshold->state == "start")
                        <x-table-body-attribute value="Offen" />
                    @elseif($threshold->state == "end")
                        <x-table-body-attribute value="Abgeschlossen" />
                    @else
                        <x-table-body-attribute value="" />
                    @endif
                    <x-table-body-attribute value="{{ date('d.m.Y H:i', $threshold->currentTime) }}" />
                    <x-table-body-attribute value="{{ date('d.m.Y H:i', $threshold->last_match) }}" />
                    <x-table-body-attribute value="{{ round($threshold->threshold / 60 / 60, 2) }}" />
                    <x-table-body-actions progressedThreshold="true" objectId="{{ $threshold->id }}"/>
                </x-table-row>
            @endforeach
        @endforeach
    </x-table>
    <div class="text-center">            
        <button 
            wire:click="markAllThresholdsAsRead()"
            class="bg-primary text-white rounded-lg border-0"
        >
        <i class="fas fa-arrow-down" data-toggle="tooltip" title="Alle als erledigt markieren"></i>
        </button>
        Alle als gelesen markieren
    </div>
    <x-table title="Archiv" tableHeadings="Name,Server,Kunde,Typ,Offen/Abgeschlossen,Anfang der Überschreitung,Letztes Match, Warnschwelle in Stunden">
        @foreach ($sensors['progressed'] as $s)
            @foreach($s->thresholds()->where('progressed', 1)->get() AS $threshold)
                <x-table-row>
                    <x-table-body-id id="{{ $s->id }}" />
                    <x-table-body-attribute value="{{ $s->name }}" />
                    <x-table-body-attribute value="{{ $s->server->name }}" />
                    <x-table-body-attribute value="{{ $s->server->customer->name }}" />
                    <x-table-body-attribute value="{{ $s->device->name }}" />
                    @if($threshold->state == "start")
                        <x-table-body-attribute value="Offen" />
                    @elseif($threshold->state == "end")
                        <x-table-body-attribute value="Abgeschlossen" />
                    @else
                        <x-table-body-attribute value="" />
                    @endif
                    <x-table-body-attribute value="{{ date('d.m.Y H:i', $threshold->currentTime) }}" />
                    <x-table-body-attribute value="{{ date('d.m.Y H:i', $threshold->last_match) }}" />
                    <x-table-body-attribute value="{{ round($threshold->threshold / 60 / 60, 2) }}" />
                    <x-table-body-actions />
                </x-table-row>
            @endforeach
        @endforeach
    </x-table>
</div>
