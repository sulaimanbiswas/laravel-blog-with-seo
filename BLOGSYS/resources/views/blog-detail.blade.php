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
             "keywords": [
               @foreach(explode(',', $blog -> keyword) as $key => $kw)
               "{{ trim($kw) }}"
               @if($key != array_key_last(explode(',', $blog -> keyword))), @endif
               @endforeach
             ],
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
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
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
           <h1 class="text-primary/80 text-2xl md:text-3xl lg:text-[40px] font-lora font-normal lg:leading-[50px]">
             {{ $blog->title }}
           </h1>

           <div class="flex items-center gap-5 mt-5">
             <div class="">
               <div class="rounded-full w-10 h-10 overflow-hidden mx-auto border p-1 flex items-center justify-center">
                 @if($blog->user->profile_picture)
                 <img src="{{ asset($blog->user->profile_picture) }}" alt="Profile Picture - {{ $blog->user->name }}" class="h-full w-full object-cover">
                 @else
                 <div class="h-full w-full flex items-center justify-center select-none">
                   <span class="font-semibold text-2xl text-gray-600 font-georgia">{{ strtoupper(substr($blog->user->name, 0, 1)) }}</span>
                 </div>
                 @endif
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

           <article id="article" class="text-left font-normal lg:text-lg format lg:format-lg format-green max-w-none text-gray-800 font-lora first-letter:text-[80px] first-letter:font-regular first-letter:float-left first-letter:mt-1 first-letter:mr-2 first-letter:leading-none">
             {!! json_decode($blog->content) !!}
           </article>

           <div class="text-left">
             @foreach(json_decode($blog->tag) as $tag)
             <a href="{{ route('tag.detail',$tag) }}" class="bg-gray-200 first-letter:uppercase p-1 px-2 rounded-sm text-black font-cabin transition-all hover:text-[#03a87c] text-sm inline-block mt-1">{{ $tag }}</a>
             @endforeach
           </div>

           <div
             class="flex items-center gap-2 self-start h-fit">
             <p>Share with: </p>
             <button
               class="border rounded-full w-8 h-8 flex items-center justify-center text-gray-600 hover:text-black">
               <svg
                 xmlns="http://www.w3.org/2000/svg"
                 viewBox="0 0 320 512"
                 class="w-4 h-4 fill-gray-500 hover:fill-green-600 transition-colors duration-200">
                 <path
                   d="M80 299.3V512H196V299.3h86.5l18-97.8H196V166.9c0-51.7 20.3-71.5 72.7-71.5c16.3 0 29.4 .4 37 1.2V7.9C291.4 4 256.4 0 236.2 0C129.3 0 80 50.5 80 159.4v42.1H14v97.8H80z" />
               </svg>
             </button>

             <button
               class="border rounded-full w-8 h-8 flex items-center justify-center text-gray-600 hover:text-black">
               <svg
                 xmlns="http://www.w3.org/2000/svg"
                 viewBox="0 0 512 512"
                 class="w-4 h-4 fill-gray-500 hover:fill-green-600 transition-colors duration-200">
                 <path
                   d="M389.2 48h70.6L305.6 224.2 487 464H345L233.7 318.6 106.5 464H35.8L200.7 275.5 26.8 48H172.4L272.9 180.9 389.2 48zM364.4 421.8h39.1L151.1 88h-42L364.4 421.8z" />
               </svg>
             </button>

             <button
               class="border rounded-full w-8 h-8 flex items-center justify-center text-gray-600 hover:text-black">
               <svg
                 xmlns="http://www.w3.org/2000/svg"
                 viewBox="0 0 512 512"
                 class="w-4 h-4 fill-gray-500 hover:fill-green-600 transition-colors duration-200">
                 <path
                   d="M48 64C21.5 64 0 85.5 0 112c0 15.1 7.1 29.3 19.2 38.4L236.8 313.6c11.4 8.5 27 8.5 38.4 0L492.8 150.4c12.1-9.1 19.2-23.3 19.2-38.4c0-26.5-21.5-48-48-48L48 64zM0 176L0 384c0 35.3 28.7 64 64 64l384 0c35.3 0 64-28.7 64-64l0-208L294.4 339.2c-22.8 17.1-54 17.1-76.8 0L0 176z" />
               </svg>
             </button>

             <button
               class="border rounded-full w-8 h-8 flex items-center justify-center text-gray-600 hover:text-black">
               <svg
                 xmlns="http://www.w3.org/2000/svg"
                 viewBox="0 0 512 512"
                 class="w-4 h-4 fill-gray-500 hover:fill-green-600 transition-colors duration-200">
                 <path
                   d="M225.8 468.2l-2.5-2.3L48.1 303.2C17.4 274.7 0 234.7 0 192.8l0-3.3c0-70.4 50-130.8 119.2-144C158.6 37.9 198.9 47 231 69.6c9 6.4 17.4 13.8 25 22.3c4.2-4.8 8.7-9.2 13.5-13.3c3.7-3.2 7.5-6.2 11.5-9c0 0 0 0 0 0C313.1 47 353.4 37.9 392.8 45.4C462 58.6 512 119.1 512 189.5l0 3.3c0 41.9-17.4 81.9-48.1 110.4L288.7 465.9l-2.5 2.3c-8.2 7.6-19 11.9-30.2 11.9s-22-4.2-30.2-11.9zM239.1 145c-.4-.3-.7-.7-1-1.1l-17.8-20-.1-.1s0 0 0 0c-23.1-25.9-58-37.7-92-31.2C81.6 101.5 48 142.1 48 189.5l0 3.3c0 28.5 11.9 55.8 32.8 75.2L256 430.7 431.2 268c20.9-19.4 32.8-46.7 32.8-75.2l0-3.3c0-47.3-33.6-88-80.1-96.9c-34-6.5-69 5.4-92 31.2c0 0 0 0-.1 .1s0 0-.1 .1l-17.8 20c-.3 .4-.7 .7-1 1.1c-4.5 4.5-10.6 7-16.9 7s-12.4-2.5-16.9-7z" />
               </svg>
             </button>
           </div>
         </div>

         <div class="flex justify-center items-center">
           <a href="">
             <img src="https://merinda-nextjs.vercel.app/_next/image?url=%2Fassets%2Fimages%2Fads%2Fads-2.png&w=1200&q=75" alt="Ads 1">
           </a>
         </div>

         <div class="">
           <h2 class="border-b text-2xl pb-2 mb-7 text-center">
             <span class="font-bold border-b pb-2.5 border-primary font-cabin">Related Posts</span>
           </h2>
           <div class="swiper">
             <!-- Additional required wrapper -->
             <div class="swiper-wrapper ">
               <!-- Slides -->
               @foreach($related as $blog)
               <article class="swiper-slide">
                 <div class="grid grid-cols-12 gap-4">
                   <div class="col-span-6">
                     <figure>
                       <a href="{{ route('blog.detail',$blog->uniq) }}">
                         <div class="aspect-video overflow-hidden bg-slate-400">
                           <img src="{{ asset($blog->thumnail) }}" class="aspect-video w-auto transition-all object-contain mx-auto" alt="{{ $blog->title }}">
                         </div>
                       </a>
                     </figure>
                   </div>
                   <div class="col-span-6 flex flex-col justify-between">
                     <h5 class="text-base font-bold font-cabin text-primary/80">
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
             <!-- If we need pagination -->
             <div class="swiper-pagination -bottom-20"></div>
           </div>
         </div>

       </div>
     </div>

   </div>
   <x-slot name="js">

     <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

     <script>
       const swiper = new Swiper(".swiper", {
         slidesPerView: 1,
         spaceBetween: 30,
         // Optional parameters
         // direction: "vertical",
         loop: true,
         autoplay: {
           delay: 5000,
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
             spaceBetween: 20,
           },
           // when window width is >= 768px
           768: {
             slidesPerView: 2,
             spaceBetween: 30,
           },
           // when window width is >= 992px
           992: {
             slidesPerView: 3,
             spaceBetween: 40,
           },
         },
       });
     </script>


     <script>
       document.addEventListener("DOMContentLoaded", function() {
         const article = document.querySelector("article");

         if (!article) return;

         const paragraphs = article.querySelectorAll("p");

         const insertAdAfter = (index, adHtml) => {
           if (paragraphs.length >= index) {
             const target = paragraphs[index - 1];
             const adWrapper = document.createElement("div");
             adWrapper.innerHTML = adHtml;

             if (target.nextSibling) {
               target.parentNode.insertBefore(adWrapper, target.nextSibling);
             } else {
               target.parentNode.appendChild(adWrapper);
             }
           }
         };

         const adHtml = `
          <div class="flex justify-center items-center my-6">
            <a href="#">
              <img src="https://merinda-nextjs.vercel.app/_next/image?url=%2Fassets%2Fimages%2Fads%2Fads-2.png&w=1200&q=75" alt="Ads 1">
            </a>
          </div>
        `;

         insertAdAfter(4, adHtml);
         insertAdAfter(8, adHtml);
         insertAdAfter(12, adHtml);
       });
     </script>
   </x-slot>
 </x-landing-layout>