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
        <meta name="csrf-token" content="{{ csrf_token() }}">
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
                <a class="dropdown-item" href="/logout">Logout</a>
                </div>
            </div>


            <div class="col d-flex flex-row-reverse">
                <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                My profile
                </button>
                <div class="dropdown-menu float-right" >
                <a class="dropdown-item" onclick='change_function("add_new_employee")'>Add new Employee</a>
                <a class="dropdown-item" onclick='change_function("remove_employee")'>Remove employee</a>
                <a class="dropdown-item" onclick='change_function("modify_employee_details")'>Modify employee details</a>
                </div>
            </div>
        </div>

    
        <center style='margin_top:30px;'>
            <fieldset class='deps' >
                <legend id='function_label' >Welcome</legend>
                <!-- This is the main div containing all the functions -->
                <div id='main_div' style='margin-top:30px;'>
                    <!-- A welcome message  -->
                    <div id='welcome_message'>
                        <h2>Welcome {{ $fname }}</h2>
                        <p>What would you like to do today</p>
                    </div>


                    <!--  -->
                    <div id='new_employee_form' style='display:none;'>
                        <form action="">
                            <input type="text" placeholder='first name' id='add_fname'><br>
                            <input type="text" placeholder='sur name' id='add_lname'><br>
                            <input type="text" placeholder='email' id='add_email'><br>
                            <input type="text" placeholder='Phone number' id='add_phone'><br>

                            <select name="religion" id="add_religion">
                                <option value='christian'>Christian</option>
                            </select><br>
                            <select name="nationality" id="add_nationality">
                                <option value='kenyan'>Kenya</option>
                            </select><br>

                            <select name="status" id="add_status">
                                <option value='leave'>Leave</option>
                                <option value='active'>Active</option>
                                <option value='suspended'>Suspended</option>
                            </select><br>

                            <select name="department" id="add_department">
                                <option value='lecturer'>Lecturer</option>
                                <option value='admin'>Admin</option>
                                <option value='finance'>Finance</option>
                            </select><br>
                            
                        </form>
                        <button onclick='add_new_staff_user()'>submit form</button>
                    </div>



                    <!-- The div to contain a form to remove a user -->
                    <div id='remove_employee' style='display:none;' >
                        <span>
                            <input type="text" id='remove_staff_user_details' placeholder='id number' name='' > <button class='btn' onclick='remove_staff_user()'>search</button>
                        </span>

                        <div id='remove_employee_action'>
                        </div>
                    </div>


                    <!-- The div to contain a form to modify a user details-->
                    <div id='modify_employee_details' style='display:none;' >
                        <form action="">
                            <input type="text" placeholder='id number' name='' > <button class='btn'>search</button>
                        </form>

                    </div>

                </div>
            </fieldset>
        </center>

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