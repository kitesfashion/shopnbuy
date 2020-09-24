<script type="text/javascript" src="{{ asset('public/frontend') }}/assets/js/jquery.min.js"></script>
<script src="{{ asset("public/frontend") }}/assets/js/flickty_package.min.js"></script>

<script type="text/javascript" src="{{ asset('public/frontend') }}/assets/new_assets/inline.1.bundle.js"></script>

<script type="text/javascript" src="{{ asset('public/frontend') }}/assets/new_assets/polyfills.4.bundle.js"></script>

<script type="text/javascript" src="{{ asset('public/frontend') }}/assets/new_assets/scripts.4.bundle.js"></script>

<script type="text/javascript" src="{{ asset('public/frontend') }}/assets/new_assets/main.106cst.bundle.js"></script>

<script type="text/javascript" src="{{ asset('public/frontend') }}/zoom-image/js/script.js"></script>
<script type="text/javascript" src="{{ asset('public/frontend') }}/zoom-image/js/zoomsl.js"></script> 
<script type="text/javascript" src="{{ asset('public/frontend') }}/zoom-image/js/zoom-slideshow.js"></script>

<script type="text/javascript" src="{{ asset('public/frontend') }}/assets/js/sidebarmenu.js"></script>

<script type="text/javascript" src="{{ asset('public/frontend') }}/assets/js/topmenu.js"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.js"></script>

@if(URL::current() == url('/'))
    <script type="text/javascript" src="{{ asset('public/frontend') }}/assets/js/resCarousel.js"></script>
@endif

<script>
    window.onscroll = function() {
        scrollFunction()
    };

    function scrollFunction() {
        if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
            document.getElementById("myBtn").style.display = "block";
        } else {
            document.getElementById("myBtn").style.display = "none";
        }
    }

    function topFunction() {
        document.body.scrollTop = 0;
        document.documentElement.scrollTop = 0;
    }
</script>

<script type="text/javascript">
    $('#exclusive_banner').hide();
    $('#new_product').hide();
    function BannerSection(section){
        window.dispatchEvent(new Event('resize'));
        if(section == 'exclusive_banner'){
            $('#exclusive_banner').show();
            $('#new_product').hide();
        }

        if(section == 'new_product'){
            $('#exclusive_banner').hide();
            $('#new_product').show();
        }
    }

    function CollapseMenu(show_hide){
        if(show_hide == 'show'){
            $('#slide-out').css('transform','translateX(0px)');
            $('.closeit').css('transform','translateX(280px)');
        }

        if(show_hide == 'hide'){
            $('#slide-out').css('transform','translateX(-105%)');
            $('.closeit').css('transform','translateX(-40px)');
        }
        
    }

    $('.alert-success').fadeIn().delay(7000).fadeOut();
</script>

@yield('custom_js')
