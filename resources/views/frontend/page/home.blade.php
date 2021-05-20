@extends('frontend.layout.default')

@push('page-meta-tags')
<title>Orbost &amp; District Real Estate</title>
@endpush

@push('body-class')
<body id="home-page" class="bg-white pb-32px">
@endpush

@push('page-styles')
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css">
@endpush

@push('page-scripts')
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>

<script type="text/javascript">
	$(document).ready(function(){
		$('#home-carousel').slick({
			centerMode: true,
			slidesToShow: 2,
			arrows: false,

			responsive: [
				{
      				breakpoint: 480,
      				settings: {
      					centerMode: false,
        				slidesToShow: 1,
        				slidesToScroll: 1
      				}
    			}
			],
		});
	});
</script>
@endpush

@section('content')
<section id="hero-image" class="overflow-hidden position-relative">
	<div class="grid-container full">
		<div class="grid-x background-row">
			<div class="cell one">
			</div>

			<div class="cell two">
				
			</div>

			<div class="cell three">
				
			</div>

			<div class="cell four">
				
			</div>
		</div>

		<div class="grid-x background-row">
			<div class="cell five">
			</div>

			<div class="cell six">
				
			</div>

			<div class="cell seven">
				
			</div>

			<div class="cell eight">
				
			</div>
		</div>
	</div>

	<h1>Orbost &amp; Districts, <br class="show-for-small hide-for-large">a great place to call home.</h1>
</section>

<section>
	<div class="grid-container">
		<div class="grid-x align-center">
			<div class="large-10 text-center">
				<p class="lead">With over 25 years experience of finding  the right property for people, the Orbost and Districts Real Estate team are here to help you find the property that is right for you.</p>
			</div>
		</div>
	</div>
</section>

<div class="vertical-separator mt-74px mb-82px"></div>

<section>
	<div class="grid-container">
		<div class="grid-x align-center">
			<div class="cell large-10">
				<h2 class="font-header font-bold text-3xl text-orbost-red text-center">LATEST LISTED PROPERTIES</h2>

				<div class="grid-x grid-margin-x listings-grid">
					@for ($i = 3; $i < 7; $i++)
						<?php 
							$image = json_decode($listings[$i]->images);
						?>

						<div class=" cell large-3 pb-25px">
							<a href="{{ url('listing') . '/' . $listings[$i]->listing_id . '/' . $listings[$i]->slug }}" class="w-full block" style="background-image: url({{ $image[0] }}); background-size: cover; padding-bottom: 56.35%;">

							</a>

							<p class="type">FOR {{ strtoupper($listings[$i]->listingtype) }}</p>

							<p><i class="fas fa-map-marker-alt"></i>
								<?php 
									$location = json_decode($listings[$i]->location);

									echo '<span class="capitalize">' . ucwords(strtolower($location[2]->suburb)) . '</span>,  <span class="capitalize">' . ucwords(strtolower($location[3]->state)) . '</span>';
								?>
							</p>
						</div>
					@endfor
				</div>
			</div>
		</div>
	</div>
</section>

<div class="vertical-separator mt-74px mb-82px"></div>

@include('frontend.includes.appraise')

<div class="vertical-separator mt-96px mb-96px"></div>

@include('frontend.includes.blog')


@endsection