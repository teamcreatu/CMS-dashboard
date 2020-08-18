@if(!empty($category->categories))
<ol class="dd-list">
@foreach($category->categories as $kk => $sub_category)
	<li class="dd-item" data-id="{{$sub_category['id']}}">
		<div class="dd-handle">{{$sub_category['menu_name_ne']}}</div>
		@if(count($sub_category->categories) > 0)
		@include('cd-admin.menu.child-category-view', [ 'category' => $sub_category])
		@endif
	</li>
@endforeach
</ol>
@endif