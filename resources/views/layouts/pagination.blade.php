@if ($paginator->hasPages())
    @if ($paginator->onFirstPage())
        <button class="prev disabled" id="prev">Previous</button>
    @else 
        <button class="prev" id="prev"><a href={{ $paginator->previousPageUrl() }}>Previous</a></button>
    @endif


    <button id="check" class="blue-confirm-btn">
        <a href="{{ route('books.create') }}">Create</a>
    </button>

    @if ($paginator->hasMorePages())
        <button class="next" id="next"><a href={{ $paginator->nextPageUrl() }}>Next</a></button>
    @else
        <button class="next disabled" id="next">Next</button>
    @endif
@else
    <button class="prev disabled" id="prev">Previous</button>
    <button id="check" class="blue-confirm-btn">
        <a href="{{ route('books.create') }}">Create</a>
    </button>
    <button class="next disabled" id="next">Next</button>
@endif