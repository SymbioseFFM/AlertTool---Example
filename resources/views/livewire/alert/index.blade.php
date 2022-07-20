<div>
    <div class="card card-secondary">
        <div class="card-header">
            <h3 class="card-title">
                <i class="fas fa-exclamation-triangle"></i>
                Meldungen
            </h3>
        </div>
        <div class="card-body">
            <a href="/alerts/error" class="link-dark">
                <div class="callout callout-danger">
                    <h5>Error ({{ $count['error'] }})</h5>
                    <p>Hier werden alle Meldungen angezeigt, wo das Muster <b>"Error"</b> zutrifft.</p>
                </div>
            </a>
            <a href="/alerts/warning" class="link-dark">
                <div class="callout callout-warning">
                    <h5>Warnung ({{ $count['warning'] }})</h5>
                    <p>Hier werden alle Meldungen angezeigt, wo das Muster <b>"Warnung"</b> zutrifft.</p>
                </div>
            </a>
            <a href="/alerts/success" class="link-dark">
                <div class="callout callout-success">
                    <h5>Erfolg ({{ $count['success'] }})</h5>
                    <p>Hier werden alle Meldungen angezeigt, wo das Muster <b>"Erfolgreich"</b> zutrifft.</p>
                </div>
            </a>
            <a href="/alerts/unknown" class="link-dark">
                <div class="callout callout-info">
                    <h5>Unbekannt ({{ $count['unknown'] }})</h5>
                    <p>Hier werden alle Meldungen angezeigt, wo die Kennung gefunden wurde, jedoch kein Muster zutraf.</p>
                </div>
            </a>
            <a href="/sensors/warning" class="link-dark">
                <div class="callout callout-warning">
                    <h5>Sensoren mit aktiv überschrittener Warnschwelle ({{ $count['sensor'] }})</h5>
                    <p>Hier werden alle Sensoren angezeigt, wo die Warnschwelle überschritten wurde und noch anhält.</p>
                </div>
            </a>
            <a href="/sensors/threshold" class="link-dark">
                <div class="callout callout-info">
                    <h5>Sensoren mit überschrittener Warnschwelle ({{ $count['threshold'] }})</h5>
                    <p>Hier werden alle Sensoren angezeigt, wo die Warnschwelle überschritten wurde.</p>
                </div>
            </a>
        </div>
    </div>
    
</div>