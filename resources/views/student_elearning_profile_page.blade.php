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
                <a class="dropdown-item" href="/student_elearning_page">Elearning</a>
                <a class="dropdown-item" href="/">Landing page</a>
                </div>
            </div>


            <div class="col d-flex flex-row-reverse">
                <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                My profile
                </button>
                <div class="dropdown-menu float-right" >
                <a class="dropdown-item" href="/logout">Logout</a>
                <button onclick='display_selfregistration_div()' class="dropdown-item">Self Registration</button>
                <a class="dropdown-item" onclick="display_profile_div()">My profile</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" onclick='display_my_marks_div()'>My marks</a>
                </div>
            </div>
        </div>


        <!--
        <center>
            <fieldset class='deps'>
                <legend>Activities</legend>
                <div>
                    <a href="/student_elearning_page"><button>Elearning</button></a><br>
                    <a href="/logout"><button>Logout</button></a><br>
                    <button onclick='display_selfregistration_div()'>Register for units</button><br>
                    <button onclick="display_profile_div()">Profile</button><br>
                    <button onclick='display_my_marks_div()'>My marks and course work</button>
                </div>
            </fieldset>
        </center>
        -->


        <center>
            <fieldset  style='width:60%;'>
                <legend id='current_activity'>My profile</legend>
                <div id='profile'>
                    <fieldset style='width:50%;'>
                        <legend>Account credentials</legend>
                        <input name='fname' type="text" value="{{ $rentry->fname }}" placeholder='First name'><br>
                        <input name='lname' type="text" value="{{ $rentry->lname }}" placeholder='Last Name'><br>
                        <input name="nationality"  value="{{ $rentry->nationality }}" placeholder='nationality' id="">
                    </fieldset>
                    <fieldset style='width:50%;'>
                        <legend>Contact</legend>
                        <input name='email' type="email" value="{{ $rentry->email }}" placeholder='Email'><br>
                        <input name='phone_no' type="text" value="{{ $rentry->phone }}" placeholder='Phone Number'>
                    </fieldset>
                    <fieldset style='width:50%;'>
                        <legend>Uploaded documents</legend>
                        <div>
                            @foreach($docs as $doc)
                                    <form action="open_file">
                                        <input name='file_name' value='{{ $doc->file_name }}' type="text" style='display:none;'> 
                                        <button class='btn' >{{ $doc->type}}</button>
                                    </form>
                            @endforeach
                        </div>
                    </fieldset>
                </div>




                <!-- self registration div -->
                <div style='display:none;' id='self_registration_div'>
                    <table>
                        <tr>
                            <th>ID</th>
                            <th>Year</th>
                            <th>Semester</th>
                            <th>Code</th>
                            <th>Name</th>
                            <th>Lecturer</th>
                        </tr>

                        @foreach( $units as $unit )
                            <tr>
                                <td>{{ $unit->id }}</td>
                                <td>{{ $unit->year }}</td>
                                <td>{{ $unit->semester }}</td>
                                <td>{{ $unit->unit_code }}</td>
                                <td>{{ $unit->name }}</td>
                                <td>{{ $unit->lecturer }}</td>
                                <td><button id='{{$unit->unit_code}}'  onclick='register_unit({{ session("student_id") }},"{{ $unit->unit_code }}","{{ $unit->name }}")'>Register</button></td>
                            </tr>
                        @endforeach
                    </table>
                </div>



                <!-- Students marks and course work-->
                <div style='display:none;' id='my_marks_div'>

                    <table>
                        <tr>
                            <th>Unit</th>
                            <th>course work</th>
                            <th>Exam Mark</th>
                            <th>Status</th>
                        </tr>
                        
                        @foreach($marks as $unit_mark)
                            <tr>
                                <td>{{ $unit_mark->unit_name }}</td>
                                <td>{{ $unit_mark->course_mark }}</td>
                                <td>{{ $unit_mark->exam_mark }}</td>
                                <td>{{ $unit_mark->status }}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </fieldset>
        </center>
    </body>


    <script>
        function display_profile_div(){
            self_registration_container=document.getElementById('self_registration_div')
            profile_container=document.getElementById('profile');
            my_marks_container=document.getElementById('my_marks_div')
            profile_container.style['display']=''
            self_registration_container.style['display']='none';
            my_marks_container.style['display']='none'

        }

        function display_selfregistration_div(){
            self_registration_container=document.getElementById('self_registration_div')
            profile_container=document.getElementById('profile');
            my_marks_container=document.getElementById('my_marks_div')
            profile_container.style['display']='none'
            self_registration_container.style['display']='';
            my_marks_container.style['display']='none'
        }

        function display_my_marks_div(){
            self_registration_container=document.getElementById('self_registration_div')
            profile_container=document.getElementById('profile');
            my_marks_container=document.getElementById('my_marks_div')
            profile_container.style['display']='none'
            self_registration_container.style['display']='none';
            my_marks_container.style['display']=''
        }


        function register_unit(student_id,unit_code,unit_name){
            
            console.log(String(student_id),unit_code);

            //Send the student id, and the unit to register
            const data = { 'student_id' : String(student_id),'unit_code':unit_code ,'unit_name':unit_name};
            fetch('/register_student_unit', {
                method: 'POST', // or 'PUT'
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
            body: JSON.stringify(data),
            })
            .then((response) => response.json())
            .then((data) => {
                console.log('Responce success:', data);
                if(data['message']==='registered'){
                    alert('Successfully registered');
                }else if(data['message']==='error'){
                    alert(data['error'])
                }
                
            })
            .catch(function (error) {
                alert('Error, try again later');
                console.log("hello");
            });
        }
    </script>
</html>