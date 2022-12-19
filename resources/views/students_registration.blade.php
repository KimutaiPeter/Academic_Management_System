<html>
    <head>
        <title></title>
        <style>
            #sign_up_form input{
                margin-bottom:5px;
            }
        </style>
    </head>
    <body>
        <center>
            <div>
                <h2>Choose a user name and password</h2>
                <form method='POST' action="" id="sign_up_form">
                    @csrf
                    <input id='u' type="email" name='email' required=true placeholder="email"><br>
                    <input id='p1' type="password" name='password' placeholder="Password"><br>
                    <input id='p2' type="password" name='confirm_password' placeholder="confirm_password"><br>
                </form>
                <button onclick='sign_up_submit()' >Sign up</button>
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