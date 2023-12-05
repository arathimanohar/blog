<x-app-layout>
    <!-- Index Post -->
    <div class="container max-w-6xl mx-auto mt-6">
        <div class="mb-4">
            
            <h1 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight"> User Posts</h1>
            @if (session()->has('message'))
            <div class="p-3 rounded bg-green-500 text-green-100 my-2">
                {{ session('message') }}
            </div>
            @endif
            
            <div class="flex justify-end">
                <a href="{{ route('posts.create')}}"
                class="px-4 py-2 rounded-md bg-sky-500 text-sky-100 hover:bg-sky-600 ext-gray-900 dark:text-gray-100">Create Post</a>
            </div>
        </div>
        @if (count($posts) > 0 )
        <div class="flex flex-col  px-1 py-1">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 h-56">
                @foreach ($posts as $post)
                <div class='text-gray-800 rounded-md bg-gray-100 p-4 h-30 grid grid-cols-1 content-between'>
                    <a href="{{ route('posts.show', $post->id)}}">
                        
                        <h1 class="text-center text-2xl"> <b>{{$post->title}} </b></h1>    
                        <p class="font-serif text-sm text-gray-600 mt-4"> Author : {{ $post->user->name}} </p>
                        <p class="font-serif text-sm text-gray-600"> Published : {{ $post->created_at->diffForHumans();}} </p>
                        <p class="min-h-30 mt-4">{{ Str::limit($post->description)}}</p> 
                        
                        
                    </a>
                    <div class="text-center w-full py-1 mt-6 text-right">
                        {{-- Like post --}}
                        @if (Auth::user()->id != $post->user_id)
                            <a class="hover:text-red-600 @if(null != $post->liked) text-red-600 @endif  inline-block like-post-btn" data-id="{{ $post->id }}">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                    <path d="M11.645 20.91l-.007-.003-.022-.012a15.247 15.247 0 01-.383-.218 25.18 25.18 0 01-4.244-3.17C4.688 15.36 2.25 12.174 2.25 8.25 2.25 5.322 4.714 3 7.688 3A5.5 5.5 0 0112 5.052 5.5 5.5 0 0116.313 3c2.973 0 5.437 2.322 5.437 5.25 0 3.925-2.438 7.111-4.739 9.256a25.175 25.175 0 01-4.244 3.17 15.247 15.247 0 01-.383.219l-.022.012-.007.004-.003.001a.752.752 0 01-.704 0l-.003-.001z" />
                                </svg>                           
                            </a>
                        @endif
                        {{-- View Post --}}
                        <a href="{{ route('posts.show', $post->id) }}"
                            class="text-indigo-600 hover:text-indigo-900 inline-block">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>                                    
                        </a>
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
            @endforeach
            </div>
            
        </div>
        @else
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        {{ __("No Post found!") }}  <a href="{{ route('posts.create')}}"> Create a Post </a>
                    </div>
                </div>
            </div>
        @endif
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