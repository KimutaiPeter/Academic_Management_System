<html>
    <head>
        <title></title>
        <style>

        </style>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

        <!-- Latest compiled JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
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
                <a class="dropdown-item" href="logout">Logout</a>
                </div>
            </div>
        </div>



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