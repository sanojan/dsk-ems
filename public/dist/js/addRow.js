/*function myFunction() {
    var table = document.getElementById("dependant_table");
    var row = table.insertRow(-1);
    var cell1 = row.insertCell(0);
    var cell2 = row.insertCell(1);
    var cell3 = row.insertCell(2);
    var cell4 = row.insertCell(3);
    var cell5 = row.insertCell(4);
    var cell6 = row.insertCell(5);
    cell1.innerText = "<input class='form-control' name='d_firstname[]' type='text' value=''>";
    cell2.innerHTML = "<input class='form-control' name='d_lastname[]' type='text' value=''>";
    cell3.innerHTML = "<input name='d_dob[]' type='date' value=''>";
    cell4.innerHTML = "<select class='form-control' name='d_relationship[]'><option value='Father'>Father</option><option value='Mother'>Mother</option><option value='Husband'>Husband</option><option value='Wife'>Wife</option><option value='Son' selected='selected'>Son</option><option value='Daughter'>Daughter</option></select>";
    cell5.innerHTML = "<input class='form-control' name='d_designation[]' type='text' value=''>";
    cell6.innerHTML = "<input class='form-control' name='d_workplace[]' type='text' value=''>";
  }
  */


  $('#addRow').on('click', function(){   
      addRow();
  });

function addRow(){
  var tr = "<tr>"+
  "<td>"+
      "<input class='form-control' name='d_firstname[]' type='text' value=''></td>"+
  "<td>"+
      "<input class='form-control' name='d_lastname[]' type='text' value=''></td>"+
  "<td>"+
      "<input name='d_dob[]' type='date' value=''></td>"+
  "<td>"+
      "<select class='form-control' name='d_relationship[]'><option value='Father'>Father</option><option value='Mother'>Mother</option><option value='Husband'>Husband</option><option value='Wife'>Wife</option><option value='Son' selected='selected'>Son</option><option value='Daughter'>Daughter</option></select></td>"+
  "<td>"+
"<input class='form-control' name='d_designation[]' type='text' value=''></td>"+
  "<td><input class='form-control' name='d_workplace[]' type='text' value=''></td>"+
"</tr>";
  
$('#dependant_table').append(tr);


}