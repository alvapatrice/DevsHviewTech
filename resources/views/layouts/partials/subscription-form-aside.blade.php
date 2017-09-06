<div class="aside_subscription">
        <div ng-controller="SubscriptionController" class="clearfix">
            <div class="sub_form_header">
                <h4 class="text-center">Don't Miss Out!</h4>
                <h5 class="text-center">Get updates on new articles, and other great technology stuff.</h5>
            </div>
            <div class="padd-tb-15 sub_form_container">
                {!! Form::open(['route' => 'user.subscribe', 'name' => 'subscriptionForm',  'ng-submit' => 'subscribeUser($event)']) !!}
                <div class="form-group">
                    {!! Form::email('email', null, [ "class" => "form-control", "placeholder" => "your@email.com", "ng-model" => "formData.email"]) !!}
                <button class="btn btn-block btn-subscribe" type="submit">Subscribe</button>
                </div><!-- /input-group -->
                {!! Form::close() !!}
            </div>
            <div class="col-md-12 message-box" ng-show="showStatus">
                <i class="fa fa-spinner fa-pulse" ng-hide="subscriptionStatus"></i>
                <p ng-bind="subscriptionStatus"ng-show="subscriptionStatus"></p>
            </div>
        </div>
</div>