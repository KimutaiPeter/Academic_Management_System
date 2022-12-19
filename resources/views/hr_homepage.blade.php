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
    </head>
    <body>
        <center>
            <div><a href="/"><button>Home page</button></a><a href="/logout"><button>Log out</button></a></div>
        </center>
        <center style='margin_top:30px;'>
            <fieldset class='deps'>
                <legend>Functions</legend>
                <div style='margin-top:30px;'>
                    <Button onclick='change_function("add_new_employee")'>Add new employee</Button><br>
                    <Button onclick='change_function("remove_employee")' >Remove employee</Button><br>
                    <Button onclick='change_function("modify_employee_details")' >Modify details</Button><br>
                </div>
            </fieldset>
        </center>
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
                                <option value='lecturur'>Lecture</option>
                                <option value='admin'>Admin</option>
                                <option value='finance'>Finance</option>
                            </select><br>
                            
                        </form>
                        <button onclick='add_new_staff_user()'>submit form</button>
                    </div>



                    <!-- The div to contain a form to remove a user -->
                    <div id='remove_employee' style='display:none;' >
                        <span>
                            <input type="text" id='remove_staff_user_details' placeholder='id number' name='' > <button style='width:50px;' onclick='remove_staff_user()'>search</button>
                        </span>

                        <div id='remove_employee_action'>
                        </div>
                    </div>


                    <!-- The div to contain a form to modify a user details-->
                    <div id='modify_employee_details' style='display:none;' >
                        <form action="">
                            <input type="text" placeholder='id number' name='' > <button style='width:50px;'>search</button>
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