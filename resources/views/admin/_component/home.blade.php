@extends('admin.master')
@section('style')
{{ Html::style('bower/AdminLTE/plugins/jvectormap/jquery-jvectormap-1.2.2.css') }}
{{ Html::style('css/admin/style.css') }}
@endsection

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            {{ __('Sales Report') }}
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i>{{ __('Home') }}</a></li>
            <li class="active">{{ __('sales report') }}</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-lg-4 col-xs-6">
                <div class="small-box bg-aqua pointer" v-on:click="salesChosen">
                    <div class="inner">
                        <h3>{{ __('150') }}</h3>
                        <p>{{ __('Sales') }}</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>
                    <a href="{{ route('admin.list_bill') }}" class="small-box-footer">{{ __('More info') }} <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-4 col-xs-6">
                <div class="small-box bg-green pointer" v-on:click="bookingChosen">
                    <div class="inner">
                        <h3>53<sup style="font-size: 20px">%</sup></h3>
                        <p>{{ __('Booking') }}</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="{{ route('admin.booking') }}" class="small-box-footer">{{ __('More info') }} <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-4 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-yellow pointer" v-on:click="customerChosen">
                    <div class="inner">
                        <h3>{{ __('44') }}</h3>
                        <p>{{ __('Customer') }}</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                    <a href="{{ route('admin.customer') }}" class="small-box-footer">{{ __('More info') }} <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 ">
                <div class="box">
                    <div class="box-header with-border">
                        <ul class="nav nav-tabs">
                            <li class="active"><a data-toggle="tab" v-on:click="selectTypeDay" href="#day">{{ __('Day') }}</a></li>
                            <li><a data-toggle="tab" v-on:click="selectTypeMonth" href="#month">{{ __('Month') }}</a></li>
                            <li><a data-toggle="tab" v-on:click="selectTypeYear" href="#year">{{ __('Year') }}</a></li>
                        </ul>

                        <div class="tab-content">
                            <div id="day" class="tab-pane fade in active">
                                <h3 class="text-center">{{ __('Bar chart Dayly Report') }}</h3>
                                <div class=" wrap-select-date">
                                    <div class="form-group col-md-5">
                                        <label for="start">Start date:</label>
                                        <input type="date" class="form-control" id="start-date" v-model="inputDate.start_date" v-on:change="selectStartDay">
                                    </div>
                                    <div class="form-group col-md-5">
                                        <label for="end">End date:</label>
                                        <input type="date" class="form-control" id="end-date" v-model="inputDate.end_date" v-on:change="selectEndDay">
                                    </div>
                                    <div class="form-group col-md-2"  v-bind:style="{visibility: statusVisible}">
                                        <label for="status">Status:</label>
                                        <select  class="form-control" v-model="inputStatus" v-on:change="selectStatus">
                                            <option value="">{{ __('All') }}</option>
                                            <option value="0">{{ __('Pending') }}</option>
                                            <option value="1">{{ __('Complete') }}</option>
                                            <option value="2">{{__('Cancel')}}</option>
                                        </select>
                                    </div>
                                    <p class="text-center">
                                        <strong>{{ __('Bar Chart Daily Report') }} </strong>
                                    </p>
                                </div>
                                <div class="col-md-6">
                                {{-- <canvas id="myChart" width="400" height="400"></canvas> --}}
                                    <main>
                                        <bar-chart-day :type="checkTypeReport" :data1="dataChartDay"></bar-chart-day>
                                    </main>
                                </div>
                                <div class="col-md-6">
                                    <p class="text-center">
                                        <strong>{{ __('Stylist - Total Hair') }}</strong>
                                    </p>
                                    <div class="col-md-6">
                                        <div class="progress-group">
                                            <span class="progress-text">Stylist 1</span>
                                            <span class="progress-number"><b>160</b>/200</span>

                                            <div class="progress sm">
                                                <div class="progress-bar progress-bar-aqua" style="width: 10%"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="progress-group">
                                            <span class="progress-text">Stylist 6</span>
                                            <span class="progress-number"><b>160</b>/200</span>

                                            <div class="progress sm">
                                                <div class="progress-bar progress-bar-aqua" style="width: 20%"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="month" class="tab-pane">
                                <h3 class="text-center">{{ __('Month Report') }}</h3>
                                <div class=" wrap-select-date">
                                    <div class="form-group col-md-5">
                                        <label for="start">Start Month:</label>
                                        <input type="date" class="form-control" id="start-date" v-model="inputMonth.start_date" v-on:change="selectStartDay">
                                    </div>
                                    <div class="form-group col-md-5">
                                        <label for="end">End Month:</label>
                                        <input type="date" class="form-control" id="end-date" v-model="inputMonth.end_date" v-on:change="selectEndDay">
                                    </div>
                                    <div class="form-group col-md-2" v-bind:style="{visibility: statusVisible}">
                                        <label for="status">Status:</label>
                                        <select  class="form-control" v-model="inputStatus" v-on:change="selectStatus">
                                            <option value="">{{ __('All') }}</option>
                                            <option value="0">{{ __('Pending') }}</option>
                                            <option value="1">{{ __('Complete') }}</option>
                                            <option value="2">{{__('Cancel')}}</option>
                                        </select>
                                    </div>
                                    <p class="text-center">
                                        <strong>{{ __('Bar Chart Monthly Report') }} </strong>
                                    </p>
                                </div>
                                <div class="col-md-6">
                                    <main>
                                        <bar-chart-month :type="checkTypeReport" :data2="dataChartMonth"></bar-chart-month>  
                                    </main>
                                </div>
                                <div class="col-md-6">
                                    <p class="text-center">
                                        <strong>{{ __('Stylist - Total Hair') }}</strong>
                                    </p>
                                    <div class="col-md-6">
                                        <div class="progress-group">
                                            <span class="progress-text">Stylist 1</span>
                                            <span class="progress-number"><b>160</b>/200</span>

                                            <div class="progress sm">
                                                <div class="progress-bar progress-bar-aqua" style="width: 10%"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="progress-group">
                                            <span class="progress-text">Stylist 6</span>
                                            <span class="progress-number"><b>160</b>/200</span>

                                            <div class="progress sm">
                                                <div class="progress-bar progress-bar-aqua" style="width: 20%"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="year" class="tab-pane">
                            <h3 class="text-center">{{ __('Year Report') }}</h3>
                                <div class=" wrap-select-date">
                                    <div class="form-group col-md-5">
                                        <label for="start">Start Year:</label>
                                        <input type="date" class="form-control" id="start-date" v-model="inputYear.start_date" v-on:change="selectStartDay">
                                    </div>
                                    <div class="form-group col-md-5">
                                        <label for="end">End Year:</label>
                                        <input type="date" class="form-control" id="end-date" v-model="inputYear.end_date" v-on:change="selectEndDay">
                                    </div>
                                    <div class="form-group col-md-2"  v-bind:style="{visibility: statusVisible}">
                                        <label for="status">Status:</label>
                                        <select  class="form-control" v-model="inputStatus" v-on:change="selectStatus">
                                            <option value="">{{ __('All') }}</option>
                                            <option value="0">{{ __('Pending') }}</option>
                                            <option value="1">{{ __('Complete') }}</option>
                                            <option value="2">{{__('Cancel')}}</option>
                                        </select>
                                    </div>
                                    <p class="text-center">
                                        <strong>{{ __('Bar Chart Year Report') }} </strong>
                                    </p>
                                </div>
                                <div class="col-md-6">
                                    <main>
                                        <bar-chart-year :type="checkTypeReport" :data3="dataChartYear" style="position: relative; height:40vh; width:80vw" ></bar-chart-year>
                                    </main>
                                </div>
                              {{--   <div class="col-md-6">
                                    <p class="text-center">
                                        <strong>{{ __('Stylist - Total Hair') }}</strong>
                                    </p>
                                    <div class="col-md-6">
                                        <div class="progress-group">
                                            <span class="progress-text">Stylist 1</span>
                                            <span class="progress-number"><b>160</b>/200</span>

                                            <div class="progress sm">
                                                <div class="progress-bar progress-bar-aqua" style="width: 10%"></div>
                                            </div>
                                        </div>
                                        
                                    </div>

                                    <div class="col-md-6">
                                        <div class="progress-group">
                                            <span class="progress-text">Stylist 6</span>
                                            <span class="progress-number"><b>160</b>/200</span>
                                    <div class="progress sm">
                                        <div class="progress-bar progress-bar-aqua" style="width: 8%"></div>
                                    </div>
                                </div>
                                <div class="progress-group">
                                    <span class="progress-text">Stylist 4</span>
                                    <span class="progress-number"><b>480</b>/800</span>
                                            <div class="progress sm">
                                                <div class="progress-bar progress-bar-aqua" style="width: 17%"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
@section('script')
    {{ Html::script('bower/jsapi/index') }}
    {{-- {{ Html::script('https://unpkg.com/vue-chartjs/dist/vue-chartjs.full.min.js') }} --}}
    {{ Html::script('bower/chart.js/dist/Chart.js') }}
    {{ Html::script('js/admin/report.js') }}
@endsection
