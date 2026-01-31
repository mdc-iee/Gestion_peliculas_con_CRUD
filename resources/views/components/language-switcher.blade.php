<select onchange="window.location.href=this.value" class="bg-gray-300 p-3" name="lang" id="">
    <option value="" disabled>{{__("Selecciona idioma")}}</option>
    @foreach(config("languages") as $code => $content)
        <option value="{{route("set_lang", $code)}}" {{app()->getLocale() === $code ? 'selected' : ''}}>{{$content['name']}} {{$content['flag']}}</option>
    @endforeach
</select>
