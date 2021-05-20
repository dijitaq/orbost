@extends('frontend.layout.default')

@push('page-meta-tags')
<title>About Orbost &amp; District Real Estate</title>
@endpush

@push('body-class')
<body id="about-page" class="bg-white pb-32px">
@endpush

@push('page-styles')
@endpush

@push('page-scripts')
@endpush

@section('content')
<div class="vertical-separator pt-64px mb-82px"></div>

<section>
     <div class="grid-container">
          <div class="grid grid-x align-center">
               <div class="cell-10">
                    <h2 class="text-color-orbost-red">PROPERTIES FOR {{ $title }}</h2>
               </div>
          </div>

          <div class="grid grid-x align-center">
               <div class="cell large-10">
                    <div class="grid-x grid-margin-x listings-grid">
                         @foreach($listings as $listing)
                              <?php 
                                   $image = json_decode($listing->images);
                              ?>
                              
                              <div class="cell large-3 pb-25px">
                                   <a href="{{ url('listing') . '/' . $listing->listing_id . '/' . $listing->slug }}" style="background-image: url({{ $image[0] }});">

                                        @if($listing->status == "conditional")
                                             <p class="status background-color-orbost-blue">Under offer</p>

                                        @elseif($listing->status == "unconditional")
                                             <p class="status background-color-orbost-red">Sold</p>
                                        @endif
                                   </a>

                                   <p class="text-orbost-blue "><i class="fas fa-map-marker-alt"></i>
                                        <?php 
                                             $location = json_decode($listing->location);
                                             echo '<span class="capitalize">' . ucwords(strtolower($location[2]->suburb)) . '</span>,  <span class="capitalize">' . ucwords(strtolower($location[3]->state)) . '</span>';
                                        ?>
                                   </p>
                              </div>
                         @endforeach
                    </div>
               </div>
          </div>
     </div>
</section>

<div class="vertical-separator pt-64px mb-82px"></div>

@include('frontend.includes.appraise')

<div class="w-40 mx-auto border-b border-orbost-red my-24"></div>
@endsection