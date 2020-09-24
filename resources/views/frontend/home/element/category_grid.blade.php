<app-category _ngcontent-c7="" _nghost-c9="">
  <div _ngcontent-c9="" class="row bg-grey text-center" id="categories">
    @foreach ($categoryList as $category)
    @php
      $categoryName = str_replace(' ', '-', $category->categoryName);
      $firstMenuLink =  url('/categories/'.@$category->id.'/'.@$categoryName);
    @endphp
      <div _ngcontent-c9="" class="col-6 col-md-3 pointer" tabindex="0">
        <div>
          <a href="{{@$firstMenuLink}}">
            @if(file_exists($category->image))
              <img _ngcontent-c9="" class="img img-fluid" src="{{ $category->image }}" style="width: 100%;">
            @else
              <img _ngcontent-c9="" class="img img-fluid rounded" src="{{$noImage}}">
            @endif

            <div _ngcontent-c9="" class="sub-header">
                <span _ngcontent-c9="" class="sub-heading">
                  @if(file_exists($category->headerImage))
                    <img _ngcontent-c7="" class="thumb-icon" src="{{ $category->headerImage }}" style="height: 20px;"> 
                  @endif
                  {{ $category->categoryName }}
                </span>
            </div>
          </a>
        </div>
      </div>
    @endforeach
  </div>
</app-category>