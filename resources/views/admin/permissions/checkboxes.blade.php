@foreach($permissions as $id => $name)
    <div class="checkbox">
        <label>
            <input type="checkbox"
                name="permissions[]" 
                value="{{ $name }}"
                {{ $user->permissions->contains($id)? 'checked' : ''}}
            > {{ $name }}
        </label>
    </div>
@endforeach