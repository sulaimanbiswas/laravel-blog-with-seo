<x-app-layout>
    <x-slot name="additional">
        <style></style>
        <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
    </x-slot>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Create Blog') }}</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @if(session('error'))
            <p
                x-data="{ show: true }"
                x-show="show"
                x-transition
                x-init="setTimeout(() => show = false, 5000)"
                class=" bg-red-400 text-white py-4 px-8 block shadow rounded-lg">{{ session('error') }}</p>
            @endif
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 px-8 text-gray-900">
                    <form method="POST" action="{{ route('admin.blog.store') }}" enctype="multipart/form-data">
                        @csrf

                        <input type="hidden" name="user_id" value="{{ Auth::user()->id}}">
                        <div id="preview-container" class="aspect-video overflow-hidden bg-slate-400 rounded hidden">
                            <img id="preview" class="aspect-video w-auto transition-all object-contain mx-auto hidden" alt="Preview Image">
                        </div>
                        <div class="py-2">
                            <x-input-label for="thumnail" value="{{ __('Thumnail') }}" />
                            <x-text-input name="thumnail" class="mt-1 w-full" id="thumnail" type="file" autocomplete="thumnail" accept="image/*" onchange="showPreview(event);" />
                            <p class="text-gray-600 text-xs italic">Recommanded aspect ratio 16:9</p>
                            <x-input-error :messages="$errors->BlogStoreRequest->get('thumnail')" class="mt-2" />

                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="py-2">
                                <x-input-label for="title" value="{{ __('Title') }}" />
                                <x-text-input name="title" class="mt-1 w-full" id="title" type="text" autocomplete="title" />
                                <x-input-error :messages="$errors->BlogStoreRequest->get('title')" class="mt-2" />
                            </div>
                            <div class="py-2">
                                <x-input-label for="uniq" value="{{ __('Uniq') }}" />
                                <x-text-input name="uniq" class="mt-1 w-full" id="uniq" type="text" autocomplete="uniq" readonly />
                                <x-input-error :messages="$errors->BlogStoreRequest->get('uniq')" class="mt-2" />
                            </div>
                        </div>
                        <div class="py-2">
                            <x-input-label for="description" value="{{ __('Short description') }}" />
                            <x-text-input name="description" class="mt-1 w-full" id="description" type="text" autocomplete="description" />
                            <x-input-error :messages="$errors->BlogStoreRequest->get('description')" class="mt-2" />
                        </div>
                        <div class="py-2">
                            <x-input-label for="content" value="{{ __('Content') }}" />
                            <textarea name="content" id="content" cols="30" rows="10" class="prose prose-slate max-w-none"></textarea>
                            <x-input-error :messages="$errors->BlogStoreRequest->get('content')" class="mt-2" />
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="py-2">
                                <x-input-label for="tag" value="{{ __('Tags') }}" />
                                <x-text-input name="tag" class="mt-1 w-full" id="tag" type="text" autocomplete="tag" />
                                <p class="text-gray-600 text-xs italic">Seperate your tag with whitespace " "</p>
                                <x-input-error :messages="$errors->BlogStoreRequest->get('tag')" class="mt-2" />
                            </div>
                            <div class="py-2">
                                <x-input-label for="keyword" value="{{ __('Keyword') }}" />
                                <x-text-input name="keyword" class="mt-1 w-full" id="keyword" type="text" autocomplete="keyword" />
                                <p class="text-gray-600 text-xs italic">Seperate your tag with comma ","</p>
                                <x-input-error :messages="$errors->BlogStoreRequest->get('keyword')" class="mt-2" />
                            </div>
                        </div>
                        <div class="py-2">
                            <x-input-label for="publish_date" value="{{ __('Publish Date') }}" />
                            <x-text-input name="publish_date" class="mt-1 w-full" id="publish_date" type="date" autocomplete="publish_date" />
                            <x-input-error :messages="$errors->BlogStoreRequest->get('publish_date')" class="mt-2" />
                        </div>
                        <x-a-button-back href="{{ route('admin.blog.index') }}">Back</x-a-button-back>
                        <x-primary-button>{{ __('Save') }}</x-primary-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <x-slot name="js">
        <script>
            $(document).ready(function() {
                $('#title').keyup(function() {
                    let title = $(this).val();
                    let uniq = title.replaceAll(" ", "-").toLowerCase();
                    document.getElementById('uniq').value = uniq;
                });
            });
        </script>
        <script>
            function showPreview(event) {
                if (event.target.files.length > 0) {
                    let src = URL.createObjectURL(event.target.files[0]);
                    let preview = document.getElementById("preview");
                    let previewContainer = document.getElementById("preview-container");

                    preview.src = src;

                    // Correctly remove the 'hidden' class without deleting other classes
                    preview.classList.remove("hidden");
                    previewContainer.classList.remove("hidden");
                }
            }
        </script>
        <script src="{{ asset('build/plugins/ck5/build/ckeditor.js') }}"></script>
        <script>
            ClassicEditor
                .create(document.querySelector('#content'), {
                    licenseKey: '',
                    ckfinder: {
                        uploadUrl: '{{ route("admin.blog.image_content_upload")."?_token=".csrf_token() }}'
                    },

                })
                .catch(error => {
                    console.error(error);
                });
        </script>
    </x-slot>
</x-app-layout>