@error( $errorName )
    <script type="text/javascript">
        document.getElementById( "{{ $inputName }}" ).className += " {{ $errorClass }}";
    </script>
    <div class="{{ $errorClass }}">
        <p>{{ $message }}</p>
    </div>
@enderror