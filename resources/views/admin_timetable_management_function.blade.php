<html>
    <head>
        <title>School time table</title>
        
    </head>
    <body>
        <center>
            <fieldset style='width:30%;'>
                <legend>Choose a group</legend>
                <div>
                    <select name="" id="semester_id" onchange='get_semester_table_data()'>
                        <optgroup label='Year 1'>
                            <option value="1.1">Semester 1</option>
                            <option value="1.2">Semester 2</option>
                        </optgroup>
                        <optgroup label='Year 2'>
                            <option value="2.1">Semester 1</option>
                            <option value="2.2">Semester 2</option>
                        </optgroup>
                        <optgroup label='Year 3'>
                            <option value="3.1">Semester 1</option>
                            <option value="3.2">Semester 2</option>
                        </optgroup>
                        <optgroup label='Year 4'>
                            <option value="4.1">Semester 1</option>
                            <option value="4.2">Semester 2</option>
                        </optgroup>
                    </select>
                </div>
            </fieldset>
        </center>




        <center>
            <fieldset style='width:50px;'>
                <legend>Timetable</legend>
                <div id='table_container'>
                    
                </div>
            </fieldset>
        </center>
    </body>

    <script>
        function get_semester_table_data(){
            semester_group=document.getElementById('semester_id')
            console.log(semester_group.value.split('.'));

            //Fetch the units being tought at that semester and the lecturuer teaching that semester , filter unique
            const data = { 'year' : semester_group.value.split('.')[0],'semester':semester_group.value.split('.')[1] };
            fetch('/get_semester_table_data', {
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
                if(data['message']==='new_entry'){
                    create_new_time_table_entry(data['unit_data'])
                }else if(data['message']==='data_entry'){
                    display_table_entries(data['timetable_data'],data['unit_data'])
                }
                
            })
            .catch(function (error) {
                alert('Error, try again later');
                console.log("hello");
            });
        }


        window.onload=function () {get_semester_table_data()}


        //Fetch the table data 
        //If the table data is empty a new entry 
        function create_new_time_table_entry(units){
            table_container=document.getElementById('table_container')
            table_container.innerHTML=""

            table=document.createElement('table')
            header_row=document.createElement('tr')
            day_header=document.createElement('th')
            day_header.textContent='Day'
            start_time_header=document.createElement('th')
            start_time_header.textContent='Start'
            end_time_header=document.createElement('th')
            end_time_header.textContent='End'
            unit_header=document.createElement('th')
            unit_header.textContent='Unit-lecturer'
            
            
            header_row.appendChild(day_header)
            header_row.appendChild(start_time_header)
            header_row.appendChild(end_time_header)
            header_row.appendChild(unit_header)
            table.appendChild(header_row)
            

            entry_input_row=document.createElement('tr')
            day_entry=document.createElement('td')
            //The day entry cell
            days=['Monday','Teusday','Wednesday',"Tursday",'Friday',"Satarday"]
            day_input=document.createElement('select')
            day_input.name='day'
            day_input.id='day_input'
            days.forEach(function(day){
                option=document.createElement('option')
                option.value=day
                option.textContent=day
                day_input.appendChild(option)
            })
            day_entry.appendChild(day_input)

            start_time_entry=document.createElement('td')
            start_time_input=document.createElement('input')
            start_time_input.type='time'
            start_time_input.id='start_time_input'
            start_time_entry.appendChild(start_time_input)

            end_time_entry=document.createElement('td')
            end_time_input=document.createElement('input')
            end_time_input.type='time'
            end_time_input.id='end_time_input'
            end_time_entry.appendChild(end_time_input)

            //The unit entry cell
            unit_entry=document.createElement('td')
            //units=['Monday','Teusday','Wednesday',"Tursday",'Friday',"Satarday"]
            unit_input=document.createElement('select')
            unit_input.id='unit_input'
            unit_input.name='unit'
            units.forEach(function(unit){
                option=document.createElement('option')
                option.value=unit['unit_code']
                option.textContent=unit['name']+"-"+unit['lecturer']
                unit_input.appendChild(option)
            })
            unit_entry.appendChild(unit_input)

            //Cell containing the add button,
            //The button should also call the add fetch funtion
            add_action_cell=document.createElement('td')
            add_button=document.createElement('button')
            add_button.textContent='Add'
            add_button.onclick=function() {
                add_new_timetable_data();
            }
            add_action_cell.appendChild(add_button)

            entry_input_row.appendChild(day_entry)
            entry_input_row.appendChild(start_time_entry)
            entry_input_row.appendChild(end_time_entry)
            entry_input_row.appendChild(unit_entry)
            entry_input_row.appendChild(add_action_cell)
            table.appendChild(entry_input_row)
            
            table_container.appendChild(table)

        }


        function display_table_entries(timetable_entries,units){
            table_container=document.getElementById('table_container')
            table_container.innerHTML=""

            table=document.createElement('table')

            //The header
            header_row=document.createElement('tr')
            day_header=document.createElement('th')
            day_header.textContent='Day'
            start_time_header=document.createElement('th')
            start_time_header.textContent='Start'
            end_time_header=document.createElement('th')
            end_time_header.textContent='End'
            unit_header=document.createElement('th')
            unit_header.textContent='Unit-lecturer'
            //Adding all the cells
            header_row.appendChild(day_header)
            header_row.appendChild(start_time_header)
            header_row.appendChild(end_time_header)
            header_row.appendChild(unit_header)
            table.appendChild(header_row)


            //Timetable entries
            /*
            timetable_entries=[
                {day:"Wednesday",start_time:'12:00',end_time:'12:00',unit_name:"one_two_three",unit_lecturer:"one lecturer"},
                {day:"Tuesday",start_time:'12:00',end_time:'12:00',unit_name:"one_two_three",unit_lecturer:"two lecturer"}
            ]
            */
            timetable_entries.forEach(function(entry){
                //The entry rows
                entry_row=document.createElement('tr')
                //Day cell
                day_cell=document.createElement('td')
                //The day entry cell
                days=[entry['day'],'Monday','Teusday','Wednesday',"Tursday",'Friday',"Satarday"]
                day_input=document.createElement('select')
                day_input.name='day'
                //day_input.id='day_input'//The id here is used to update the detail in the database
                days.forEach(function(day){
                    option=document.createElement('option')
                    option.value=day
                    option.textContent=day
                    day_input.appendChild(option)
                })
                day_cell.appendChild(day_input)
                //Start time cell
                start_time_cell=document.createElement('td')
                start_time_input=document.createElement('input')
                start_time_input.type='time'
                start_time_input.value=entry['start_time']
                //start_time_input.id='start_time_input'
                start_time_cell.appendChild(start_time_input)
                //End time cell
                end_time_cell=document.createElement('td')
                end_time_input=document.createElement('input')
                end_time_input.type='time'
                //end_time_input.id='end_time_input'
                end_time_input.value=entry['end_time']
                end_time_cell.appendChild(end_time_input)
                //Unit cell
                unit_cell=document.createElement('td')
                unit_cell.textContent=entry['unit_code']+'-'+entry['lecturer']
                //The update action cell
                update_action_cell=document.createElement('td')
                update_button=document.createElement('button')
                update_button.textContent='Update'
                update_button.onclick=function(){console.log("Updatae")}
                update_action_cell.appendChild(update_button)
                //The delete action cell
                delete_action_cell=document.createElement('td')
                delete_button=document.createElement('button')
                delete_button.textContent='Delete'
                delete_button.onclick=function(){console.log("Delete")}
                delete_action_cell.appendChild(delete_button)
                //Adding all the cells
                entry_row.appendChild(day_cell)
                entry_row.appendChild(start_time_cell)
                entry_row.appendChild(end_time_cell)
                entry_row.appendChild(unit_cell)
                entry_row.appendChild(update_action_cell)
                entry_row.appendChild(delete_action_cell)
                table.appendChild(entry_row)
            });



            

            //The input row
            entry_input_row=document.createElement('tr')
            day_entry=document.createElement('td')
            //The day entry cell
            days=['Monday','Teusday','Wednesday',"Tursday",'Friday',"Satarday"]
            day_input=document.createElement('select')
            day_input.name='day'
            day_input.id='day_input'
            days.forEach(function(day){
                option=document.createElement('option')
                option.value=day
                option.textContent=day
                day_input.appendChild(option)
            })
            day_entry.appendChild(day_input)
            //Start Time entry
            start_time_entry=document.createElement('td')
            start_time_input=document.createElement('input')
            start_time_input.type='time'
            start_time_input.id='start_time_input'
            start_time_entry.appendChild(start_time_input)
            //End time entry cell
            end_time_entry=document.createElement('td')
            end_time_input=document.createElement('input')
            end_time_input.type='time'
            end_time_input.id='end_time_input'
            end_time_entry.appendChild(end_time_input)
            //The unit entry cell
            unit_entry=document.createElement('td')
            //units=['Monday','Teusday','Wednesday',"Tursday",'Friday',"Satarday"]
            unit_input=document.createElement('select')
            unit_input.id='unit_input'
            unit_input.name='unit'
            units.forEach(function(unit){
                option=document.createElement('option')
                option.value=unit['unit_code']
                option.textContent=unit['name']+"-"+unit['lecturer']
                unit_input.appendChild(option)
            })
            unit_entry.appendChild(unit_input)
            //Cell containing the add button,
            //The button should also call the add fetch funtion
            add_action_cell=document.createElement('td')
            add_button=document.createElement('button')
            add_button.textContent='Add'
            add_button.onclick=function() {
                add_new_timetable_data();
            }
            add_action_cell.appendChild(add_button)
            //Adding all its cells
            entry_input_row.appendChild(day_entry)
            entry_input_row.appendChild(start_time_entry)
            entry_input_row.appendChild(end_time_entry)
            entry_input_row.appendChild(unit_entry)
            entry_input_row.appendChild(add_action_cell)
            table.appendChild(entry_input_row)

            
            table_container.appendChild(table)

        }










        function add_new_timetable_data(){
            console.log('add new time table data')
            year_semester=document.getElementById('semester_id').value.split(".")
            day_input=document.getElementById('day_input').value
            start_time_input=document.getElementById('start_time_input').value
            end_time_input=document.getElementById('end_time_input').value
            unit_input=document.getElementById('unit_input').value
            console.log(year_semester,day_input,start_time_input,end_time_input,unit_input)
            //Fetch the units being tought at that semester and the lecturuer teaching that semester , filter unique
            const data = { 'year':year_semester[0],'semester':year_semester[1],'day':day_input,'start_time':start_time_input,'end_time':end_time_input,'unit_code':unit_input };
            console.log(data);
            fetch('/add_new_timetable_data', {
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
                if(data['message']==='added'){
                    get_semester_table_data();
                }
                
            })
            .catch(function (error) {
                alert('Error, try again later');
                console.log("hello");
            });

            
        }
    </script>
</html>