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
                <a class="dropdown-item" href="admin_home_page">Admin home page</a>
                <a class="dropdown-item" href="staff_department_page">Departments</a>
                <a class="dropdown-item" href="/">Home</a>
                <a class="dropdown-item" href="/logout">Logout</a>
                </div>
            </div>

        </div>


        <center>
            <fieldset>
                <legend>Units table</legend>
                <div>
                    <table>
                        <tr>
                            <th>ID</th>
                            <th>Year</th>
                            <th>Semester</th>
                            <th>Code</th>
                            <th>Name</th>
                            <th>Lecturer</th>
                        </tr>

                        @foreach( $details as $unit )
                            <tr>
                                <td>{{ $unit->id }}</td>
                                <td>{{ $unit->year }}</td>
                                <td>{{ $unit->semester }}</td>
                                <td>{{ $unit->unit_code }}</td>
                                <td>{{ $unit->name }}</td>
                                <form method='POST' action="/assigning_function_data">
                                    @csrf
                                    <input type="text" style='display:none;' name='unit_id' value="{{ $unit->id }}">
                                    <td>
                                        <select name="lecturer_id" id="">
                                            @foreach ($lecturers as $lecturer)
                                                <option value="{{ $lecturer->id }}">{{ $lecturer->fname }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td><button class='btn' type='submit'>update</button></td>
                                </form>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </fieldset>
        </center>
    </body>
</html>