<div class="footer_subscription">
    <div class="container">
        <div class="row">
            <div class="col-md-12" ng-controller="SubscriptionController">
                <h4 class="text-center">Get notified when new tutorial is posted</h4>
                <div class="col-sm-offet-3 col-md-offset-3 col-sm-6 padd-tb-15 margin-bottom-15">
                    {!! Form::open(['route' => 'user.subscribe', 'name' => 'subscriptionForm',  'ng-submit' => 'subscribeUser($event)']) !!}
                    <div class="input-group footer-form" footer-form-directive>
                        {!! Form::email('email', null, [ "class" => "form-control", "placeholder" => "your@email.com", "ng-model" => "formData.email"]) !!}
                        <span class="input-group-btn">
                                <button class="btn" type="submit">Subscribe</button>
                              </span>
                    </div><!-- /input-group -->
                    {!! Form::close() !!}
                </div>
                <div class="col-md-12 message-box" ng-show="subscriptionStatus">
                    <p ng-bind="subscriptionStatus"></p>
                </div>
            </div>
        </div>
    </div>
</div>