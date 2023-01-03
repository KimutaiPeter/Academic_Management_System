<html>
    <head>
        <style>
            .navigation a{
                margin:10px;
                visited:
            }

            .applicants_list p{
                border:black 1px solid;
            } 

            .part4 button{
                width:100px;
                margin:10px;
            }
            .part4 input{
                width:220px;
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
                <a class="dropdown-item" href="/admin_home_page">Admin home page</a>
                <a class="dropdown-item" href="/staff_department_page">Departments</a>
                <a class="dropdown-item" href="/">Home page</a>
                <a class="dropdown-item" href="/logout">Logout</a>
                </div>
            </div>


        </div>

        <center>
            <div class='container'>
                <div class='row'>

                    <div class='col-4'>
                        <fieldset style='width:40%; min-height:100px;' >
                            <legend>Students</legend>
                            <div class='applicants_list'>
                                @foreach ($details as $detail)
                                    <p id='{{ "student_profile_".$detail->id }}' onclick="fetch_student_data({{ $detail->id }})" ><span></span><span> {{ $detail->id }} | {{ $detail->fname }} | {{ $detail->courses }}</span></p>
                                @endforeach
                            </div>
                        </fieldset>
                    </div>

                    <div class='col-8'>
                            <fieldset style='width:40%; min-height:100px;'>
                        <legend>Activities</legend>
                        
                        <!-- The default display before a student has been chosen -->
                        <div id='default_display'>
                            <h2>Choose a student</h2>
                        </div>


                        <!-- The display sucess message when the student is successfully admited -->
                        <div id='success_message' style='display:none;' >
                            <h2>Successfully admited</h2>
                        </div>


                        <!-- The display error message -->
                        <div id='error_message' style='display:none;'>
                            <h2>Error</h2>
                        </div>


                        <!-- The main display for the student admition functions -->
                        <div id='main_function_display' style='display:none;'>
                            <fieldset>
                                <legend>Student details</legend>
                                <p><span>fname:</span><span id='fname_display' ></span></p>
                                <p><span>lname:</span><span id='lname_display' ></span></p>
                                <p><span>Religion:</span><span id='religion_display' ></span></p>
                                <p><span>Nationality:</span><span id='nationality_display' ></span></p>
                                <p><span>Email:</span><span id='email_display' ></span></p>
                                <p><span>Phone:</span><span id='phone_display' ></span></p>
                            </fieldset>
                            <fieldset>
                                <legend>Student documents</legend>
                                <div id='student_docs_container'></div>
                            </fieldset>
                            <fieldset>
                                <legend>Upload admition letter</legend>
                                <div>
                                    <form id='approved_form' method='POST' enctype='multipart/form-data'>
                                        @csrf
                                        <input type="file" name="file" id='doc' placeholder='file'>
                                    </form>
                                </div>
                            </fieldset>
                            <fieldset class='part4'>
                                <legend>Approve or reject the application</legend>
                                <input type="text" id='comment' placeholder='comment'><br>
                                <button>Reject</button> <button id='approve_button'>Approve</button>
                            </fieldset>
                        </div>


                    </fieldset>
                    </div>
                </div>

            </div>


        </center>
    </body>


    <script>
        function toggle_activities(student_id){
            fetch_student_data(student_id);
        }

        function default_display(){
            document.getElementById('default_display').style['display']='';
            document.getElementById('success_message').style['display']='none';
            document.getElementById('error_message').style['display']='none';
            document.getElementById('main_function_display').style['display']='none';
        }

        function success_message(){
            document.getElementById('default_display').style['display']='none';
            document.getElementById('success_message').style['display']='';
            document.getElementById('error_message').style['display']='none';
            document.getElementById('main_function_display').style['display']='none';
        }

        function error_message(){
            document.getElementById('default_display').style['display']='none';
            document.getElementById('success_message').style['display']='none';
            document.getElementById('error_message').style['display']='';
            document.getElementById('main_function_display').style['display']='none';
        }

        function main_function_display(){
            document.getElementById('default_display').style['display']='none';
            document.getElementById('success_message').style['display']='none';
            document.getElementById('error_message').style['display']='none';
            document.getElementById('main_function_display').style['display']='';
        }


        function populate_student_details_data(data){
            document.getElementById('fname_display').textContent=data['fname'];
            document.getElementById('lname_display').textContent=data['lname'];
            document.getElementById('religion_display').textContent=data['religion'];
            document.getElementById('nationality_display').textContent=data['nationality'];
            document.getElementById('email_display').textContent=data['email'];
            document.getElementById('phone_display').textContent=data['phone'];
            document.getElementById('approve_button').onclick=function (){Approve(data['id'])}
        }

        function populate_student_docs_data(data){
            container=document.getElementById('student_docs_container');
            //Clearing the privious contents of the container
            container.innerHTML=''
            //Populate it with every available document
            data.forEach(function (doc){
                form=document.createElement('form')
                form.action='/open_file';
                form.method='GET'
                form.target='_blank'
                input=document.createElement('input')
                input.type='text'
                input.name='file_name'
                input.value=doc['file_name']
                input.style['display']='none'
                //Create a button for submiting file
                button=document.createElement('button');
                button.innerHTML=String(doc['type']);
                console.log(doc['type']);
                //Append every form component
                form.appendChild(input)
                form.appendChild(button);
                container.appendChild(form);
            });
        }


        function fetch_student_data(student_id){
            const data = { 'student_id' : student_id };
            fetch('/fetch_student_data', {
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
                if(data['message']==='not_found'){
                    error_message();
                }else{
                    populate_student_details_data(data['data']);
                    populate_student_docs_data(data['docs'])
                    main_function_display();
                }
            })
            .catch(function (error) {
                error_message();
                console.log("hello");
            });
        }



        function Approve(student_id){
            form = document.getElementById('approved_form')
            student_id_input=document.createElement('input')
            student_id_input.name='student_id'
            student_id_input.style['display']='none'
            student_id_input.value=student_id
            form.appendChild(student_id_input)
            fetch('admition_approval_form', {
                method: 'POST',
                body: new FormData(form)
            })
            .then((response) => response.json())
            .then((data) => {
                console.log('Responce success:', data);
                if(data['message']==='error'){
                    error_message();
                }else{
                    success_message();
                    document.getElementById('student_profile_'+data['student_id']).remove();
                }
            })
            .catch(function (error) {
                error_message();
                console.log("hello");
            });
        }


    </script>
</html>