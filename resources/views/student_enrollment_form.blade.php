<html>
    <head>
        <title></title>
        <style>

        </style>
    </head>
    <body>
        <center>
            <div style='margin_top:30px;'>
                <h2>Enroll now!!!</h2>
                <form action="/regestration_process" method='POST' id='sign_up_form'>
                    @csrf
                    <fieldset style='width:50%;'>
                    <legend>Identification</legend>
                        <input name='fname' type="text" placeholder='First name'><br>
                        <input name='lname' type="text" placeholder='Last Name'><br>
                        <select name="nationality" id="">
                            <option value="kenya">Kenyan</option>
                        </select><br>
                        <select name="religion" id="">
                            <option value="christian">Christian</option>
                        </select><br>
                    </fieldset>
                    <fieldset style='width:50%;'>
                        <legend>Course prefered</legend>
                        <select name="courses" id="">
                            <option value="ICS">Computer Science</option>
                        </select><br>
                    </fieldset>
                    <fieldset style='width:50%;'>
                        <legend>Account credentials</legend>
                        <input name='email' type="email" placeholder='Email'><br>
                        <input id='p1' type="password" name='password' placeholder="Password"><br>
                        <input id='p2' type="password" name='confirm_password' placeholder="confirm_password"><br>
                    </fieldset>

                    <fieldset style='width:50%;'>
                        <legend>Contact</legend>
                        <input name='phone' type="text" placeholder='Phone Number'>
                    </fieldset>
                </form>
                <button onclick='sign_up_submit()'>submit</button>
            </div>
        </center>
    </body>


    <script>
        function sign_up_submit(){
            form=document.getElementById('sign_up_form');
            if(check_password()){
                form.submit();
            }
        }

        function check_password(){
            a=document.getElementById('p1');
            b=document.getElementById('p2');
            if(a.value===b.value){
                return true;
            }else{
                alert('Passwords miss-match');
                return false;
            }
        }
    </script>
</html>