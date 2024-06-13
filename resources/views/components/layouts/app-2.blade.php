<!DOCTYPE html>
<html lang="en" style="--theme-deafult: #c6164f; --theme-secondary: #622222;">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="Sinarmas" />
    <meta name="keywords" content="Sinarmas" />
    <meta name="author" content="pixelstrap" />
    <link rel="icon" href="{{ asset('images/pngegg.ico') }}" type="image/x-icon" />
    <link rel="shortcut icon" href="{{ asset('images/pngegg.ico') }}" type="image/x-icon" />
    <title>Sinarmas</title>
    <!-- Google font-->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="" />
    <link
        href="https://fonts.googleapis.com/css2?family=Outfit:wght@100;200;300;400;500;600;700;800;900&amp;display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets-2/css/font-awesome.css') }}" />
    <!-- ico-font-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets-2/css/vendors/icofont.css') }}" />
    <!-- Themify icon-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets-2/css/vendors/themify.css') }}" />
    <!-- Flag icon-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets-2/css/vendors/flag-icon.css') }}" />
    <!-- Feather icon-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets-2/css/vendors/feather-icon.css') }}" />
    <!-- Plugins css start-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets-2/css/vendors/slick.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets-2/css/vendors/slick-theme.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets-2/css/vendors/scrollbar.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets-2/css/vendors/animate.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets-2/css/vendors/flatpickr/flatpickr.min.css') }}" />

    <!-- Plugins css Ends-->
    <!-- Bootstrap css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets-2/css/vendors/bootstrap.css') }}" />
    <!-- App css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets-2/css/style.css') }}" />
    <link id="color" rel="stylesheet" href="{{ asset('assets-2/css/color-1.css') }}" media="screen" />
    <!-- Responsive css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets-2/css/responsive.css') }}" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/webix/codebase/webix.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/pivot/codebase/pivot.css') }}" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        .container-filter {
            /* border: 1px solid;
            margin-bottom:  */
        }

        [x-cloak] {
            display: none !important;
        }

        /* .webix_pivot_toolbar {
            display: none;
        } */
        .webix_el_segmented {
            display: none;
        }

        [button_id="table"],
        [button_id="tree"],
        [button_id="chart"] {
            display: none !important;
        }
    </style>
    @yield('styles')
</head>

<body>
    <div class="loader-wrapper">
        <div class="loader loader-1">
            <div class="loader-outter"></div>
            <div class="loader-inner"></div>
            <div class="loader-inner-1"></div>
        </div>
    </div>
    <!-- loader ends-->
    <!-- tap on top starts-->
    <div class="tap-top"><i data-feather="chevrons-up"></i></div>
    <!-- tap on tap ends-->
    <!-- page-wrapper Start-->
    <div class="page-wrapper horizontal-wrapper" id="pageWrapper">
        <div class="page-header row">
            <div class="header-logo-wrapper col-auto">
                <div class="logo-wrapper">
                    <a href="#"><img class="img-fluid for-light" src="{{ asset('images/Sinarmas-logo.png') }}"
                            alt="" /><img class="img-fluid for-dark"
                            src="{{ asset('images/Sinarmas-logo.png') }}" alt="" /></a>
                </div>
            </div>
            <div class="col-4 col-xl-4 page-title">
                <h4 class="f-w-700">{{ $pageTitle ?? '' }}</h4>
                <nav>
                    <ol class="breadcrumb justify-content-sm-start align-items-center mb-0">
                        <!-- <li class="breadcrumb-item">
                                <a href="{{ route('dashboard') }}">
                                    <i data-feather="home"> </i
                                ></a>
                            </li>
                            <li class="breadcrumb-item f-w-400">Pages</li>
                            <li class="breadcrumb-item f-w-400 active">
                                Sample Page
                            </li> -->
                    </ol>
                </nav>
            </div>
            <!-- Page Header Start-->
            <div class="header-wrapper col m-0">
                <div class="row">
                    <div class="header-logo-wrapper col-auto p-0">
                        <div class="logo-wrapper">
                            <a href="#"><img class="img-fluid" src="{{ asset('images/Sinarmas-logo.png') }}"
                                    alt="" /></a>
                        </div>
                        <div class="toggle-sidebar">
                            <svg class="stroke-icon sidebar-toggle status_toggle middle">
                                <use href="{{ asset('assets-2/svg/icon-sprite.svg#toggle-icon') }}">
                                </use>
                            </svg>
                        </div>
                    </div>
                    <div class="nav-right col-xxl-8 col-xl-6 col-md-7 col-8 pull-right right-header p-0 ms-auto">
                        <ul class="nav-menus">
                            <li class="cart-nav onhover-dropdown">
                                <div class="cart-box">
                                    <svg>
                                        <use href="{{ asset('assets-2/svg/icon-sprite.svg#stroke-ecommerce') }}">
                                        </use>
                                    </svg>
                                </div>
                            </li>
                            <li class="profile-nav onhover-dropdown px-0 py-0">
                                <div class="d-flex profile-media align-items-center">
                                    <img class="img-30" src="{{ asset('assets-2/images/dashboard/profile.png') }}"
                                        alt="" />
                                    <div class="flex-grow-1">
                                        <span>{{ Auth::user()->USER_ID }}</span>
                                        <p class="mb-0 font-outfit">
                                            -<i class="fa fa-angle-down"></i>
                                        </p>
                                    </div>
                                </div>
                                <ul class="profile-dropdown onhover-show-div">
                                    <li>
                                        <a href="{{ route('logout') }}"><i data-feather="log-out"> </i><span>Log
                                                Out</span></a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <script
                            class="result-template"
                            type="text/x-handlebars-template"
                        >
                            <div class="ProfileCard u-cf">
                                <div class="ProfileCard-avatar"><svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        width="24"
                                        height="24"
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="2"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        class="feather feather-airplay m-0"
                                    ><path
                                            d="M5 17H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-1"
                                        ></path><polygon
                                            points="12 15 17 21 7 21 12 15"
                                        ></polygon></svg></div>
                                <div class="ProfileCard-details">
                                    <div
                                        class="ProfileCard-realName"
                                    >{-{name}-}</div>
                                </div>
                            </div>
                        </script>
                    <script
                            class="empty-template"
                            type="text/x-handlebars-template"
                        >
                            <div class="EmptyMessage">Your search turned up 0
                                results. This most likely means the backend is
                                down, yikes!</div>
                        </script>
                </div>
            </div>
            <!-- Page Header Ends                              -->
        </div>
        <!-- Page Body Start-->
        <div class="page-body-wrapper">
            <!-- Page Sidebar Start-->
            <div class="sidebar-wrapper" data-layout="stroke-svg">
                <div>
                    <div class="logo-wrapper">
                        <a href="javascript:void(0)"><img class="img-fluid bg-white"
                                src="{{ asset('images/Sinarmas-logo.png') }}" alt="" /></a>
                        <div class="back-btn">
                            <i class="fa fa-angle-left"></i>
                        </div>
                        {{-- <div class="toggle-sidebar" style="">
                            <svg class="stroke-icon sidebar-toggle status_toggle middle">
                                <use href="{{ asset('assets-2/svg/icon-sprite.svg#toggle-icon') }}">
                                </use>
                            </svg>
                            <svg class="fill-icon sidebar-toggle status_toggle middle">
                                <use href="{{ asset('assets-2/svg/icon-sprite.svg#fill-toggle-icon') }}">
                                </use>
                            </svg>
                        </div> --}}
                    </div>
                    <div class="logo-icon-wrapper">
                        <a href="#"><img class="img-fluid" src="{{ asset('images/pngegg.ico') }}"
                                alt="" /></a>
                    </div>
                    <nav class="sidebar-main">
                        <div class="left-arrow" id="left-arrow">
                            <i data-feather="arrow-left"></i>
                        </div>
                        <div id="sidebar-menu">
                            <ul class="sidebar-links" id="simple-bar">
                                <li class="back-btn"><a href="index.html"><img class="img-fluid"
                                            src="{{ asset('images/pngegg.ico') }}" alt=""></a>
                                    <div class="mobile-back text-end"><span>Back</span><i
                                            class="fa fa-angle-right ps-2" aria-hidden="true"></i></div>
                                </li>
                                <li class="pin-title sidebar-main-title">
                                    <div>
                                        <h6>Pinned</h6>
                                    </div>
                                </li>
                                <li class="sidebar-main-title">
                                    <div>
                                        <h6 class="lan-1">General</h6>
                                    </div>
                                </li>
                                <li class="sidebar-list"><i class="fa fa-thumb-tack"> </i><a
                                        class="sidebar-link sidebar-title link-nav" href="{{ route('dashboard') }}"
                                        wire:navigate>
                                        <svg class="stroke-icon">
                                            <use href="{{ asset('/assets-2/svg/icon-sprite.svg#stroke-board') }}">
                                            </use>
                                        </svg>
                                        <svg class="fill-icon">
                                            <use href="{{ asset('/assets-2/svg/icon-sprite.svg#fill-board') }}"></use>
                                        </svg><span>Dashboard</span></a></li>
                                <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a
                                        class="sidebar-link sidebar-title" href="javascript:void(0)">
                                        <svg class="stroke-icon">
                                            <use href="{{ asset('/assets-2/svg/icon-sprite.svg#stroke-ecommerce') }}">
                                            </use>
                                        </svg>
                                        <svg class="fill-icon">
                                            <use href="{{ asset('/assets-2/svg/icon-sprite.svg#fill-ecommerce') }}">
                                            </use>
                                        </svg><span>Production
                                        </span></a>
                                    <ul class="sidebar-submenu">
                                        <li><a href="{{ route('production.long-term') }}">Long Term
                                            </a></li>
                                        <li><a href="{{ route('production.year') }}">Year
                                            </a></li>
                                    </ul>
                                </li>
                                <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a
                                        class="sidebar-link sidebar-title" href="javascript:void(0)">
                                        <svg class="stroke-icon">
                                            <use href="{{ asset('/assets-2/svg/icon-sprite.svg#stroke-ecommerce') }}">
                                            </use>
                                        </svg>
                                        <svg class="fill-icon">
                                            <use href="{{ asset('/assets-2/svg/icon-sprite.svg#fill-ecommerce') }}">
                                            </use>
                                        </svg><span>Claim
                                        </span></a>
                                    <ul class="sidebar-submenu">
                                        <li><a href="{{ route('claim.accepted-claim') }}">Accepted Claim
                                            </a></li>
                                        <li><a href="{{ route('claim.reject-claim') }}">Reject Claim
                                            </a></li>
                                        <li><a href="{{ route('claim.outstanding-claim') }}">Outstanding Claim
                                            </a></li>
                                    </ul>
                                </li>
                                <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a
                                        class="sidebar-link sidebar-title" href="javascript:void(0)">
                                        <svg class="stroke-icon">
                                            <use href="{{ asset('/assets-2/svg/icon-sprite.svg#stroke-ecommerce') }}">
                                            </use>
                                        </svg>
                                        <svg class="fill-icon">
                                            <use href="{{ asset('/assets-2/svg/icon-sprite.svg#fill-ecommerce') }}">
                                            </use>
                                        </svg><span>Consolidated Surplus UW
                                        </span></a>
                                    <ul class="sidebar-submenu">
                                        <li><a class="submenu-title" href="javascript:void(0)">Long Term
                                                <span class="sub-arrow"><i class="fa fa-angle-right"></i></span></a>
                                            <ul class="nav-sub-childmenu submenu-content">
                                                <li><a
                                                        href="{{ route('consolidated-surplus-uw.surplus-uw-long-term') }}">Surplus
                                                        UW Long Term
                                                    </a></li>
                                                <li><a
                                                        href="{{ route('consolidated-surplus-uw.profit-loss-long-term') }}">Profit/Loss
                                                        Long Term
                                                    </a></li>
                                            </ul>
                                        </li>
                                        <li><a class="submenu-title" href="javascript:void(0)">Year
                                                <span class="sub-arrow"><i class="fa fa-angle-right"></i></span></a>
                                            <ul class="nav-sub-childmenu submenu-content">
                                                <li><a href="{{ route('consolidated-surplus-uw.surplus-uw-year') }}">Surplus
                                                        UW Year
                                                    </a></li>
                                                <li><a href="{{ route('consolidated-surplus-uw.profit-loss-year') }}">Profit
                                                        / Loss Year
                                                    </a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                                <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a
                                        class="sidebar-link sidebar-title" href="javascript:void(0)">
                                        <svg class="stroke-icon">
                                            <use href="{{ asset('/assets-2/svg/icon-sprite.svg#stroke-ecommerce') }}">
                                            </use>
                                        </svg>
                                        <svg class="fill-icon">
                                            <use href="{{ asset('/assets-2/svg/icon-sprite.svg#fill-ecommerce') }}">
                                            </use>
                                        </svg><span>Search CIF
                                        </span></a>
                                    <ul class="sidebar-submenu">
                                        <li><a href="{{ route('search-cif.surplus-uw-long-term') }}">Search
                                                CIF(Surplus UW Long Term)
                                            </a></li>
                                        <li><a href="{{ route('search-cif.surplus-uw-year') }}">Search CIF(Surplus UW
                                                Year)
                                            </a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="right-arrow" id="right-arrow">
                            <i data-feather="arrow-right"></i>
                        </div>
                    </nav>
                </div>
            </div>
            <!-- Page Sidebar Ends-->
            <div class="page-body">
                <!-- Container-fluid starts-->
                <div class="container-fluid">
                    {{ $slot }}
                </div>
                <!-- Container-fluid Ends-->
            </div>
            <!-- footer start-->
            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <!-- latest jquery-->
    <script src="{{ asset('assets-2/js/jquery.min.js') }}"></script>
    <script src="https://code.jquery.com/ui/1.13.3/jquery-ui.min.js"
        integrity="sha256-sw0iNNXmOJbQhYFuC9OF2kOlD5KQKe1y5lfBn4C9Sjg=" crossorigin="anonymous"></script>
    <!-- Bootstrap js-->
    <script src="{{ asset('assets-2/js/bootstrap/bootstrap.bundle.min.js') }}"></script>
    <!-- feather icon js-->
    <script src="{{ asset('assets-2/js/icons/feather-icon/feather.min.js') }}"></script>
    <script src="{{ asset('assets-2/js/icons/feather-icon/feather-icon.js') }}"></script>
    <!-- scrollbar js-->
    <script src="{{ asset('assets-2/js/scrollbar/simplebar.js') }}"></script>
    <script src="{{ asset('assets-2/js/scrollbar/custom.js') }}"></script>
    <!-- Sidebar jquery-->
    <script src="{{ asset('assets-2/js/config.js') }}"></script>
    <!-- Plugins JS start-->
    <script src="{{ asset('assets-2/js/sidebar-menu.js') }}"></script>
    <script src="{{ asset('assets-2/js/sidebar-pin.js') }}"></script>
    <script src="{{ asset('assets-2/js/slick/slick.min.js') }}"></script>
    <script src="{{ asset('assets-2/js/slick/slick.js') }}"></script>
    <script src="{{ asset('assets-2/js/header-slick.js') }}"></script>
    <script src="{{ asset('assets-2/js/header-slick.js') }}"></script>
    <script src="{{ asset('assets-2/js/flat-pickr/flatpickr.js') }}"></script>
    <script src="{{ asset('assets-2/js/flat-pickr/custom-flatpickr.js') }}"></script>
    <script src="{{ asset('assets-2/js/height-equal.js') }}"></script>

    <script src="{{ asset('assets-2/js/jquery-collapse/src/jquery.collapse.js') }}"></script>
    <script src="{{ asset('plugins/webix/codebase/webix.js') }}"></script>
    <script src="{{ asset('plugins/pivot/codebase/pivot.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <!-- calendar js-->
    <!-- Plugins JS Ends-->
    <!-- Theme js-->
    <script src="{{ asset('assets-2/js/script.js') }}"></script>
    <!-- Plugin used-->
    <script>
        serialize = function(obj) {
            var str = [];
            for (var p in obj)
                if (obj.hasOwnProperty(p)) {
                    str.push(encodeURIComponent(p) + "=" + encodeURIComponent(obj[p]));
                }
            return str.join("&");
        }

        function collectAllForm() {
            return {
                'PERIODE': $$("PERIODE").getValue(),
                'CLIENT_NAME': $$("CLIENT_NAME").getValue(),
                'NO_CIF': $$("NO_CIF").getValue(),
                'NO_POLIS': $$("NO_POLIS").getValue(),
            }
        }
        const rupiah = (number) => {
            return new Intl.NumberFormat("id-ID", {
                style: "currency",
                currency: "IDR"
            }).format(number);
        }

        function getToolbar() {
            return {
                view: "toolbar",
                cols: [{
                        view: "button",
                        label: "Export to PDF",
                        click: () =>
                            webix.toPDF("pivot", {
                                autowidth: true,
                                styles: true,
                            }),
                    },
                    {
                        view: "button",
                        label: "Export to Excel",
                        click: () => webix.toExcel("pivot", {
                            styles: true,
                            spans: true
                        }),
                    },
                    {
                        view: "button",
                        label: "Export to CSV",
                        click: () => webix.toCSV("pivot"),
                    },
                    {
                        view: "button",
                        label: "Export to PNG",
                        click: () => webix.toPNG("pivot"),
                    },
                ]
            };
        }


        class MyBackend extends pivot.services.Backend {
            data() {
                if (this.app.$data)
                    return webix.promise.resolve(this.app.$data);
                else
                    return super.data();
            }
            url(path) {
                return this.app.config.url + (path || "");
            }
        }

        webix.protoUI({
            name: "pivot-load",
            load(url, structure, fields) {
                let $this = this;
                return (new Promise(function(resolve, reject) {
                    try {
                        $pivot.showProgress({
                            type: "top"
                        });
                        $this.getService('local')._app.refresh();
                        $this.clearAll();
                        $this.getService("backend")._url = url;
                        $this.getService("local").getData(true).then(() => {
                            resolve();
                            $this.setStructure(structure);

                        });
                    } catch (error) {
                        console.log(error);
                        reject();
                    }
                }));
            },
        }, webix.ui.pivot);

        webix.attachEvent("onBeforeAjax",
            function(mode, url, params, x, headers, files, defer) {
                defer.then(function(data) {
                    if (data.json() == false) {
                        $$("pivot").hideProgress();
                    }
                }, function(x) {
                    console.log("err", x)
                });
            });
        webix.CustomScroll.init();

        function renderPivot(url, structure = null, MyBackend) {
            webix.ui({
                container: "container",
                rows: [{
                    cols: [{
                        view: "scrollview",
                        body: {
                            rows: [
                                // getToolbar(),
                                {
                                    structure,
                                    id: 'pivot',
                                    view: "pivot-load",
                                    on: {
                                        onInit: function() {
                                            $pivot = this;
                                            webix.extend($$("pivot"), webix
                                                .ProgressBar);
                                            console.log('onInit pivot');
                                        },
                                        onFilterChange: function() {
                                            console.log('filter changed');
                                            $pivot.hideProgress();
                                        }
                                    },
                                    datatable: {
                                        cleanRows: true,
                                        minX: true,
                                        maxX: true,
                                        footer: "sumOnly",
                                        rowHeight: 45,
                                        rowLineHeight: 45,
                                        scheme: {
                                            $init: function(obj) {
                                                // jika ingin menambah atau mengurangi value, lakukan disini.
                                            },
                                        },
                                        on: {
                                            onStructureLoad: (function() {
                                                console.log(
                                                    'onStructureLoad');
                                                var columns = this.config
                                                    .columns;
                                                for (var i = 1; i < columns
                                                    .length; i++) {
                                                    columns[i].header[0]
                                                        .text = $pivot
                                                        .getStructure()
                                                        .values[(i - 1)]
                                                        .name;
                                                    columns[i].format =
                                                        function(
                                                            value) {
                                                            return rupiah(
                                                                value);
                                                        };
                                                    columns[i].footer[0]
                                                        .text = rupiah(
                                                            columns[i]
                                                            .footer[0]
                                                            .text);
                                                }
                                            }),
                                            onBeforeLoad: (function() {
                                                console.log('onBeforeLoad');
                                                $pivot.showProgress({
                                                    type: "top"
                                                });
                                            }),
                                            onAfterLoad: (function() {
                                                console.log('onAfterLoad');
                                                this.eachColumn(function(
                                                    col) {
                                                    if (col) {
                                                        this.adjustColumn(
                                                            col,
                                                            true
                                                        );
                                                    };
                                                })
                                                this.closeAll();
                                                $pivot.hideProgress();
                                            }),
                                            onBeforeRender: (function(config) {
                                                console.log(
                                                    'onBeforeRender');
                                            }),
                                            onAfterRender: (function(config) {
                                                console.log(
                                                    'onAfterRender');
                                            }),
                                        },
                                    },
                                    override: new Map([
                                        [pivot.services.Backend, MyBackend]
                                    ]),
                                }
                            ],
                        },
                    }]
                }]
            });

        }

        document.addEventListener('livewire:navigated', function() {
            $(".select2").select2();
        });

        // $("#container").parent().css('overflow', 'auto');
    </script>
    @yield('scripts')
</body>

</html>
