@php
use App\DeliveryZone;
    $deliveryZoneList = DeliveryZone::all();
@endphp
<div id="pe-overlay-backdrop" style="display: none;">
    <div id="pushengage-overlay-close">
    </div>
    <div class="" tabindex="-1" role="dialog" style="margin-top: 170px;">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="col-12 modal-title text-center">Select your location</h5>
              </div>
              <div class="modal-body">
                <form _ngcontent-c4="" novalidate="" class="ng-untouched ng-pristine ng-valid">
                    <div _ngcontent-c4="" class="form-group">
                        <label _ngcontent-c4="">Delivery Zone</label>
                        <select _ngcontent-c4="" class="form-control chosen-select deliveryZone" id="deliveryZone">
                            <option _ngcontent-c4="" value="">Select Zone</option>
                            @foreach ($deliveryZoneList as $deliveryZone)
                                <option _ngcontent-c4="" value="{{$deliveryZone->id}}">{{$deliveryZone->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </form>
                <form _ngcontent-c4="" novalidate="" class="ng-untouched ng-pristine ng-valid">
                    <div _ngcontent-c4="" class="form-group">
                        <label _ngcontent-c4="">Delivery Area</label>
                        <select _ngcontent-c4="" class="form-control deliveryArea" id="deliveryArea">
                            <option _ngcontent-c4="" value="">Select Area</option>
                        </select>
                    </div>
                </form>
              </div>
            </div>
        </div>
    </div>
</div>