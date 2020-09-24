<div class="col-lg-4 col-md-4">
    <div class="card ordertable">
        <div class="card-body" style="min-height: 498px;">
            <h4 class="card-title" style="float: left;">Top Sale by Category </h4>
            <div class="table-responsive">
                <table id="checkoutsTable" class="table table-bordered table-striped"  name="checkoutsTable">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Amount</th>

                        </tr>
                    </thead>
                    <tbody id="tbody">
                        <?php foreach ($saleByCategory as $categorySale) { ?>
                            <tr>
                                <td>{{$categorySale->categoryName}}</td>
                                <td>{{$categorySale->sum}}</td>


                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>