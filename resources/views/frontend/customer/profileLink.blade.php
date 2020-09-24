<style type="text/css">
    .profileLink{
        display: block;
        padding-left: 10px !important;
    }

    .profileLink li{
        list-style: none;
    }
</style>
<div style="padding: 15px 0px 25px 25px;">
    <h3>Profile Link</h3>
    <?php
    use App\Customer;
        $customerId = Session::get('customerId');
        $customers =Customer::where('id',$customerId)->first();
    ?>
    <ul class="profileLink">
    <?php if($customers->password != ''){ ?>
        <li><a href="{{route('customer.profile',$customerId)}}">Profile</a></li>
    <?php } ?>
        <li><a href="{{route('customer.order')}}">Order</a></li>
        <li><a href="{{route('customer.logout')}}">Logout</a></li>
    </ul>       
</div>