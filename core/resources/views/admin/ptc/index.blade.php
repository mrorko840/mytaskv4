@extends('admin.layouts.app')
@section('panel')
    {{-- <div class="container mb-2">
        <div class="row">
            @foreach ($plans as $plan)
                <div class="col-auto ps-0">

                    <button class="btn btn-warning" type="button" data-bs-toggle="collapse" data-target="#{{ str_replace(' ', '', $plan->name) }}"
                        data-bs-target="#{{ str_replace(' ', '', $plan->name) }}" aria-expanded="false"
                        aria-controls="{{ str_replace(' ', '', $plan->name) }}">
                        {{ str_replace(' ', '', $plan->name) }}
                    </button>
                </div>
            @endforeach
        </div>
    </div> --}}

    {{-- <div class="accordion" id="accordionExample">
        <div class="card">

            <div class="card-header" id="">
                @foreach ($plans as $plan)
                    <button class="btn btn-primary btn-block text-left" type="button" data-toggle="collapse"
                        data-target="#{{ str_replace(' ', '', $plan->name) }}" aria-expanded="true" aria-controls="{{ str_replace(' ', '', $plan->name) }}">
                        {{ $plan->name }}
                    </button>
                @endforeach
            </div>

            <table class="table table--light style--two">
                <thead>
                    <tr>
                        <th scope="col">@lang('Title')</th>
                        <th scope="col">@lang('Posted By')</th>
                        <th scope="col">@lang('Type')</th>
                        <th scope="col">@lang('Only for')</th>
                        <th scope="col">@lang('Duration')</th>
                        <th scope="col" hidden>@lang('Maximum View')</th>
                        <th scope="col" hidden>@lang('Viewed')</th>
                        <th scope="col" hidden>@lang('Remain')</th>
                        <th scope="col">@lang('Amount')</th>
                        <th scope="col">@lang('Status')</th>
                        <th scope="col">@lang('Action')</th>
                    </tr>
                </thead>
                <tbody id="headingOne">
                    @forelse($ads as $ptc)
                        @foreach ($plans as $plan)
                            @if ($plan->id == $ptc->plan_id)
                            <tr id="{{ str_replace(' ', '', $plan->name) }}" class="collapse active" aria-labelledby="{{ str_replace(' ', '', $plan->name) }}" data-parent="#accordionExample">
                                <td data-label="@lang('Title')">{{ strLimit($ptc->title, 20) }}</td>
                                <td data-label="@lang('Posted By')">
                                    @if ($ptc->user)
                                        <span class="fw-bold">{{ $ptc->user->fullname }}</span>
                                        <br>
                                        <span class="small">
                                            <a href="{{ route('admin.users.detail', $ptc->user_id) }}"><span>@</span>{{ $ptc->user->username }}</a>
                                        </span>
                                    @else
                                        <span class="fw-bold">@lang('Admin')</span>
                                    @endif
                                </td>
                                <td data-label="@lang('Type')">
                                    @php echo $ptc->typeBadge @endphp
                                </td>

                                <td data-label="@lang('Type')">
                                    @foreach ($plans as $plan)
                                        @if ($plan->id == $ptc->plan_id)
                                            {{ $plan->name }}
                                        @endif
                                    @endforeach

                                </td>

                                <td data-label="@lang('Duration')">{{ $ptc->duration }} @lang('Sec')
                                </td>
                                <td data-label="@lang('Maximum View')" hidden>{{ $ptc->max_show }}</td>
                                <td data-label="@lang('Viewed')" hidden>{{ $ptc->showed }}</td>
                                <td data-label="@lang('Remain')" hidden>{{ $ptc->remain }}</td>


                                <td data-label="@lang('Amount')" class="font-weight-bold">
                                    {{ showAmount($ptc->amount) }} {{ $general->cur_text }}</td>

                                <td data-label="@lang('Status')">
                                    @php echo $ptc->statusBadge @endphp
                                </td>
                                <td data-label="@lang('Action')"><a
                                        class="btn btn-outline--primary btn-sm"
                                        href="{{ route('admin.ptc.edit', $ptc->id) }}"><i
                                            class="la la-pen"></i> @lang('Edit')</a></td>
                            </tr>
                            @break
                            @endif
                        @endforeach
                    @empty
                        <tr>
                            <td class="text-muted text-center" colspan="100%">{{ __($emptyMessage) }}</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

        </div>
        
    </div> --}}

    {{-- <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body p-0">
                    <div class="table-responsive--sm">
                        <table class="table table--light style--two">
                            <thead>
                                <tr>
                                    <th scope="col">@lang('Title')</th>
                                    <th scope="col">@lang('Posted By')</th>
                                    <th scope="col">@lang('Type')</th>
                                    <th scope="col">@lang('Only for')</th>
                                    <th scope="col">@lang('Duration')</th>
                                    <th scope="col" hidden>@lang('Maximum View')</th>
                                    <th scope="col" hidden>@lang('Viewed')</th>
                                    <th scope="col" hidden>@lang('Remain')</th>
                                    <th scope="col">@lang('Amount')</th>
                                    <th scope="col">@lang('Status')</th>
                                    <th scope="col">@lang('Action')</th>
                                </tr>
                            </thead>
                            <tbody>

                                @forelse($ads as $ptc)
                                    @foreach ($plans as $plan)
                                        @if ($plan->id == $ptc->plan_id)
                                            <tr id="{{ str_replace(' ', '', $plan->name) }}" class="collapse active" aria-labelledby="{{ str_replace(' ', '', $plan->name) }}" data-parent="#accordionExample">
                                                <td data-label="@lang('Title')">{{ strLimit($ptc->title, 20) }}</td>
                                                <td data-label="@lang('Posted By')">
                                                    @if ($ptc->user)
                                                        <span class="fw-bold">{{ $ptc->user->fullname }}</span>
                                                        <br>
                                                        <span class="small">
                                                            <a
                                                                href="{{ route('admin.users.detail', $ptc->user_id) }}"><span>@</span>{{ $ptc->user->username }}</a>
                                                        </span>
                                                    @else
                                                        <span class="fw-bold">@lang('Admin')</span>
                                                    @endif
                                                </td>
                                                <td data-label="@lang('Type')">
                                                    @php echo $ptc->typeBadge @endphp
                                                </td>

                                                <td data-label="@lang('Type')">
                                                    @foreach ($plans as $plan)
                                                        @if ($plan->id == $ptc->plan_id)
                                                            {{ $plan->name }}
                                                        @endif
                                                    @endforeach
                                                </td>

                                                <td data-label="@lang('Duration')">{{ $ptc->duration }} @lang('Sec')
                                                </td>
                                                <td data-label="@lang('Maximum View')" hidden>{{ $ptc->max_show }}</td>
                                                <td data-label="@lang('Viewed')" hidden>{{ $ptc->showed }}</td>
                                                <td data-label="@lang('Remain')" hidden>{{ $ptc->remain }}</td>


                                                <td data-label="@lang('Amount')" class="font-weight-bold">
                                                    {{ showAmount($ptc->amount) }} {{ $general->cur_text }}</td>

                                                <td data-label="@lang('Status')">
                                                    @php echo $ptc->statusBadge @endphp
                                                </td>
                                                <td data-label="@lang('Action')">
                                                    <a class="btn btn-outline--primary btn-sm"
                                                        href="{{ route('admin.ptc.edit', $ptc->id) }}"><i
                                                            class="la la-pen"></i> @lang('Edit')
                                                        </a>
                                                        </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                @empty
                                    <tr>
                                        <td class="text-muted text-center" colspan="100%">{{ __($emptyMessage) }}</td>
                                    </tr>
                                @endforelse

                            </tbody>
                        </table>
                    </div>
                </div>
                @if ($ads->hasPages())
                    <div class="card-footer">
                        {{ paginateLinks($ads) }}
                    </div>
                @endif
            </div>
        </div>
    </div> --}}

    <ul class="nav nav-tabs justify-content-left" id="myTab" role="tablist">
        @foreach($plans as $plan)
        <li class="nav-item">
            <a style="background-color: #fff0;" class="nav-link  bg-info mx-1" id="yt-tab" data-toggle="tab" href="#{{ str_replace(' ', '', $plan->name) }}" role="tab"
                aria-controls="{{ str_replace(' ', '', $plan->name) }}" aria-selected="true">{{ $plan->name }}</a>
        </li>
        @endforeach

    </ul>
    
    <div class="tab-content" id="myTabContent">
        @foreach($ads as $ptc)
            @foreach ($plans as $plan)
            <tr>
                <div class="tab-pane fade" id="{{ str_replace(' ', '', $plan->name) }}" role="tabpanel" aria-labelledby="yt-tab">
                    @foreach($ads as $ptc)
                    @if ($plan->id == $ptc->plan_id)

                    <div class="card my-2">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col-auto pr-0">
                                    <div class="avatar avatar-50 rounded">
                                        <div class="background">
                                            @if ($ptc->ads_type == 4)
                                                <img width="50px" height="50px" src="{{ asset($activeTemplateTrue . '/assets/img/services/yt_logo.png') }}" alt="">
                                            @elseif ($ptc->ads_type == 1)
                                                <img width="50px" height="50px" src="{{ asset($activeTemplateTrue . '/assets/img/services/web_logo.png') }}" alt="">
                                            @elseif ($ptc->ads_type == 2)
                                                <img width="50px" height="50px" src="{{ asset($activeTemplateTrue . '/assets/img/services/image_logo.png') }}" alt="">
                                            @elseif ($ptc->ads_type == 3)
                                                <img width="50px" height="50px" src="{{ asset($activeTemplateTrue . '/assets/img/services/code_logo.png') }}" alt="">
                                            @endif
                                        </div>
                                    </div>
                                </div>
    
                                <div class="col align-self-center pr-0">
                                    <h6 class="font-weight-normal mb-1"> {{ strLimit($ptc->title, 20) }}</h6>
                                    <p class="small text-secondary">
                                        Only for 
                                        <span class="text-info">
                                            @if ($plan->id == $ptc->plan_id)
                                                {{ $plan->name }}
                                            @endif
                                        </span>
                                        <br>
                                        Duration: <span class="text-warning">{{ $ptc->duration }} @lang('Sec')</span>
                                    </p>
                                    
                                    
                                </div>
          
                                <div class="col-auto text-center">
    
                                    <h6 class="text-danger">
                                        {{ showAmount($ptc->amount) }} {{ $general->cur_text }}
                                    </h6>

                                    @php echo $ptc->statusBadge @endphp
                                    <br>

                                    <a class="badge badge--warning mt-1" href="{{ route('admin.ptc.edit', $ptc->id) }}">
                                        <i class="la la-pen"></i> @lang('Edit')
                                    </a>
    
                                </div>
    
                            </div>
                        </div>
                    </div>

                    @endif
                    @endforeach
                    
                </div>
            </tr>
                

            @endforeach
        @endforeach
            
    </div>



@endsection
@push('breadcrumb-plugins')
    <a href="{{ route('admin.ptc.create') }}" class="btn btn-outline--primary btn-sm"><i class="las la-plus"></i>
        @lang('Add New')</a>
@endpush

<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
    integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous">
</script>
