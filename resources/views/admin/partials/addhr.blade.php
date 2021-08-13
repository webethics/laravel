            <!-- Add HR TAB Content -->

<div class="card">
    <div class="card-body">
        <div class="row" id="tag_container">
            <div class="box box-primary">
                <div class="box-body">
                    <form method="POST" accept-charset="UTF-8" class="profile form-horizontal" id="add_hr_form" >
                        <div class="form-group col-md-12">
                            <div class="row">
                                <div class="col-md-6 row">
                                    <div class="col-md-12 col-xs-12 field mb-4">
                                        <label for="tech_stack">Tech Stack</label>
                                            <select id="tech_stack"  class="form-control select2-single"  name="tech_stack[]"  data-width="100%" multiple>
                                                <option value="">Select Tech Stack</option>
                                                <option value="PHP" >PHP</option>
                                                <option value="Wordpress" >Wordpress</option>
                                                <option value="Java" >Java</option>
                                                <option value="C++" >C++</option>
                                            </select>
                                    </div>
                                    <div class="col-md-12 col-xs-12 field mb-4">
                                        <label for="title">Past Experience</label>
                                            <input class="form-control" placeholder="Ex: 2.6 Years" name="past_experience" type="text"  id="past_experience">
                                    </div>

                                    <div class="col-md-12 col-xs-12 field mb-4">
                                        <label for="title">Past Companoies</label>
                                            <input class="form-control" placeholder="Past Companoies" name="past_companies" type="text"  id="past_companies">
                                    </div>

                                    <div class="col-md-12 col-xs-12 field mb-4">
                                        <label for="title">Tele Verification</label>
                                            <select  class="form-control select2-single"  name="tele_verification" id="tele_verification" data-width="100%">
                                                <option value=" ">Tele Verification</option>
                                                <option value="1" >Yes</option>
                                                <option value="2" >No</option>
                                            </select>
                                    </div>

                                    <div class="col-md-12 col-xs-12 field mb-4">
                                        <label for="title">Email Verification</label>
                                            <select  class="form-control select2-single"  name="email_verification" id="email_verification"  data-width="100%">
                                                <option value=" ">Email Verification</option>
                                                <option value="1" >Yes</option>
                                                <option value="2" >No</option>
                                            </select>
                                    </div>

                                    <div class="col-md-12 col-xs-12 field mb-4">
                                        <label for="title">Hired Through</label>
                                            <input class="form-control" placeholder="Hired Through" name="hired_through" type="text"  id="hired_through">
                                    </div>
                                               
                                </div>


                                <!-- NEW DIV START 6-6 -->
                                <div class="col-md-6 row">
                                    <div class="col-md-12 col-xs-12 field mb-4">
                                        <label for="title">Hired on</label>
                                            <input class="form-control" placeholder="Ex: 20k " name="hired_on" type="textarea"  id="hired_on">
                                            <span class="text-danger" id="hired_on-error"></span>	
                                    </div>

                                    <div class="col-md-12 col-xs-12 field mb-4">
                                        <label for="title">Increment due</label>
                                            <div class="input-group date">
                                                <input type="text" class="form-control" id="increment_due" name="increment_due" placeholder="Increment Due">
                                                <span class="input-group-text input-group-append input-group-addon">
                                                    <i class="simple-icon-calendar"></i>
                                                </span>
                                            </div>
                                            <span class="text-danger" id="increment_due-error"></span>	
                                    </div>

                                    <div class="col-md-12 col-xs-12 field mb-4">
                                        <label for="DOJ">Leaving Date</label>
                                            <div class="input-group date">
                                                <input type="text" class="form-control" id="leaving_date" name="leaving_date" placeholder="Leaving Date">
                                                <span class="input-group-text input-group-append input-group-addon">
                                                <i class="simple-icon-calendar"></i>
                                                </span>
                                            </div>
                                    </div>

                                    <div class="col-md-12 col-xs-12 field mb-4">
                                        <label for="title">Education</label>
                                            <input class="form-control" placeholder="Education" name="education" type="text"  id="education">
                                    </div>
                                  

                                    <div class="col-md-12 col-xs-12 field mb-4">
                                        <label for="title">Comments</label>
                                            <textarea class="form-control" id="comments" rows="6" name="comments" placeholder="Add Comments.."></textarea>
                                    </div>
                                   
                                                           

                                </div>
                                <button id="submit" class="btn btn-primary default  btn-lg mb-2 mb-lg-0 col-12 col-lg-auto mx-auto d-block">{{trans('global.submit')}}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
		</div>
	</div>
</div>
                     