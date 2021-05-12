@extends('admin.layouts.admin')
@section('content')
@section('pageTitle','Subcategories')
<div class="row">
	<div class="col-12">
		<h1>All Subcategories</h1>
		<div class="separator mb-5"></div>
	</div>
</div>
            <div class="row mb-4">
                <div class="col-12 mb-4">
			
				   
									
					<div class="card">
						<div class="card-body">
						<div class="table-responsive"  id="tag_container">
							 <table class="table table-hover mb-0">
								<thead class="bg-primary">
									<tr>
									<th scope="col">#No.</th>
									<th scope="col">Subcategories Name</th>
									<th scope="col">Category Name</th>
										
									<th scope="col">{{ trans('global.actinos') }}</th>								
									</tr>
								</thead>
								<tbody>
								 @if(is_object($categories) && !empty($categories) && $categories->count())
									 @php $i=1;  @endphp
								  @foreach($categories as $key => $category)
									<tr data-user-id="{{ $category->id }}" class="user_row_{{$category->id}}" >
										<td id="name_{{$category->id}}">{{$i}}</td>
										<td id="name_{{$category->id}}">{{ $category->sub_category_name ?? '' }} </td>
										<td id="email_{{$category->id}}"> {{ $category->category_name  ?? '' }}</td>
										
										

										<td>
										
											<a class="action" href ="{{url('admin/edit-sub-categories')}}/{{$category->id}}" title="Edit"><i class="simple-icon-note"></i></a>
											
											<a title="Delete Subcategory"  data-id="{{ $category->id }}" data-confirm_type="complete" data-confirm_message ="Are you sure you want to delete the Subcategory?"  data-left_button_name ="Yes" data-left_button_id ="delete_Subcategory" data-left_button_cls="btn-primary" class="open_confirmBox action deleteSubcategory"  href="javascript:void(0)" data-role_id="{{ $category->id }}"><i class="simple-icon-trash"></i></a>
										</td>
									</tr>
									@php $i++;  @endphp
								 @endforeach
								@else
									<tr><td colspan="7" class="error" style="text-align:center">No Data Found.</td></tr>
								@endif	
								</tbody>
							</table> 
						</div>
						</div>
					</div>
                </div>
            </div>
			<div class="modal fade modal-top confirmBoxCompleteModal"  tabindex="-1" role="dialog"  aria-hidden="true"></div>
<div class="modal fade modal-right userEditModal"  tabindex="-1" role="dialog" aria-labelledby="exampleModalRight" aria-hidden="true">
 </div>
@section('userJs')
<script src="{{ asset('js/module/category.js')}}"></script>	
@stop
@endsection