<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">

                <div id="container" style="min-height:600px;"></div>
            </div>
        </div>
    </div>

</div>

</div>


@section('scripts')
    @parent
    @once
        <script>
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

            var filteredUrl = '';

            var structure = {
                rows: [
                    "NAMALEADER0",
                    "NAMALEADER1",
                    'NAMALEADER2',
                    'NAMALEADER3'
                ],
                values: [{
                        name: "TSI",
                        operation: "sum",
                    },
                    {
                        name: "GROSS_PREMIUM_WRITTEN",
                        operation: "sum",
                        text: 'Wee'
                    },
                    {
                        name: "NETTO_GROSS_WRITTEN_PREMIUM",
                        operation: "sum",
                    },
                    {
                        name: "BIAYA_KANTOR_PUSAT",
                        operation: "sum",
                    },
                    {
                        name: "REINSURANCE",
                        operation: "sum",
                    },
                    {
                        name: "RICOM",
                        operation: "sum",
                    },
                    {
                        name: "NETTO_WRITTEN_PREMIUM",
                        operation: "sum",
                    }
                ],
                // filters: [{
                //     name: "PRODDATETIME"
                // }],
                // on: {
                //     onFilterCreate: function(str, config) {
                //         console.log(config);
                //     }
                // }

            };

            var pivotConf = [{
                    view: "toolbar",
                    margin: 20,
                    padding: 20,
                    css: "border",
                    cols: [{
                            rows: [{
                                id: "PERIODE",
                                view: "text",
                                placeholder: 'Input Periode',
                            }, ]
                        },
                        {
                            rows: [{
                                    id: "CLIENT_NAME",
                                    view: "text",
                                    placeholder: 'Client Name',
                                },
                                {
                                    id: "NO_CIF",
                                    view: "text",
                                    placeholder: 'CIF No.',
                                }, {
                                    id: "NO_POLIS",
                                    view: "text",
                                    placeholder: 'Policy No.',
                                }
                            ]
                        },
                        {
                            rows: [{
                                view: "text",
                                placeholder: "Business Source"
                            }]
                        },
                        {
                            rows: [{
                                view: "text",
                                placeholder: "Business Class"
                            }]
                        },
                        {
                            rows: [{
                                    view: "text",
                                    placeholder: "Branch",
                                }

                            ]
                        }

                    ]
                },
                {
                    view: "button",
                    label: "Filter Data",
                    click: function() {
                        filtered = collectAllForm();
                        filtered['FILTER'] = true;
                        let serializer = serialize(filtered);
                        let _url = "{{ route('dataset.consolidated-surplus-uw-year') }}" + "?" + serializer;
                        let $this = this;
                        $this.disable();
                        $$("pivot").showProgress();
                        $$("pivot").load(
                                _url,
                                structure,
                            )
                            .then(() => {
                                $$("pivot").hideProgress();
                                $this.enable();

                            }, () => {
                                $this.enable();
                            })
                    }
                },
                {
                    id: 'pivot',
                    view: "pivot-load",
                    on: {
                        onInit: function() {
                            $pivot = this;
                            webix.extend($$("pivot"), webix.ProgressBar);

                        }
                    },
                    url: "{{ route('dataset.consolidated-surplus-uw-year') }}" + "?" + 'FILTER=true',
                    override: new Map([
                        [pivot.services.Backend, MyBackend]
                    ]),

                    datatable: {
                        cleanRows: true,
                        minX: true,
                        maxX: true,
                        footer: "sumOnly",
                        rowHeight: 45,
                        rowLineHeight: 45,

                        scheme: {
                            $init: function(obj) {},
                        },
                        on: {
                            onStructureLoad: (function() {
                                $datatable = this;
                                console.log('onStructureLoad');
                                var columns = this.config.columns;
                                for (var i = 1; i < columns.length; i++) {

                                    columns[i].header[0].text = $pivot.getStructure()
                                        .values[(i - 1)].name;

                                    columns[i].format = function(value) {
                                        return rupiah(value);
                                    };

                                    columns[i].footer[0].text = rupiah(columns[i].footer[0]
                                        .text);
                                }
                            }),
                            onBeforeLoad: (function() {
                                console.log('onBeforeLoad');


                            }),
                            onAfterLoad: (function() {
                                console.log('onAfterLoad');
                                try {
                                    this.eachColumn(function(col) {
                                        if (col) {
                                            this.adjustColumn(col, true);
                                        };
                                    })
                                    this.closeAll();
                                } catch (error) {

                                }

                            }),
                            onBeforeRender: (function(config) {
                                console.log('onBeforeRender');


                            }),
                            onAfterRender: (function(config) {
                                console.log('onAfterRender');
                                $("#container").parent().css('overflow', 'auto');

                            }),
                        },

                    },
                    structure: structure

                }
            ];

            webix.ready(function() {

                if (!webix.env.touch && webix.env.scrollSize)
                    webix.CustomScroll.init();

                webix.protoUI({
                    name: "pivot-load",
                    load(url, structure, fields) {
                        let $this = this;
                        return (new Promise(function(resolve, reject) {
                            $this.$app.config.url = url;
                            try {
                                $this.clearAll();

                                $this.getService("local").getData(true).then(() => {
                                    resolve();
                                    $this.setStructure(structure);
                                });
                            } catch (error) {
                                reject();
                            }
                        }));
                    },
                }, webix.ui.pivot);

                class MyBackend extends pivot.services.Backend {
                    url(path) {
                        return this.app.config.url + (path || "");
                    }
                }

                let layout = renderPivot(pivotConf);
            });
        </script>
    @endonce
@endsection
