<x-landing-layout>
    <x-slot name="title">
        <title>Tag | {{ config('app.name', 'Blog with SEO') }}</title>
    </x-slot>
    <x-slot name="seo_config">
        <meta name="description" content="Kumpulan Tag blog pada website {{ config('app.name', 'Blog with SEO') }}">
        <meta name="keywords" content="tag, blog, education, edukatif, teknologi, technology, @foreach($tags as $key => $tag){{ $key.', ' }}@endforeach">

        <meta name="copyright" content="Entol Rizky Development" />
        <meta name="owner" content="Entol Rizky Development" />
        <meta name="author" content="Entol Rizky Development" />
        <meta name="publisher" content="Entol Rizky Development">

        <meta name="blogcatalog" />
    </x-slot>


    <div class="max-w-full pb-10 pt-5">
        <div class="container max-w-[1140px] mx-auto px-3 md:px-3 lg:px-0 flex flex-col gap-5">
            <div class="flex justify-center items-center">
                <a href="">
                    <img src="https://merinda-nextjs.vercel.app/_next/image?url=%2Fassets%2Fimages%2Fads%2Fads-2.png&w=1200&q=75" alt="Ads 1">
                </a>
            </div>

            <div class="mb-5">
                <h2 class="border-b text-2xl md:text-3xl text-primary/80 pb-2 mb-3 text-center w-full">
                    <span class="border-b pb-2 border-primary font-lora font-normal">Blog Tag</span>
                </h2>

                <div class="text-center flex flex-wrap justify-center gap-3">
                    @foreach($tags as $key => $tag)
                    <a href="{{ route('tag.detail',$key) }}" class="text-sky-800 hover:text-[#03a87c] mx-4 inline-block lowercase">
                        <span>{{ $key }}</span>
                        <span class="bg-[#03a87c] text-white text-xs px-1 rounded-full text-center">{{ $tag }}</span></a>
                    @endforeach
                </div>
            </div>

        </div>


        <div class="flex justify-center items-center">
            <a href="">
                <img src="https://merinda-nextjs.vercel.app/_next/image?url=%2Fassets%2Fimages%2Fads%2Fads-2.png&w=1200&q=75" alt="Ads 1">
            </a>
        </div>
    </div>



</x-landing-layout>