@extends('admin.layouts.admin')
@section('pageTitle','Dashboard')
@section('headtitle')
|Dashboard
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
				
				<!-- <div class="col-xl-3 col-md-6">
                    <div class="card" style="background-color: red;">
                        <div class="card-block">
                            <div class="row align-items-end">
                                <div class="col-lg-12">
									<h3 class="m-b-0"> <a title="users" href="#" class="float-right"><i class="dash-icon"></i></a></h3>
                                    <h4></h4>
                                    <h6 class="action-fn m-b-0"><a href="">View all</a></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->
               
                
            </div>
           
         

                                    <!-- Leads Dashboard -->
       
            <div class="row mt-4">
           
            <div class="col-xl-3 col-md-6">
                    <div class="card" style="background-color:#3d28e0;">
                        <div class="card-block">
                            <div class="row align-items-end" style="color:white;">
                                <div class="col-lg-12">
									<h3 class="m-b-0">Total Leads - {{date('F')}}<a title="users" href="{{url('/admin/leads')}}" class="float-right"><i class="dash-icon simple-icon-user" style="color: white;"></i></a></h3>
                                    <h4>{{$leads}}</h4>
                                    <h6 class="action-fn m-b-0"  ><a href="{{url('/admin/leads')}}" style="color:white;">View all</a></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
              
                <div class="col-xl-3 col-md-6">
                    <div class="card" style="background-color:#36A745; color:white;">
                        <div class="card-block">
                            <div class="row align-items-end">
                                <div class="col-lg-12">
									<h3 class="m-b-0">	Hired - Monthly - {{date('F')}}<a title="users" href="#" class="float-right"><i class="dash-icon iconsminds-dollar" style="color: white;"></i></a></h3>
                                    <h4>{{$hired}}</h4>
                                    <h6 class="action-fn m-b-0"><a href="{{url('/admin/leads')}}"  style="color:white;">View all</a></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card" style="background-color:#DC3545; color:white;">
                        <div class="card-block">
                            <div class="row align-items-end">
                                <div class="col-lg-12">
									<h3 class="m-b-0">	Lost - {{date('F')}} <a title="users" href="#" class="float-right"><i class="dash-icon simple-icon-grid" style="color: white;"></i></a></h3>
                                    <h4>{{$lost}}</h4>
                                    <h6 class="action-fn m-b-0"><a href="{{url('/admin/leads')}}" style="color:white;">View all</a></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card" style="background-color: #3493D5; color:white;">
                        <div class="card-block">
                            <div class="row align-items-end">
                                <div class="col-lg-12">
									<h3 class="m-b-0">Unresponsive - {{date('F')}} <a title="users" href="#" class="float-right">	<i class="dash-icon simple-icon-docs" style="color: white;"></i></a> </h3>
                                    <h4>{{$unresponsive}}</h4>
                                    <h6 class="action-fn m-b-0"><a href="{{url('/admin/leads')}}"  style="color:white;">View all</a></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


                            <!-- Hr Dashboard -->

            <div class="row mt-4">
            <div class="col-xl-3 col-md-6">
                    <div class="card" style="background-color: brown; color:white;">
                        <div class="card-block">
                            <div class="row align-items-end">
                                <div class="col-lg-12">
									<h3 class="m-b-0">All Employees {{date('F')}}<a title="users" href="{{url('/admin/leads')}}" class="float-right"><i class="dash-icon simple-icon-user" style="color: white;"></i></a></h3>
                                    <h4>8</h4>
                                    <h6 class="action-fn m-b-0"><a href="{{url('/admin/hrpanel')}}"  style="color:white;">View all</a></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card" style="background-color: darkturquoise; color:white;">
                        <div class="card-block">
                            <div class="row align-items-end">
                                <div class="col-lg-12">
									<h3 class="m-b-0">	Increment Due-This Month<a title="users" href="#" class="float-right"><i class="dash-icon iconsminds-dollar" style="color: white;"></i></a></h3>
                                    <h4>8</h4>
                                    <h6 class="action-fn m-b-0"><a href="#"  style="color:white;">View all</a></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card" style="background-color: chocolate; color:white;">
                        <div class="card-block">
                            <div class="row align-items-end">
                                <div class="col-lg-12">
									<h3 class="m-b-0">Active Employees<a title="users" href="#" class="float-right"><i class="dash-icon simple-icon-grid" style="color: white;" ></i></a></h3>
                                    <h4>8</h4>
                                    <h6 class="action-fn m-b-0"><a href="#"  style="color:white;">View all</a></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
               
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

	