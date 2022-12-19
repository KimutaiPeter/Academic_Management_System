<html>
    <head>

    </head>
    <body>
        <center style='margin-top:100px;'>
            <fieldset style='margin-bottom:50px; width:30%'>
                <legend>Students login</legend>
                <div>
                    <form action="login_process" method='POST'>
                        @csrf
                        <input style='margin-top:10px;' name='email' type="email" placeholder='user_name'><br>
                        <input style='margin-top:10px;' name="password" type="password" placeholder='password'><br>
                        <button type='submit'>login</button>
                    </form>
                </div>
            </fieldset>
            <fieldset style='margin-bottom:200px; width:30%'>
                <legend>Staff login</legend>
                <div>
                    <form action="staff_login_process" method='POST'>
                        @csrf
                        <input style='margin-top:10px;' name='email' type="email" placeholder='user_name'><br>
                        <input style='margin-top:10px;' name="password" type="password" placeholder='password'><br>
                        <button type='submit'>login</button>
                    </form>
                </div>
            </fieldset>
        </center>
    </body>
</html>