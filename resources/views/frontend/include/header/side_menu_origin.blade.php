@php
    use App\Category;
@endphp
<div _ngcontent-c1="" class="side-nav mdb-sidenav fixed" id="slide-out">
    <ul _ngcontent-c1="" class="custom-scrollbar list-unstyled">
        <li _ngcontent-c1="" class="logo-sn d-block waves-effect">
            <div _ngcontent-c1="" class="text-center">
                <a _ngcontent-c1="" class="pl-0" href="{{ url('/') }}">
                    @if(file_exists(@$information->siteLogo))
                        <img _ngcontent-c1="" id="MeenaClick-logo" src="{{asset('/').@$information->siteLogo}}">
                    @else
                        <img  src="{{$noImage}}">
                    @endif
                </a>
            </div>
        </li>
        <li _ngcontent-c1="">
            <ul _ngcontent-c1="" class="collapsible collapsible-accordion" id="side-menu">
                @foreach($publishedCategories as $category)
                    @php
                        $categoryName = str_replace(' ', '-', $category->categoryName);
                        $subcategory = Category::where('parent',$category->id)->where('categoryStatus',1)->get();
                        if(file_exists($category->headerImage)){
                            $categoryImage = asset($category->headerImage);
                        }else{
                            $categoryImage = asset('images/categories/category_offer.png');
                        }
                        if(count(@$subcategory) > 0){
                           $firstMenuLink = 'javascript:void(0)'; 
                        }else{
                            $firstMenuLink =  url('/categories/'.@$category->id.'/'.@$categoryName);
                        }
                        
                    @endphp 
                    <li _ngcontent-c1="" class="menu-item">
                        <a _ngcontent-c1="" href="{{@$firstMenuLink}}" class="collapsible-header waves-effect arrow-r">
                            <span _ngcontent-c1="" class="menu-icon">
                                <img _ngcontent-c1="" src="{{$categoryImage}}">
                            </span> {{$category->categoryName}}
                            <i _ngcontent-c1="" class="fa fa-angle-right rotate-icon"></i>
                        </a>
                        @if(count(@$subcategory) > 0)
                            <div _ngcontent-c1="" class="collapsible-body">
                                <ul _ngcontent-c1="" class="sub-menu">
                                    @php
                                        foreach ($subcategory as $subcat) {
                                        if ($subcat->parent == $category->id) { 
                                          $subCategoryName = str_replace(' ', '-', $subcat->categoryName);
                                          $secondMenuLink = url('/categories/'.@$subcat->id.'/'.@$subCategoryName);
                                    @endphp 
                                        <li _ngcontent-c1="" class="menu-item">
                                            <a _ngcontent-c1="" href="{{@$secondMenuLink}}" class="collapsible-header waves-effect">{{$subcat->categoryName}}</a>
                                        </li>
                                    @php
                                        } }
                                    @endphp
                                </ul>
                            </div>
                        @endif
                    </li>
                @endforeach
            </ul>
        </li>
        <div _ngcontent-c1="" class="contant-number">
            <p _ngcontent-c1="">
                <i _ngcontent-c1="" class="fa fa-phone"></i> Call Us: {{$information->mobile1}}
            </p>
        </div>
    </ul>
    <div _ngcontent-c1="" class="sidenav-bg mask-strong"></div>
</div>