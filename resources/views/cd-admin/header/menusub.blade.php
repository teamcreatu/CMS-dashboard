
@foreach($categories as $child)
<li class="nav-item first-dropdown">
  @if($child->url_type != 'custom')
  <a class="dropdown-item {{ count($child->categories) ? 'dropdown-toggle' :'' }}" href="{{url(Request::root().'/'.$child->page_url)}}">{{ $child->menu_name }}</a>
  @if(count($child->categories))
  <ul class="dropdown-menu border-0 shadow">
    @if($categories->url_type != 'custom')
    @if($language == 'en')
    <li>
      @include('header.menusub',['categories' => $child->categories])
    </li>
    @else
    <li>
      @include('header.menusub',['categories' => $child->categories])
    </li>
    @endif
    @else
    @if($language == 'en')
    <li>
      @include('header.menusub',['categories' => $child->categories])
    </li>
    @else
    <li>
      @include('header.menusub',['categories' => $child->categories])
    </li>
    @endif
    @endif
  </ul>
  @endif

  @else

  <a class="dropdown-item {{ count($child->categories) ? 'dropdown-toggle' :'' }}"  href="{{$child->page_url}}">{{ $child->menu_name }}</a>
  @if(count($child->categories))
  <ul class="dropdown-menu border-0 shadow">
    @if($child->url_type != 'custom')
    @if($language == 'en')
    <li>
      @include('header.menusub',['categories' => $child->categories])
    </li>
    @else
    <li>
      @include('header.menusub',['categories' => $child->categories])
    </li>
    @endif
    @else
    @if($language == 'en')
    <li>
      @include('header.menusub',['categories' => $child->categories])
    </li>
    @else
    <li>
      @include('header.menusub',['categories' => $child->categories])
    </li>
    @endif
    @endif
  </ul>
  @endif

  @endif
</li>
@endforeach