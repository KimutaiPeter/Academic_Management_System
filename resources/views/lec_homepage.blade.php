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
                <a class="dropdown-item" href="staff_department_page">Departments</a>
                <a class="dropdown-item" href="/">Home</a>
                <a class="dropdown-item" href="logout">Logout</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">Separated link</a>
                </div>
            </div>

        </div>



        <center>
            <fieldset style='width:40%;'>
                <legend>Activities</legend>
                @if($unit_count!=0)
                <form action="lec_manage_marks_function">
                    <select name="unit_code" id="">
                        @foreach($units as $unit)
                            <option value="{{ $unit->unit_code }}">{{ $unit->name }}</option>
                        @endforeach
                    </select>
                    <button class='btn'>Manage students marks</button>
                </form><br>
                
                <form action="lec_elearning_content_management_page">
                    <select name="unit_code" id="">
                        @foreach($units as $unit)
                            <option value="{{ $unit->unit_code }}">{{ $unit->name }}</option>
                        @endforeach
                    </select>
                    <button class='btn'>Manage course content</button>
                </form><br>
                @else
                <button onclick='no_classes()'>Manage students marks</button><br>
                <button onclick='no_classes()' >Manage classess</button><br>
                @endif
            </fieldset>
        </center>

        <center>
            <fieldset style='width:60%;'>
                <legend>My timetable</legend>
                @if($count!=0)
                    <div>
                        <table>
                            <tr>
                                <th>Day</th>
                                <th>Start time</th>
                                <th>End time</th>
                                <th>Unit</th>
                            </tr>
                            @foreach( $time_table as $lesson)
                                <tr>
                                    <td>{{ $lesson->day }}</td>
                                    <td>{{ $lesson->start_time }}</td>
                                    <td>{{ $lesson->end_time }}</td>
                                    <td>{{ $lesson->unit_code }}</td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                @else
                    <div>
                        <h1>No classess assigned yet</h1>
                        <h3>Contact the administrator</h3>
                    </div>
                @endif
            </fieldset>
        </center>
    </body>

    <script>
        function no_classes(){
            alert("You currently have no classes \n please contact the administator");
        }
    </script>
</html>