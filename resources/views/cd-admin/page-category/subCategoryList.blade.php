@foreach($subcategories as $subcategory)
        <ul>
            <li>{{$subcategory['name']}}</li> 
	    @if($subcategory = App\PageCategory::where('parent_id',$subcategory->id)->get())
            @include('cd-admin.page-category.subCategoryList',['subcategories' => $subcategory])
        @endif
        </ul> 
@endforeach