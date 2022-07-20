<div>
    <x-table title="Sensoren deren Warnschwelle aktuell übertreten ist" tableHeadings="Name,Server,Kunde,Typ,Überfällig seit,Warnschwelle in Stunden">
        @foreach ($sensors as $s)
            <x-table-row>
                <x-table-body-id id="{{ $s->id }}" />
                <x-table-body-attribute value="{{ $s->name }}" />
                <x-table-body-attribute value="{{ $s->server->name }}" />
                <x-table-body-attribute value="{{ $s->server->customer->name }}" />
                <x-table-body-attribute value="{{ $s->device->name }}" />
                <x-table-body-attribute value="{{ date('d.m.Y H:i', $s->thresholds()->orderBy('id', 'DESC')->first()->last_match + $s->thresholds()->orderBy('id', 'DESC')->first()->threshold)  }}" />
                <x-table-body-attribute value="{{ round($s->threshold / 60 / 60, 2) }}" />
                <x-table-body-actions />
            </x-table-row>
        @endforeach
    </x-table>
</div>
