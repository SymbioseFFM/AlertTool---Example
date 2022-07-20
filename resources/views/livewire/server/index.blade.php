<div>
    <x-table title="Server" tableHeadings="Name,Standort,Kunde,IP,OS,Backup-Software" createModal="#create">
        @foreach ($servers as $s)
            <x-table-row>
                <x-table-body-id id="{{ $s->id }}" />
                <x-table-body-attribute value="{{ $s->name }}" />
                <x-table-body-attribute value="{{ $s->location->name }}" />
                <x-table-body-attribute value="{{ $s->customer->name }}" />
                <x-table-body-attribute value="{{ $s->ip }}" />
                <x-table-body-attribute value="{{ $s->os }}" />
                <x-table-body-attribute value="{{ $s->backup_software }}" />
                <x-table-body-actions edit="#edit" delete="#delete" objectId="{{ $s->id }}" />
            </x-table-row>
        @endforeach
    </x-table>

    <x-modal title="Neuen Server anlegen" function="create()" modalId="create">
        <x-input-field.text-row title="Name" attribute="name" placeholder="Name eingeben" model="s.name"/>
        <x-input-field.text-row title="IP" attribute="ip" placeholder="IP Adresse eingeben" model="s.ip"/>
        <x-input-field.text-row title="OS" attribute="os" placeholder="Betriebssystem eingeben" model="s.os"/>
        <x-input-field.text-row title="Backup Software" attribute="backup_software" placeholder="Backup Software eingeben" model="s.backup_software"/>
        <x-input-field.select title="Kunde" model="Customer" binding="s.customer_id"/>
        <x-input-field.select title="Standort" model="Location" binding="s.location_id"/>
    </x-modal>
    <x-modal title="Server bearbeiten" function="edit()" modalId="edit">
        <x-input-field.text-row title="Name" attribute="name" placeholder="Name eingeben" model="s.name"/>
        <x-input-field.text-row title="IP" attribute="ip" placeholder="IP Adresse eingeben" model="s.ip"/>
        <x-input-field.text-row title="OS" attribute="os" placeholder="Betriebssystem eingeben" model="s.os"/>
        <x-input-field.text-row title="Backup Software" attribute="backup_software" placeholder="Backup Software eingeben" model="s.backup_software"/>
        <x-input-field.select title="Kunde" model="Customer" binding="s.customer_id"/>
        <x-input-field.select title="Standort" model="Location" binding="s.location_id"/>
    </x-modal>
    <x-modal title="Server löschen" function="delete()" modalId="delete" confirm="Bestätigen">
        Sind Sie sich sicher, dass Sie den Server löschen wollen?
    </x-modal>
</div>
