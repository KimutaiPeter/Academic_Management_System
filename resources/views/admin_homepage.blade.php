<html>
    <head>
        <style>
            .deps Button{
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
        <meta name="csrf-token" content="{{ csrf_token() }}">
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
                <a class="dropdown-item" href="/logout">Logout</a>
                </div>
            </div>

        </div>




        <center style='margin_top:30px;'>
            <fieldset class='deps'>
                <legend>Functions</legend>

                <div style='margin-top:30px;'>
                    <p>What would you like to do today {{ $fname }}</p>
                    <a href="/admition_function_page"><button class='btn'>Admit new students <span style='color:red;'>{{ $applied_students_number }}</span></button></a><br>
                    <a href="/assigning_function_page"><Button class='btn'>Assign units to lectururs</Button></a><br>
                    <a href="/admin_timetable_management_function_page"><button class='btn'>Manage the timetable</button></a><br>
                    <button class='btn' type="button" data-toggle="modal" data-target="#exampleModalCenter" >Post anouncement</button>
                </div>
            </fieldset>
        </center>



        <!-- Pop up for messages -->
        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Post departmental anouncement</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action='admin_post_anouncement' method='post' id='approved_form' method='POST' enctype='multipart/form-data'>
                    @csrf
                    <section class='row'>
                    <label class='col-2' for="title">Title</label>
                    <input class='col-8' id='title' type="text" name='title'>
                    </section>
                    <section>
                    <label class='row' for="message">Message</label>
                    <input class='row w-100' id='message' type="textarea" >
                    </section>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button onclick='upload_new_content()' type="button" class="btn btn-success">Save changes</button>
            </div>
            </div>
        </div>
        </div>


    </body>
    <script>

        function remove_staff_user(){
            staff_user_id=document.getElementById('remove_staff_user_details');
            get_user_data(parseInt(staff_user_id.value),'remove')
        }
        function change_function(func){
            function_lable=document.getElementById('function_label');
            welcome_view=document.getElementById('welcome_message');
            new_employee_view=document.getElementById('new_employee_form');
            remove_employee_view=document.getElementById('remove_employee');
            modify_employee_view=document.getElementById('modify_employee_details');


            if(func==='add_new_employee'){
                function_lable.textContent='Add new Employee';
                welcome_view.style['display']='none';
                new_employee_view.style['display']='';
                remove_employee_view.style['display']='none';
                modify_employee_view.style['display']='none';
                
            }else if(func==='remove_employee'){
                function_lable.textContent='Remove employee';
                welcome_view.style['display']='none';
                new_employee_view.style['display']='none';
                remove_employee_view.style['display']='';
                modify_employee_view.style['display']='none';
            }else{
                function_lable.textContent='Modify employee details';
                welcome_view.style['display']='none';
                new_employee_view.style['display']='none';
                remove_employee_view.style['display']='none';
                modify_employee_view.style['display']='';
            }
        }


        function remove_staff_action(details){
            display=document.getElementById('remove_employee_action');
            display.innerHTML='';
            for(let [detail_key,detail] of Object.entries(details)){
                console.log(detail);
                disp_detail=document.createElement('p')
                disp_detail.innerHTML=detail_key+":"+detail
                display.appendChild(disp_detail);
            }
            remove_button=document.createElement('button')
            remove_button.innerHTML='Remove user'
            remove_button.onclick= function() {
                const data = { 'staff_id' : details[id] };
                fetch('/remove_staff_user', {
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
                        alert('Error try again');
                    }else{
                        alert('Successfully removed');
                    }
                })
                .catch(function (error) {
                    alert('Error, try again later');
                    console.log("hello");
                });
            }
            display.appendChild(remove_button)
            
        }


        function get_user_data(staff_id,directive){
            const data = { 'staff_id' : staff_id };

            fetch('/check_staff_user', {
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
                    alert('staff not found');
                }else{
                    if(directive==='remove'){
                        remove_staff_action(data['data']);
                    }
                }
            })
            .catch(function (error) {
                alert('Error, try again later');
                console.log("hello");
            });
        }



        function add_new_staff_user(){
            const data = { 
            
                'fname':document.getElementById('add_fname').value,
                'lname':document.getElementById('add_lname').value,
                'religion':document.getElementById('add_religion').value,
                'nationality':document.getElementById('add_nationality').value,
                'email':document.getElementById('add_email').value,
                'phone':document.getElementById('add_phone').value,
                'department':document.getElementById('add_department').value
            };

            fetch('/add_new_staff_user', {
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
                if(data['message']==='not_added'){
                    alert('staff not added');
                }else{
                    alert('New user aded');
                }
            })
            .catch(function (error) {
                alert('Error, try again later');
                console.log("hello");
            });
        }


    </script>
</html>