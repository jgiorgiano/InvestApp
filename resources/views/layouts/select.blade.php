<div class="form-group {{ $class ?? null}}">
    <label>{{ $label ?? $select ?? "ERROR"}}</label>
    {!! Form::select($select, $data , null, $atributes) !!}    
  </div>