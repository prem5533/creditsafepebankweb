<div class="col-md-6 PR2 PLR15 PL0 tabletB">
    <section id="cta" class="cta YouTube">
        <div class="container">
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators myCarousel">
                    @if(count($banner))
                        @foreach($banner as $key => $value)
                            <li data-target="#carouselExampleIndicators" data-slide-to="{{$key}}" class="active"></li>
                        @endforeach
                    @endif
                </ol>
                <div class="carousel-inner">
                    @foreach($banner as $key => $value)
                        <div class="carousel-item {{$key==0 ? 'active':'' }}">
                            <h3 class="text-center">{{$translate['youtube_heading']}} {{$key+1}}</h3>
                            @if($value->book_id)
                                <a href="{{$value->banner_category_id=='1' ? '' :''}}/{{$value->book_id ? '' : $value->book_id}}">
                                    <img src="{{asset($value->banner_path)}}" class="" alt="">
                                </a>
                            @else
                                <iframe width="688" height="180" src="{{$value->banner_path}}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                            @endif
                        </div>
                    @endforeach
                </div>
                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">{{__('pagination.previous')}}</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">{{__('pagination.next')}}</span>
                </a>
            </div>
        </div>
    </section><!-- End Cta Section -->
</div>