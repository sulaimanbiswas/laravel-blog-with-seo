<x-landing-layout>

	<x-slot name="seo_config">
		<meta name="description" content="Dapatkan informasi edukatif seputar perkembangan teknologi, pengembangan infastruktur, perangkat lunak dan berbagai hal teknologi lainnya.">
		<meta name="keywords" content="@foreach($tags as $key => $val){{$key .','}} @endforeach {{ config('app.name', 'Blog with SEO') }}">

		<meta name="copyright" content="Entol Rizky Development" />
		<meta name="owner" content="Entol Rizky Development" />
		<meta name="author" content="Entol Rizky Development" />
		<meta name="publisher" content="Entol Rizky Development">
		<meta property="og:image" content="{{ asset('assets/picture/blog_thumnail.png') }}" />
		<script type="application/ld+json">
			{
				"@context": "https://schema.org",
				"@graph": [{
						"@type": "CollectionPage",
						"@id": "{{ url('/') }}",
						"url": "{{ url('/') }}",
						"name": "{{ config('app.name', 'Blog') }} - Informasi, Tutorial Pengembangan Infrastuktur Teknologi",
						"isPartOf": {
							"@id": "{{ url('/') }}"
						},
						"about": {
							"@id": "{{ url('/about') }}"
						},
						"description": "Dapatkan informasi edukatif seputar perkembangan teknologi, pengembangan infastruktur, perangkat lunak dan berbagai hal teknologi lainnya.",
						"inLanguage": "id-ID"
					},
					{
						"@type": "BreadcrumbList",
						"itemListElement": [{
								"@type": "ListItem",
								"position": 1,
								"name": "Home",
								"item": "{{ route('index') }}"
							},
							{
								"@type": "ListItem",
								"position": 2,
								"name": "Tag",
								"item": "{{ route('tag') }}"
							},
							{
								"@type": "ListItem",
								"position": 3,
								"name": "Contac tus",
								"item": "{{ route('index') }}"
							}
						]
					},
					{
						"@type": "WebSite",
						"@id": "{{ url('/') }}",
						"url": "{{ url('/') }}",
						"name": "{{ config('app.name', 'Blog') }}",
						"description": "Dapatkan informasi edukatif seputar perkembangan teknologi, pengembangan infastruktur, perangkat lunak dan berbagai hal teknologi lainnya",
						"publisher": {
							"@id": "{{ url('/') }}#organization"
						},
						"inLanguage": "id-ID"
					},
					{
						"@type": "Organization",
						"@id": "{{ url('/') }}",
						"name": "{{ config('app.name', 'Blog') }}",
						"url": "{{ url('/') }}",
						"logo": {
							"@type": "ImageObject",
							"inLanguage": "en-US",
							"@id": "{{ url('/') }}#",
							"url": "{{ asset('assets/picture/blog_thumnail.png') }}",
							"contentUrl": "{{ asset('assets/picture/blog_thumnail.png') }}",
							"width": 1920,
							"height": 1080,
							"caption": "Home | {{ config('app.name', 'Blog') }}"
						},
						"sameAs": [
							"https://www.instagram.com/meeerrrm/",
							"https://www.facebook.com/MuhammadE.Rizky08/",
							"https://github.com/meeerrrm",
							"https://www.linkedin.com/in/mohammad-entol-rizky/",
							"https://entolrizky.com"
						]
					}
				]
			}
		</script>
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

	</x-slot>


	<div class="max-w-full py-20  ">
		<div class="container max-w-[1140px] mx-auto ">
			<section class="grid grid-cols-12 gap-5 border-b pb-10">
				<div class="col-span-12 md:col-span-9">
					<h2 class="border-b text-2xl pb-2 mb-7">
						<span class="font-bold border-b pb-2.5 border-primary font-cabin">Editor's Picks</span>
					</h2>
					<div class="grid grid-cols-12 gap-5">
						<div class="col-span-12 md:col-span-6">
							@foreach($featuredMain as $blog)
							<div class="flex flex-col gap-4">
								<figure>
									<a href="{{ route('blog.detail',$blog->uniq) }}">
										<div class="aspect-video overflow-hidden bg-slate-400">
											<img src="{{ asset($blog->thumnail) }}" class="aspect-video w-auto transition-all object-contain mx-auto" alt="{{ $blog->title }}">
										</div>
									</a>
								</figure>
								<h3 class="text-[22px] font-bold font-cabin">
									<a href="{{ route('blog.detail',$blog->uniq) }}">{{ $blog->title }}</a>
								</h3>
								<div class="text-primary/50">
									{{ $blog->description }}
								</div>
								<div class="text-primary/50 flex items-center gap-2 font-cabin text-xs">
									<span>{{ $blog->created_at->format('F d, Y') }}</span>
									<span>-</span>
									<span>{{ count($blog->blog_view_log) }} Views</span>
								</div>
							</div>
							@endforeach
						</div>
						<div class="col-span-12 md:col-span-6 flex flex-col gap-4">
							@foreach($featuredSide as $blog)
							<article>
								<div class="grid grid-cols-12 gap-4">
									<div class="col-span-4">
										<figure>
											<a href="{{ route('blog.detail',$blog->uniq) }}">
												<div class="aspect-video overflow-hidden bg-slate-400">
													<img src="{{ asset($blog->thumnail) }}" class="aspect-video w-auto transition-all object-contain mx-auto" alt="{{ $blog->title }}">
												</div>
											</a>
										</figure>
									</div>
									<div class="col-span-8 flex flex-col justify-between">
										<h5 class="text-[17.5px] font-bold font-cabin text-primary/80">
											<a href="{{ route('blog.detail',$blog->uniq) }}" class="pt-0">
												{{ $blog->title }}
											</a>
										</h5>
										<div class="text-primary/50 flex items-center gap-2 font-cabin text-xs">
											<span>{{ $blog->created_at->format('F d, Y') }}</span>
											<span>-</span>
											<span>{{ count($blog->blog_view_log) }} Views</span>
										</div>
									</div>
								</div>
							</article>
							@endforeach
						</div>
					</div>
				</div>
				<div class="col-span-12 md:col-span-3">
					<h2 class="border-b text-2xl pb-2 mb-7">
						<span class="font-bold border-b pb-2.5 border-primary font-cabin">Trending</span>
					</h2>
					<div class="grid grid-cols-12 gap-2">
						<div class="col-span-12 flex flex-col gap-4">
							@foreach($trending as $blog)
							<article>
								<ol class="">
									<div class=" flex flex-col justify-between">
										<h5 class="text-[17.5px] font-bold font-cabin text-primary/80">
											<a href="{{ route('blog.detail',$blog->uniq) }}" class="pt-0">
												{{ $blog->title }}
											</a>
										</h5>
										<div class="text-primary/50 flex items-center gap-2 font-cabin text-xs">
											<span>{{ $blog->created_at->format('F d, Y') }}</span>
											<span>-</span>
											<span>{{ count($blog->blog_view_log) }} Views</span>
										</div>
									</div>
								</ol>
							</article>
							@endforeach
						</div>
					</div>
				</div>
			</section>
			<section class="py-10">
				<div class="swiper">
					<!-- Additional required wrapper -->
					<div class="swiper-wrapper">
						<!-- Slides -->
						<div class="swiper-slide">
							<section class="max-w-6xl mx-auto p-4 mt-8">
								<div class="p-6 flex flex-col md:flex-row gap-6">
									<div class="flex-1">
										<h2 class="text-sm text-gray-500 mb-2">Readers Vote</h2>
										<h2 class="text-3xl font-bold mb-2">
											What No One Tells You About Leaving a Job You Were 'Good At'
										</h2>
										<p class="text-gray-600 text-sm mt-5">
											I was competent, praised, and promoted—but I wasn't happy. Walking
											away from something you're good at is terrifying, especially when
											people don't understand why. This is what I wish someone had told me
											before I made that leap.
										</p>
										<div class="flex flex-col mt-5">
											<p class="text-xs text-gray-500 mt-1">
												<span class="text-black font-medium">Alentica</span> in
												<span class="text-black">Police</span>
											</p>
											<p class="text-xs text-gray-500 mt-1">
												Jun 16 &nbsp;·&nbsp; 7 min read
												<span class="text-gray-400">★</span>
											</p>
										</div>
									</div>
									<div class="w-full md:w-1/2">
										<img src="assets/blog_pic_1.png" alt="Job Story" class="w-full" />
									</div>
								</div>
								<div class="border-t border-gray-300 mt-6"></div>
							</section>
						</div>
						<div class="swiper-slide bg-gray-200 h-20">Slide 2</div>
						<div class="swiper-slide bg-red-500 h-20">Slide 3</div>
					</div>
					<!-- If we need pagination -->
					<div class="swiper-pagination"></div>

				</div>
			</section>
		</div>
	</div>

	<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

	<script>
		const swiper = new Swiper(".swiper", {
			slidesPerView: 3,
			spaceBetween: 30,
			// Optional parameters
			// direction: "vertical",
			loop: true,
			autoplay: {
				delay: 2500,
				disableOnInteraction: false,
			},

			// If we need pagination
			pagination: {
				el: ".swiper-pagination",
			},

			// Responsive breakpoints
			breakpoints: {
				// when window width is >= 576px
				576: {
					slidesPerView: 1,
					spaceBetween: 30,
				},
				// when window width is >= 768px
				768: {
					slidesPerView: 1,
					spaceBetween: 30,
				},
				// when window width is >= 992px
				992: {
					slidesPerView: 1,
					spaceBetween: 30,
				},
			},
		});
	</script>

</x-landing-layout>