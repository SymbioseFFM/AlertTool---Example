<div>
    <x-table title="Standorte" tableHeadings="Name" createModal="#create">
        @foreach ($locations as $l)
            <x-table-row>
                <x-table-body-id id="{{ $l->id }}" />
                <x-table-body-attribute value="{{ $l->name }}" />
                <x-table-body-actions edit="#edit" delete="#delete" objectId="{{ $l->id }}" />
            </x-table-row>
        @endforeach
    </x-table>

    <x-modal title="Neuen Standort anlegen" function="create()" modalId="create">
        <x-input-field.text-row title="Name" attribute="name" placeholder="Standort eingeben" model="l.name"/>
    </x-modal>
    <x-modal title="Standort bearbeiten" function="edit()" modalId="edit">
        <x-input-field.text-row title="Name" attribute="name" placeholder="Standort eingeben" model="l.name"/>
    </x-modal>
    <x-modal title="Standort löschen" function="delete()" modalId="delete" confirm="Bestätigen">
        Sind Sie sich sicher, dass Sie den Standort löschen wollen?
    </x-modal>
</div>