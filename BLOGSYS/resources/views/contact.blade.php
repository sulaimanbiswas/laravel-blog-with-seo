<x-landing-layout>
    <x-slot name="title">
        <title>Contact | {{ config('app.name', 'Blog') }}</title>
    </x-slot>
    <x-slot name="seo_config">
        <meta name="description" content="Tag blog Contact dengan konten edukatif yang berisi seputar teknologi.">
        <meta name="keywords" content="tag, blog, education, edukatif, teknologi, technology">
        <meta name="copyright" content="Entol Rizky Development" />
        <meta name="owner" content="Entol Rizky Development" />
        <meta name="author" content="Entol Rizky Development" />
        <meta name="publisher" content="Entol Rizky Development">
        <meta name="blogcatalog" />
    </x-slot>



    <div class="max-w-full pb-10 pt-5">
        <div class="container max-w-[1140px] mx-auto px-3 md:px-0 flex flex-col gap-5">
            <div class="mb-10 flex flex-col gap-4">
                <h1 class="font-cabin text-2xl sm:text-3xl md:text-4xl lg:text-4xl text-center font-semibold mt-10">Contact Us</h1>
                <p class="text-center w-10/12 md:max-w-[500px] mx-auto text-primary">We have a dedicated support center for all of your support needs. We usually get back to you within 12-24 hours.</p>
            </div>

            <div class="grid grid-rows-1 md:grid-cols-12 gap-5 md:gap-10">
                <div class="col-span-12 md:col-span-6">
                    <h2 class="border-b text-2xl pb-2 mb-7">
                        <span class="font-bold border-b pb-2.5 border-primary font-cabin">Others websites</span>
                    </h2>
                    <p class="mb-4">
                        To explore our other projects or for platform-specific information, please visit the websites listed below. Each site is a part of our growing network.
                    </p>
                    <ol class="list-decimal ms-5 flex flex-col gap-2">
                        <li>
                            <a class="hover:text-[#03a87c]" target="_blank" href="https://ractari.com">https://ractari.com</a>
                        </li>
                        <li>
                            <a class="hover:text-[#03a87c]" target="_blank" href="https://diacona.com">https://diacona.com</a>
                        </li>
                        <li>
                            <a class="hover:text-[#03a87c]" target="_blank" href="https://limojil.com">https://limojil.com</a>
                        </li>
                        <li>
                            <a class="hover:text-[#03a87c]" target="_blank" href="https://lpister.com">https://lpister.com</a>
                        </li>
                        <li>
                            <a class="hover:text-[#03a87c]" target="_blank" href="https://snombr.com">https://snombr.com</a>
                        </li>
                        <li>
                            <a class="hover:text-[#03a87c]" target="_blank" href="https://sobreasa.com">https://sobreasa.com</a>
                        </li>
                        <li>
                            <a class="hover:text-[#03a87c]" target="_blank" href="https://tralimi.com">https://tralimi.com</a>
                        </li>
                    </ol>
                </div>
                <div class="col-span-12 md:col-span-6">
                    <h2 class="border-b text-2xl pb-2 mb-7">
                        <span class="font-bold border-b pb-2.5 border-primary font-cabin">Get in touch</span>
                    </h2>
                    <p>
                        To learn more about our services or for specific information, please fill out the form below. Our representative will contact you shortly.
                    </p>
                    <form action="mailto:sulaimanbiswasbd@gmail.com" method="post" enctype="text/plain">
                        <div class="flex justify-between items-center gap-4 mt-5">
                            <input type="text" class="w-full font-cabin focus-within:ring-0 focus-within:border-[#03a87c] border-gray-300" name="name" placeholder="Your Name">
                            <input type="email" class="w-full font-cabin focus-within:ring-0 focus-within:border-[#03a87c] border-gray-300" name="email" placeholder="Your Email">
                        </div>
                        <div class="flex justify-between items-center gap-4 mt-5">
                            <input type="text" class="w-full font-cabin focus-within:ring-0 focus-within:border-[#03a87c] border-gray-300" name="subject" placeholder="Your Subject">
                        </div>
                        <div class="flex justify-between items-center gap-4 mt-5">
                            <textarea type="text" class="w-full font-cabin focus-within:ring-0 focus-within:border-[#03a87c] border-gray-300" name="message" placeholder="Your Message" rows="10"></textarea>
                        </div>
                        <div class="flex justify-between items-center gap-4 mt-5">
                            <button class="font-cabin uppercase bg-[#03a87c] px-4 py-1 rounded-full text-[15px] text-white">Send message</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
</x-landing-layout>