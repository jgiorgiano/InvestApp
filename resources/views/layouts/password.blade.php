<div class="form-group {{ $class ?? null}}">
    <label>{{ $label ?? $input ?? "ERROR"}}</label>
    {!! Form::password($input, $atributes ) !!}    
  </div>