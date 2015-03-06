@section('head')
    <script src="/compiled/js/epiceditor.js" type="text/javascript"></script>
@stop

<input type="hidden" name="_token" value="{{ csrf_token() }}">

<div class="form-group">
    {!! Form::label('title', 'Title') !!}
    {!! Form::text('title', null, ['class' => 'form-control']) !!}
</div>

<div id="epiceditor" style="border:1px solid #000;border-radius:4px;box-shadow:0px 0px 12px 2px #888">
    {!! Form::textarea('body', null) !!}
</div>

<div class="form-group">
    {!! Form::input('date', 'published_at', date('Y-m-d'), ['class' => 'form-control', 'style' => 'display:none']) !!}
</div>

<div class="form-group">
    {!! Form::label('tags', 'Tags') !!}
    {!! Form::select('tag_list[]', $tags, null, ['id' => 'tag_list', 'class' => 'form-control', 'multiple']) !!}
</div>

<div class="form-group">
    {!! Form::submit($submitButtonText, ['class' => 'btn btn-primary form-control']) !!}
</div>

@section('footer')
    <script>
        var editor = new EpicEditor().load();
    </script>
@stop