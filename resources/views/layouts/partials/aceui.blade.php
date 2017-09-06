@if( getenv('APP_ENV') == 'production')
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.1.8/ace.js"></script>
@else
<script type="text/javascript" src="/js/bower_components/ace-builds/src-min-noconflict/ace.js"></script>
@endif
<script type="text/javascript" src="/js/bower_components/angular-ui-ace/ui-ace.min.js"></script>
<script type="text/javascript" src="/js/aceAngular.js"></script>