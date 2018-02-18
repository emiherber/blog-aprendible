<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog">
    <!-- inicio form -->
    <form method="POST" action="{{ route('admin.posts.strore') }}">
        {{ csrf_field() }}
        <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content modal-primary">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Agrega el título de tú nueva Publicación</h4>
            </div>
            <div class="modal-body">
                <div class="form-group {{ $errors->has('title') ? 'has-error':'' }}">
                    {{--  <label for="título de la publicación">
                        Título de la Publicación
                    </label>  --}}
                    <input 
                        value="{{ old('title') }}"
                        type="text" 
                        name="title" 
                        class="form-control" 
                        autofocus 
                        placeholder="Ingrese aquí el titulo de la publicación">
                    {!! $errors->first('title','<span class="help-block">:message</span>')!!}
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-info">Crear Publicación</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
        
        </div>
    </form>
</div>