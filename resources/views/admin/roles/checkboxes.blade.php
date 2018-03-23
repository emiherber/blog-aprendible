@foreach($roles as $role)
    <div class="checkbox">
        <label>
            <input type="checkbox"
                name="roles[]" 
                value="{{ $role->name }}"
                {{ $model->roles->contains($role->id)? 'checked' : ''}}
            > {{ $role->name }}: 
            <small>{{ $role->permissions->pluck('name')->implode(', ') }}</small>
        </label>
    </div>
@endforeach