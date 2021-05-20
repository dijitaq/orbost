@extends('frontend.layout.default')

@push('page-meta-tags')
<title>About Orbost &amp; District Real Estate</title>
@endpush

@push('body-class')
<body id="about-page" class="bg-white pb-32px">
@endpush

@push('page-styles')
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css">
@endpush

@push('page-scripts')
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>

<script type="text/javascript">
     $('#team-carousel').slick({
          arrows: false,
          dots: true,
          'appendDots': '.dots-container.team-carousel',
          customPaging: function(slider, i) {
                    return '<button>' + $(slider.$slides[i]).data('title') + '</button>';
               }
     });

     $('#testimonial-carousel').slick({
          arrows: false,
          dots: true,
          'appendDots': '.dots-container.testimonial-carousel',
          adaptiveHeight: true,
     });
</script>
@endpush

@section('content')
<div class="vertical-separator pt-64px mb-82px"></div>

<section>
     <div class="grid-container">
          <div class="grid-x align-center">
               <div class="cell large-10 text-center">
                    <h2 class="font-header text-color-orbost-red mb-20px">ABOUT ORBOST &amp; DISTRICT REAL ESTATE</h2>

                    <p class="mb-1">Orbost and Districts Real Estate is all about finding you the best property that is right for you and your needs.</p>

				<p class="mb-1">Specialising in sales and residential property management, we service the Orbost and Districts area, right across to Lakes Entrance and beyond.</p>

				<p class="mb-1">We approach property with our customers being at the centre of everything we do. Our priority is not just selling you a property but selling you one that is right for you. We show you around, listen to what you like and don’t like and we get you to experience what the region has to offer.</p>
               </div>
          </div>
     </div>
</section>

<section class="background-color-orbost-red mt-74px pt-82px pb-74px">
     <div class="grid-container">
          <div class="grid-x align-center">
               <div class="cell large-10">
                    <h2 class="font-header text-color-white text-center mb-20px">THE TEAM</h2>

                    <div class="dots-container team-carousel"></div>

                    <div id="team-carousel" class="relative text-center">
                         <div data-title="Anna Curren">
                              <h3 class="font-header text-color-white">Anna Curren</h3>

                              <p class="text-color-white">Extensive background in the hospitality and tourism industry, then went on to pursue her career in Real Estate in Omeo. This led to her and husband Kim to go that extra mile and take on a business in Orbost.  Anna has 10 years' experience in Property Management and Sales and small business management. The best part is working with people and achieving happy results. Family time is precious time spent fishing, listening to music and gardening or just kicking back.</p>
                         </div>

                         <div data-title="Kim Curren">
                              <h3 class="font-header text-color-white">Kim Curren</h3>

                              <p class="text-color-white">Has extensive hospitality experience, owned and operated family restaurant. Kim is now pursuing a career as an Agents Representative alongside his "trouble and strife" wife, Anna. A sense of humour indeed, but also excited to be on board the Orbost team to help build a business around making people feel at home.</p>
                         </div>

                         <div data-title="Casey Beveridge">
                              <h3 class="font-header text-color-white">Casey Beveridge</h3>

                              <p class="text-color-white">Locally born and bred. Married to Travis with 2 children.  Casey is well known in the area and has an excellent rapport with locals.  She loves the country life and is keen to pursue her career in Real Estate.  She has obtained her Agents Representative Certificate and is excelling in Property Management and Admin. </p>
                         </div>
                    </div>
               </div>
          </div>
     </div>
</section>

<section class="background-color-orbost-blue pt-82px pb-74px">
     <div class="grid-container">
          <div class="grid-x align-center">
               <div class="cell large-10">
                    <h2 class="font-header text-color-white text-center mb-20px">SATISFIED CUSTOMERS</h2>

                    <div id="testimonial-carousel" class="relative">
                         <div>
                              <p class="text-color-white">Thank you Anna.</p>

                              <p class="text-color-white">It's been a pleasure working with you and I appreciate your efforts a great deal. I'll miss our emails and chats :-)</p>

                              <p class="text-color-white">Best wishes to you and Kim</p>

                              <p class="text-color-white">Leanne</p>
                         </div>

                         <div>
                              <p class="text-color-white">I would like to express my extreme gratitude for ALL you have done for us, in the past 2 yrs. Our grateful thanks also, to both Kim & Casey as well, for their assistance when you were unable to be there.</p>

                              <p class="text-color-white">Being so far away, having someone we could trust in watching over the property in Orbost, as far as RENTING &amp; it's eventual SALE was concerned, was such a BLESSING for which we will always be grateful to you for.</p>

                              <p class="text-color-white">Your integrity &amp; supportiveness, in looking after the welfare of the home thru vetting any potential Tenant, has given us such a peace of mind, with no resulting problems to attend to & also ensured that the value of the home was maintained, throughout that time.</p>

                              <p class="text-color-white">Anna, whenever you could be, you were there to help us with any concerns &amp; a listening ear.</p>

                              <p class="text-color-white">My friend, I hope you'll always know how much that has meant to me personally &amp; to us as a family.</p>

                              <p class="text-color-white">May ALL you strive for come to fruition, in time.  May your health concerns resolve, or at the very least, be controlled enough, in order that you may have a life that, in the main, is enjoyable & worth the living, each &amp; every day.</p>

                              <p class="text-color-white">Looking forward to catching up with you when I'm next up there.</p>

                              <p class="text-color-white">Take care &amp; STAY SAFE.<br>Kindest regards ALWAYS,</p>

                              <p class="text-color-white">Mary Dyson x</p>

                         </div>
                    </div>

                    <div class="dots-container testimonial-carousel"></div>
               </div>
          </div>
     </div>
</section>

<div class="vertical-separator pt-96px mb-96px"></div>

@include('frontend.includes.blog')

@endsection