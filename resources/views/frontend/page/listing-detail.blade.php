@extends('frontend.layout.default')

@push('page-meta-tags')
<title>FOR {{ strtoupper($listing->listingtype) }} - {{ $title }} - Orbost &amp; District Real Estate</title>
@endpush

@push('body-class')
<body id="listing-detail-page" class="bg-white pb-32px">
@endpush

@push('page-styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />
@endpush

@push('page-scripts')
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDKJIH7Ywy7JzOcsm9NhbpiRnCraSx5Dzk"></script>
<script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>

<script type="text/javascript">
    function initialize_gmap() {
            var latlang = new google.maps.LatLng( {{ $latitude }}, {{ $longitude }} );
            
            var options = {
                center: latlang,
                zoom: 16,
                mapTypeId: google.maps.MapTypeId.ROADMAP,
                };

            var map = new google.maps.Map(document.getElementById("gmap"),  options);

            var marker = new google.maps.Marker({
                position: latlang,
                map: map,
            });
        }

        initialize_gmap();
</script>
@endpush

@section('content')
<div class="vertical-separator pt-64px mb-96px"></div>

<section>
    <div class="grid-container">
        <div class="grid-x align-center">
            <div class="cell large-9">
                <div class="grid-x align-center">
                    <div class="hero-image cell large-8 small-order-2 large-order-1" style="background-image: url({{ $images[0] }});">
                        
                        @if ($listing->status == "conditional")
                            <p class="status background-color-orbost-blue">Under offer</p>

                        @elseif ($listing->status == "unconditional")
                            <p class="status background-color-orbost-red">Sold</p>

                        @endif
                    </div>

                    <div class="heading cell large-4 small-order-1 large-order-2 background-color-orbost-blue" style="padding: 8px 15px;">
                        <p class="font-header text-color-white font-size-1-75x text-center large-text-left">{{ $listing->heading }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="vertical-separator pt-96px mb-82px"></div>

<section>
    <div class="grid-container">
        <div class="grid-x align-center">
            <div class="cell large-9">
                <div class="grid-x align-center">
                    <div class="cell large-8">
                        {!! $listing->description !!}

                        <div class="vertical-separator pt-96px mb-82px"></div>

                        <h2 class="text-color-orbost-red text-center">IMAGE GALLERY</h2>

                        <div class="grid-x grid-margin-x listings-grid">
                            @foreach($images as $image)
                                <div class="cell large-3">
                                    <a data-fancybox="gallery" href="{{ $image }}" style="background-image: url({{ $image }}); background-size: cover; padding-bottom: 56.35%; margin-bottom: 32px"></a>
                                </div>
                            @endforeach
                        </div>

                        <div class="vertical-separator pt-64px mb-82px"></div>

                        <h2 class="text-color-orbost-red text-center">LOCATION</h2>

                        <div id="gmap"></div>
                    </div>

                    <div class="cell large-4 text-center">
                        <p class="font-size-1-25x text-color-orbost-blue"><i class="fas fa-bed"></i> {{ $facilities[0]->bedrooms }} <i class="fas fa-bath ml-2"></i> {{ $facilities[1]->bathrooms }} <i class="fas fa-car-side ml-2"></i></i> {{ $facilities[2]->cars }}</p>

                        @if ($listing->status == "unconditional")
                            <p class="font-size-3 text-color-orbost-red">SOLD</p>

                        @else
                            <p class="font-size-3 text-color-orbost-red">$ {{ $listing->price }}</p>
                        @endif

                        <hr>

                        <p class="font-header font-size-1-5x text-color-orbost-red">Agent</p>

                        <div class="agent-image">
                            <img src="{{ $agents[3]->avatar }}">
                        </div>

                        <p class="font-size-1-25x text-color-orbost-blue">{{ $agents[0]->name }}</p>

                        <p class="text-color-orbost-blue"><i class="fas fa-envelope-open-text"></i>&nbsp;<a href="{{ $agents[1]->email }}" class="text-color-orbost-blue">{{ $agents[1]->email }}</a><br><i class="fas fa-mobile-alt"></i> {{ $agents[2]->telephone }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection