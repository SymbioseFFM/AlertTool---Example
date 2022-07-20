<div>
    <div class="form-group row">
        <label for="{{ $attribute }}" class="col-sm-5 col-form-label">{{ $title }}</label>
        <div class="col-sm-7">
            <input 
                wire:model="{{ $model }}"
                id="{{ $attribute }}"
                type="text"
                placeholder="{{ $placeholder }}"
                class="form-control"
            >
            @error($model) <span class="text-danger error">{{ $message }} </span> @enderror
        </div>
    </div>
</div>