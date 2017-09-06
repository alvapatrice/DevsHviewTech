@if( getenv('APP_ENV') == 'production')
    {{--<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/ckeditor/4.4.5/ckeditor.js"></script>--}}
    <script src="/js/bower_components/ckeditor/ckeditor.js"></script>
@else
    <script src="/js/bower_components/ckeditor/ckeditor.js"></script>
@endif
<script type="text/javascript" src="/js/bower_components/ng-ckeditor/ng-ckeditor.js"></script>
<script type="text/javascript" src="/js/ckeditorAngular.js"></script>