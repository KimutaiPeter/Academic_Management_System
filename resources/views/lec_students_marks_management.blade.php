<html>
    <head>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    </head>
    <body>


        <div class="row bg-dark">
            <div class="col">
                <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Back
                </button>
                <div class="dropdown-menu float-right" >
                <a class="dropdown-item" href="lec_home_page">Lecturers home page</a>
                <a class="dropdown-item" href="staff_department_page">Departments</a>
                <a class="dropdown-item" href="/">Home</a>
                <a class="dropdown-item" href="logout">Logout</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">Separated link</a>
                </div>
            </div>

        </div>


        <center>
            <div>
                @if($count!=0)
                    <table>
                        <tr>
                            <th>student id</th>
                            <th>course work</th>
                            <th>exam mark</th>
                        </tr>
                        @foreach( $students as $student )
                
                                <tr>
                                    <form action="">
                                    <td>{{ $student->student_id }}</td>
                                    <td><input type="text" placeholder='course work' value='{{ $student->course_work }}'></td>
                                    <td><input type="text" placeholder='Exam mark' value='{{ $student->exam_mark }}'></td>
                                    <td><button class='btn'>Update</button></td>
                                    </form>
                                    <td><button class=' btn btn-success' >Mark unit completion</button></td>
                                </tr>
                            
                        @endforeach
                    </table>
                @else 
                    <h3>No student has registered for this unit</h3>
                    <h2>Contact the admin</h2>
                @endif
            </div>
        </center>
    </body>
</html>