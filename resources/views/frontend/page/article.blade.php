@extends('frontend.layout.default')

@push('page-meta-tags')
<title>{{ $post->title }} - Make it a Tree Change - Orbost &amp; District Real Estate</title>
<meta property="og:title" content="About Jimbaran Hijau">
<meta property="og:type" content="Real estate">
<meta property="og:url" content="{{ $url }}">
<meta property="og:site_name" content="Orbost & District Real Estate">
<meta property="og:description" content="{{ $post->excerpt }}">
@endpush

@push('body-class')
<body id="article-page" class="bg-white pb-32px">
@endpush

@push('page-styles')
@endpush

@push('page-scripts')
<script type="text/javascript">
     $('[rel="share"]').on('click', function(e) {
               e.preventDefault();
               var url = $(this).attr('url');

               $.ajax(url)
                    .done(function(resp){
                         $('#facebook-reveal').foundation('open').find('.container').html(resp);
                    });
          });
</script>
@endpush

@section('content')
<div class="vertical-separator pt-64px mb-82px"></div>

<section>
     <div class="grid-container">
          <div class="grid-x align-center">
               <div class="cell large-10 text-center">
                    <h1 class="text-color-orbost-red mb-33px">{{ $post->title }}</h1>
               </div>
          </div>

          <div class="grid-x align-center">
               <div class="cell large-9 text">
                    {!! $post->content !!}
               </div>
          </div>

          <div class="grid-x align-center">
               <div class="cell large-9 text-center">
                    <div class="vertical-separator mb-74px"></div>

                    <h2>Share article</h2>

                    <ul class="navigation social-media">
                        <li>
                            <a onclick="window.open('https://www.facebook.com/sharer.php?u=<?php echo htmlentities($url); ?>', '', 'width=200,height=100');">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                        </li>
                    </ul>
               </div>
          </div>
     </div>
</section>

<div class="reveal small" id="facebook-reveal" data-reveal>
     <button class="close-button" data-close aria-label="Close modal" type="button">
          <i class="fas fa-times"></i>
     </button>

     <div class="container"></div>
</div>
@endsection