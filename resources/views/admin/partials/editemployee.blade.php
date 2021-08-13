

<!-- Add Employee TAB Content -->

<div class="card">
  <div class="card-body">
      <div class="row" id="tag_container">
          <div class="box box-primary">
              <div class="box-body">
              @foreach($employees as $employee)
                  <form method="POST"  accept-charset="UTF-8" class="profile form-horizontal" id="edit_employee_form">
                 
                      <div class="col row col-md-12">
                            <div class="col row col-md-6">
                       
                                           <!--    EMP ID     -->
                                  <div class="col-md-12 col-xs-12 field mb-4">
                                      <label for="Sale Item No">EMP ID</label>
                                          <input class="form-control" id="emp_id" value="{{$employee->emp_id}}" placeholder="Employee ID"  name="emp_id" type="text" >	
                                          <span class="text-danger" id="emp_id-error"></span>	
                                  </div>
                                   
                                                          <!--Name  -->
                                  
                                  <div class="col-md-12 col-xs-12 field mb-4">
                                      <label for="title">Name</label>
                                          <input class="form-control" placeholder="Name" name="emp_name" type="text" value="{{$employee->emp_id}}" id="emp_name">
                                          <span class="text-danger" id="emp_name-error"></span>	
                                  </div>
                                                       <!--  Father Name-->
                                  <div class="col-md-12 col-xs-12 field mb-4">
                                      <label for="title">Father Name</label>
                                          <input class="form-control" placeholder="Father-Name" name="father_name" type="text" value="{{$employee->emp_id}}" id="father_name">

                                          <span class="text-danger" id="father_name-error"></span>	
                                  </div>
                                                  <!--Personal Email   -->
                                  <div class="col-md-12 col-xs-12 field mb-4" >
                                      <label for="Personal_Email">Personal Email </label>
                                          <a  href="#" id="more_fields"><i class="action simple-icon-plus"></i></a>
                                          <input class="form-control" placeholder="Personal Email" name="personal_email" type="email" value="{{$employee->emp_id}}"  id="personal_email">

                                          <span class="text-danger" id="personal_email-error"></span>	
                                  </div>
                                                    <!-- Professional Email  -->
                                   <div class="col-md-12 col-xs-12 field mb-4" id="Professional_Email">
                                      <label for="Professional_Email" id="label_email">Professional Email  </label>
                                          <input class="form-control" placeholder="Professional_Email" name="professional_email" value="{{$employee->emp_id}}" id="professional_email" type="email" >

                                         
                                  </div>

                                                  <!-- Phone -->
                                  <div class="col-md-12 col-xs-12 field mb-4">
                                      <label for="title">Phone</label>
                                          <input class="form-control" placeholder="Phone" name="phone" type="text"  id="phone">
                                          <span class="text-danger" value="{{$employee->emp_id}}" id="phone-error"></span>
                                  </div>

                                                   <!-- Current Address-->
                                <div class="col-md-12 col-xs-12 field mb-4">
                                      <label for="title">Current Address</label>
                                          <a  href="#" id="more_address"><i class="action simple-icon-plus"></i></a>
                                          <textarea class="form-control" placeholder="Current Address.." name="current_address"   row="6" id="current_address">
                                          </textarea>

                                      
                                </div>

                                                        <!-- Permanent Address -->
                                    <div class="col-md-12 col-xs-12 field mb-4" id="Permanent_Address"> 
                                      <label for="title">Permanent Address</label>
                                          <textarea class="form-control" placeholder="Permanent Address" name="permanent_address" id="permanent_address"> </textarea> 
                                  </div>
                                                  <!-- Date Of Joining -->
                                  <div class="col-md-12 col-xs-12 field mb-4">
                                      <label for="DOJ">Date Of Joining</label>
                                          <div class="input-group date">
                                              <input type="text" class="form-control" id="date_of_joining" name="date_of_joining" placeholder="Date of Joining">
                                              <span class="input-group-text input-group-append input-group-addon">
                                              <i class="simple-icon-calendar"></i>
                                              </span>
                                          </div>

                                          <span class="text-danger" id="date_of_joining-error"></span>	
                                  </div>   
                                
                     
                                              

                            </div>
                                                       <!-- SECOND GRID STARTED -->
                            <div class="col row col-md-6">
                                     <!-- Date of Birth -->
                                     <div class="col-md-12 col-xs-12 field mb-4">
                                      <label for="DOB">Date Of Birth</label>
                                          <div class="input-group date">
                                              <input type="text" class="form-control" id="date_of_birth" name="date_of_birth" placeholder="Date of Birth">
                                              <span class="input-group-text input-group-append input-group-addon">
                                              <i class="simple-icon-calendar"></i>
                                              </span>
                                          </div>

                                          <span class="text-danger" id="date_of_birth-error"></span>	
                                  </div>
                                                  <!-- Current Salray -->
                                  <div class="col-md-12 col-xs-12 field mb-4">
                                      <label for="title">Current Salary</label>
                                          <input class="form-control" placeholder="Current-Salary" name="current_salary" type="textarea"  id="current_salary">

                                          <span class="text-danger" id="current_salary-error"></span>	
                                  </div>

                                      <!-- category -->
                                  <div class="col-md-12 col-xs-12 field mb-4">
                                  <label for="category">Select Category</label>
                                      <select id="category"  class="form-control select2-single"  name="category"  data-width="100%">
                                          
                                            <option value=" ">Select Category</option>
                                            @foreach($categories as $c)
                                            <option value="{{$c->id}}"  >{{$c->category_name}}</option>
                                            @endforeach                     
                                        </select>
                                                              <span class="text-danger" id="category-error"></span>	
                                  </div>

                                      <!--  PAN -->
                                  <div class="col-md-12 col-xs-12 field mb-4">
                                      <label for="pan_details">PAN</label>
                                          <input class="form-control" placeholder="PAN-Details" name="pan_details" type="text"  id="pan_details">

                                          
                                  </div>

                                          <!-- EPFO -->
                                  <div class="col-md-12 col-xs-12 field mb-4">
                                      <label for="title">EPFO</label>
                                          <input class="form-control" placeholder="EPFO-Details" name="epfo_details" type="text"  id="epfo_details">

                                        
                                  </div>

                                      <!-- ESI -->
                                  <div class="col-md-12 col-xs-12 field mb-4">
                                      <label for="title">ESI</label>
                                          <input class="form-control" placeholder="ESI" name="esi_details" type="text"  id="esi_details">

                                          <span class="text-danger" id="esi_details-error"></span>	
                                  </div>

                                  <!-- Bank Acount -->
                                  <div class="col-md-12 col-xs-12 field mb-4">
                                      <label for="title">Bank Account</label>
                                          <input class="form-control" placeholder="Bank Account " name="bank_account" type="text"  id="bank_account">

                                          
                                  </div>

                                              <!-- IFSC  -->
                                  <div class="col-md-12 col-xs-12 field mb-4">
                                      <label for="title">IFSC</label>
                                          <input class="form-control" placeholder="IFSC CODE" name="ifsc_code" type="text"  id="ifsc_code">

                                          
                                  </div>
                                                       
                              </div>

                                <div class="col-md-12 col-xs-12 field mb-4">

                                <button id="submit" class="btn btn-primary default  btn-lg mb-2 mt-4 mb-lg-0 col-6 col-lg-auto mx-auto d-block">{{trans('global.submit')}}</button>
                                </div>   
                            </div>  
                        
                  </form>
                  @endforeach
              </div>
          </div>
      </div>
  </div>
</div>


              <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
                  <script>
                      $(document).ready(function(){
                      $("#more_fields").click(function(){
                          $("#Professional_Email").toggle();
                          ;
                          $("i", this).toggleClass("simple-icon-plus simple-icon-minus");
                      });
                      });
                  </script>

                  <script>
                      $(document).ready(function(){
                      $("#more_address").click(function(){
                          $("#Permanent_Address").toggle();
                      
                          $("i", this).toggleClass("simple-icon-plus simple-icon-minus");
                      });
                      });
                  </script>