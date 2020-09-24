<div class="col-lg-4 col-md-4">
    <div class="card ordertable">
     <div class="card-body" style="min-height: 441px;">
        <h4 class="card-title" style="float: left;">Top Client </h4>
            <div class="table-responsive">
                <table id="checkoutsTable" class="table table-bordered table-striped"  name="checkoutsTable">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Amount</th>

                        </tr>
                    </thead>
                    <tbody id="tbody">
                        @foreach ($topclients as $customer)
                            <tr>
                                <td>{{$customer->name}}</td>
                                <td>{{$customer->totalAmount}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>