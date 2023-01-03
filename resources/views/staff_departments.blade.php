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
    </head>
    <body>
    <div class="row bg-dark">
            <div class="col">
                <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Back
                </button>
                <div class="dropdown-menu float-right" >
                <a class="dropdown-item" href="/">Landing page</a>
                <a class="dropdown-item" href="/logout">Logout</a>
                </div>
            </div>

        </div>


        <center style='margin_top:30px;'>
            <fieldset class='deps' >
                <legend>Departments</legend>
                <div style='margin-top:30px;'>
                    <a href="lec_home_page"><Button class='btn' >Lectururs</Button></a><br>
                    <a href=""><Button class='btn'>Finance</Button></a><br>
                    <a href='/hr_home_page'><Button class='btn'>Human resources</Button></a><br>
                    <a href="/admin_home_page"><Button class='btn'>Admin</Button></a><br>
                </div>
            </fieldset>
            <hr>
            <fieldset class='container'>
                <legend><h5>Anouncement</h5></legend>
                <div class='container w-50'>
                    <h3>Ohh no!!</h3>
                    <h6>No anouncement at this time</h6>
                </div>
            </fieldset>
        </center>

    </body>
</html>