<x-landing-layout>
  <x-slot name="title">
    <title>{{ $blog->title }}</title>
  </x-slot>
  <x-slot name="seo_config">
    <meta name="description" content="{{ $blog->description }}">
    <meta name="keywords" content="@foreach(json_decode($blog->tag) as $val){{ $val }}, @endforeach{{ $blog->keyword }},{{ strtolower($blog->user->name) }}">
    <meta name="author" content="{{ $blog->user->name }}" />
    <meta name="publisher" content="{{ config('app.name', 'Blog with SEO') }}">
    <meta property="og:title" content="{{ $blog->title }}" />
    <meta property="og:type" content="article" />
    <meta property="og:url" content="{{ Request::url() }}" />
    <meta property="og:image" content="{{ asset('assets/blog/'.$blog->thumnail) }}" />
    <meta property="og:image:alt" content="{{ $blog->title }}" />
    <meta property="og:site_name" content="{{ config('app.name', 'Blog with SEO') }}" />
    <meta property="og:description" content="{{ $blog->description }}..." />
    <meta property="article:published_time" content="{{ $blog->publish_date }}" />
    <script type="application/ld+json">
      {
        "@context": "https://schema.org",
        "@graph": [{
            "@type": "Article",
            "@id": "{{ route('blog.detail',$blog->uniq) }}#article",
            "isPartOf": {
              "@id": "{{ route('blog.detail',$blog->uniq) }}"
            },
            "author": [{
              "@id": "{{ url('/') }}"
            }],
            "headline": "{{ $blog->title }}",
            "datePublished": "{{ $blog->publish_date }}T03:00:00+00:00",
            "dateModified": "{{ date('Y-m-d',strtotime($blog->updated_at)) }}T05:07:25+00:00",
            "mainEntityOfPage": {
              "@id": "{{ route('blog.detail',$blog->uniq) }}"
            },
            "wordCount": {
              {
                strlen($blog - > content)
              }
            },
            "publisher": {
              "@id": "{{ url('/') }}"
            },
            "image": {
              "@id": "{{ route('blog.detail',$blog->uniq) }}#primaryimage"
            },
            "thumbnailUrl": "{{ asset('assets/blog/'.$blog->thumnail) }}",
            // "keywords": [
            //   @foreach(explode(',', $blog -> keyword) as $key => $kw)
            //   "{{ trim($kw) }}"
            //   @if($key != array_key_last(explode(',', $blog -> keyword))), @endif
            //   @endforeach
            // ],
            "inLanguage": "en-US",
            "video": [{
              "@id": "{{ route('blog.detail',$blog->uniq) }}#video"
            }]
          },
          {
            "@type": "WebPage",
            "@id": "{{ route('blog.detail',$blog->uniq) }}",
            "url": "{{ route('blog.detail',$blog->uniq) }}",
            "name": "{{ $blog->title }}",
            "isPartOf": {
              "@id": "{{ url('/') }}"
            },
            "primaryImageOfPage": {
              "@id": "{{ route('blog.detail',$blog->uniq) }}#primaryimage"
            },
            "image": {
              "@id": "{{ route('blog.detail',$blog->uniq) }}#primaryimage"
            },
            "thumbnailUrl": "{{ asset('assets/blog/'.$blog->thumnail) }}",
            "datePublished": "2022-03-21T03:00:00+00:00",
            "dateModified": "2023-04-13T05:07:25+00:00",
            "description": "{{ $blog->description }}",
            "breadcrumb": {
              "@id": "{{ route('blog.detail',$blog->uniq) }}#breadcrumb"
            },
            "inLanguage": "en-US",
            "potentialAction": [{
              "@type": "ReadAction",
              "target": [
                "{{ route('blog.detail',$blog->uniq) }}"
              ]
            }]
          },
          {
            "@type": "ImageObject",
            "inLanguage": "en-US",
            "@id": "{{ route('blog.detail',$blog->uniq) }}#primaryimage",
            "url": "{{ asset('assets/blog/'.$blog->thumnail) }}",
            "contentUrl": "{{ asset('assets/blog/'.$blog->thumnail) }}",
            "width": 720,
            "height": 384,
            "caption": "{{ $blog->title }}"
          },
          {
            "@type": "BreadcrumbList",
            "@id": "{{ route('blog.detail',$blog->uniq) }}#breadcrumb",
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
                "name": "Portal",
                "item": "{{ url('/') }}"
              },
              @php $no = 4 @endphp
              @foreach($newest as $nw) {
                "@type": "ListItem",
                "position": {
                  {
                    $no++
                  }
                },
                "name": "{{ $nw->title }}",
                "item": "{{ route('blog.detail',$nw->uniq) }}"
              }
              @if($no != 7), @endif
              @endforeach
            ]
          },
          {
            "@type": "Organization",
            "@id": "{{ url('/') }}",
            "name": "Mohammad Entol Rizky",
            "url": "{{ url('/') }}",
            "logo": {
              "@type": "ImageObject",
              "inLanguage": "en-US",
              "@id": "{{ url('/') }}#",
              "url": "{{ url('/assets/logo/logo.png') }}",
              "contentUrl": "{{ url('/assets/logo/logo.png') }}",
              "width": 1920,
              "height": 1080,
              "caption": "{{ config('app.name', 'Blog with SEO') }}"
            },
            "image": {
              "@id": "{{ url('/') }}#/schema/logo/image/"
            },
            "sameAs": [
              "https://www.instagram.com/meeerrrm/",
              "https://www.facebook.com/MuhammadE.Rizky08/",
              "https://github.com/meeerrrm",
              "https://www.linkedin.com/in/mohammad-entol-rizky/",
              "{{ url('/') }}"
            ]
          },
          {
            "@type": "Person",
            "@id": "{{ url('/') }}",
            "name": "{{ $blog->user->name}}",
            "image": {
              "@type": "ImageObject",
              "inLanguage": "en-US",
              "@id": "{{ url('/') }}",
              "url": "{{ url('/assets/picture/'.$blog->user->profile_picture) }}",
              "contentUrl": "{{ url('/assets/picture/'.$blog->user->profile_picture) }}",
              "caption": "{{ $blog->user->name}}"
            },
            "url": "{{ url('/') }}"
          }
        ]
      }
    </script>
  </x-slot>
  <div class="">

    <div class="max-w-full pb-10 pt-5">
      <div class="container max-w-[1140px] mx-auto px-3 md:px-0 flex flex-col gap-5">
        <div class="flex justify-center items-center">
          <a href="">
            <img src="https://merinda-nextjs.vercel.app/_next/image?url=%2Fassets%2Fimages%2Fads%2Fads-2.png&w=1200&q=75" alt="Ads 1">
          </a>
        </div>

        <div class="max-w-[800px] mx-auto">
          <h1 class="text-primary/80 text-2xl md:text-3xl lg:text-[40px] font-lora font-medium lg:leading-[50px]">
            {{ $blog->title }}
          </h1>

          <div class="flex items-center gap-5 mt-5">
            <div class="">
              <div class="rounded-full w-10 h-10 overflow-hidden mx-auto">
                <img src="{{ asset($blog->user->profile_picture) }}" alt="Profile Picture - {{ $blog->user->name}}" class="h-full">
              </div>
            </div>
            <div class="">
              <p class="font-cabin text-primary text-xs font-bold">{{ strtoupper($blog->user->name) }}</p>
              <p class="font-cabin text-primary text-xs">Publish at <strong>{{ date('d F Y',strtotime($blog->publish_date)) }}</strong></p>
            </div>
          </div>
        </div>

        <div class="aspect-video bg-slate-900 rounded-md overflow-hidden group" id="imagePlace">
          <img src="{{ asset($blog->thumnail) }}" class="mx-auto h-full  transition-transform duration-[2000ms] ease-in-out transform group-hover:scale-105" alt="{{ $blog->title }}">
        </div>

        <div class="max-w-[800px] mx-auto flex flex-col gap-5">
          <article class="text-left lg:text-xl format lg:format-lg format-green max-w-none text-gray-800 font-lora first-letter:text-[80px] first-letter:font-medium first-letter:float-left first-letter:mt-1 first-letter:mr-2 first-letter:leading-none">
            {!! json_decode($blog->content) !!}
          </article>

          <div class="text-left">
            @foreach(json_decode($blog->tag) as $tag)
            <a href="{{ route('tag.detail',$tag) }}" class="bg-gray-200 p-1 px-2 rounded-sm text-black font-cabin transition-all hover:text-[#03a87c] text-sm inline-block mt-1">{{ $tag }}</a>
            @endforeach
          </div>
        </div>


      </div>
    </div>

  </div>
  <x-slot name="js">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.8.0/styles/stackoverflow-dark.min.css">
    <script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/11.7.0/highlight.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/highlightjs-line-numbers.js/2.8.0/highlightjs-line-numbers.min.js"></script>
    <script>
      hljs.highlightAll();
      hljs.initLineNumbersOnLoad();
    </script>
    <script>
      $(document).ready(function() {
        $('#mainContent').ready(function() {
          $("pre").addClass("bg-[#1c1b1b]");
          $(".hljs-ln-numbers").addClass('!pr-4 border-r-2 border-r-gray-600');
          $(".hljs-ln-code").addClass('!pl-2')
          $(".hljs-ln").find('tr').addClass('!border-0');
        });
      });
    </script>
  </x-slot>
</x-landing-layout>