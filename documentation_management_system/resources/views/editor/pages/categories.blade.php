@extends('editor.inc.main')
@section('contents')
<style>
    .custom-margin-top {
    margin-top: 100px;
    }

    .scroll-wrapper {
      overflow: hidden;
      position: relative;
    }
  
    .scroll-container {
      display: flex;
      gap: 1.5rem;
      overflow-x: auto;
      scroll-snap-type: x mandatory;
      scroll-behavior: smooth;
      padding: 0 2.5rem;
    }
  
    .scroll-container::-webkit-scrollbar {
      display: none;
    }
  
    .scroll-card {
      flex: 0 0 16rem;
      scroll-snap-align: start;
    }
  

</style>

    <div class="max-w-7xl mx-auto px-8 sm:px-8 lg:px-10 pt-10 custom-margin-top">

        <div class="mb-12">
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
              @forelse($categories as $category)
              <a href="{{ route('editor.categories.detail', $category->slug) }}" class="block">
                <div class="bg-white rounded-xl border border-gray-200 shadow-md overflow-hidden hover:shadow-lg transition">
                  <img
                    src="{{ $category->image ? asset('storage/' . ltrim($category->image, '/')) : asset('images/category-fallback.jpg') }}"
                    alt="{{ $category->name }}"
                    class="w-full h-40 object-cover"
                    loading="lazy">
                  <div class="p-4">
                    <p class="text-xs text-gray-500 mb-1">{{ $category->slug }}</p>
                    <div class="flex items-center justify-between">
                      <h3 class="font-semibold text-lg text-gray-800">{{ $category->name }}</h3>
                      <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                      </svg>
                    </div>
                  </div>
                </div>
              </a>
            @empty
              <div class="col-span-full text-center text-gray-500 py-12">
                No categories yet.
              </div>
            @endforelse
            </div>
        </div>
        
    </div>

<script>
        const toggleBtn = document.getElementById('searchToggle');
        const inputContainer = document.getElementById('searchInputContainer');
      
        toggleBtn.addEventListener('click', () => {
          if (inputContainer.style.maxWidth === '320px') {
            inputContainer.style.maxWidth = '0';
            inputContainer.querySelector('input').value = '';
          } else {
            inputContainer.style.maxWidth = '320px';
            inputContainer.querySelector('input').focus();
          }
        });
</script>

@endsection