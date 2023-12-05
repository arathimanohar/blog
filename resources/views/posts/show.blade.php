<x-app-layout>
    <div class="container max-w-6xl mx-auto ">
        <div class="mb-4">
            @if (session()->has('message'))
            <div class="p-3 rounded bg-green-500 text-green-100 my-2">
                {{ session('message') }}
            </div>
            @endif

            <div class="flex justify-end mt-6">
                <a href="{{ route('posts.index')}}"
                    class="px-4 py-2 rounded-md bg-sky-500 text-sky-100 hover:bg-sky-600 ext-gray-900 dark:text-gray-100">Back</a>
            </div>
        </div>
        <div class="flex flex-col items-center">
            
            <div class="w-full px-16 py-20 mt-6 overflow-hidden bg-white rounded-lg lg:max-w-4xl">
                
                <div class="mb-4">
                    <h1 class="font-serif text-3xl font-bold"> {{ $post->title}}</h1>
                    <h5 class="font-serif text-xl"> Author : {{ $post->user->name}} </h5>
                    <p class="font-serif text-md"> Published : {{ $post->created_at->diffForHumans();}} </p>
                </div>
                <p>
                    {{ $post->description }}
                </p>
                
                <div class="text-center w-full py-1 mt-6 text-right">
                    {{-- Like post --}}
                    @if (Auth::user()->id != $post->user_id)
                        <a class="hover:text-red-600 @if(null != $post->liked) text-red-600 @endif  inline-block like-post-btn" data-id="{{ $post->id }}">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                <path d="M11.645 20.91l-.007-.003-.022-.012a15.247 15.247 0 01-.383-.218 25.18 25.18 0 01-4.244-3.17C4.688 15.36 2.25 12.174 2.25 8.25 2.25 5.322 4.714 3 7.688 3A5.5 5.5 0 0112 5.052 5.5 5.5 0 0116.313 3c2.973 0 5.437 2.322 5.437 5.25 0 3.925-2.438 7.111-4.739 9.256a25.175 25.175 0 01-4.244 3.17 15.247 15.247 0 01-.383.219l-.022.012-.007.004-.003.001a.752.752 0 01-.704 0l-.003-.001z" />
                            </svg>                           
                        </a>
                    @endif
                    
                    {{-- Edit Post --}}
                    @if (Auth::user()->id == $post->user_id)
                        <a href="{{ route('posts.edit', $post->id) }}"
                            class="text-indigo-600 hover:text-indigo-900  inline-block">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                        </a>
                    @endif
                    {{-- Delete Post --}}
                    @if (Auth::user()->id == $post->user_id)
                        <form class=" inline-block" action="{{ route('posts.destroy',$post->id) }}" method="POST" onsubmit="return confirm('{{ trans('Are you sure you want to delete ? ') }}');">
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <button type="submit" class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="w-6 h-6 text-red-600 hover:text-red-800 cursor-pointer" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                            </button>
                        </form>
                    @endif
                </div>
        </div>
        {{-- </div> --}}
    </div>

</x-app-layout>
<script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script type="text/javascript">

    $(document).ready(function() {
        $('.like-post-btn').on('click', function() {
            var $el = $(this);
            var postId = $el.data('id');
            $.ajax({
                url: "{{ route('posts.like') }}",
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data:{
                    post_id: postId
                },
                success: function(response)
                {
                    if(response.status == 1) {
                        $el.addClass('text-red-600');
                    } else {
                        $el.removeClass('text-red-600');
                    }
                    Swal.fire({
                        position: "top-end",
                        icon: "success",
                        title: response.message,
                        showConfirmButton: false,
                        timer: 1500
                    });
                }
            });
        });
    });
    
</script>