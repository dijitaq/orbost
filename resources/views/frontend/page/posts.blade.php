@extends('frontend.layout.default')

@push('page-meta-tags')
<title>Make it a Tree Change - Orbost &amp; District Real Estate</title>
@endpush

@push('body-class')
<body id="blog-page" class="bg-white pb-32px">
@endpush

@push('page-styles')
@endpush

@push('page-scripts')
@endpush

@section('content')
<section id="hero-image" class="grid-container full position-relative mb-96px">
     <div class="flex-container flex-dir-column align-center position-relative" style="width: 100%; height: 100%; left: 0; top: 0">
          <h1 class="text-color-white text-center">MAKE IT A TREE CHANGE</h1>
     </div>
</section>

<section>
     <div class="grid-container posts-grid">
          <div class="grid-x align-center">
               <div class="cell large-10">
                    @foreach ($posts as $post)
                    <div class="grid-x">
                         <div class="cell large-1 date flex-container flex-dir-column align-center">
                              @php
                                   $orig_date = $post->publish_date;

                                   $month = date("M", strtotime($orig_date));
                                   $day = date("d", strtotime($orig_date));
                                   $year = date("Y", strtotime($orig_date));
                              @endphp
                              <p class="font-header text-white text-center">
                                   {{ $month }}<br><span class="font-size-2-5x">{{ $day }}</span><br>{{ $year }}
                              </p>
                         </div>

                         <div class="cell large-11 pl-15px">
                              <h3><a href="{{ url('article/'.$post->slug) }}" class="text-color-orbost-red">{{ $post->title }}</a></h3>

                              <p class="italic">Posted by {{ $post->author->name }}</p>

                              <p>{{ $post->excerpt }}</p>
                         </div>
                    </div>
                    @endforeach
               </div>
          </div>
     </div>
</section>
@endsection