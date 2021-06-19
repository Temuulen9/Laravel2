@extends('layouts.app')
@section('styles')
<link href="{{ asset('css/main.css') }}" rel="stylesheet">
@endsection
@section('content')
    <div class=" justify-content-center">
        <div class = "back">
        <img src="/storage/uploads/back.jpg" class="responsive">
        </div>

                <section id ="one">

				<div class="container0">
					<header class="major">
						<h2>Манай сургалтууд</h2>
					
					</header>
					<div class="sub_container">
                        
                        
						<div class="columns">

							<section class="box">
							<img src="/storage/uploads/driving-license1.svg" class = "thumb" >
							
								<h3>Шинэ жолоочийн сургалт</h3>
								<p>B ангилал Хугацаа : 45 хоног, Дүрэм 7 хоногт 3 удаа, Жолоо 7 хоногт 2 удаа. Өөрт ойр салбартай холбогдож өөрийн боломжит хуваарийг сонгож хийлгэнэ.</p>
							</section>
						</div>
						<div class="columns">
							<section class="box">
							<img src="/storage/uploads/transportation1.svg" class = "thumb" >
							
								<h3>Ангилал ахиулах сургалт</h3>
								<p>Ангилал: A, C, D, E, M. Хугацаа: 14 хоног</p>
							</section>
						</div>
						<div class="columns">
							<section class="box">
							<img src="/storage/uploads/truck1.svg" class = "thumb" >
								<h3>Мэргэшсэн жолоо</h3>
								<p>C, E Мэргэшсэн жолоо, улс хооронд ачаа тээвэр, аюултай ачаа тээвэр, D нийтийн тээвэр, улс хооронд зорчигч тээвэр, жуулчин тээвэр, В такси үйлчилгээ Хугацаа: 21 хоног</p>
							</section>
						</div>
						
					</div>
				</div>
                </section>

            <section id="two">
            <div class="container1">
					<header class="major">
						<h2>Салбар</h2>
					
					</header>
                    
                    <div class="bot_container">
                    @foreach($branchs as $branch)
                    

						<div class="columns1">

							<section class="branch_box">
							<img src="/storage/{{ $branch->image }}" alt="" class = "branch_img">
							
								<h2>{{ $branch->name }}</h2>
                                <p>{{ $branch->location }}</p>
                                <p>Холбогдох утас : {{ $branch->phone_number }}</p>
								</section>
						</div>
                    
                      
                        @endforeach
						
					</div>
            <div>   
            </div>
        </section>

        <!-- Footer -->
			<footer id="footer">
				<div class="container">
					<section class="links">
						<div class="row">
						<section class="3u 6u(medium) 12u$(small)">
								<h3>Бидний тухай</h3>
								<ul class="unstyled">
									<li><a href="#">Номуунбаялаг авто сургууль</a></li>
									<li><a href="#" id = 'surgalt'>Сургалт</a></li>
									<li><a href="#" id = 'salbar'>Салбар</a></li>
								</ul>
							</section>
							<section class="3u 6u(medium) 12u$(small)">
								<h3>Холбоо барих</h3>
								<ul class="unstyled">
									<p> 99101504</p>
									<p> 96664399</p>
									
								</ul>
							</section>
							
						</div>
					</section>
					<div class="row">
						<div class="8u 12u$(medium)">
							<ul class="copyright">
								<li>&copy; Номуунбаялаг авто сургууль. All rights reserved.</li>
								
							</ul>
						</div>
						<!-- <div class="4u$ 12u$(medium)">
							<ul class="icons">
								<li>
									<a class="icon rounded fa-facebook"><span class="label">Facebook</span></a>
								</li>
								<li>
									<a class="icon rounded fa-twitter"><span class="label">Twitter</span></a>
								</li>
								<li>
									<a class="icon rounded fa-google-plus"><span class="label">Google+</span></a>
								</li>
								<li>
									<a class="icon rounded fa-linkedin"><span class="label">LinkedIn</span></a>
								</li>
							</ul>
						</div> -->
					</div>
				</div>
			</footer>
    </div>
  
@endsection