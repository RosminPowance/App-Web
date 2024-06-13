<div class="row" x-data>
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header card-no-border pb-0">
                <div class="header-top">
                    <h4 class="">Filter Data</h4>

                    <div class="dropdown icon-dropdown">

                    </div>
                </div>
            </div>
            <div class="card-body">
                <form id="formFilter">
                    <input type="hidden" name="FILTER" value="FILTER">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3 row">
                                <label class="col-sm-3">Production Date Time</label>
                                <div class="col-sm-9">
                                    <div class="input-group">
                                        <select name="filterProdDateTime" class="select2 form-control">
                                            <option value="">All Date</option>
                                            @foreach ($filterProdDateTime as $prodDateTime)
                                                <option value="{{ $prodDateTime->PRODDATETIME }}">
                                                    {{ $prodDateTime->PRODDATETIME }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3 row">
                                <label class="col-sm-3">Business </label>
                                <div class="col-sm-9">
                                    <div class="input-group">
                                        <select name="filterBusiness" class="select2 form-control">
                                            <option value="">All Business</option>
                                            @foreach ($filterBusiness as $business)
                                                <option value="{{ $business->BUSINESS }}">{{ $business->BUSINESS }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3 row">
                                <label class="col-sm-3">Cabang </label>
                                <div class="col-sm-9">
                                    <div class="input-group">
                                        <select name="filterCabang" class="select2 form-control">
                                            <option value="">All Cabang</option>
                                            @foreach ($filterCabang as $cabang)
                                                <option value="{{ $cabang->CABANG }}">{{ $cabang->CABANG }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3 row">
                                <label class="col-sm-3">Client Name </label>
                                <div class="col-sm-9">
                                    <div class="input-group">
                                        <select name="filterClientName" class="select2 form-control">
                                            <option value="">All Client Name</option>
                                            @foreach ($filterClientName as $clientName)
                                                <option value="{{ $clientName->CLIENT_NAME }}">
                                                    {{ $clientName->CLIENT_NAME }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3 row">
                                <label class="col-sm-3">No CIF </label>
                                <div class="col-sm-9">
                                    <div class="input-group">
                                        <select name="filterNoCif" class="select2 form-control">
                                            <option value="">All NO CIF</option>
                                            @foreach ($filterNoCif as $noCif)
                                                <option value="{{ $noCif->NO_CIF }}">{{ $noCif->NO_CIF }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3 row">
                                <label class="col-sm-3">No Polis </label>
                                <div class="col-sm-9">
                                    <div class="input-group">
                                        <select name="filterNoPolis" class="select2 form-control">
                                            <option value="">All NO Polis</option>
                                            @foreach ($filterNoPolis as $noCif)
                                                <option value="{{ $noCif->NO_POLIS }}">{{ $noCif->NO_POLIS }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3 text-end">
                                <button type="submit" disabled x-init="$el.disabled = false" class="btn btn-primary"
                                    disabled>Show Data</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="card">
            <div class="card-header card-no-border pb-0">
                <div class="header-top">
                    <h4>Generate Report</h4>
                </div>
            </div>
            <div class="card-body">

                <div>
                    <div class="design-button" id="btnReport">
                        <button
                            @click="webix.toPDF('pivot', {
                                autowidth: true,
                                styles: true,
                            })"
                            disabled class="btn-report btn bg-light-primary font-primary f-w-500"><i
                                class="fa fa-file-pdf-o"></i> PDF</button>
                        <button
                            @click="webix.toExcel('pivot', {
                            styles: true,
                            spans: true
                        })"
                            disabled class="btn-report btn bg-light-secondary font-secondary f-w-500"><i
                                class="fa fa-file-pdf-o"></i> Excel</button>
                        <button @click="webix.toCSV('pivot')" disabled
                            class="btn-report btn bg-light-success font-success f-w-500"><i
                                class="fa fa-file-text-o"></i> CSV</button>
                        <button @click="webix.toPNG('pivot')" disabled
                            class="btn-report btn bg-light-warning font-warning f-w-500"><i
                                class="fa fa-file-image-o"></i> PNG</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header card-no-border pb-0">
                <div class="header-top">
                    <h4 class="">Table Consolidated Surplus UW Year</h4>

                    <div class="dropdown icon-dropdown">

                    </div>
                </div>
            </div>
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
            let structure = {
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
            };


            webix.ready(function() {
                renderPivot();
                // setTimeout(() => {
                //     $$("pivot").load(url, structure)
                // }, 0);

                $("#formFilter").on('submit', function(e) {
                    e.preventDefault();
                    let $form = $(this);

                    $form.find('button[type="submit"]').attr('disabled', 'disabled');
                    $(".btn-report").attr('disabled', 'disabled');
                    let serialize = $(this).serialize();
                    let url = '{{ route('dataset.consolidated-surplus-uw-year') }}' + "?" + serialize;
                    $$("pivot").load(url, structure)
                        .then(() => {
                            $form.find('button[type="submit"]').removeAttr('disabled');
                            $(".btn-report").removeAttr('disabled');
                        });

                })
            });
        </script>
    @endonce
@endsection
