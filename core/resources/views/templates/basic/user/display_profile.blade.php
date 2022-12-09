@extends($activeTemplate.'layouts.master')
@section('content')

    @php
        $yourLinks = getContent('links.content', true);
        $total_task = $user->daily_limit;
        if ($total_task > 0) {
            $remain_task_ratio = 100 * (($total_task - $user->clicks->where('view_date',Date('Y-m-d'))->count()) / $total_task);
            $complete_task_ratio = 100 * ($user->clicks->where('view_date',Date('Y-m-d'))->count() / $total_task);
        }
    @endphp
    <!-- App download Modal -->
    @include('templates.basic.includes.app_down_modal')
    
    
<body class="body-scroll d-flex flex-column h-100 menu-overlay" data-page="addmoney">

        @include(activeTemplate().'includes.side_nav')

        <!-- Begin page content -->
        <main class="flex-shrink-0 main has-footer">
            <!-- Fixed navbar -->
            @include(activeTemplate().'includes.top_nav')

            <!-- page content start -->
            <div class="container-fluid px-0">
                <div class="card overflow-hidden">
                    <div class="card-body p-0 h-150">
                        <div class="background">
                            <img src="{{ asset($activeTemplateTrue.'assets/img/image10.jpg') }}" alt="" style="display: none;">
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid top-70 text-center mb-4">
                <div class="avatar avatar-140 rounded-circle mx-auto shadow">
                    <div class="background">
                        <img src="{{ getImage(imagePath()['profile']['user']['path'].'/'. @$user->image,imagePath()['profile']['user']['size']) }}" alt="">
                    </div>
                </div>
            </div>

            <div class="container mb-4 text-center text-white">
                <h6 class="mb-1">{{ __($user->fullname) }}</h6>
                <p>{{@$user->address->country}}</p>
                {{-- <p class="mb-1">{{$user->email}}</p>
                <p>+{{$user->mobile}}</p> --}}
            </div>

            <div class="main-container">

                
                <div class="container mb-4">
                    <div class="row mb-4">
                        <div class="col-6">
                            <a href="#" class="btn btn-outline-default px-2 btn-block rounded" data-toggle="modal" data-target="#QrCodeModal">
                                <span class="material-icons mr-1">
                                    qr_code_scanner
                                </span> 
                                Share QR
                            </a>
                        </div>
                        <div class="col-6">
                            <a href="{{ route('plans') }}" class="btn btn-outline-default px-2 btn-block rounded">
                                <span class="material-icons mr-1">
                                    diamond
                                </span> 
                                @if($user->plan)
                                    @if($user->expire_date > now()) {{ __($user->plan->name) }} @endif 
                                    @if($user->expire_date < now()) <span class="text-danger">(@lang('Expired'))</span> @endif
                                @else
                                    @lang('No Plan')
                                @endif
                            </a>
                        </div>
                    </div>

                    <!-- Wallet Card -->
                    {{-- <div class="container">
                        <div class="wallet-card">
                            <!-- Balance -->
                            <div class="balance">
                                <div class="left">
                                    <span class="title">My Balance</span>
                                    <h1 class="total">{{ $general->cur_sym }} {{ showAmount($user->balance) }}</h1>
                                </div>
                                <div align="center" class="right">
                                    <a href="{{ route('plans') }}" class="text-primary">

                                        <div class="chip chip-media">
                                            <i class="chip-icon bg-primary">
                                                <ion-icon style="font-size:20px;" name="basket" role="img" class="md hydrated"
                                                    aria-label="person"></ion-icon>
                                            </i>
                                            <span class="chip-label">{{ __($user->plan ? $user->plan->name : 'No Plan') }}</span>
                                        </div>



                                    </a>
                                </div>
                            </div>
                            <!-- * Balance -->
                            <!-- Wallet Footer -->
                            <div class="wallet-footer">
                                <div class="item">
                                    <a href="{{ route('user.deposit') }}">
                                        <div class="shadow icon-wrapper bg-warning bg-gradiant">
                                            <ion-icon name="arrow-up-outline"></ion-icon>
                                        </div>
                                        <strong>Deposit</strong>
                                    </a>
                                </div>
                                <div class="item">
                                    <a href="{{ route('user.referred') }}">
                                        <div class="shadow icon-wrapper bg-secondary bg-gradiant">
                                            <ion-icon name="person-add-outline"></ion-icon>
                                        </div>
                                        <strong>Invite</strong>
                                    </a>
                                </div>
                                <div class="item">
                                    <a href="{{ route('user.withdraw') }}">
                                        <div class="shadow icon-wrapper bg-success bg-gradiant">
                                            <ion-icon name="arrow-down-outline"></ion-icon>
                                        </div>
                                        <strong>Withdraw</strong>
                                    </a>
                                </div>
                            </div>
                            <!-- * Wallet Footer -->
                        </div>
                    </div> --}}
                    <!-- Wallet Card -->

                    <div class="card border-0 mb-3 bg-danger text-white">
                        <div class="card-header mt-2">
                            <h6 class="mb-0">My Balance</h6>
                            <h3>{{ $general->cur_sym }} {{ showAmount($user->balance) }}</h3>
                        </div>
                        
                        <div class="card-footer">
                            <div class="row justify-content-center mb-3">

                                <div style="flex-direction: column;" class="col d-flex justify-content-center align-items-center">
                                    <a style="height: 50px; width: 50px; box-shadow: 0 0 0.5rem 0px #00000040 !important;" 
                                    class=" border-custom p-3 text-white shadow d-flex justify-content-center align-items-center" href="{{ route('user.deposit') }}">
                                        <span class="material-icons">
                                            arrow_upward
                                        </span>
                                    </a>
                                    <div class="text-center pt-1">
                                        Deposit
                                    </div>
                                </div>
                                <div style="flex-direction: column;" class="col d-flex justify-content-center align-items-center">
                                    <a style="height: 50px; width: 50px; box-shadow: 0 0 0.5rem 0px #00000040 !important;" 
                                    class=" border-custom p-3 text-white shadow d-flex justify-content-center align-items-center" href="{{ route('user.transfer.balance') }}">
                                        <span class="material-icons">
                                            swap_horiz
                                        </span>
                                    </a>
                                    <div class="text-center pt-1">
                                        Transfer
                                    </div>
                                </div>
                                <div style="flex-direction: column;" class="col d-flex justify-content-center align-items-center">
                                    <a style="height: 50px; width: 50px; box-shadow: 0 0 0.5rem 0px #00000040 !important;" 
                                    class=" border-custom p-3 text-white shadow d-flex justify-content-center align-items-center" href="{{ route('user.withdraw') }}">
                                        <span class="material-icons">
                                            arrow_downward
                                        </span>
                                    </a>
                                    <div class="text-center pt-1">
                                        Withdraw
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Task Ratio -->
                    <div class="row">

                        <div class="col-12 col-md-6 pb-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <h6 class="mb-1">Remain Today: <span class="text-danger">{{ $user->daily_limit - $user->clicks->where('view_date',Date('Y-m-d'))->count() }} Task</span></h6>
                                            <p class="text-secondary">Remain Rario: 
                                                <span class="text-danger">
                                                    {{ round(@$remain_task_ratio) }} %
                                                </span>
                                            </p>

                                        </div>
                                    </div>
                                    <div class="progress h-5 mt-3">
                                        <div class="progress-bar bg-danger" role="progressbar" style="width:{{ round(@$remain_task_ratio) }}%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <h6 class="mb-1">Complete Today: <span class="text-success">{{ $user->clicks->where('view_date',Date('Y-m-d'))->count() }} Task</span></h6>
                                            <p class="text-secondary">Complete Rario: 
                                                <span class="text-success">
                                                    {{ round(@$complete_task_ratio) }} %
                                                </span>
                                            </p>

                                        </div>
                                    </div>
                                    <div class="progress h-5 mt-3">
                                        <div class="progress-bar bg-success" role="progressbar" style="width:{{ round(@$complete_task_ratio) }}%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- total status -->
                {{-- <div class="container ">
                    <div class="row" hidden>
                        <div class="col text-center" >
                            <h5 class="subtitle">Most Exciting Feature</h5>
                            <p class="text-secondary">Take a look at our services</p>
                        </div>
                    </div>
                    
                    <div class="row text-center mt-3">
                        <div class="col-6 col-md-3">
                            <div class="card border-0 mb-4">
                                <div class="card-body">
                                    <div class="avatar avatar-60 bg-warning-light rounded-circle text-warning">
                                        <i class="material-icons vm md-36 text-template">savings</i>
                                    </div>
                                    <h3 class="mt-3 mb-0 font-weight-normal">{{ $general->cur_sym }} {{ showAmount($user->deposits->where('status',1)->sum('amount')) }}</h3>
                                    <p class="text-secondary small">Total Deposit</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-md-3">
                            <div class="card border-0 mb-4">
                                <div class="card-body">
                                    <div class="avatar avatar-60 bg-success-light rounded-circle text-success">
                                        <i class="material-icons vm md-36 text-template">add_shopping_cart</i>
                                    </div>
                                    <h3 class="mt-3 mb-0 font-weight-normal">{{ $general->cur_sym }} {{ showAmount($user->withdrawals->where('status',1)->sum('amount')) }}</h3>
                                    <p class="text-secondary small">Total Withdraw</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-md-3">
                            <div class="card border-0 mb-4">
                                <div class="card-body">
                                    <div class="avatar avatar-60 bg-warning-light rounded-circle text-warning">
                                        <i class="material-icons vm md-36 text-template">savings</i>
                                    </div>
                                    <h3 class="mt-3 mb-0 font-weight-normal">{{ $general->cur_sym }} {{ showAmount($total_invest) }}</h3>
                                    <p class="text-secondary small">Total Invest</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-md-3">
                            <div class="card border-0 mb-4">
                                <div class="card-body">
                                    <div class="avatar avatar-60 bg-success-light rounded-circle text-success">
                                        <i class="material-icons vm md-36 text-template">add_shopping_cart</i>
                                    </div>
                                    <h3 class="mt-3 mb-0 font-weight-normal">{{ $general->cur_sym }} {{ showAmount($ptc->sum('amount') + $total_commission) }}</h3>
                                    <p class="text-secondary small">Total Earned</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}

                <!-- Recent Transactions -->
                {{-- <div class="container mb-4">
                    <div class="card">
                        <div class="card-header border-bottom">
                            <h6 class="mb-0">Recent Transactions</h6>
                        </div>
                        <div class="card-body px-0 pt-0">
                            <ul class="list-group list-group-flush">

                                @forelse($transactions as $singleTrx)

                                <li class="list-group-item">
                                    <div class="row align-items-center">
                                        <div class="col-auto pr-0">
                                            <div class="avatar avatar-40 rounded">
                                                <div class="background">
                                                    @if($singleTrx->logo_type == 'deposit' || $singleTrx->remark == 'deposit')
                                                        <img src="{{ getImage(imagePath()['gateway']['path'].'/'. $singleTrx->trx_logo,imagePath()['gateway']['size'])}}" alt="">
                                                    @elseif($singleTrx->logo_type == 'withdraw' || $singleTrx->remark == 'withdraw')
                                                        <img src="{{ getImage(imagePath()['gateway']['path'].'/'. $singleTrx->trx_logo,imagePath()['gateway']['size'])}}" alt="">
                                                    @elseif($singleTrx->logo_type == 'admin' || ($singleTrx->remark == 'balance_add') || ($singleTrx->remark == 'balance_subtract') || ($singleTrx->remark == 'register_bonus'))
                                                        <img src="{{ asset($activeTemplateTrue . '/assets/img/services/' . $singleTrx->trx_logo ) }}" alt="">
                                                    @elseif(($singleTrx->remark == 'invest') || ($singleTrx->remark == 'Win_Bonus') || ($singleTrx->remark == 'invest_back'))
                                                        <img src="{{ getImage(getFilePath('game') . '/' . $singleTrx->trx_logo, getFileSize('game')) }}" alt="">
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col align-self-center pr-0">
                                            <h6 class="font-weight-normal mb-1">{{ __($singleTrx->details) }}</h6>
                                            <p class="small text-secondary">{{ showDateTime($singleTrx->created_at, 'd-m-Y, h:i a') }}</p>
                                        </div>

                                        <div class="col-auto">
                                            <h6 class="@if(($singleTrx->trx_type)=='+') {{'text-success'}} @else {{'text-danger'}} @endif">

                                                @if(getAmount($singleTrx->amount) != 0)
                                                {{ __($singleTrx->trx_type) }}
                                                {{ __($general->cur_sym) }}
                                                {{ getAmount($singleTrx->amount) }}
                                                
                                                @else
                                                {{ __($singleTrx->trx_type) }}
                                                {{ __($general->cur_sym) }}
                                                {{ getAmount($singleTrx->charge) }}
                                                @endif

                                            </h6>
                                        </div>

                                    </div>
                                </li>

                                @break($loop->index == 2)

                                @empty
                                    <div colspan="100%" class="text-center text-danger mt-2">No Transactions Found!</div>
                                @endforelse

                            </ul>
                            @forelse($transactions as $singleTrx)
                            <div align="center" class="card-footer p-0">
                                <a href="{{ route('user.transactions') }}" class="btn btn-sm btn-mini btn-outline-secondary rounded">Show more</a>
                            </div>
                            @break($loop->index == 0)

                            @empty

                            @endforelse
                            
                        </div>
                    </div>
                </div> --}}

                <!-- Profile Settings -->
                <div class="container">
                    <div class="card">
                        <div class="card-header">
                            <h6 class="mb-0">Profile</h6>
                        </div>
                        <div class="card-body px-0 pt-0">
                            <div class="list-group list-group-flush border-top border-color">
                                
                                <a href="{{ route('user.profile.setting') }}" class="list-group-item list-group-item-action border-color">
                                    <div class="row">
                                        <div class="col-auto">
                                            <div class="avatar avatar-50 bg-default-light text-default rounded">
                                                <span class="material-icons">manage_accounts</span>
                                            </div>
                                        </div>
                                        <div class="col align-self-center pl-0">
                                            <h6 class="mb-1">Profile Setting</h6>
                                            <p class="text-secondary">Update account informations</p>
                                        </div>
                                    </div>
                                </a>
                                
                                <a href="{{ route('user.address.setting') }}" class="list-group-item list-group-item-action border-color">
                                    <div class="row">
                                        <div class="col-auto">
                                            <div class="avatar avatar-50 bg-default-light text-default rounded">
                                                <span class="material-icons">location_city</span>
                                            </div>
                                        </div>
                                        <div class="col align-self-center pl-0">
                                            <h6 class="mb-1">My Address</h6>
                                            <p class="text-secondary">Update Address informations</p>
                                        </div>
                                    </div>
                                </a>

                                <a href="{{ route('user.change.password') }}" class="list-group-item list-group-item-action border-color">
                                    <div class="row">
                                        <div class="col-auto">
                                            <div class="avatar avatar-50 bg-default-light text-default rounded">
                                                <span class="material-icons">lock_open</span>
                                            </div>
                                        </div>
                                        <div class="col align-self-center pl-0">
                                            <h6 class="mb-1">Security Settings</h6>
                                            <p class="text-secondary">Change Password</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Reports -->
                <div class="container mt-3">
                    <div class="card">
                        <div class="card-header">
                            <h6 class="mb-0">Reports</h6>
                        </div>
                        <div class="card-body px-0 pt-0">
                            <div class="list-group list-group-flush border-top border-color">
                                
                                <a href="{{ route('user.commissions') }}" class="list-group-item list-group-item-action border-color">
                                    <div class="row">
                                        <div class="col-auto">
                                            <div class="avatar avatar-50 bg-success-light text-success rounded">
                                                <span class="material-icons">bubble_chart</span>
                                            </div>
                                        </div>
                                        <div class="col align-self-center pl-0">
                                            <h6 class="mb-1">Commissions</h6>
                                            <p class="text-secondary">Commissions from myTeam</p>
                                        </div>
                                    </div>
                                </a>

                                <a href="{{ route('user.transactions') }}" class="list-group-item list-group-item-action border-color">
                                    <div class="row">
                                        <div class="col-auto">
                                            <div class="avatar avatar-50 bg-success-light text-success rounded">
                                                <span class="material-icons">bar_chart</span>
                                            </div>
                                        </div>
                                        <div class="col align-self-center pl-0">
                                            <h6 class="mb-1">Transactions</h6>
                                            <p class="text-secondary">All Transactions Here</p>
                                        </div>
                                    </div>
                                </a>
                                
                                <a href="{{ route('user.deposit.history') }}" class="list-group-item list-group-item-action border-color">
                                    <div class="row">
                                        <div class="col-auto">
                                            <div class="avatar avatar-50 bg-success-light text-success rounded">
                                                <span class="material-icons">history_toggle_off</span>
                                            </div>
                                        </div>
                                        <div class="col align-self-center pl-0">
                                            <h6 class="mb-1">Deposit History</h6>
                                            <p class="text-secondary">All deposit records here.</p>
                                        </div>
                                    </div>
                                </a>
                                <a href="{{ route('user.withdraw.history') }}" class="list-group-item list-group-item-action border-color">
                                    <div class="row">
                                        <div class="col-auto">
                                            <div class="avatar avatar-50 bg-success-light text-success rounded">
                                                <span class="material-icons">history_toggle_off</span>
                                            </div>
                                        </div>
                                        <div class="col align-self-center pl-0">
                                            <h6 class="mb-1">Withdraw History</h6>
                                            <p class="text-secondary">All withdraw records here.</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Others -->
                <div class="container mt-3">
                    <div class="card">
                        <div class="card-header">
                            <h6 class="mb-0">Others</h6>
                        </div>
                        <div class="card-body px-0 pt-0">
                            <div class="list-group list-group-flush border-top border-color">
                                
                                <a href="{{ route('user.referred') }}" class="list-group-item list-group-item-action border-color">
                                    <div class="row">
                                        <div class="col-auto">
                                            <div class="avatar avatar-50 bg-warning-light text-warning rounded">
                                                <span class="material-icons">groups</span>
                                            </div>
                                        </div>
                                        <div class="col align-self-center pl-0">
                                            <h6 class="mb-1">My Team</h6>
                                            <p class="text-secondary">See Team Earning Informations</p>
                                        </div>
                                    </div>
                                </a>
                                <a href="javascript:void(0)" data-toggle="modal" data-target="#appDownloadModal" class="list-group-item list-group-item-action border-color">
                                    <div class="row">
                                        <div class="col-auto">
                                            <div class="avatar avatar-50 bg-warning-light text-warning rounded">
                                                <span class="material-icons">system_update</span>
                                            </div>
                                        </div>
                                        <div class="col align-self-center pl-0">
                                            <h6 class="mb-1">Download App</h6>
                                            <p class="text-secondary">Install Our Offical Application</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Exit -->
                <div class="container mt-3">
                    <div class="card">
                        <div class="card-header">
                            <h6 class="mb-0">Exit</h6>
                        </div>
                        <div class="card-body px-0 pt-0">
                            <div class="list-group list-group-flush border-top border-color">
                                <a href="{{ route('user.logout') }}" class="list-group-item list-group-item-action border-color">
                                    <div class="row">
                                        <div class="col-auto">
                                            <div class="avatar avatar-50 bg-danger-light text-danger rounded">
                                                <span class="material-icons">power_settings_new</span>
                                            </div>
                                        </div>
                                        <div class="col align-self-center pl-0">
                                            <h6 class="mb-1">Logout</h6>
                                            <p class="text-secondary">Logout from the application</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </main>

        <!-- QrCode Modal -->

        <div class="modal fade" id="QrCodeModal" tabindex="-1" role="dialog" aria-labelledby="QrCodeModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-sm modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="QrCodeModalCenterTitle">Invite with - QR Code</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div align="center" class="modal-body">
                        <img src="https://chart.googleapis.com/chart?cht=qr&chl={{ route('home') }}?reference={{ auth()->user()->username }}&chs=180x180&choe=UTF-8&chld=L|2" alt="QR Code">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

</body>










    @include(activeTemplate() . 'includes.bottom_nav')
@endsection
