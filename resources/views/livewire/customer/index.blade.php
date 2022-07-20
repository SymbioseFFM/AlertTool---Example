<div>
    <x-table title="Kunden" tableHeadings="Name,E-Mail,Domain,Nummer" createModal="#create">
        @foreach ($customers as $c)
            <x-table-row>
                <x-table-body-id id="{{ $c->id }}" />
                <x-table-body-attribute value="{{ $c->name }}" />
                <x-table-body-attribute value="{{ $c->email }}" />
                <x-table-body-attribute value="{{ $c->domain }}" />
                <x-table-body-attribute value="{{ $c->number }}" />
                <x-table-body-actions edit="#edit" delete="#delete" objectId="{{ $c->id }}" />
            </x-table-row>
        @endforeach
    </x-table>

    <x-modal title="Neuen Kunden anlegen" function="create()" modalId="create">
        <x-input-field.text-row title="Name" attribute="name" placeholder="Name eingeben" model="c.name"/>
        <x-input-field.text-row title="E-Mail" attribute="email" placeholder="E-Mail eingeben" model="c.email"/>
        <x-input-field.text-row title="Domain" attribute="domain" placeholder="Domäne eingeben" model="c.domain"/>
        <x-input-field.text-row title="Nummer" attribute="nummer" placeholder="+4912345678" model="c.number"/>
    </x-modal>
    <x-modal title="Kunden bearbeiten" function="edit()" modalId="edit">
        <x-input-field.text-row title="Name" attribute="name" placeholder="Name eingeben" model="c.name"/>
        <x-input-field.text-row title="E-Mail" attribute="email" placeholder="E-Mail eingeben" model="c.email"/>
        <x-input-field.text-row title="Domain" attribute="domain" placeholder="Name eingeben" model="c.domain"/>
        <x-input-field.text-row title="Nummer" attribute="nummer" placeholder="+4912345678" model="c.number"/>
    </x-modal>
    <x-modal title="Kunden löschen" function="delete()" modalId="delete" confirm="Bestätigen">
        Sind Sie sich sicher, dass Sie den Kunden löschen wollen?
    </x-modal>
</div>
