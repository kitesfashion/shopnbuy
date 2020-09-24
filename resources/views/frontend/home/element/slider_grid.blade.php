{{-- <div class="row">
    <div class="col-md-12">
        <ul class="slider" id="fullscreen-slider">
            @foreach ($sliders as $slider)
                <li>
                    <a @if(@$slider->link) href="{{@$slider->link}}" @endif>
                        @if(file_exists($slider->image))
                            <img src="{{ $slider->image}}" />
                        @else
                            <img src="{{ $noImage }}" style="height: 500px;width: 500px;" />
                        @endif
                    </a>
                </li>
            @endforeach
          </ul>
    </div>
</div> --}}

<div class="row mySlider">
    <div class="col-md-12">
        <div class="resCarousel" data-items="1-1-1-1" data-slide="1" data-speed="700" data-interval="4000">
            <div class="resCarousel-inner banner">
                @foreach ($sliders as $slider)
                    <div class="item">
                        <a @if(@$slider->link) href="{{@$slider->link}}" @endif>
                            @if(file_exists($slider->image))
                            <img src="{{ $slider->image}}" style="width: 100%;" />
                            @else
                                <img src="{{ $noImage }}" style="height: 360px;width: 360px;" />
                            @endif
                        </a>
                    </div>
                @endforeach
            </div>
            
            <button class='btn btn-default leftRs'><span><</span></button>
            <button class='btn btn-default rightRs'><span>></span></button>
        </div>
    </div>
</div>