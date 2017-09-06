@if (count($errors) > 0 || Session::has('error_message'))
    <a class="btn btn-primary btn-outline" id="inputErrors" data-plugin="toastr"
       data-message="
       @if(Session::has('error_message'))
           <div class='container'>{{ Session::get('error_message') }}</div>
       @else
           <div class='container' >
               <ul>
                    @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                    @endforeach
               </ul>
           </div>
       @endif

          "
       data-title="
       @if(Session::has('error_message'))
           <div class='container'><h4 style='color:white'>Error</h4></div>
       @else
            <div class='container'><h4 style='color:white'>Opps! There are some errors in your input</h4></div>
       @endif
       "
       data-progress-bar="true"
       data-close-button="true"
       data-tap-to-dismiss="false"
       data-position-class="toast-top-full-width"
       data-time-out="10000"
       data-icon-class="toast-just-text toast-danger"
       href="javascript:void(0)"
       role="button">Progress Bar</a>
    <script>
        (function($) {
            setTimeout(function() {
                $('#inputErrors').trigger('click');
            }, 2000);
        })(jQuery);
    </script>
@endif

@if (Session::has('flash_message'))
    <a class="btn btn-primary btn-outline" id="taskSuccess" data-plugin="toastr"
       data-message="<div class='container'>{{ Session::get('flash_message') }}</div>"
       data-title="<div class='container'><h4 style='color:white'>Success</h4></div>"
       data-progress-bar="true"
       data-close-button="true"
       data-tap-to-dismiss="false"
       data-position-class="toast-top-full-width"
       data-time-out="10000"
       data-icon-class="toast-just-text toast-success"
       href="javascript:void(0)"
       role="button">Progress Bar</a>
    <script>
        (function($) {
            setTimeout(function() {
                $('#taskSuccess').trigger('click');
            }, 2000);
        })(jQuery);
    </script>
@endif
