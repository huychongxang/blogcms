@section('script')
    <script src="{{asset('/backend/js/moment-with-locales.js')}}"></script>
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/3.1.3/js/bootstrap-datetimepicker.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/3.1.3/js/jasny-bootstrap.min.js"></script>
    <script src="//cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script>
    <script src="{{asset('/backend/plugins/tag-editor/jquery.caret.min.js')}}"></script>
    <script src="{{asset('/backend/plugins/tag-editor/jquery.tag-editor.min.js')}}"></script>

    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script>
        var options = {
            filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
            filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=',
            filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
            filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token='
        };
        CKEDITOR.replace('body', options);
        var option = {
            showClear: true,
            defaultDate: new Date(),
            format: 'Y-MM-DD HH:mm:ss'
        };
        jQuery(document).ready(function () {
            var tagOptions = {};
            tagOptions.autocomplete = {delay: 0, // show suggestions immediately
                position: { collision: 'flip' }, // automatic menu position up/down
                source: '/tags'};
            @if($post->exists)
                tagOptions.initialTags = {!! $post->tags_list !!};
            @endif
            $('input[name=post_tags]').tagEditor(tagOptions);

            $('#published_at').datetimepicker(option);
            $('#draft-btn').click(function (event) {
                event.preventDefault();
                $('#published_at').val("");
                $('#post-form').submit();
            });
        });

    </script>
@endsection
