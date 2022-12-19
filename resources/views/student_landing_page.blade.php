<html>
    <head>
        <title></title>
        <style>

        </style>
    </head>
    <body>
        <center>
            <div>
                <a href="logout"><button>Logout</button></a>
            </div>
        </center>



        <center>
            <div>
                <h3>Stages</h3>
                complete the following stages to enroll
                <div>
                    <fieldset style='width:50%;'>
                        <ol>
                            <option value="">Complete profile</option>
                            <option value="">Upload documents</option>
                            <option value="">Choose a course</option>
                        </ol>
                    </fieldset>
                </div>
            </div>
        </center>



        <center>
            <div style='margin_top:30px;'>
                <h2>Profile</h2>
                <form action="" id='sign_up_form'>
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
                </form>
                <button onclick='sign_up_submit()'>Update</button>
            </div>
        </center>


        <center>
            <div style='margin_top:30px;'>
                <h2>Uploaded documents</h2>
                    <fieldset style='width:50%;'>
                        <legend>Uploaded documents</legend>
                        <ul>
                            @foreach($docs as $doc)
                                <li> 
                                    <span>{{ $doc->normal_file_name}}
                                    <form action="open_file">
                                        <input name='file_name' value='{{ $doc->file_name }}' type="text" style='display:none;'> 
                                        <button>Open</button>
                                    </form>
                                    </span>
                                </li>
                            @endforeach
                        </ul>
                    </fieldset>
                    <fieldset style='width:50%;'>
                        <legend>Upload</legend>
                        <form action="/upload_student_document" method='POST' enctype='multipart/form-data'>
                            @csrf
                            <input name='file' type="file" placeholder='file'>
                            <select name="type" id="">
                                <option value="birth_certificate">Birth certificate</option>
                                <option value="KCSE results slip">Results slip</option>
                            </select>
                            <button type='submit' >Upload</button>
                        </form>
                    </fieldset>
                
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