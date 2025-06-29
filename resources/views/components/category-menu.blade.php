@isset($categories)
    <ul>
        @foreach ($categories as $category)
            <li>
                <a href="{{ route('category.show', $category->slug) }}">
                    {{ $category->name }}
                </a>
                @if ($category->children->isNotEmpty())
                    <ul>
                        @foreach ($category->children as $child)
                            <li>
                                <a href="{{ route('category.show', $child->slug) }}">
                                    {{ $child->name }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </li>
        @endforeach
    </ul>
@endisset
