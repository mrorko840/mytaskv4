@extends($activeTemplate . 'layouts.frontend')
@section('content')
    @guest
        @php
            header('Location: user/login');
            die();
        @endphp
    @endguest

<body class="body-scroll d-flex flex-column h-100 menu-overlay" data-page="addmoney">
    <!-- Top navbar -->
    @include($activeTemplate . 'includes.side_nav')

    <!-- Begin page content -->
    <main class="flex-shrink-0 main has-footer">
        <!-- Fixed navbar -->
        @include($activeTemplate . 'includes.top_nav')

        <div class="container mt-3 mb-4 text-center">
            <h2 class="text-white">{{ $general->cur_sym }} {{ showAmount($user->balance) }}</h2>
            <p class="text-white mb-4">Current Balance</p>
        </div>

        <div class="main-container">
            <!-- page content start -->

            <div class="container mb-1 mt-4">
                    
                        <div class="swiper-container swipercards">
                            <div class="swiper-wrapper pb-3">

                                @foreach ($plans as $plan)
                                <div class="swiper-slide ">
                                    <div class="card border-0
                                    @if ($loop->index == 0) 
                                        bg-secondary
                                    @elseif($loop->index == 1)
                                        bg-default
                                    @elseif($loop->index == 2)
                                        bg-info
                                    @elseif($loop->index == 3)
                                        bg-success
                                    @elseif($loop->index == 4)
                                        bg-warning
                                    @elseif($loop->index == 5)
                                        bg-danger
                                    @elseif($loop->index == 6)
                                        bg-orange
                                    @elseif($loop->index == 7)
                                        bg-purple 
                                    @else
                                        bg-default
                                    @endif
                                    text-white">
                                        <div class="card-header">
                                            <div class="row">
                                                <div class="col-auto">
                                                    <i class="material-icons vm text-template">diamond</i>
                                                </div>
                                                <div class="col pl-0">
                                                    <h6 class="mb-1">{{ __($plan->name) }}</h6>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col">
                                                    <h5 class="mb-0 mt-3">{{ $general->cur_sym }} {{ __(showAmount($plan->price)) }}</h5>
                                                </div>
                                                <div class="col">
                                                    <p class="mb-0 mt-3 text-right">@lang('Daily') {{ $plan->daily_limit }} @lang('Task')</p>
                                                </div>
                                            </div>
                                            
                                        </div>
                                        <div class="card-footer">
                                            <div class="row">
                                                <div class="col">
                                                    <p class="mb-0">{{ $plan->validity }} @lang('Days')</p>
                                                    <p class="small ">Validity</p>
                                                </div>
                                                {{-- <div class="col">
                                                    <p class="mb-0">{{ $plan->daily_limit }} @lang('Daily')</p>
                                                    <p class="small ">Task</p>
                                                </div> --}}
                                                <div class="col-auto align-self-center text-right">
                                                    @if (@auth()->user()->runningPlan && @auth()->user()->plan_id == $plan->id)
                                                        <button class="package-disabled btn btn-sm border-custom btn-outline-light">@lang('Current')</button>
                                                    @else
                                                        <button class="buyBtn btn btn-sm border-custom btn-outline-light" data-id="{{ $plan->id }}">@lang('BUY NOW')</button>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach


                            </div>
                        </div>
            </div>


        </div>
    </main>

    <!-- footer-->
    @include($activeTemplate . 'includes.bottom_nav')


    
</body>














    {{-- <section class="cmn-section price">
        <div class="container">
            <div class="row justify-content-center">
                @foreach ($plans as $plan)
                    <div class="col-xl-4 col-lg-4 col-md-6 mb-4">
                        <div class="single-price">
                            <div class="part-top">
                                <h3>{{ __($plan->name) }}</h3>
                                <h4>{{ __(showAmount($plan->price)) }} {{ $general->cur_text }}<br></h4>
                            </div>
                            <div class="part-bottom">
                                <ul>
                                    <li>@lang('Plan Details')</li>
                                    <li>@lang('Daily Limit') : {{ $plan->daily_limit }} @lang('PTC')</li>
                                    <li>@lang('Referral Bonus') : @lang('Upto') {{ $plan->ref_level }} @lang('Level')</li>
                                    <li>@lang('Plan Price') : {{ showAmount($plan->price) }} {{ __($general->cur_text) }}</li>
                                    <li>@lang('Validity') : {{ $plan->validity }} @lang('Days')</li>
                                </ul>

                                @if (@auth()->user()->runningPlan && @auth()->user()->plan_id == $plan->id)
                                    <button class="package-disabled">@lang('Current Package')</button>
                                @else
                                    <button class="buyBtn" data-id="{{ $plan->id }}">@lang('Subscribe Now')</button>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section> --}}

    
    {{-- Modal --}}

    <div class="modal fade" id="BuyModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <form method="post" action="{{ route('user.buyPlan') }}">
                    @csrf
                    <input type="hidden" name="id">
                    <div class="modal-header">
                        <strong class="modal-title"> @lang('Confirmation')</strong>

                        <button type="button" class="close btn btn-sm" data-bs-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        @auth
                        <strong>@lang('Are you sure to subscribe this plan')?</strong>
                            @if(auth()->user()->runningPlan)
                            <code class="d-block">@lang('If you subscribe to this one. Your old limitation will reset according to this package.')</code>
                            @endif
                        @else
                        <strong>@lang('Please login to subscribe plan')</strong>
                        @endauth
                    </div>
                    <div class="modal-footer">
                        @auth
                            <button type="button" class="btn btn-dark" data-bs-dismiss="modal">@lang('No')</button>
                            <button type="submit" class="btn btn--base">@lang('Yes')</button>
                        @else
                            <a href="{{ route('user.login') }}" class="btn btn--base w-100">@lang('Login')</a>
                        @endauth
                    </div>

                </form>

            </div>
        </div>
    </div>

@endsection
@push('style')
    <style>
        .package-disabled {
            opacity: 0.5;
        }
    </style>
@endpush
@push('script')
    <script type="text/javascript">
        (function($) {
            "use strict";
            $('.buyBtn').click(function() {
                var modal = $('#BuyModal');
                modal.find('input[name=id]').val($(this).data('id'));
                modal.modal('show');
            });
        })(jQuery);
    </script>
@endpush
