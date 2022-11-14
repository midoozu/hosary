@extends('layouts.frontend')

@section('styles')

@endsection

@section('page-title')
    إعدادات شئون الموظفين
@endsection

@section('current-page-name')
    إعدادات شئون الموظفين
@endsection

@section('page-links')
    <li class="breadcrumb-item active">      إعدادات شئون الموظفين</li>
@endsection

@section('content')

    <style>

        .settings-category .content {
            height: 140px;
            -webkit-box-shadow: 0px 0px 6px #00000030;
            box-shadow: 0px 0px 6px #00000030;
            border-radius: 6px;
            -webkit-transition: all .3s ease-in-out;
            transition: all .3s ease-in-out;
            background-color: white;
        }

        .settings-category .content h3 {
            font-weight: 600;
        }

        .settings-category .content i {
            font-size: 35px;
            color: #a6b7bf;
        }

        .settings-category .content:hover {
            -webkit-transform: scale(0.95);
            transform: scale(0.95);
            -webkit-box-shadow: 0px 0px 8px #186dde;
            box-shadow: 0px 0px 8px #186dde;
        }

        .settings-category .content h3 {
            font-weight: 600;
            color: black;
        }
    </style>

    <section class="settings-category my-5">

        <div class="row">


            {{--======================== HR Mohamed ============================--}}

            <div class="col-lg-4 col-sm-6 mb-4">
                <a href="{{route('frontend.reports.filterbydate')}}">
                    <div class="content  d-flex align-items-center justify-content-center">
                        <div class="text-i">
                            <div class="w-100 mb-3 d-flex align-items-center justify-content-center">
                                <i class="fa fa-adjust"></i>
                            </div>
                            <h3>
                                {{' تقرير الكل'}}
                            </h3>
                        </div>
                    </div>
                </a>

            </div>
            <div class="col-lg-4 col-sm-6 mb-4">
                <a href="{{route('frontend.reports.todayreport')}}">
                    <div class="content  d-flex align-items-center justify-content-center">
                        <div class="text-i">
                            <div class="w-100 mb-3 d-flex align-items-center justify-content-center">
                                <i class="fa fa-adjust"></i>
                            </div>
                            <h3>
                                {{'تقرير اليوم'}}
                            </h3>
                        </div>
                    </div>
                </a>

            </div>
            <div class="col-lg-4 col-sm-6 mb-4">
                <a href="{{route('frontend.reports.yasterdayreport')}}">
                    <div class="content  d-flex align-items-center justify-content-center">
                        <div class="text-i">
                            <div class="w-100 mb-3 d-flex align-items-center justify-content-center">
                                <i class="fa fa-adjust"></i>
                            </div>
                            <h3>
                                {{'تقرير امس'}}
                            </h3>
                        </div>
                    </div>
                </a>

            </div>
            <div class="col-lg-4 col-sm-6 mb-4">
                <a href="{{route('frontend.reports.servicesreport')}}">
                    <div class="content  d-flex align-items-center justify-content-center">
                        <div class="text-i">
                            <div class="w-100 mb-3 d-flex align-items-center justify-content-center">
                                <i class="fa fa-adjust"></i>
                            </div>
                            <h3>
                                {{' تقرير الخدمات'}}
                            </h3>
                        </div>
                    </div>
                </a>

            </div>
            <div class="col-lg-4 col-sm-6 mb-4">
                <a href="{{route('frontend.reports.servicesreport')}}">
                    <div class="content  d-flex align-items-center justify-content-center">
                        <div class="text-i">
                            <div class="w-100 mb-3 d-flex align-items-center justify-content-center">
                                <i class="fa fa-adjust"></i>
                            </div>
                            <h3>
                                {{' تقرير الشركات'}}
                            </h3>
                        </div>
                    </div>
                </a>

            </div>

        </div>

    </section>
@endsection

@section('js')
    <script>

    </script>
@endsection
