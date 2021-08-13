
<tr class="employee_row_{{$employee->id}}">
    <td>{{$employee->emp_id}}</td>
    <td>{{$employee->emp_name}}</td>
    <td><a href="#">{{$employee->personal_email}}</a></td>
    
    <td>{{$employee->phone}}</td>
	<td>{{$employee->current_salary}}</td>
 
    <td>
		<!-- Edit Lead -->
        <a class="action2" title="Edit employee" href="{{url('admin/employee/edit')}}/{{$employee->id}}" ><i class="simple-icon-note" ></i> </a>
                    <!-- View Lead -->
            <a class="action2 viewemployee" data-employee_id="{{$employee->id}}" title="View employee" href="javascript:void(0)" ><i class="simple-icon-eye" > </i></a>

           

					<!-- Delete Lead -->
                <a title="Delete Employee" data-id="{{$employee->id}}" data-confirm_type="complete" data-confirm_message="Are you sure you want to delete this Employee?" data-left_button_name="Yes" data-left_button_id="delete_employee" data-left_button_cls="btn-primary" class="open_confirmBox action2 deleteemployee" href="javascript:void(0)" data-employee_id="{{ $employee->id }}"><i class="simple-icon-trash"></i></a>



         
    </td>
</tr>


