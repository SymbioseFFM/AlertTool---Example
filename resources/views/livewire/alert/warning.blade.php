<div>
    <x-table title="Meldungen mit Warnung" tableHeadings="E-Mail,Betreff,Kunde,Sensor">
        @foreach ($alerts['active'] as $a)
            <x-table-row>
                <x-table-body-id id="{{ $a->id }}" />
                <x-table-body-attribute value="{{ $a->email }}" />
                <x-table-body-attribute value="{{ $a->subject }}" />
                <x-table-body-attribute value="{{ $a->sensors()->first()->name }}" />
                <x-table-body-attribute value="{{ $a->sensors()->first()->server->customer->name }}" />
                <x-table-body-actions show="#show" progressed="true" objectId="{{ $a->id }}" />
            </x-table-row>
        @endforeach
    </x-table>
    <div class="text-center">            
        <button 
            wire:click="markAllAsRead(2)"
            class="bg-primary text-white rounded-lg border-0"
        >
        <i class="fas fa-arrow-down" data-toggle="tooltip" title="Alle als erledigt markieren"></i>
        </button>
        Alle als gelesen markieren
    </div>
    <x-table title="Archiv" tableHeadings="E-Mail,Betreff,Kunde,Sensor">
        @foreach ($alerts['progressed'] as $a)
            <x-table-row>
                <x-table-body-id id="{{ $a->id }}" />
                <x-table-body-attribute value="{{ $a->email }}" />
                <x-table-body-attribute value="{{ $a->subject }}" />
                <x-table-body-attribute value="{{ $a->sensors()->first()->name }}" />
                <x-table-body-attribute value="{{ $a->sensors()->first()->server->customer->name }}" />
                <x-table-body-actions show="#show" reverse="true" objectId="{{ $a->id }}" />
            </x-table-row>
        @endforeach
    </x-table>

    <x-modal title="E-Mail anzeigen" function="hideShowModal()" modalId="show" close="Schließen" save="">
        <div class="row">
            <div class="col"><b>Absender:</b> {{ $a->email }}</div>
        </div>
        <div class="row">
            <div class="col"><b>Empfangen am:</b> {{ date('d.m.Y H:i', $a->received_date) }} Uhr</div>
        </div>
        <div class="row">
            <div class="col text-center text-lg mt-4"><b>{{ $a->subject }}</b> </div>
        </div>
        <iframe src="{{ route('alertcontent', ['alertId' => $a->id]) }}" frameborder="0" class="w-full h-full" scrolling="yes" onload="resizeIframe(this)"></iframe>
    </x-modal>

</div>
<script>
    function resizeIframe(obj) 
    {
      obj.style.height = obj.contentWindow.document.documentElement.scrollHeight + 'px';
    }
</script>
