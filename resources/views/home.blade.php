<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite('resources/css/app.css')

</head>
<body class=" flex justify-center">
  <div class="p-24 w-1/2">

<form action="/post" method="POST">
  @csrf
  <div class="space-y-12">
    <a href="/logout">
      <button type="button" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Log out</button>
    </a>
    <div class="border-b border-gray-900/10 pb-12">
      <h2 class="text-base font-semibold leading-7 text-gray-900">Create Post</h2>
      <p class="mt-1 text-sm leading-6 text-gray-600">This post will be displayed publicly so be careful what you share.</p>

      <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
        <div class="sm:col-span-4">
          <label for="username" class="block text-sm font-medium leading-6 text-gray-900">Title</label>
          <div class="mt-2">
            <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
              {{-- <span class="flex select-none items-center pl-3 text-gray-500 sm:text-sm">workcation.com/</span> --}}
              <input type="text" name="title" id="username" autocomplete="username" class="px-2 block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6" placeholder="...">
            </div>
          </div>
        </div>

        <div class="col-span-full">
          <label for="about" class="block text-sm font-medium leading-6 text-gray-900">Details</label>
          <div class="mt-2">
            <textarea id="about" name="details" rows="3" class="px-2 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"></textarea>
          </div>
          <p class="mt-3 text-sm leading-6 text-gray-600">Write a few sentences about your post.</p>
        </div>

        

  <div class="mt-6 flex justify-end gap-x-6">
    <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save</button>
  </div>
</form>

 </div>

 <div class="mt-5">
  
  <h2>All Post</h2>
  @foreach ($posts as $post)
  <div class="bg-blue-200 m-2 p-3">
    <h3>{{$post['title']}} by <b>{{$post->user->name}}</b></h3>
    {{$post['details']}}
    <p><a href="/edit-post/{{$post->id}}">Edit</a></p>
    <form action="/delete-post/{{$post->id}}" method="POST">
      @csrf 
      @method('DELETE')
      <button>Delete</button>
    </form>
    
  </div>
  @endforeach
 </div>
  
      
</body>
</html>