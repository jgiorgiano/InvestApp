<div class="form-group {{ $class ?? null}}">
    <label>{{ $label ?? $input ?? "ERROR"}}</label>
    {!! Form::text($input, $value ?? null, $atributes ) !!}    
  </div>