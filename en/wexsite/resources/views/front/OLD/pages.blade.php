@extends('front.new_layout')
@section('content')

</header>
</div>
<div id="Content">
	<div class="content_wrapper clearfix">
		<div class="sections_group">
			<div class="entry-content">
				<div class="section flv_sections_8" id="orientation-test">
					<div class="section_wrapper clearfix">
						<div class="items_group clearfix">
							<!-- Page Title-->
							<!-- One full width row-->
							<div class="column one column_fancy_heading">
								<div class="fancy_heading fancy_heading_icon">
									<h2 style="background: url('{{ asset('frontend/immagini/linea-titolo-verde.png') }}') no-repeat bottom center; padding-bottom: 25px;">ABOUT US</h2>
								</div>
							</div>

							<div class="column two-third column_column">
								<div class="column_attr ">
									<p>
                                                    <span class="big">We are a group people who believe that life is about continuous transformation, and some transitions may require more preparation and support, in order to become true learning experiences.<br>
We believe that there is a very powerful sensation of liberty in undergoing many transitions during one’s lifetime, to learn new aspects of oneself and of others in different circumstances. <br>
We believe in building strong foundations to enable you to soar high and achieve your full potential.<br>
We are people who believe that “a goal without a plan is just a wish” (Antoine de Saint-Exupery).<br>
We are experts in the area of career services, leveraging on technology and complementary expertise to create for you a unique personal and professional journey…because you are what you do, and what you do makes you who you are!</span>
									</p>
								</div>
							</div>
							<div class="column one-third column_image">
								<div class="image_frame no_link scale-with-grid no_border aligncenter">
									<div class="image_wrapper"><img class="scale-with-grid" src="{{ asset('frontend/immagini/logo-wexplore.png') }}" alt="" />
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="section flv_sections_6" style="margin-top:50px;" id="global-toolbox">
					<div class="section_wrapper clearfix">
						<div class="items_group clearfix">
							<!-- Page Title-->
							<!-- One full width row-->
							<div class="column one column_fancy_heading">
								<div class="fancy_heading fancy_heading_icon">
									<h2 style="color:#1f87c7; background: url('{{ asset('frontend/immagini/linea-titolo-blu.png') }}') no-repeat bottom center; padding-bottom: 25px;">WHY WEXPLORE</h2>
									WE CREATE AN EMPOWERING JOURNEY TOWARDS YOUR GOAL</div>
							</div>
							<!-- One Second (2/3) Column --><!-- One Second (1/3) Column -->

							<div class="column one-fourth column_column" style="margin-bottom:10px;">
								<div class="column_attr">
									<p><span class="big">We are the only international career service available globally and focused on supporting the individual, not the companies.</span>
									</p>
								</div>
							</div>
							<div class="column mcb-column one-fourth column_column" style="margin-bottom:10px;">
								<div class="column_attr" style=" padding:0 5% 0 0;">
									<p><span class="big">We address the person as a whole, combining job search skills and career development with cultural, emotional, and practical issues that you might experience as a unique human being.</span>
									</p>
								</div>
							</div>

							<div class="column mcb-column one-fourth column_column" style="margin-bottom:10px;">
								<div class="column_attr" style=" padding:0 5% 0 0;">
									<p><span class="big">We back you up in all the phases and stages of your professional journey, from graduate to executive, from application to onboarding.</span> </p>
								</div>
							</div>

							<div class="column mcb-column one-fourth column_column" style="margin-bottom:10px;">
								<div class="column_attr" style=" padding:0 5% 0 0;">
									<p><span class="big">We provide effective online solutions with a human touch.</span></p>
								</div>
							</div>
						</div>
					</div>
				</div>

				<!-- FAQ Area --></div>
		</div>
	</div>
</div>
</div>



















{{--
<div class="container">
	<div class="row">
		<h3>{{ $page_title }}</h3>
		<div class="page_desc">{{ $desc }}</div>
	</div>
</div>--}}
@endsection

