@extends('layouts.app')

@section('content')
    <!--begin::Portlet-->
    <div class="col-xl-4">
        <div class="m-portlet m-portlet--full-height">
            <div class="m-portlet__body">
                <div class="m-widget4">
                    <div class="m-widget4__item">
                        <div class="m-widget4__ext">
                            <span class="m-widget4__icon m--font-brand">
                                <i class="fa fa-layer-group"></i>
                            </span>
                        </div>
                        <div class="m-widget4__info">
                            <span class="m-widget4__text">Total Domains</span>
                        </div>
                        <div class="m-widget4__ext">
                            <span class="m-widget4__number m--font-brand">
                                {{ $data['domain'] }}
                            </span>
                        </div>
                    </div>
                    <div class="m-widget4__item">
                        <div class="m-widget4__ext">
                            <span class="m-widget4__icon m--font-danger">
                                <i class="fa fa-chart-line"></i>
                            </span>
                        </div>
                        <div class="m-widget4__info">
                            <span class="m-widget4__text">Total Campaigns</span>
                        </div>
                        <div class="m-widget4__ext">
                            <span class="m-widget4__number m--font-danger">{{ $data['campaign'] }}</span>
                        </div>
                    </div>
                    <div class="m-widget4__item">
                        <div class="m-widget4__ext">
                            <span class="m-widget4__icon m--font-brand">
                                <i class="fa fa-server"></i>
                            </span>
                        </div>
                        <div class="m-widget4__info">
                            <span class="m-widget4__text">Total Servers</span>
                        </div>
                        <div class="m-widget4__ext">
                            <span class="m-widget4__number m--font-success">{{ $data['server'] }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end::Portlet-->
    <!--begin::Portlet-->
    <div class="col-xl-2">
        <div class="m-portlet m-portlet--half-height m-portlet--border-bottom-brand text-center" style="height: 216px;">
            <div class="m-portlet__body">
                <div class="m-widget26">
                    <div class="m-widget26__number m--font-success">Running<small style="font-size:1.25rem;color:#575962;">Rotator Status</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end::Portlet-->
@endsection