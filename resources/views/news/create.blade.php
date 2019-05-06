@extends('layouts.app')

@section('content')
    <div class="container" style="height: 700px !important">
        
        {!! Form::open([
            'method' => 'post',
            'url' => route('news.store'),
            'class' => 'form-horizontal',
            'enctype' => 'multipart/form-data'
        ]) !!}
            <div class="form-group">
                <div class="col-md-8">
                    {!! Form::label('title', 'Tiêu Đề', ['class' => 'col-form-label']) !!}
                    {!! Form::text('title', '', ['class' => 'form-control']) !!}
                    @if ($errors->has('title'))
                        <span class="text-danger">{{ $errors->first('title') }}</span>
                    @endif
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-8">
                    {!! Form::label('category', 'Thể Loại', ['class' => 'col-form-label']) !!}
                    
                    {!! Form::select('category', $categories, null, ['class' => 'custom-select']) !!}
                    
                    @if ($errors->has('category'))
                        <span class="text-danger">{{ $errors->first('category') }}</span>
                    @endif
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-8">
                    {!! Form::label('author', 'Tác Giả', ['class' => 'col-form-label']) !!}
                    {!! Form::text('author', '', ['class' => 'form-control']) !!}
                    @if ($errors->has('author'))
                        <span class="text-danger">{{ $errors->first('author') }}</span>
                    @endif
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-8">
                    {!! Form::label('thumbnail', 'Ảnh Đại Diện', ['class' => 'col-form-label']) !!}
                    {!! Form::file('thumbnail', ['class' => 'form-control-file', 'id' => 'input_thumnail']) !!}
                    @if ($errors->has('thumbnail'))
                        <span class="text-danger">{{ $errors->first('thumbnail') }}</span>
                    @endif
                    <img src="" alt="" id="preview_thumnail">
                </div>
            </div>
            <button type="submit" class="btn btn-success">Save</button>
            <a role="button" class="btn btn-danger" href="{{ route('news.index') }}">Cancel</a>
            <div></div>
            @if ($errors->has('content'))
                <span class="text-danger">{{ $errors->first('content') }}</span>
            @endif
            <textarea class="form-control" id="ckeditor1" name="content"></textarea>


        {!! Form::close() !!}
        
    </div>
@endsection

@section('js')
    <script type="text/javascript" rel="script" src="{{ asset('ckeditor/ckeditor.js') }}"></script>
    <script>
        CKEDITOR.replace( 'ckeditor1', {
            height: 500,
            filebrowserBrowseUrl: "{{ asset('ckfinder/ckfinder.html') }}",
            filebrowserImageBrowseUrl: "{{ asset('ckfinder/ckfinder.html?type=Images') }}",
            filebrowserFlashBrowseUrl: "{{ asset('ckfinder/ckfinder.html?type=Flash') }}",
            filebrowserUploadUrl: "{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files') }}",
            filebrowserImageUploadUrl: "{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images') }}",
            filebrowserFlashUploadUrl: "{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash') }}"
        });

    </script>

    <script>
        function readURL(input) {

            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                $('#preview_thumnail').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#input_thumnail").change(function() {
            readURL(this);
        });

    </script>
@endsection
