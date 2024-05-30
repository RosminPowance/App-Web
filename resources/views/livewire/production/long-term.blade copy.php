<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <div id="example-table" wire:ignore></div>
                </div>
            </div>
        </div>
    </div>
</div>

@script
    <script>
        let aggMap = {
            'agg1': {
                aggType: 'Sum',
                arguments: ['TSI'],
                name: 'TSI',
                varName: 'TSI',
                renderEnhancement: 'none'
            },

            'agg2': {
                aggType: 'Sum',
                arguments: ['OC'],
                name: 'OC',
                varName: 'OC',
                hidden: false,
                renderEnhancement: 'none'
            },
            'agg3': {
                aggType: 'Count',
                arguments: ['Total Polis'],
                name: 'Total Polis',
                varName: 'NAMA_CEDING',
                hidden: false,
                renderEnhancement: 'none'
            },
        };


        let customAggs = {};
        customAggs['Multifact Aggregators'] = $.pivotUtilities.multifactAggregatorGenerator(aggMap, []);

        let config = {
            "cols": [],
            "rows": ["NAMALEADER0", 'NAMALEADER1', 'NAMALEADER2'],
            "vals": [],
            "rowOrder": "key_a_to_z",
            "colOrder": "key_a_to_z",
            "aggregatorName": "Multifact Aggregators",
            "rendererName": "GT Table Heatmap and Barchart",
            "rendererOptions": {
                aggregations: {
                    defaultAggregations: aggMap,
                }
            }
        };


        $.pivotUtilities.customAggs = customAggs;

        config.aggregators = $.extend($.pivotUtilities.aggregators, $.pivotUtilities.customAggs);

        config.renderers = $.extend($.pivotUtilities.renderers, $.pivotUtilities.gtRenderers);

        let renderPivot = function(data) {
            $("#example-table").pivotUI(
                data,
                config
            );
        }

        $.getJSON(" {{ route('dataset.production-long-term') }}", function(mps) {
            $("#example-table").pivotUI(mps, config);
        });


      
    </script>
@endscript

@section('scripts')
    @parent
    @once
        <script>

              // let utils = $.pivotUtilities;
        // let heatmap = utils.renderers["Heatmap"];
        // let sumOverSum = utils.aggregators["Sum over Sum"];

        // let dataClass = utils.SubtotalPivotData;
        // let renderer = utils.subtotal_renderers["Table With Subtotal"];
        // let aggregators = $.extend($.pivotUtilities.subtotal_aggregators, $.pivotUtilities.aggregators)


        // let sum = utils.aggregatorTemplates.sum;


        // $.getJSON("", function(mps) {
        //     $("#example-table").pivotUI(mps, {
        //         dataClass: dataClass,
        //         rows: ["NAMALEADER0", "NAMALEADER1"],
        //         cols: [],
        //         aggregators: aggregators,
        //         aggregatorName: "Sum As Fraction Of Parent Row",
        //         vals: ["TSI", "GROSS PREMIUM WRITTEN"],
        //         renderer: renderer,
        //         rendererOptions: {
        //             arrowExpanded: "[+]",
        //             arrowCollapsed: "[-]",
        //             rowSubtotalDisplay: {
        //                 collapseAt: 0
        //             },
        //             colSubtotalDisplay: {
        //                 collapseAt: 0
        //             }
        //         }
        //     });
        // });
        </script>

    @endonce
@endsection
