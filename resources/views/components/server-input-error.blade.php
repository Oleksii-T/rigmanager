@error( $inputName )
    <script type="text/javascript">
        document.querySelectorAll("select[name={{$inputName}}], input[name={{$inputName}}], textarea[name={{$inputName}}]")[0].className += " form-error";
    </script>
    <div class="form-error">{{$message}}</div>
@enderror
<div class="{{$inputName}} form-error dz-error hidden"></div>