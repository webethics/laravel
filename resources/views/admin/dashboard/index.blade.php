@extends('admin.layouts.admin')
@section('headtitle')
| Dashboard
@endsection
@section('content')
	<div class="row">
		<div class="col-12">
			<h1>Dashboard </h1>
			<div class="separator mb-5"></div>
		</div>
	</div>
	<div class="row mb-4">
		<div class="col-12 mb-4">
			<div class="row">
				@foreach ($dashboard as $key=>$value)
				<div class="col-xl-3 col-md-6">
                    <div class="card" style="background-color: {{$value['backgroundColor']}};">
                        <div class="card-block">
                            <div class="row align-items-end">
                                <div class="col-lg-12">
									<h3 class="m-b-0">{{$key}} <a title="users" href="{{url($value['url'])}}" class="float-right"><i class="dash-icon {{$value['icon']}}"></i></a></h3>
                                    <h4>{{$value['count']}}</h4>
                                    <h6 class="action-fn m-b-0"><a href="{{url($value['url'])}}">View all</a></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

		</div>
	</div>
<style>
.dash-icon {
    font-size: 58px;
}
i.dash-icon.simple-icon-list, i.dash-icon.simple-icon-grid, i.dash-icon.simple-icon-user {
    position: relative;
    left: -5px;
    top: 13px;
}
</style>	
@section('userJs')
<script src="{{ asset('js/module/user.js')}}"></script>	
@stop
@endsection

	