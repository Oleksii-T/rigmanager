<div id="{{$row}}-edit" class="popup" style="width: 90%">
    <div class="popup-title">Enter new <span class="orange">{{$row}}</span></div>
    <div class="sure-dialog">
        <form method="POST" id="{{$row}}-edit-form" action="{{route('admin.post.edit.row', ['post'=>$id])}}">
            @csrf
            @method('PATCH')
            <input type="text" class="hidden" name="skip" value="0">
            <input type="text" class="hidden" name="row" value="{{$row}}">
            @if ($textarea)
                <textarea cols="30" rows="10" maxlength="9000" class="textarea" name="value" form="{{$row}}-edit-form">{{$value}}</textarea>
            @else
                <input type="text" class="input input-long" name="value" value="{{$value}}">
            @endif
            <div class="form-note" style="text-align:left;color:red">There is no validation!
                Be sure to enter valid values!</div>
            <button type="submit">SUBMIT</button>
        </form>
    </div>
</div>