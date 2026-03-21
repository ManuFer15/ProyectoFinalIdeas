@props(['label', 'name', 'type' => 'text'])
<div>
    <label for="{{$name}}" class="label">{{$label}}</label>
    <input type="{{$type}}" name="{{$name}}" id="{{$name}}" required class="input" value="{{old($name)}}" {{ $attributes }} />

    @error($name)
        <p clasS="error">{{$message}}</p>
    @enderror
</div>
