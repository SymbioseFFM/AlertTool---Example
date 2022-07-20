<div>
    <div class="form-group">
        <label>{{ $title }}</label>
        <select 
            wire:model="{{ $binding }}"
            class="custom-select" 
        >
            <option value="">Bitte auswählen ...</option>
            @foreach ($options as $o)
                <option value="{{ $o->id }}">
                    {{ $o->name }}
                </option>
            @endforeach
        </select>
        @error($binding) <span class="text-danger error">{{ $message }} </span> @enderror
    </div>
</div>