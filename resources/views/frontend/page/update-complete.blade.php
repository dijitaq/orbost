@extends('frontend.layout.update')

@push('page-meta-tags')
<title>Update Listings - Orbost &amp; District Real Estate</title>
@endpush

@push('body-class')
<body class="bg-white pb-32px">
@endpush

@push('page-styles')
@endpush

@push('page-scripts')

@endpush

@section('content')
<div class="vertical-separator pt-64px mb-82px"></div>

<section class="w-full mt-20">
  	<div class="grid-container posts-grid">
          <div class="grid-x align-center">
               <div class="cell large-10 text-center">
              		<h2 class="font-header text-color-orbost-red mb-20px">UPDATE COMPLETE</h2>

              		<p class="mb-1"><a href="{{ route('home') }}">Click here to go back to the home page.</a></p>
          	</div>
      	</div>
      </div>
 </section>
@endsection