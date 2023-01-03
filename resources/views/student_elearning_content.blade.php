<html>
    <head>
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
                <a class="dropdown-item" href="/student_elearning_page">Elearning</a>
                <a class="dropdown-item" href="/">Home</a>
                <a class="dropdown-item" href="logout">Logout</a>
                </div>
            </div>

        </div>




        <center>
            

            <fieldset style='width:50%;'>
                <legend>Unit content</legend>

                <!-- No course content available on dispaly -->
                <div id='no_unit_content_display' style='display:none;'>
                    <h3>No content available</h3>
                    <h4>Uplaod new content using the button above</h4>
                </div>
                
                <!-- unit content -->
                <div id='unit_content_display' class="list-group" style='display:none;'></div>
            </fieldset>

        </center>







        <!-- Modal -->
        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Add new content</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action='upload_new_elearning_content' method='post' id='approved_form' method='POST' enctype='multipart/form-data'>
                    @csrf
                    <select name="type" id="">
                        <option value="notes">notes</option>
                        <option value="comment">comment</option>
                    </select><br>
                    <input type="text" name='comment' placeholder='comment'><br>
                    <input type="file" name="file" id='doc' placeholder='file'>
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
        unit_code='{{ $unit_code }}'


        window.onload=function (){
            get_unit_content();
        }


        function no_unit_content_display(){
            no_unit_content_display=document.getElementById('no_unit_content_display')
            unit_content_display=document.getElementById('unit_content_display')
            no_unit_content_display.style['display']=''
            unit_content_display.style['display']='none'
        }

        function unit_content_display(){
            no_unit_content_display=document.getElementById('no_unit_content_display')
            unit_content_display=document.getElementById('unit_content_display')
            no_unit_content_display.style['display']='none'
            unit_content_display.style['display']=''
        }


        //Upload new content
        function upload_new_content(){
            form = document.getElementById('approved_form')
            unit_code_input=document.createElement('input')
            unit_code_input.name='unit_code'
            unit_code_input.style['display']='none'
            unit_code_input.value=unit_code
            form.appendChild(unit_code_input)
            fetch('upload_new_elearning_content', {
                method: 'POST',
                body: new FormData(form)
            })
            .then((response) => response.json())
            .then((data) => {
                console.log('Responce success:', data);
                if(data['message']==='success'){
                    alert('Successfully posted')
                    get_unit_content();
                }
            })
            .catch(function (error) {
                console.log("fatal error");
            });
        }


        function get_unit_content(){
            const data = { 'unit_code' : unit_code ,'king':45};
            fetch('/lec_get_unit_content', {
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
                if(data['count']===0){
                    no_unit_content_display()
                }else{
                    unit_content_display()
                    content_display(data['data'])
                    console.log('Hello Hi')
                }
                
            })
            .catch(function (error) {
                console.log("hello");
            });
        }


        function content_display(unit_content){
            unit_content_display=document.getElementById('unit_content_display')
            unit_content_display.innerHTML=""
            unit_content.forEach(function (content){
                content_container=document.createElement('a')
                content_container.className='list-group-item'
                file_name=document.createElement('h6')
                comment=document.createElement('p')
                actions_section=document.createElement('span')
                file_name.textContent=content['normal_file_name']
                comment.textContent=content['comment']
                actions_section.innerHTML='<a><button class="btn btn-success">Open</button></a>'
                content_container.appendChild(file_name)
                content_container.appendChild(comment)
                content_container.appendChild(actions_section)
                unit_content_display.appendChild(content_container)
            });


        }
    </script>
</html>