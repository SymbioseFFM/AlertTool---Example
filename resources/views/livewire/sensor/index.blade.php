<div>

    <x-table title="Sensoren" tableHeadings="Name,Server,Kunde,Typ, Warnschwelle in Stunden" createModal="#create">
        @foreach ($sensors as $s)
            <x-table-row>
                <x-table-body-id id="{{ $s->id }}" />
                <x-table-body-attribute value="{{ $s->name }}" />
                <x-table-body-attribute value="{{ $s->server->name }}" />
                <x-table-body-attribute value="{{ $s->server->customer->name }}" />
                <x-table-body-attribute value="{{ $s->device->name }}" />
                @if($s->threshold)
                    <x-table-body-attribute value="{{ round($s->threshold / 60 / 60, 2) }}" />
                @else
                    <x-table-body-attribute value="" />   
                @endif
                <x-table-body-actions edit="#edit" delete="#delete" pattern="#pattern" objectId="{{ $s->id }}" />
            </x-table-row>
        @endforeach
    </x-table>

    <x-modal title="Neuen Sensor anlegen" function="create()" modalId="create">
        <x-input-field.text-row title="Name" attribute="name" placeholder="Name eingeben" model="s.name"/>
        <x-input-field.select title="Server" model="Server" binding="s.server_id"  />
        <x-input-field.select title="Typ" model="Device" binding="s.device_id"  />
        <div class="form-group">
            <div class="custom-control custom-switch">
                <input wire:model="threshold" type="checkbox" class="custom-control-input" id="threshold">
                <label class="custom-control-label" for="threshold">Möchten Sie für den Sensor eine Warnschwelle einrichten?</label>
            </div>
        </div>
        @if($threshold)
            <x-input-field.text-row title="Warnschwelle in Minuten" attribute="threshold" placeholder="1 Tag = 1440 Min | 7 Tage = 10080 Min" model="s.threshold"/>
        @endif
    </x-modal>

    <x-modal title="Sensor bearbeiten" function="edit()" modalId="edit">
        <x-input-field.text-row title="Name" attribute="name" placeholder="Name eingeben" model="s.name"/>
        <x-input-field.select title="Server" model="Server" binding="s.server_id"  />
        <x-input-field.select title="Typ" model="Device" binding="s.device_id"  />
        <div class="form-group">
            <div class="custom-control custom-switch">
            <input wire:model="threshold" type="checkbox" class="custom-control-input" id="editThreshold">
            <label class="custom-control-label" for="editThreshold">Möchten Sie für den Sensor eine Warnschwelle einrichten?</label>
            </div>
        </div>
        @if($threshold)
            <x-input-field.text-row title="Warnschwelle in Minuten" attribute="threshold" placeholder="1 Tag = 1440 Min | 7 Tage = 10080 Min" model="s.threshold"/>
        @endif
    </x-modal>

    <x-modal title="Sensor löschen" function="delete()" modalId="delete" confirm="Bestätigen">
        Sind Sie sich sicher, dass Sie den Sensor löschen wollen?
    </x-modal>

    <x-modal title="Kennung und Muster hinzufügen/bearbeiten" function="pattern()" modalId="pattern">
        <h3 class="text-center"> Kennung </h3>
        <div class="py-2"> Geben Sie hier eine Zeichenkette ein, welche die E-Mail einem Sensor zuordnet </div>
        <x-input-field.text-row title="Kennung" attribute="identifier" placeholder="Kennung der E-Mail angeben" model="identifier.pattern"/>
        <div class="py-2"> Wählen Sie aus, ob die Kennung im Absender, Betreff oder innerhalb der E-Mail zufinden ist  </div>
        <x-input-field.select title="Suche" model="Search" binding="search.id"  />
        <h3 class="text-center"> Muster </h3>
        <div class="py-2"> Geben Sie hier eine Zeichenkette ein, welche die E-Mail in die Kategorien "Erfolgreich, Warnung und Error" unterteilt </div>
        <x-input-field.text-row title="Erfolgreich" attribute="success" placeholder="Muster für Erfolgreich eingeben" model="pattern.success"/>
        <x-input-field.text-row title="Warnung" attribute="warning" placeholder="Muster für Warnung eingeben" model="pattern.warning"/>
        <x-input-field.text-row title="Error" attribute="error" placeholder="Muster für Error eingeben" model="pattern.error"/>
    </x-modal>

</div>
