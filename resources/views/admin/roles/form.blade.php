{{ csrf_field() }} 
<div class="form-group {{ $errors->has('name') ? 'has-error':'' }}">
    <label for="identificador">Identificador</label>
    @if($role->exists)
        <input 
            type="text" 
            class="form-control" 
            value="{{ $role->name }}"
            placeholder="Ingrese el identificador del rol"
            disabled 
        >
    @else
        <input 
            type="text" 
            name="name" 
            class="form-control" 
            value="{{ old('name', $role->name) }}"
            placeholder="Ingrese el identificador del rol"
            autofocus
        >
    @endif
    {!! $errors->first('name','<span class="help-block">:message</span>')!!}
</div>
<div class="form-group {{ $errors->has('display_name') ? 'has-error':'' }}">
    <label for="display_name">Nombre</label>
    <input 
        type="text" 
        class="form-control" 
        name="display_name" 
        value="{{ old('display_name', $role->display_name)}}"
        placeholder="Ingrese el nombre del rol"
        autofocus
    >
    {!! $errors->first('display_name','<span class="help-block">:message</span>')!!}
</div>
<div class="form-group col-md-6">
    <label for="permissions">Permisos</label>
    @include('admin.permissions.checkboxes',['model' => $role])
</div>