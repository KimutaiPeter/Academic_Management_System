<html>
    <head>
        <title></title>

        <style>
            .deps button{
                margin:5px;
                width:200px;
            }
            .deps {
                width:40%;
            }
        </style>
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
                <a class="dropdown-item" href="/">Landing page</a>
                </div>
            </div>


            <div class="col d-flex flex-row-reverse">
                <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                My profile
                </button>
                <div class="dropdown-menu float-right" >
                <a class="dropdown-item" href="/student_elearning_profile_page">Profile</a>
                <a class="dropdown-item" href="/logout">Logout</a>
                </div>
            </div>
        </div>



        <center>
            <fieldset>
                <legend>Time table</legend>

                @if($count==0)
                <div id='no_time_table_data_yet'>
                    <h2>No time table data yet</h2>
                    <h4>register for this semesters units</h4>
                </div>
                @else
                <table>
                    <tr>
                        <th>Day</th>
                        <th>Start time</th>
                        <th>End time</th>
                        <th>Unit</th>
                    </tr>
                    @foreach( $my_time_table as $lesson)
                        <tr>
                            <td>{{ $lesson->day }}</td>
                            <td>{{ $lesson->start_time }}</td>
                            <td>{{ $lesson->end_time }}</td>
                            <td>{{ $lesson->unit_code }}</td>
                            <td><form action="student_unit_content_page"><input type="text" name='unit_code' value='{{ $lesson->unit_code }}' style='display:none;'><button class='btn'>Elearning</button></form></td>
                            <td><form action=""><input type="text" style='display:none;'><button class='btn'>Open lesson</button></form></td>
                        </tr>
                    @endforeach
                </table>

                @endif
            </fieldset>
        </center>
    </body>
</html>