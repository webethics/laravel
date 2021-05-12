@extends('frontend.layouts.landing')
@section('pageTitle','FAQ')
@section('content')
@section('extraJsCss')

@stop
<main class="site-content">
	 <section class="innersection innerbannersection">
		<div class="container">
		   <div class="row align-items-center">
			  <div class="col-md-6 col-6 innerbanner_img wow fadeInUp">
				 <h2>FAQ</h2>
			  </div>
			  <div class="col-md-6 col-6 innerbanner_title text-right wow fadeInUp">
				 <img src="{{asset('frontend/images/faq-banner.png')}}" />
			  </div>
		   </div>
		</div>
	 </section>
	 <section class="homesection faqsection wow fadeInUp" data-wow-duration="1500ms">
		<div class="container">
		   <div class="faqcontentsec">
			  <h2 class="text-center">Frequently Asked Questions</h2>
			  <p>Want to ask something from us?</p>
			  <div id="accordion" class="faqaccordion">
				 <div class="card wow fadeInUp" data-wow-duration="1500ms">
					<div class="card-header">
					   <a class="card-link" data-toggle="collapse" href="#collapseOne">
					   What information is captured by SQLBenchmarkPro?
					   </a>
					</div>
					<div id="collapseOne" class="collapse show" data-parent="#accordion">
					   <div class="card-body">
						  <p>No business or user data from your databases ever leaves your network. Query parameters containing your data (eg values being inserted or updated, stored procedure parameters etc) are deleted before your performance data is uploaded to our cloud storage servers. 
						  </p>
						  <ul>
							 <span>Web Portfolio captures:</span>
							 <li>Queries running longer than 1 second</li>
							 <li>Machine Perfmon counters (CPU, Memory, Disk, NIC etc)</li>
							 <li>SQL Server Perfmon counters (SQLOS, wait stats, database stats etc)</li>
							 <li>Database Virtual File Stats (I/Os & waits per database file)</li>
							 <li>Server configurations, Database properties, Table & Index structure definitions, Partitions, Files, Filegroups & Views</li>
						  </ul>
					   </div>
					</div>
				 </div>
				 <div class="card wow fadeInUp" data-wow-duration="1500ms">
					<div class="card-header">
					   <a class="collapsed card-link" data-toggle="collapse" href="#collapseTwo">
					   Can Monitoring Agent service be stopped/started or Uninstalled?
					   </a>
					</div>
					<div id="collapseTwo" class="collapse" data-parent="#accordion">
					   <div class="card-body">
						  <p>No business or user data from your databases ever leaves your network. Query parameters containing your data (eg values being inserted or updated, stored procedure parameters etc) are deleted before your performance data is uploaded to our cloud storage servers. 
						  </p>
						  <ul>
							 <span>Web Portfolio captures:</span>
							 <li>Queries running longer than 1 second</li>
							 <li>Machine Perfmon counters (CPU, Memory, Disk, NIC etc)</li>
							 <li>SQL Server Perfmon counters (SQLOS, wait stats, database stats etc)</li>
							 <li>Database Virtual File Stats (I/Os & waits per database file)</li>
							 <li>Server configurations, Database properties, Table & Index structure definitions, Partitions, Files, Filegroups & Views</li>
						  </ul>
					   </div>
					</div>
				 </div>
				 <div class="card wow fadeInUp" data-wow-duration="1500ms">
					<div class="card-header">
					   <a class="collapsed card-link" data-toggle="collapse" href="#collapseThree">
					   Is it really free?
					   </a>
					</div>
					<div id="collapseThree" class="collapse" data-parent="#accordion">
					   <div class="card-body">
						  <p>No business or user data from your databases ever leaves your network. Query parameters containing your data (eg values being inserted or updated, stored procedure parameters etc) are deleted before your performance data is uploaded to our cloud storage servers. 
						  </p>
						  <ul>
							 <span>Web Portfolio captures:</span>
							 <li>Queries running longer than 1 second</li>
							 <li>Machine Perfmon counters (CPU, Memory, Disk, NIC etc)</li>
							 <li>SQL Server Perfmon counters (SQLOS, wait stats, database stats etc)</li>
							 <li>Database Virtual File Stats (I/Os & waits per database file)</li>
							 <li>Server configurations, Database properties, Table & Index structure definitions, Partitions, Files, Filegroups & Views</li>
						  </ul>
					   </div>
					</div>
				 </div>
				 <div class="card wow fadeInUp" data-wow-duration="1500ms">
					<div class="card-header">
					   <a class="collapsed card-link" data-toggle="collapse" href="#collapseFour">
					   Which versions are supported?
					   </a>
					</div>
					<div id="collapseFour" class="collapse" data-parent="#accordion">
					   <div class="card-body">
						  <p>No business or user data from your databases ever leaves your network. Query parameters containing your data (eg values being inserted or updated, stored procedure parameters etc) are deleted before your performance data is uploaded to our cloud storage servers. 
						  </p>
						  <ul>
							 <span>Web Portfolio captures:</span>
							 <li>Queries running longer than 1 second</li>
							 <li>Machine Perfmon counters (CPU, Memory, Disk, NIC etc)</li>
							 <li>SQL Server Perfmon counters (SQLOS, wait stats, database stats etc)</li>
							 <li>Database Virtual File Stats (I/Os & waits per database file)</li>
							 <li>Server configurations, Database properties, Table & Index structure definitions, Partitions, Files, Filegroups & Views</li>
						  </ul>
					   </div>
					</div>
				 </div>
				 <div class="card wow fadeInUp" data-wow-duration="1500ms">
					<div class="card-header">
					   <a class="collapsed card-link" data-toggle="collapse" href="#collapseFive">
					   Server performance counters are unavailable.
					   </a>
					</div>
					<div id="collapseFive" class="collapse" data-parent="#accordion">
					   <div class="card-body">
						  <p>No business or user data from your databases ever leaves your network. Query parameters containing your data (eg values being inserted or updated, stored procedure parameters etc) are deleted before your performance data is uploaded to our cloud storage servers. 
						  </p>
						  <ul>
							 <span>Web Portfolio captures:</span>
							 <li>Queries running longer than 1 second</li>
							 <li>Machine Perfmon counters (CPU, Memory, Disk, NIC etc)</li>
							 <li>SQL Server Perfmon counters (SQLOS, wait stats, database stats etc)</li>
							 <li>Database Virtual File Stats (I/Os & waits per database file)</li>
							 <li>Server configurations, Database properties, Table & Index structure definitions, Partitions, Files, Filegroups & Views</li>
						  </ul>
					   </div>
					</div>
				 </div>
				 <div class="card wow fadeInUp" data-wow-duration="1500ms">
					<div class="card-header">
					   <a class="collapsed card-link" data-toggle="collapse" href="#collapseSix">
					   What information is captured by SQLBenchmarkPro?
					   </a>
					</div>
					<div id="collapseSix" class="collapse" data-parent="#accordion">
					   <div class="card-body">
						  <p>No business or user data from your databases ever leaves your network. Query parameters containing your data (eg values being inserted or updated, stored procedure parameters etc) are deleted before your performance data is uploaded to our cloud storage servers. 
						  </p>
						  <ul>
							 <span>Web Portfolio captures:</span>
							 <li>Queries running longer than 1 second</li>
							 <li>Machine Perfmon counters (CPU, Memory, Disk, NIC etc)</li>
							 <li>SQL Server Perfmon counters (SQLOS, wait stats, database stats etc)</li>
							 <li>Database Virtual File Stats (I/Os & waits per database file)</li>
							 <li>Server configurations, Database properties, Table & Index structure definitions, Partitions, Files, Filegroups & Views</li>
						  </ul>
					   </div>
					</div>
				 </div>
				 <div class="card wow fadeInUp" data-wow-duration="1500ms">
					<div class="card-header">
					   <a class="collapsed card-link" data-toggle="collapse" href="#collapseSeven">
					   Can Monitoring Agent service be stopped/started or Uninstalled?
					   </a>
					</div>
					<div id="collapseSeven" class="collapse" data-parent="#accordion">
					   <div class="card-body">
						  <p>No business or user data from your databases ever leaves your network. Query parameters containing your data (eg values being inserted or updated, stored procedure parameters etc) are deleted before your performance data is uploaded to our cloud storage servers. 
						  </p>
						  <ul>
							 <span>Web Portfolio captures:</span>
							 <li>Queries running longer than 1 second</li>
							 <li>Machine Perfmon counters (CPU, Memory, Disk, NIC etc)</li>
							 <li>SQL Server Perfmon counters (SQLOS, wait stats, database stats etc)</li>
							 <li>Database Virtual File Stats (I/Os & waits per database file)</li>
							 <li>Server configurations, Database properties, Table & Index structure definitions, Partitions, Files, Filegroups & Views</li>
						  </ul>
					   </div>
					</div>
				 </div>
				 <div class="card wow fadeInUp" data-wow-duration="1500ms">
					<div class="card-header">
					   <a class="collapsed card-link" data-toggle="collapse" href="#collapseEight">
					   Is it really free?
					   </a>
					</div>
					<div id="collapseEight" class="collapse" data-parent="#accordion">
					   <div class="card-body">
						  <p>No business or user data from your databases ever leaves your network. Query parameters containing your data (eg values being inserted or updated, stored procedure parameters etc) are deleted before your performance data is uploaded to our cloud storage servers. 
						  </p>
						  <ul>
							 <span>Web Portfolio captures:</span>
							 <li>Queries running longer than 1 second</li>
							 <li>Machine Perfmon counters (CPU, Memory, Disk, NIC etc)</li>
							 <li>SQL Server Perfmon counters (SQLOS, wait stats, database stats etc)</li>
							 <li>Database Virtual File Stats (I/Os & waits per database file)</li>
							 <li>Server configurations, Database properties, Table & Index structure definitions, Partitions, Files, Filegroups & Views</li>
						  </ul>
					   </div>
					</div>
				 </div>
				 <div class="card wow fadeInUp" data-wow-duration="1500ms">
					<div class="card-header">
					   <a class="collapsed card-link" data-toggle="collapse" href="#collapseNine">
					   Which versions are supported?
					   </a>
					</div>
					<div id="collapseNine" class="collapse" data-parent="#accordion">
					   <div class="card-body">
						  <p>No business or user data from your databases ever leaves your network. Query parameters containing your data (eg values being inserted or updated, stored procedure parameters etc) are deleted before your performance data is uploaded to our cloud storage servers. 
						  </p>
						  <ul>
							 <span>Web Portfolio captures:</span>
							 <li>Queries running longer than 1 second</li>
							 <li>Machine Perfmon counters (CPU, Memory, Disk, NIC etc)</li>
							 <li>SQL Server Perfmon counters (SQLOS, wait stats, database stats etc)</li>
							 <li>Database Virtual File Stats (I/Os & waits per database file)</li>
							 <li>Server configurations, Database properties, Table & Index structure definitions, Partitions, Files, Filegroups & Views</li>
						  </ul>
					   </div>
					</div>
				 </div>
				 <div class="card wow fadeInUp" data-wow-duration="1500ms">
					<div class="card-header">
					   <a class="collapsed card-link" data-toggle="collapse" href="#collapseTen">
					   Server performance counters are unavailable.
					   </a>
					</div>
					<div id="collapseTen" class="collapse" data-parent="#accordion">
					   <div class="card-body">
						  <p>No business or user data from your databases ever leaves your network. Query parameters containing your data (eg values being inserted or updated, stored procedure parameters etc) are deleted before your performance data is uploaded to our cloud storage servers. 
						  </p>
						  <ul>
							 <span>Web Portfolio captures:</span>
							 <li>Queries running longer than 1 second</li>
							 <li>Machine Perfmon counters (CPU, Memory, Disk, NIC etc)</li>
							 <li>SQL Server Perfmon counters (SQLOS, wait stats, database stats etc)</li>
							 <li>Database Virtual File Stats (I/Os & waits per database file)</li>
							 <li>Server configurations, Database properties, Table & Index structure definitions, Partitions, Files, Filegroups & Views</li>
						  </ul>
					   </div>
					</div>
				 </div>
				 <div class="card wow fadeInUp" data-wow-duration="1500ms">
					<div class="card-header">
					   <a class="collapsed card-link" data-toggle="collapse" href="#collapseEleven">
					   What information is captured by SQLBenchmarkPro?
					   </a>
					</div>
					<div id="collapseEleven" class="collapse" data-parent="#accordion">
					   <div class="card-body">
						  <p>No business or user data from your databases ever leaves your network. Query parameters containing your data (eg values being inserted or updated, stored procedure parameters etc) are deleted before your performance data is uploaded to our cloud storage servers. 
						  </p>
						  <ul>
							 <span>Web Portfolio captures:</span>
							 <li>Queries running longer than 1 second</li>
							 <li>Machine Perfmon counters (CPU, Memory, Disk, NIC etc)</li>
							 <li>SQL Server Perfmon counters (SQLOS, wait stats, database stats etc)</li>
							 <li>Database Virtual File Stats (I/Os & waits per database file)</li>
							 <li>Server configurations, Database properties, Table & Index structure definitions, Partitions, Files, Filegroups & Views</li>
						  </ul>
					   </div>
					</div>
				 </div>
				 <div class="card wow fadeInUp" data-wow-duration="1500ms">
					<div class="card-header">
					   <a class="collapsed card-link" data-toggle="collapse" href="#collapseTwelve">
					   Can Monitoring Agent service be stopped/started or Uninstalled?
					   </a>
					</div>
					<div id="collapseTwelve" class="collapse" data-parent="#accordion">
					   <div class="card-body">
						  <p>No business or user data from your databases ever leaves your network. Query parameters containing your data (eg values being inserted or updated, stored procedure parameters etc) are deleted before your performance data is uploaded to our cloud storage servers. 
						  </p>
						  <ul>
							 <span>Web Portfolio captures:</span>
							 <li>Queries running longer than 1 second</li>
							 <li>Machine Perfmon counters (CPU, Memory, Disk, NIC etc)</li>
							 <li>SQL Server Perfmon counters (SQLOS, wait stats, database stats etc)</li>
							 <li>Database Virtual File Stats (I/Os & waits per database file)</li>
							 <li>Server configurations, Database properties, Table & Index structure definitions, Partitions, Files, Filegroups & Views</li>
						  </ul>
					   </div>
					</div>
				 </div>
				 <div class="card wow fadeInUp" data-wow-duration="1500ms">
					<div class="card-header">
					   <a class="collapsed card-link" data-toggle="collapse" href="#collapseThirteen">
					   Is it really free?
					   </a>
					</div>
					<div id="collapseThirteen" class="collapse" data-parent="#accordion">
					   <div class="card-body">
						  <p>No business or user data from your databases ever leaves your network. Query parameters containing your data (eg values being inserted or updated, stored procedure parameters etc) are deleted before your performance data is uploaded to our cloud storage servers. 
						  </p>
						  <ul>
							 <span>Web Portfolio captures:</span>
							 <li>Queries running longer than 1 second</li>
							 <li>Machine Perfmon counters (CPU, Memory, Disk, NIC etc)</li>
							 <li>SQL Server Perfmon counters (SQLOS, wait stats, database stats etc)</li>
							 <li>Database Virtual File Stats (I/Os & waits per database file)</li>
							 <li>Server configurations, Database properties, Table & Index structure definitions, Partitions, Files, Filegroups & Views</li>
						  </ul>
					   </div>
					</div>
				 </div>
				 <div class="card wow fadeInUp" data-wow-duration="1500ms">
					<div class="card-header">
					   <a class="collapsed card-link" data-toggle="collapse" href="#collapseFourteen">
					   Which versions are supported?
					   </a>
					</div>
					<div id="collapseFourteen" class="collapse" data-parent="#accordion">
					   <div class="card-body">
						  <p>No business or user data from your databases ever leaves your network. Query parameters containing your data (eg values being inserted or updated, stored procedure parameters etc) are deleted before your performance data is uploaded to our cloud storage servers. 
						  </p>
						  <ul>
							 <span>Web Portfolio captures:</span>
							 <li>Queries running longer than 1 second</li>
							 <li>Machine Perfmon counters (CPU, Memory, Disk, NIC etc)</li>
							 <li>SQL Server Perfmon counters (SQLOS, wait stats, database stats etc)</li>
							 <li>Database Virtual File Stats (I/Os & waits per database file)</li>
							 <li>Server configurations, Database properties, Table & Index structure definitions, Partitions, Files, Filegroups & Views</li>
						  </ul>
					   </div>
					</div>
				 </div>
				 <div class="card wow fadeInUp" data-wow-duration="1500ms">
					<div class="card-header">
					   <a class="collapsed card-link" data-toggle="collapse" href="#collapseFiveteen">
					   Server performance counters are unavailable.
					   </a>
					</div>
					<div id="collapseFiveteen" class="collapse" data-parent="#accordion">
					   <div class="card-body">
						  <p>No business or user data from your databases ever leaves your network. Query parameters containing your data (eg values being inserted or updated, stored procedure parameters etc) are deleted before your performance data is uploaded to our cloud storage servers. 
						  </p>
						  <ul>
							 <span>Web Portfolio captures:</span>
							 <li>Queries running longer than 1 second</li>
							 <li>Machine Perfmon counters (CPU, Memory, Disk, NIC etc)</li>
							 <li>SQL Server Perfmon counters (SQLOS, wait stats, database stats etc)</li>
							 <li>Database Virtual File Stats (I/Os & waits per database file)</li>
							 <li>Server configurations, Database properties, Table & Index structure definitions, Partitions, Files, Filegroups & Views</li>
						  </ul>
					   </div>
					</div>
				 </div>
				 <div class="card wow fadeInUp" data-wow-duration="1500ms">
					<div class="card-header">
					   <a class="collapsed card-link" data-toggle="collapse" href="#collapseSixteen">
					   What information is captured by SQLBenchmarkPro?
					   </a>
					</div>
					<div id="collapseSixteen" class="collapse" data-parent="#accordion">
					   <div class="card-body">
						  <p>No business or user data from your databases ever leaves your network. Query parameters containing your data (eg values being inserted or updated, stored procedure parameters etc) are deleted before your performance data is uploaded to our cloud storage servers. 
						  </p>
						  <ul>
							 <span>Web Portfolio captures:</span>
							 <li>Queries running longer than 1 second</li>
							 <li>Machine Perfmon counters (CPU, Memory, Disk, NIC etc)</li>
							 <li>SQL Server Perfmon counters (SQLOS, wait stats, database stats etc)</li>
							 <li>Database Virtual File Stats (I/Os & waits per database file)</li>
							 <li>Server configurations, Database properties, Table & Index structure definitions, Partitions, Files, Filegroups & Views</li>
						  </ul>
					   </div>
					</div>
				 </div>
				 <div class="card wow fadeInUp" data-wow-duration="1500ms">
					<div class="card-header">
					   <a class="collapsed card-link" data-toggle="collapse" href="#collapseSeventeen">
					   Can Monitoring Agent service be stopped/started or Uninstalled?
					   </a>
					</div>
					<div id="collapseSeventeen" class="collapse" data-parent="#accordion">
					   <div class="card-body">
						  <p>No business or user data from your databases ever leaves your network. Query parameters containing your data (eg values being inserted or updated, stored procedure parameters etc) are deleted before your performance data is uploaded to our cloud storage servers. 
						  </p>
						  <ul>
							 <span>Web Portfolio captures:</span>
							 <li>Queries running longer than 1 second</li>
							 <li>Machine Perfmon counters (CPU, Memory, Disk, NIC etc)</li>
							 <li>SQL Server Perfmon counters (SQLOS, wait stats, database stats etc)</li>
							 <li>Database Virtual File Stats (I/Os & waits per database file)</li>
							 <li>Server configurations, Database properties, Table & Index structure definitions, Partitions, Files, Filegroups & Views</li>
						  </ul>
					   </div>
					</div>
				 </div>
				 <div class="card wow fadeInUp" data-wow-duration="1500ms">
					<div class="card-header">
					   <a class="collapsed card-link" data-toggle="collapse" href="#collapseEighteen">
					   Is it really free?
					   </a>
					</div>
					<div id="collapseEighteen" class="collapse" data-parent="#accordion">
					   <div class="card-body">
						  <p>No business or user data from your databases ever leaves your network. Query parameters containing your data (eg values being inserted or updated, stored procedure parameters etc) are deleted before your performance data is uploaded to our cloud storage servers. 
						  </p>
						  <ul>
							 <span>Web Portfolio captures:</span>
							 <li>Queries running longer than 1 second</li>
							 <li>Machine Perfmon counters (CPU, Memory, Disk, NIC etc)</li>
							 <li>SQL Server Perfmon counters (SQLOS, wait stats, database stats etc)</li>
							 <li>Database Virtual File Stats (I/Os & waits per database file)</li>
							 <li>Server configurations, Database properties, Table & Index structure definitions, Partitions, Files, Filegroups & Views</li>
						  </ul>
					   </div>
					</div>
				 </div>
			  </div>
		   </div>
		</div>
	 </section>
  </main>
@endsection