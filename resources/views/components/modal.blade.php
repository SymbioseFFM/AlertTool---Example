<div>
    <div 
        wire:ignore.self
        id="{{ $modalId }}"
        tabindex="-1"
        class="modal fade"
    >
        <div class="modal-dialog">
        <div class="modal-content border-2 border-primary">
            <div class="modal-header">
            <h5 class="modal-title">{{ $title }}</h5>
            <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {{ $slot }}
            </div>
            <div class="modal-footer container">
                <p type="button" class="btn btn-secondary align-self-start" data-dismiss="modal">{{ $close }}</button>
                @if($save)
                    <p 
                        wire:click="{{ $function }}"
                        type="button"
                        class="btn btn-primary"
                    >
                        {{ $confirm  }}
                    </button>
                @endif
            </div>
        </div>
        </div>
    </div>
</div>
