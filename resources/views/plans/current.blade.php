@extends('layouts.app', ['title' => __('Pages')])

@section('content')
    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
    </div>


    <div class="container-fluid mt--7">

        <div clas="row">
            <div class="col-12">
                @if (session('status'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('status') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
            </div>
        </div>

        <div class="row align-items-center">
            <?php $plan = $plans[1]; ?>
            <div class="col-md-{{ $col}}">
                <div style="border-radius: 2rem;" class="card shadow">
                    <div class="card-body">
                        <div class="header border-bottom border-light mb-3 pb-4">
                            <div id="plan_{{$plan['id']}}" class="row align-items-center">
                                <div class="col-4">
                                    <h3 class="text-dark text-nowrap mb-0">{{ $plan['name'] }}</h3>
                                </div>
                                <div class="col-8 text-right">
                                    <h3 class="mb-0 text-nowrap price_amount">@money($plan['price'], env('CASHIER_CURRENCY','usd'),env('DO_CONVERTION',true))/{{ $plan['period']==1?__('m'):__('y') }}</h3>
                                </div>
                                @if ($plan['price'] > 0)
                                    <div class="col-auto">
                                        <div class="mt-3">
                                            <div class="btn-toolbar">
                                                <div class="btn-group mr-2">
                                                    <button type="button" onClick="pricePlan({{$plan['id']}}, 'month')" class="btn btn-sm btn-primary">month</button>
                                                </div>
                                                <div class="btn-group">
                                                    <button type="button" onClick="pricePlan({{$plan['id']}}, 'year')" class="btn btn-sm btn-info">year</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                        @if(count($plans))
                        <div class="plan_list">
                            @foreach (explode(".",$plan['features']) as $feature)
                                <p class="m-0 mb-3">
                                    <span class="material-icons" style="font-size: inherit;">qr_code_2</span>
                                    {{ __($feature) }}
                                </p>
                            @endforeach
                        </div>
                        @endif

                        <div class="card-button mt-3 text-center">
                            @if($currentPlan&&$plan['id'].""==$currentPlan->id."")
                                <a href="" class="btn btn-primary disabled">{{__('Current Plan')}}</a>
                            @else
                                @if(strlen($plan['paddle_id'])>2&&env('SUBSCRIPTION_PROCESSOR','Stripe')=='Paddle')
                                    <a href="javascript:openCheckout({{ $plan['paddle_id'] }})" class="btn btn-primary">{{__('Switch to ').$plan['name']}}</a>
                                @endif
                                @if(strlen($plan['stripe_id'])>2&&env('SUBSCRIPTION_PROCESSOR','Stripe')=='Stripe')
                                    <a href="javascript:showStripeCheckout({{ $plan['id'] }} , '{{ $plan['name'] }}')" class="btn btn-primary">{{__('Switch to ').$plan['name']}}</a>
                                @endif
                                @if(strlen($plan['paypal_id'])>2&&env('SUBSCRIPTION_PROCESSOR','Stripe')=='PayPal')
                                    <div <?php echo 'id="paypal-button-container-'.$plan['paypal_id'].'"'; ?> ></div>
                                @endif

                                @if(strlen($plan['mollie_id'])>2&&env('SUBSCRIPTION_PROCESSOR','Stripe')=='Mollie')
                                    <a href="javascript:openMollieCheckout({{ $plan['id'] }})" class="btn btn-primary">{{__('Switch to ').$plan['name']}}</a>
                                @endif

                                @if(strlen($plan['paystack_id'])>2&&env('SUBSCRIPTION_PROCESSOR','Stripe')=='Paystack')
                                    <a href="javascript:openPaystackCheckout({{ $plan['id'] }})" class="btn btn-primary">{{__('Switch to ').$plan['name']}}</a>
                                @endif

                                @if($plan['price']>0&&(env('SUBSCRIPTION_PROCESSOR','Stripe')=='Local'||env('SUBSCRIPTION_PROCESSOR','Stripe')=='local'))
                                    <button  data-toggle="modal" data-target="#paymentModal{{ $plan['id']  }}" class="btn btn-primary">{{__('Upgrade to ').$plan['name']}}</button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="paymentModal{{ $plan['id']  }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-danger modal-dialog-centered modal-" role="document">
                                            <div class="modal-content bg-gradient-danger">
                                            <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">{{ $plan['name'] }}</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            </div>
                                            <div class="modal-body">
                                            {{ env('LOCAL_TRANSFER_INFO')}}
                                            <br /><br />
                                            {{ env('LOCAL_TRANSFER_ACCOUNT')}}
                                            <hr /><br />
                                            {{ __('Plan price ')}}<br />
                                            @money($plan['price'], env('CASHIER_CURRENCY','usd'),env('DO_CONVERTION',true))/{{ $plan['period']==1?__('m'):__('y') }}
                                            </div>
                                            <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Close') }}</button>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                @endif
                                @if(auth()->user()->hasBankAccount())
                                    <!-- <button  data-toggle="modal" data-target="#paymentModal{{ $plan['id']  }}" class="btn btn-primary">{{__('Upgrade to ').$plan['name']}}</button> -->
                                    <form action="{{ route('plans.subscribe') }}" method="post" id="flutterwave-payment-form">
                                        @csrf
                                        <input name="plan_id" id="plan_id" type="hidden" value="{{ $plan['id'] }}" />
                                        <script src="https://checkout.flutterwave.com/v3.js"></script>
                                        <button type="submit" class="btn btn-primary" onClick="{{'makePayment(event, this.form, {email:\'' . (auth()->user()?auth()->user()->email:env('MAIL_FROM_ADDRESS')) . '\', amount:\'' . $plan['price'] . '\', currency:\'' . env('CASHIER_CURRENCY','usd') . '\', app_name:\'' . env('APP_NAME', 'Nimopay') . '\', logo:\'' . env('APP_URL') . '/apple-touch-icon.png' . '\', name:\'' . (auth()->user()?auth()->user()->name:'Guest') . '\'})'}}">{{__('Upgrade to ').$plan['name']}}</button>
                                    </form>

                                    <!-- Modal -->
                                    <div class="modal fade" id="paymentModal{{ $plan['id']  }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-danger modal-dialog-centered modal-" role="document">
                                            <div class="modal-content bg-gradient-danger">
                                            <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">{{ $plan['name'] }}</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            </div>
                                            <div class="modal-body">
                                            {{ env('LOCAL_TRANSFER_INFO')}}
                                            <br /><br />
                                            {{ env('LOCAL_TRANSFER_ACCOUNT')}}
                                            <hr /><br />
                                            {{ __('Plan price ')}}<br />
                                            @money($plan['price'], env('CASHIER_CURRENCY','usd'),env('DO_CONVERTION',true))/{{ $plan['period']==1?__('m'):__('y') }}
                                            </div>
                                            <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Close') }}</button>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                @endif
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <?php $plan = $plans[0]; ?>
            <div class="col-md-{{ $col}}">
                <div style="border-radius: 2rem;" class="card bg-dark text-light shadow">
                    <div class="card-body">
                        <div class="header border-bottom border-light mb-3 pb-4">
                            <div id="plan_{{$plan['id']}}" class="row align-items-center">
                                <div class="col-4">
                                    <h3 class="text-white text-nowrap mb-0">{{ $plan['name'] }}</h3>
                                </div>
                                <div class="col-8 text-right">
                                    <h3 class="mb-0 text-nowrap price_amount">@money($plan['price'], env('CASHIER_CURRENCY','usd'),env('DO_CONVERTION',true))/{{ $plan['period']==1?__('m'):__('y') }}</h3>
                                </div>
                                @if ($plan['price'] > 0)
                                    <div class="col-auto">
                                        <div class="mt-3">
                                            <div class="btn-toolbar">
                                                <div class="btn-group mr-2">
                                                    <button type="button" onClick="pricePlan({{$plan['id']}}, 'month')" class="btn btn-sm btn-primary">month</button>
                                                </div>
                                                <div class="btn-group">
                                                    <button type="button" onClick="pricePlan({{$plan['id']}}, 'year')" class="btn btn-sm btn-info">year</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>

                        @if(count($plans))
                        <div class="plan_list">
                            @foreach (explode(".",$plan['features']) as $feature)
                                <p class="m-0 mb-3">
                                    <span class="material-icons" style="font-size: inherit;">qr_code_2</span>
                                    {{ __($feature) }}
                                </p>
                            @endforeach
                        </div>
                        @endif

                        <div class="card-button mt-3 text-center">
                            @if($currentPlan&&$plan['id'].""==$currentPlan->id."")
                                <a href="" class="btn btn-primary disabled">{{__('Current Plan')}}</a>
                            @else
                                @if(strlen($plan['paddle_id'])>2&&env('SUBSCRIPTION_PROCESSOR','Stripe')=='Paddle')
                                    <a href="javascript:openCheckout({{ $plan['paddle_id'] }})" class="btn btn-primary">{{__('Switch to ').$plan['name']}}</a>
                                @endif
                                @if(strlen($plan['stripe_id'])>2&&env('SUBSCRIPTION_PROCESSOR','Stripe')=='Stripe')
                                    <a href="javascript:showStripeCheckout({{ $plan['id'] }} , '{{ $plan['name'] }}')" class="btn btn-primary">{{__('Switch to ').$plan['name']}}</a>
                                @endif
                                @if(strlen($plan['paypal_id'])>2&&env('SUBSCRIPTION_PROCESSOR','Stripe')=='PayPal')
                                    <div <?php echo 'id="paypal-button-container-'.$plan['paypal_id'].'"'; ?> ></div>
                                @endif

                                @if(strlen($plan['mollie_id'])>2&&env('SUBSCRIPTION_PROCESSOR','Stripe')=='Mollie')
                                    <a href="javascript:openMollieCheckout({{ $plan['id'] }})" class="btn btn-primary">{{__('Switch to ').$plan['name']}}</a>
                                @endif

                                @if(strlen($plan['paystack_id'])>2&&env('SUBSCRIPTION_PROCESSOR','Stripe')=='Paystack')
                                    <a href="javascript:openPaystackCheckout({{ $plan['id'] }})" class="btn btn-primary">{{__('Switch to ').$plan['name']}}</a>
                                @endif

                                @if($plan['price']>0&&(env('SUBSCRIPTION_PROCESSOR','Stripe')=='Local'||env('SUBSCRIPTION_PROCESSOR','Stripe')=='local'))
                                    <button  data-toggle="modal" data-target="#paymentModal{{ $plan['id']  }}" class="btn btn-primary">{{__('Upgrade to ').$plan['name']}}</button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="paymentModal{{ $plan['id']  }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-danger modal-dialog-centered modal-" role="document">
                                            <div class="modal-content bg-gradient-danger">
                                            <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">{{ $plan['name'] }}</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            </div>
                                            <div class="modal-body">
                                            {{ env('LOCAL_TRANSFER_INFO')}}
                                            <br /><br />
                                            {{ env('LOCAL_TRANSFER_ACCOUNT')}}
                                            <hr /><br />
                                            {{ __('Plan price ')}}<br />
                                            @money($plan['price'], env('CASHIER_CURRENCY','usd'),env('DO_CONVERTION',true))/{{ $plan['period']==1?__('m'):__('y') }}
                                            </div>
                                            <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Close') }}</button>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                @endif
                                @if(auth()->user()->hasBankAccount())
                                    <!-- <button  data-toggle="modal" data-target="#paymentModal{{ $plan['id']  }}" class="btn btn-primary">{{__('Upgrade to ').$plan['name']}}</button> -->
                                    <form action="{{ route('plans.subscribe') }}" method="post" id="flutterwave-payment-form">
                                        @csrf
                                        <input name="plan_id" id="plan_id" type="hidden" value="{{ $plan['id'] }}" />
                                        <script src="https://checkout.flutterwave.com/v3.js"></script>
                                        <button type="submit" class="btn btn-primary" onClick="{{'makePayment(event, this.form, {email:\'' . (auth()->user()?auth()->user()->email:env('MAIL_FROM_ADDRESS')) . '\', amount:\'' . $plan['price'] . '\', currency:\'' . env('CASHIER_CURRENCY','usd') . '\', app_name:\'' . env('APP_NAME', 'Nimopay') . '\', logo:\'' . env('APP_URL') . '/apple-touch-icon.png' . '\', name:\'' . (auth()->user()?auth()->user()->name:'Guest') . '\'})'}}">{{__('Upgrade to ').$plan['name']}}</button>
                                    </form>

                                    <!-- Modal -->
                                    <div class="modal fade" id="paymentModal{{ $plan['id']  }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-danger modal-dialog-centered modal-" role="document">
                                            <div class="modal-content bg-gradient-danger">
                                            <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">{{ $plan['name'] }}</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            </div>
                                            <div class="modal-body">
                                            {{ env('LOCAL_TRANSFER_INFO')}}
                                            <br /><br />
                                            {{ env('LOCAL_TRANSFER_ACCOUNT')}}
                                            <hr /><br />
                                            {{ __('Plan price ')}}<br />
                                            @money($plan['price'], env('CASHIER_CURRENCY','usd'),env('DO_CONVERTION',true))/{{ $plan['period']==1?__('m'):__('y') }}
                                            </div>
                                            <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Close') }}</button>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                @endif
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <?php $plan = $plans[2]; ?>
            <div class="col-md-{{ $col}}">
                <div style="border-radius: 2rem;" class="card shadow">
                    <div class="card-body">
                        <div class="header border-bottom border-light mb-3 pb-4">
                            <div id="plan_{{$plan['id']}}" class="row align-items-center">
                                <div class="col-4">
                                    <h3 class="text-dark text-nowrap mb-0">{{ $plan['name'] }}</h3>
                                </div>
                                <div class="col-8 text-right">
                                    <h3 class="mb-0 text-nowrap price_amount">@money($plan['price'], env('CASHIER_CURRENCY','usd'),env('DO_CONVERTION',true))/{{ $plan['period']==1?__('m'):__('y') }}</h3>
                                </div>
                                @if ($plan['price'] > 0)
                                    <div class="col-auto">
                                        <div class="mt-3">
                                            <div class="btn-toolbar">
                                                <div class="btn-group mr-2">
                                                    <button type="button" onClick="pricePlan({{$plan['id']}}, 'month')" class="btn btn-sm btn-primary">month</button>
                                                </div>
                                                <div class="btn-group">
                                                    <button type="button" onClick="pricePlan({{$plan['id']}}, 'year')" class="btn btn-sm btn-info">year</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                        @if(count($plans))
                        <div class="plan_list">
                            @foreach (explode(".",$plan['features']) as $feature)
                                <p class="m-0 mb-3">
                                    <span class="material-icons" style="font-size: inherit;">qr_code_2</span>
                                    {{ __($feature) }}
                                </p>
                            @endforeach
                        </div>
                        @endif
                        
                        <div class="card-button mt-3 text-center">
                            @if($currentPlan&&$plan['id'].""==$currentPlan->id."")
                                <a href="" class="btn btn-primary disabled">{{__('Current Plan')}}</a>
                            @else
                                @if(strlen($plan['paddle_id'])>2&&env('SUBSCRIPTION_PROCESSOR','Stripe')=='Paddle')
                                    <a href="javascript:openCheckout({{ $plan['paddle_id'] }})" class="btn btn-primary">{{__('Switch to ').$plan['name']}}</a>
                                @endif
                                @if(strlen($plan['stripe_id'])>2&&env('SUBSCRIPTION_PROCESSOR','Stripe')=='Stripe')
                                    <a href="javascript:showStripeCheckout({{ $plan['id'] }} , '{{ $plan['name'] }}')" class="btn btn-primary">{{__('Switch to ').$plan['name']}}</a>
                                @endif
                                @if(strlen($plan['paypal_id'])>2&&env('SUBSCRIPTION_PROCESSOR','Stripe')=='PayPal')
                                    <div <?php echo 'id="paypal-button-container-'.$plan['paypal_id'].'"'; ?> ></div>
                                @endif

                                @if(strlen($plan['mollie_id'])>2&&env('SUBSCRIPTION_PROCESSOR','Stripe')=='Mollie')
                                    <a href="javascript:openMollieCheckout({{ $plan['id'] }})" class="btn btn-primary">{{__('Switch to ').$plan['name']}}</a>
                                @endif

                                @if(strlen($plan['paystack_id'])>2&&env('SUBSCRIPTION_PROCESSOR','Stripe')=='Paystack')
                                    <a href="javascript:openPaystackCheckout({{ $plan['id'] }})" class="btn btn-primary">{{__('Switch to ').$plan['name']}}</a>
                                @endif

                                @if($plan['price']>0&&(env('SUBSCRIPTION_PROCESSOR','Stripe')=='Local'||env('SUBSCRIPTION_PROCESSOR','Stripe')=='local'))
                                    <button  data-toggle="modal" data-target="#paymentModal{{ $plan['id']  }}" class="btn btn-primary">{{__('Upgrade to ').$plan['name']}}</button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="paymentModal{{ $plan['id']  }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-danger modal-dialog-centered modal-" role="document">
                                            <div class="modal-content bg-gradient-danger">
                                            <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">{{ $plan['name'] }}</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            </div>
                                            <div class="modal-body">
                                            {{ env('LOCAL_TRANSFER_INFO')}}
                                            <br /><br />
                                            {{ env('LOCAL_TRANSFER_ACCOUNT')}}
                                            <hr /><br />
                                            {{ __('Plan price ')}}<br />
                                            @money($plan['price'], env('CASHIER_CURRENCY','usd'),env('DO_CONVERTION',true))/{{ $plan['period']==1?__('m'):__('y') }}
                                            </div>
                                            <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Close') }}</button>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                @endif
                                @if(auth()->user()->hasBankAccount())
                                    <!-- <button  data-toggle="modal" data-target="#paymentModal{{ $plan['id']  }}" class="btn btn-primary">{{__('Upgrade to ').$plan['name']}}</button> -->
                                    <form action="{{ route('plans.subscribe') }}" method="post" id="flutterwave-payment-form">
                                        @csrf
                                        <input name="plan_id" id="plan_id" type="hidden" value="{{ $plan['id'] }}" />
                                        <script src="https://checkout.flutterwave.com/v3.js"></script>
                                        <button type="submit" class="btn btn-primary" onClick="{{'makePayment(event, this.form, {email:\'' . (auth()->user()?auth()->user()->email:env('MAIL_FROM_ADDRESS')) . '\', amount:\'' . $plan['price'] . '\', currency:\'' . env('CASHIER_CURRENCY','usd') . '\', app_name:\'' . env('APP_NAME', 'Nimopay') . '\', logo:\'' . env('APP_URL') . '/apple-touch-icon.png' . '\', name:\'' . (auth()->user()?auth()->user()->name:'Guest') . '\'})'}}">{{__('Upgrade to ').$plan['name']}}</button>
                                    </form>

                                    <!-- Modal -->
                                    <div class="modal fade" id="paymentModal{{ $plan['id']  }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-danger modal-dialog-centered modal-" role="document">
                                            <div class="modal-content bg-gradient-danger">
                                            <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">{{ $plan['name'] }}</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            </div>
                                            <div class="modal-body">
                                            {{ env('LOCAL_TRANSFER_INFO')}}
                                            <br /><br />
                                            {{ env('LOCAL_TRANSFER_ACCOUNT')}}
                                            <hr /><br />
                                            {{ __('Plan price ')}}<br />
                                            @money($plan['price'], env('CASHIER_CURRENCY','usd'),env('DO_CONVERTION',true))/{{ $plan['period']==1?__('m'):__('y') }}
                                            </div>
                                            <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Close') }}</button>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                @endif
                            @endif
                        </div>
                    </div>
                </div>
            </div>


        </div>


        <div class="row mt-4" id="stripe-payment-form-holder" style="display: none">
            <div class="col-md-12">
                <div class="card bg-secondary shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('Subscribe to') }} <span id="plan_name">PLAN_NAME</span></h3>
                            </div>

                        </div>
                    </div>
                    <div class="card-body">

                    <form action="{{ route('plans.subscribe') }}" method="post" id="stripe-payment-form"   >
                            @csrf
                            <input name="plan_id" id="plan_id" type="hidden" />
                            <div style="width: 100%;" class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                <input name="name" id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ __( 'Name on card' ) }}" value="{{auth()->user()?auth()->user()->name:""}}" required>
                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form">
                                <div style="width: 100%;" #stripecardelement  id="card-element" class="form-control">

                                <!-- A Stripe Element will be inserted here. -->
                              </div>

                              <!-- Used to display form errors. -->
                              <br />
                              <div class="" id="card-errors" role="alert">

                              </div>
                          </div>
                          <div class="text-center" id="totalSubmitStripe">
                            <button
                                v-if="totalPrice"
                                type="submit"
                                class="btn btn-success mt-4 paymentbutton"
                                >{{ __('Subscribe') }}</button>
                          </div>

                          </form>


                    </div>
                </div>
            </div>
        </div>

        @if($currentPlan)

        <div class="row mt-4">
            <div class="col-md-12">
                <div class="card bg-secondary shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('Your current plan') }}</h3>
                            </div>

                        </div>
                    </div>
                    <div class="card-body">
                        <p>{{ __('You are currently using the ').$currentPlan->name." ".__('plan') }}<p>
                            @if(strlen(auth()->user()->plan_status)>0)
                            <p>{{ __('Status').": "}} <strong>{{ auth()->user()->plan_status }}</strong><p>
                            @endif
                    </div>
                    @if(strlen(auth()->user()->cancel_url)>5 && env('SUBSCRIPTION_PROCESSOR','Stripe') != "PayPal")
                        <div class="card-footer py-4">
                            <a href="{{ auth()->user()->update_url }}" target="_blank" class="btn btn-warning">{{__('Update subscription')}}</a>
                            <a href="{{ auth()->user()->cancel_url }}" target="_blank" class="btn btn-danger">{{__('Cancel subscription')}}</a>
                        </div>
                    @elseif(env('SUBSCRIPTION_PROCESSOR','Stripe') == "PayPal"&&false)
                        <div class="card-footer py-4">
                            <form id="form-subscription-actions" action="{{ route('subscription.actions') }}" method="post" onsubmit="return false;">
                                @csrf
                                <input type="hidden" id="action" name="action" value=""/>

                                <button type="button" class="btn btn-warning btn-sub-actions" data-action="update">{{__('Update subscription')}}</button>
                                <button type="button" class="btn btn-danger btn-sub-actions" data-action="cancel">{{__('Cancel subscription')}}</button>
                            </form>
                        </div>
                    @endif
                </div>

            </div>

        </div>
        @endif


        @include('layouts.footers.auth')
    </div>
@endsection
@section('js')
<!-- Mollie -->

<script>
    function openMollieCheckout(plan_id){
        $('#plan_id').val(plan_id);

        document.getElementById('stripe-payment-form').submit();
    }

    function openPaystackCheckout(plan_id){
        $('#plan_id').val(plan_id);

        document.getElementById('stripe-payment-form').submit();
    }
</script>



<!-- PayPal -->
<script src="https://www.paypal.com/sdk/js?client-id=<?php echo env('PAYPAL_CLIENT_ID',''); ?>&vault=true&intent=subscription" data-sdk-integration-source="button-factory"></script>
<script type="text/javascript">
    $(".btn-sub-actions").click(function() {
        var action = $(this).attr('data-action');

        $('#action').val(action);
        document.getElementById('form-subscription-actions').submit();
    });

    function showLocalPayment(plan_name,plan_id){
        alert(plan_name);
    }
    function updateSubscribtion(subscriptionID, planID){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type:'POST',
            url: '/paypal/subscribe',
            dataType: 'json',
            data: {
                subscriptionID: subscriptionID,
                planID: planID
            },
            success:function(response){
                if(response.status){
                    location.replace(response.success_url);
                    //window.location.reload();
                }
            }, error: function (response) {
            }
        })
    }
    var plans = <?php echo json_encode($plans) ?>;
    var user = <?php echo json_encode(auth()->user()) ?>;
    var payment_processor = <?php echo json_encode(env('SUBSCRIPTION_PROCESSOR','Stripe')) ?>;

    if(payment_processor.toString() == "PayPal"){
        plans.forEach(plan => {
            if(plan.paypal_id != null && user.paypal_subscribtion_id != plan.paypal_id){
                paypal.Buttons({
                    style: {
                        shape: 'rect',
                        color: 'gold',
                        layout: 'vertical',
                        label: 'subscribe'
                    },
                    createSubscription: function(data, actions) {
                        return actions.subscription.create({
                            'plan_id': plan.paypal_id
                        });
                    },
                    onApprove: function(data, actions) {
                        updateSubscribtion(data.subscriptionID, plan.id);
                    }
                }).render('#paypal-button-container-'+plan.paypal_id);
            }
        });
    }
</script>

<!-- Stripe -->
<script src="https://js.stripe.com/v3/"></script>

<script>
  "use strict";
  var STRIPE_KEY="{{ env('STRIPE_KEY',"") }}";
  var ENABLE_STRIPE="{{ env('SUBSCRIPTION_PROCESSOR','Stripe')=='Stripe' }}";
  if(ENABLE_STRIPE){
      js.initStripe(STRIPE_KEY,"stripe-payment-form");
  }

  function showStripeCheckout(plan_id,plan_name){
   $('#plan_id').val(plan_id);
   $('#plan_name').html(plan_name);
   $('#stripe-payment-form-holder').show();
  }
</script>
<script src="{{ asset('custom') }}/js/checkout.js"></script>


<script src="https://cdn.paddle.com/paddle/paddle.js"></script>
<script type="text/javascript">
    "use strict";
    var paddleVendorID={{ env('paddleVendorID','')}};
    var currentUserEmail="{{ auth()->user()->email }}";
    Paddle.Setup({ vendor: paddleVendorID  });
	function openCheckout(product_id) {
		var form = document.getElementById('pre-checkout');
		Paddle.Checkout.open({
			product: product_id,
			email: currentUserEmail
		});
	}
</script>
@endsection
