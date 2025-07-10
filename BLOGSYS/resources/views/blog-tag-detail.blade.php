<x-landing-layout>
	<x-slot name="title">
		<title>{{ $tag }} | {{ config('app.name', 'Blog') }}</title>
	</x-slot>
	<x-slot name="seo_config">
		<meta name="description" content="Tag blog {{ $tag }} dengan konten edukatif yang berisi seputar teknologi.">
		<meta name="keywords" content="tag, blog, education, edukatif, teknologi, technology">
		<meta name="copyright" content="Entol Rizky Development" />
		<meta name="owner" content="Entol Rizky Development" />
		<meta name="author" content="Entol Rizky Development" />
		<meta name="publisher" content="Entol Rizky Development">
		<meta name="blogcatalog" />
	</x-slot>



	<div class="max-w-full pb-10 pt-5">
		<div class="container max-w-[1140px] mx-auto px-3 md:px-0 flex flex-col gap-5">
			<div class="flex justify-center items-center">
				<a href="">
					<img src="https://merinda-nextjs.vercel.app/_next/image?url=%2Fassets%2Fimages%2Fads%2Fads-2.png&w=1200&q=75" alt="Ads 1">
				</a>
			</div>

			<div class="">
				<h2 class="border-b text-2xl md:text-3xl text-primary/80 pb-2 mb-3 text-center w-full">
					<span class="border-b pb-2 border-primary font-lora font-normal">{{ $tag }}</span>
				</h2>
			</div>
			@if(count($blogs) > 0)
			<div class="grid grid-cols-12 gap-5">
				@foreach($blogs as $index => $blog)
				<div class="col-span-12 md:col-span-4">
					<div class="flex flex-col gap-4">
						<figure>
							<a href="{{ route('blog.detail',$blog->uniq) }}">
								<div class="aspect-video overflow-hidden bg-slate-400">
									<img src="{{ asset($blog->thumnail) }}" class="aspect-video w-auto transition-all object-contain mx-auto" alt="{{ $blog->title }}">
								</div>
							</a>
						</figure>
						<div class="flex flex-col gap-2">
							<h3 class="text-xl font-bold font-cabin">
								<a href="{{ route('blog.detail',$blog->uniq) }}">{{ $blog->title }}</a>
							</h3>
							<div class="text-primary/50 flex items-center gap-2 font-cabin text-xs">
								<span>{{ $blog->created_at->format('F d, Y') }}</span>
								<span>-</span>
								<span>{{ count($blog->blog_view_log) }} Views</span>
							</div>
						</div>

					</div>
				</div>
				@if(($index + 1) % 6 === 0 && ($index + 1) < count($blogs))
					<div class="col-span-12">
					<div class="flex justify-center items-center my-6">
						<a href="#">
							<img src="https://merinda-nextjs.vercel.app/_next/image?url=%2Fassets%2Fimages%2Fads%2Fads-2.png&w=1200&q=75" alt="Ads 1">
						</a>
					</div>
			</div>
			@endif
			@endforeach
		</div>
		@else
		<div class="md:col-span-3 h-[30vh]">
			<h2 class="text-black text-2xl">Blog with <b>{{ $tag }}</b> tag not found.</h2>
		</div>
		@endif
		{{ $blogs->links() }}

		<div class="flex justify-center items-center">
			<a href="">
				<img src="https://merinda-nextjs.vercel.app/_next/image?url=%2Fassets%2Fimages%2Fads%2Fads-2.png&w=1200&q=75" alt="Ads 1">
			</a>
		</div>
	</div>
	</div>
</x-landing-layout>