<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body" style="overflow: hidden">
                <div id="container" style="height:600px;"></div>
            </div>
        </div>
    </div>

</div>

</div>

@section('scripts')
    @parent
    @once
        <script>
            var pivotConf = {
                id: 'pivot',
                view: "pivot",
                on: {
                    onInit: function() {
                        $pivot = this;
                        webix.extend($$("pivot"), webix.ProgressBar);
                        $pivot.showProgress();

                    }
                },
                url: "{{ route('dataset.consolidated-surplus-uw-long-term') }}",
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
                            this.eachColumn(function(col) {
                                if (col) {
                                    this.adjustColumn(col, true);
                                };
                            })
                            this.closeAll();
                            $pivot.hideProgress();

                        }),
                        onBeforeRender: (function(config) {
                            console.log('onBeforeRender');


                        }),
                        onAfterRender: (function(config) {
                            console.log('onAfterRender');

                        }),


                    },

                },
                structure: {

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
                    filters: [{
                            name: "PERIODE"
                        },
                        {
                            name: "CABANG"
                        },
                        {
                            name: "PERWAKILAN"
                        },
                        {
                            name: "SUB_PERWAKILAN"
                        },
                    ],
                },

            };

            webix.CustomScroll.init();
            webix.ready(function() {
                renderPivot(pivotConf);
            });
        </script>
    @endonce
@endsection