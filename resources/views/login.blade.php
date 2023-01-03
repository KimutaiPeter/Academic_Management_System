<html>
    <head>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    </head>
    <body >
        <center style='margin-top:100px;'>

            <div class='container' style='width:500px;'>
                <div class='row'>
                    <span id='std_button' onclick='std_login_display()' class='col btn btn-success'>Students</span>
                    <span id='lec_button' onclick='lec_login_display()' class='col btn'>Staff</span>
                </div>


                <div>
                <fieldset id='std_login' style='margin-bottom:50px; width:60%'>
                <legend>Students login</legend>
                <div>
                    <form action="login_process" method='POST'>
                        @csrf
                        <input class='w-100' style='margin-top:10px;' name='email' type="email" placeholder='user_name'><br>
                        <input class='w-100' style='margin-top:10px;' name="password" type="password" placeholder='password'><br>
                        <button style='margin-top:10px;' class='btn w-100' type='submit'>login</button>
                    </form>
                </div>

                </fieldset>
                <fieldset id='lec_login' style='margin-bottom:200px; display:none;width:60%'>
                    <legend>Staff login</legend>
                    <div>
                        <form action="staff_login_process" method='POST'>
                            @csrf
                            <input class='w-100' style='margin-top:10px;' name='email' type="email" placeholder='user_name'><br>
                            <input class='w-100' style='margin-top:10px;' name="password" type="password" placeholder='password'><br>
                            <button style='margin-top:10px;' class='btn w-100' type='submit'>login</button>
                        </form>
                    </div>
                </fieldset>
                </div>
                
            </div>
            
        </center>
    </body>


    <script>
        function std_login_display(){
            std_login=document.getElementById('std_login');
            lec_login=document.getElementById('lec_login');
            std_login.style['display']=''
            lec_login.style['display']='none'

            std_login=document.getElementById('std_button');
            lec_login=document.getElementById('lec_button');
            std_login.className='col btn btn-success'
            lec_login.className='col btn'


        }

        function lec_login_display(){
            std_login=document.getElementById('std_login');
            lec_login=document.getElementById('lec_login');
            std_login.style['display']='none'
            lec_login.style['display']=''

            std_login=document.getElementById('std_button');
            lec_login=document.getElementById('lec_button');
            std_login.className='col btn'
            lec_login.className='col btn btn-success'


        }
    </script>
</html>