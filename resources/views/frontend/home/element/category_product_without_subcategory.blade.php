@php
    use App\Product;
    use App\ProductImage;
@endphp
@foreach ($homeCategoryListWithoutSubcategory as $homeCategory)
    @php
        $homeCategoryProductList = Product::where('category_id',$homeCategory->id)
                                ->where('status',1)
                                ->orderBy('orderBy',"ASC")
                                ->get();
        $categoryName = str_replace(' ', '-', $homeCategory->categoryName);
        $categoryLink =  url('/categories/'.@$homeCategory->id.'/'.@$categoryName);
    @endphp
    <app-books-collection _ngcontent-c7="" _nghost-c10="">
        <div _ngcontent-c10="" class="row pt-1 pb-1 bg-grey">
            <div _ngcontent-c10="" class="col-md-12 text-center pointer" tabindex="0">
                <a href="{{$categoryLink}}">
                    {{-- <img _ngcontent-c10="" alt="Flash Deals" class="img img-fluid rounded" src="https://www.meenaclick.com/assets/img/section.png"> --}}
                    <div _ngcontent-c10="" class="categorySection">
                        <h3 _ngcontent-c10="">{{$homeCategory->categoryName}}</h3>
                    </div>
                </a>
            </div>
        </div>
    </app-books-collection>
@endforeach

