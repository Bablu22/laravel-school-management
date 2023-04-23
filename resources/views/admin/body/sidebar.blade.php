<div class="sidebar-inner niceScrollleft">

    <div id="sidebar-menu">
        <ul>
            <li class="menu-title">Main</li>

            <li>
                <a href="{{route('dashboard')}}" class="waves-effect">
                    <i class="mdi mdi-airplay"></i>
                    <span> Dashboard </span>
                </a>
            </li>
            @if(Auth::user()->role=='Admin')
                <li>
                    <a href="{{route('user.all')}}" class="waves-effect"><i class="fas fa-user-tie"></i>
                        <span>Manage User</span></a>
                </li>
            @endif

            <li class="menu-title">Setup Management</li>

            <li class="has_sub">
                <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-settings"></i>
                    <span>Setup Manage</span> <span class="float-right"><i
                            class="mdi mdi-chevron-right"></i></span></a>
                <ul class="list-unstyled">
                    <li><a href="{{route('class.all')}}">Student Class</a></li>
                    <li><a href="{{route('years.all')}}">Student Year</a></li>
                    <li><a href="{{route('group.all')}}">Student Group</a></li>
                    <li><a href="{{route('shift.all')}}">Student Shift</a></li>
                    <li><a href="{{route('fee_category.all')}}">Fee Categories</a></li>
                    <li><a href="{{route('fee_category_amount.all')}}">Fee Amount</a></li>
                    <li><a href="{{route('exam_type.all')}}">Exam Types</a></li>
                    <li><a href="{{route('subject.all')}}">Subjects</a></li>
                    <li><a href="{{route('subject-assign.all')}}">Assign Subject</a></li>
                    <li><a href="{{route('designation.all')}}">Designations</a></li>

                </ul>
            </li>

            <li class="has_sub">
                <a href="javascript:void(0);" class="waves-effect"><i class="fas fa-user-graduate"></i>
                    <span>Student Manage</span> <span class="float-right"><i
                            class="mdi mdi-chevron-right"></i></span></a>
                <ul class="list-unstyled">
                    <li><a href="{{route('student-registration.all')}}">Student Registration</a></li>
                    <li><a href="{{route('reg-fee.all')}}">Registration Fees</a></li>
                    <li><a href="{{route('monthly-fee.all')}}">Monthly Fees</a></li>
                    <li><a href="{{route('exam-fee.all')}}">Exam Fees</a></li>
                </ul>
            </li>
            <li class="has_sub">
                <a href="javascript:void(0);" class="waves-effect"><i class="fas fa-users"></i>
                    <span>Employee Manage</span> <span class="float-right"><i
                            class="mdi mdi-chevron-right"></i></span></a>
                <ul class="list-unstyled">
                    <li><a href="{{route('employee.all')}}">Employee Registration</a></li>
                    <li><a href="{{route('employee.salary.view')}}">Employee Salary</a></li>
                    <li><a href="{{route('employee.leave.view')}}">Employee Leave</a></li>
                    <li><a href="{{route('employee.attendance.view')}}">Employee Attendance</a></li>
                    <li><a href="{{route('employee.monthly.salary')}}">Employee Salary</a></li>
                </ul>
            </li>
        </ul>
    </div>
    <div class="clearfix"></div>
</div>

