
					<div class="modal-dialog">
						<!-- Modal content-->
						<div class="modal-content">
							<div class="modal-header py-1">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								
							</div>
							@foreach($employees as $employee)
							<div class="modal-body">
						
								<p style="font-size: .85rem;line-height: 1.2rem;font-family: Nunito,sans-serif"><strong>EMP ID: </strong>{{$employee->emp_id}}</p>

							

								<p style="font-size: .85rem;line-height: 1.2rem;font-family: Nunito,sans-serif"><strong>Name: </strong>{{$employee->emp_name}}</p>

								<p style="font-size: .85rem;line-height: 1.2rem;font-family: Nunito,sans-serif"><strong>Father Name: </strong>{{$employee->father_name}}</p>

								<p style="font-size: .85rem;line-height: 1.2rem;font-family: Nunito,sans-serif"><strong>Personal Email: </strong>{{$employee->personal_email}}</p>

                                <p style="font-size: .85rem;line-height: 1.2rem;font-family: Nunito,sans-serif"><strong>Professional Email: </strong>{{$employee->professional_email}}</p>

                                <p style="font-size: .85rem;line-height: 1.2rem;font-family: Nunito,sans-serif"><strong>Phone: </strong>{{$employee->phone}}</p>

                                <p style="font-size: .85rem;line-height: 1.2rem;font-family: Nunito,sans-serif"><strong>Current-Address: </strong>{{$employee->current_address}}</p>

                                <p style="font-size: .85rem;line-height: 1.2rem;font-family: Nunito,sans-serif"><strong>Permanent-Address: </strong>{{$employee->permanent_address}}</p>


								<p style="font-size: .85rem;line-height: 1.2rem;font-family: Nunito,sans-serif"><strong>DOJ: </strong>{{$employee->date_of_joining}}</p>

								<p style="font-size: .85rem;line-height: 1.2rem;font-family: Nunito,sans-serif"><strong>DOB: </strong>{{$employee->date_of_birth}}</p>

								<p style="font-size: .85rem;line-height: 1.2rem;font-family: Nunito,sans-serif"><strong>Current Salary: </strong>{{$employee->current_salary}}</p>

                                <p style="font-size: .85rem;line-height: 1.2rem;font-family: Nunito,sans-serif"><strong>Category: </strong>{{$employee->category}}</p>
								
							</div>
							@endforeach
							<div class="modal-header py-1">
								
								
							</div>
							<div class="modal-body">
							
								
								<p style="font-size: .85rem;line-height: 1.2rem;font-family: Nunito,sans-serif"><strong>Tech Stack: </strong> Wordpress</p>

							

								<p style="font-size: .85rem;line-height: 1.2rem;font-family: Nunito,sans-serif"><strong>Past Experience: </strong>3 Years</p>

								<p style="font-size: .85rem;line-height: 1.2rem;font-family: Nunito,sans-serif"><strong>Past Companies: </strong>Google, Wipro</p>

								<p style="font-size: .85rem;line-height: 1.2rem;font-family: Nunito,sans-serif"><strong>Telverification: </strong>Yes</p>

                                <p style="font-size: .85rem;line-height: 1.2rem;font-family: Nunito,sans-serif"><strong>Email Verification: </strong>No</p>

                                <p style="font-size: .85rem;line-height: 1.2rem;font-family: Nunito,sans-serif"><strong>Hired Through: </strong>Test</p>

                                <p style="font-size: .85rem;line-height: 1.2rem;font-family: Nunito,sans-serif"><strong>Hired On: </strong>26k</p>

                                <p style="font-size: .85rem;line-height: 1.2rem;font-family: Nunito,sans-serif"><strong>Increment Due: </strong>No</p>


								<p style="font-size: .85rem;line-height: 1.2rem;font-family: Nunito,sans-serif"><strong>Leaving Date: </strong> 01-04-2021</p>

								<p style="font-size: .85rem;line-height: 1.2rem;font-family: Nunito,sans-serif"><strong>Education: </strong> Graduate</p>

							

                               
                                <button type="submit" class="btn btn-dark default btn-lg mt-5 mb-sm-0 mr-2 col-12 col-sm-auto closebutton" data-dismiss="modal">Close</button>
							
							</div>
							
						</div>

					</div>
				</div>