@extends('frontend.layout.default')

@push('page-meta-tags')
<title>Appraise Your Property with Orbost &amp; District Real Estate</title>
@endpush

@push('body-class')
<body id="sell-page" class="bg-white pb-32px">
@endpush

@push('page-styles')
@endpush

@push('page-scripts')
<script type="text/javascript">
     $('#contact-form').on('submit', function(e)
          {    
               e.preventDefault();

               var formData = new FormData( this );

               $.ajax(
                    {
                         url: '{{ route('api.send.appraisal') }}',
                         method: 'POST',
                         data: formData,
                         cache: false,
                         contentType: false,
                         processData: false,

                         beforeSend: function()
                              {
                                   $('#submit').attr('disabled', 'disabled');
                                   $('#submit').html('Sending');
                              },

                         success: function(data)
                              {
                                   $('#submit').attr('disabled', false);
                                   $('#submit').html('Submit');
                                   $('#contact-form')[0].reset();

                                   data = JSON.parse(data);

                                   if (data.message == "success") {
                                        $('#email-response-reveal').foundation('open').find('.container').html("You request for appraisal have been sent. We will get back to you as soon as possible.");

                                   } else if (data.message == "failed") {
                                        $('#email-response-reveal').foundation('open').find('.container').html("Your message failed to send. Please try again.");

                                   } else {
                                        $('#email-response-reveal').foundation('open').find('.container').html("Error: " + data.message);
                                   }
                              },

                         error:function(data, xhr)
                              {
                                   $('#submit').attr('disabled', false);
                                   $('#submit').html('Submit');

                                   $('#email-response-reveal').foundation('open').find('.container').html(data);
                              }
                    });
          });
</script>
@endpush

@section('content')
<div class="vertical-separator pt-64px mb-82px"></div>

<section class="w-full mt-20">
  	<div class="grid-container posts-grid">
          <div class="grid-x align-center">
               <div class="cell large-10 text-center">
              		<h2 class="font-header text-color-orbost-red mb-20px">APPRAISE YOUR PROPERTY</h2>

              		<p class="mb-1">If you’re thinking of buying a new property it’s always a good idea to know how much your current property is worth. Simply fill in the form below and we will contact you to schedule for an appraisal.</p>
          	</div>
      	</div>

      	<form class="grid-x align-center" id="contact-form">
          	<div class="cell large-10">
          		<div class="grid-x grid-margin-x">
          			<div class="cell large-6">
          				<label class="block tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">First name</label>

          				<input name="first_name"  id="grid-first-name" type="text" require>
          			</div>

          			<div class="cell large-6">
          				<label class="block tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">Last name</label>

          				<input name="last_name"  id="grid-last-name" type="text" require>
          			</div>
          		</div>

          		<div class="grid-x grid-margin-x">
                         <div class="cell large-6">
          				<label class="block tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-email">Email</label>

          				<input name="email"  id="grid-email" type="text" require>
          			</div>

          			<div class="cell large-6">
          				<label class="block tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-phone">Phone</label>

          				<input name="phone"  id="grid-phone" type="text">
          			</div>
          		</div>

          		<div class="grid-x grid-margin-x">
                         <div class="cell large-8">
          				<label class="block tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-address">Address</label>

          				<input name="address"  id="grid-address" type="text" require>
          			</div>

          			<div class="cell large-4">
          				<label class="block tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-suburb">Suburb</label>

          				<input name="suburb"  id="grid-suburb" type="text" require>
          			</div>
          		</div>

          		<div class="grid-x grid-margin-x">
                         <div class="cell">
                              <button id="submit" class="cta red" type="submit">Submit</button>
                         </div>
                    </div>
          	</div>
          </form>
  	</div>
</section>

<div class="reveal small" id="email-response-reveal" data-reveal>
     <button class="close-button" data-close aria-label="Close modal" type="button">
          <i class="fas fa-times"></i>
     </button>

     <div class="container"></div>
</div>
@endsection