@php
  use App\Menu;
    $menuList = Menu::orderBy('orderBy','ASC')->where('showInFooterMenu','yes')->where('menuStatus','1')->where('parent',NULL)->orWhere(\DB::raw('menus.id'), '=', \DB::raw('menus.parent'))->get();
@endphp
<div _ngcontent-c2="" class="text-center text-md-left mt-1">
    <div _ngcontent-c2="" class="row mt-2" id="footer-menus">
        <div _ngcontent-c2="" class="col-md-3 col-lg-3 col-xl-3 mb-1">
            @if(file_exists(@$information->siteLogo))
                <img _ngcontent-c2="" class="img pt-3" src="{{asset('/').@$information->siteLogo}}" style="height: 120px;width:200px;">
                @else
                    <img _ngcontent-c2="" class="img pt-3" src="{{$noImage}}">
                @endif
        </div>
        <div _ngcontent-c2="" class="col-md-3 col-lg-4 col-xl-3 mb-1">
            @php
                $i = 0;
                foreach ($menuList as $menu){
                    $i++;
                    if($i == 5){
                        break;
                    }
                $menuName = str_replace(' ', '-', $menu->menuName);
            @endphp
                <p _ngcontent-c2="">
                    <a _ngcontent-c2="" href="{{ route('page.content',['menuName'=>$menuName,'menuId'=>$menu->id]) }}">{{$menu->menuName}}
                    </a>
                </p>
            @php
                }
            @endphp
        </div>
        <div _ngcontent-c2="" class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-1">
            @php
                $i = 0;
                foreach ($menuList as $menu){
                    $i++;
                    if($i > 4 ){
                $menuName = str_replace(' ', '-', $menu->menuName);
            @endphp
            <p _ngcontent-c2="">
                <a _ngcontent-c2="" href="{{ route('page.content',['menuName'=>$menuName,'menuId'=>$menu->id]) }}">{{$menu->menuName}}
                </a>
            </p>
            @php
                }
            }
            @endphp
        </div>
        <div _ngcontent-c2="" class="col-md-3 col-lg-3 col-xl-3">
            <div class="footerContact">
                <h6 _ngcontent-c2="" class="text-uppercase font-weight-bold">
                    <strong _ngcontent-c2="">Contact Us</strong>
                </h6>

                <p _ngcontent-c2="" id="footer-contact">
                    <a _ngcontent-c2="" class="no-cursor" href="javascript:void(0)">{{$information->siteAddress1}}
                    </a>

                    <br _ngcontent-c2="">
                    <a _ngcontent-c2="" class="no-cursor" href="javascript:void(0)">{{$information->siteAddress2}}
                    </a>

                    <br _ngcontent-c2="">
                    <a _ngcontent-c2="" class="no-cursor" href="javascript:void(0)">
                        <i _ngcontent-c2="" aria-hidden="true" class="fa fa-phone"></i> 
                        {{$information->mobile1}}
                    </a>

                    @if($information->mobile2)
                        <br _ngcontent-c2="">
                        <a _ngcontent-c2="" class="no-cursor" href="javascript:void(0)">
                            <i _ngcontent-c2="" aria-hidden="true" class="fa fa-phone"></i> 
                            {{$information->mobile2}}
                        </a>
                    @endif

                    <br _ngcontent-c2="">
                    <a _ngcontent-c2="" href="mailto:{{$information->siteEmail1}}" target="_top">
                        <i _ngcontent-c2="" class="fa fa-envelope"></i> 
                        {{$information->siteEmail1}}
                    </a>

                    @if($information->siteEmail2)
                        <br _ngcontent-c2="">
                        <a _ngcontent-c2="" href="mailto:{{$information->siteEmail2}}" target="_top">
                            <i _ngcontent-c2="" class="fa fa-envelope"></i> 
                            {{$information->siteEmail2}}
                        </a>
                    @endif
                </p>
            </div>
        </div>
    </div>
</div>