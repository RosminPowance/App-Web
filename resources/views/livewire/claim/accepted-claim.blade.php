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
                    <div class="mb-3 row">
                        <label class="col-sm-3">Start Accepted</label>
                        <div class="col-sm-9">
                            <div class="input-group flatpicker-calender">
                                <input class="form-control datetime-local" type="date" name="ACCEPTED_DATE">
                            </div>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-sm-3">End Accepted</label>
                        <div class="col-sm-9">
                            <div class="input-group flatpicker-calender">
                                <input class="form-control datetime-local" type="date" name="END_DATE">
                            </div>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-sm-3"></label>
                        <div class="col-sm-9">
                            <button type="submit" disabled x-init="$el.disabled = false" class="btn btn-primary"
                                disabled>Show Data</button>
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
                    <h4 class="">Table Accepted Claim</h4>

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
                        name: "PSS",
                        operation: "sum",
                    },
                    {
                        name: "QS_RI",
                        operation: "sum",
                        text: 'Wee'
                    },
                    {
                        name: "SURPLUS1",
                        operation: "sum",
                    },
                    {
                        name: "SURPLUS2",
                        operation: "sum",
                    },
                    {
                        name: "XL",
                        operation: "sum",
                    },
                    {
                        name: "PFRA",
                        operation: "sum",
                    },
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
                    let url = '{{ route('dataset.accepted-claim') }}' + "?" + serialize;
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
