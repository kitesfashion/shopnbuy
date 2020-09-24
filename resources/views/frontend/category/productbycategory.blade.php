@extends('frontend.master')

@section('mainContent')
  <app-category-page _nghost-c4="">
    <input type="hidden" class="categoryId" value="{{@$category->id}}">
    <input type="hidden" id="filterBy" value="">
    <input type="hidden" id="sortingBy" value="orderBy">
    <input type="hidden" id="sortingOrder" value="asc">
    <input type="hidden" id="productLimit" value="40">

    <div _ngcontent-c4="" id="skip-header"></div>
    <div _ngcontent-c4="" class="row no-gutters">
        <div _ngcontent-c4="" class="col-md-12 col-12 p-12 mb-2">
            <div _ngcontent-c4="">
                <div _ngcontent-c4="" class="row bg-white">
                    <div _ngcontent-c4="" class="col-md-5 p-3 text-right cst-no-text-right">
                        Products Filter
                        <button _ngcontent-c4="" class="btn btn-sm btn-filter-by-discount" onclick="ProductFilterBy('discount','asc')">
                          <i _ngcontent-c4="" aria-hidden="true" class="fa fa-tag"></i> Discount</button>
                    </div>
                    <div _ngcontent-c4="" col-md-1=""></div>
                    <div _ngcontent-c4="" class="col-md-5 p-3 text-left">
                        Sort
                        <button _ngcontent-c4="" class="btn btn-sm btn-sort-asc" onclick="ProductSortBy('price','asc')">
                          <i _ngcontent-c4="" aria-hidden="true" class="fa fa-arrow-up"></i> Low to High
                        </button>
                        <button _ngcontent-c4="" class="btn btn-sm btn-sort-dsc" onclick="ProductSortBy('price','desc')">
                          <i _ngcontent-c4="" aria-hidden="true" class="fa fa-arrow-down"></i> High to Low
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div _ngcontent-c4="" class="row no-gutters bg-white" id="categoryProductList">
    </div>

    <div _ngcontent-c4="">
      <div _ngcontent-c4="" class="row bg-grey">
          <div _ngcontent-c4="" class="col-md-12 p-3 text-center">
              <button _ngcontent-c4="" id="viewMore" class="btn btn-sm add-to-bag" onclick="ViewMore()">View More
                  <i _ngcontent-c4="" aria-hidden="true" class="fa fa-arrow-down"></i>
              </button>
          </div>
      </div>
    </div>
  </app-category-page>

@endsection