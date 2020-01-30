@extends('layouts.app')

@section('main-content')
<div class="row">
    <div class="col-md-12 col-lg-12">
        <div class="mb-3 card" >
            <div class="card-header-tab card-header-tab-animation card-header">
                <div class="card-header-title">
                    <i class="header-icon lnr-apartment icon-gradient bg-love-kiss"> </i>
                    <form action="#">
                        <label for="">Relatório referente ao ano: </label>
                        <select name="year" id="Year">
                            <option value="2019">2019</option>
                            <option value="2018">2018</option>
                            <option value="2017">2017</option>
                        </select>
                    </form>
                </div>
            </div>
            <!-- body -->
            <div class="card-body">
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="tabs-eg-77">
                        <div class="card mb-3 widget-chart widget-chart2 text-left w-100">
                            <div class="widget-chat-wrapper-outer">
                                <div class="widget-chart-wrapper widget-chart-wrapper-lg opacity-10 m-0">
                                    <canvas id="myChart" width="300" height="150"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end body -->
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="{{ asset('js/report-charts.js') }}"></script>
@endpush
