    var counter = 1;
    var limit = 4;

    function addInput(divName){

         if (counter == limit)  {

              alert("You have reached the limit of adding " + counter + " inputs");
         }
         else {

              var newdiv = document.createElement('div');
                  newdiv.setAttribute("id", "pickme"+counter);


              newdiv.innerHTML = "<b>Nama</b> "  + " <br><input type='text' class='form-control' name='myInputs[]'>" +"<label class='custom-file'><br>" +
                                  "<input type='file'  class='custom-file-input' 'required'>" + "<span class='custom-file-control'></span></label><br><br>" +
                                   "<input type='button' value='delete' onClick= " + "removeDiv('pickme" + counter + "');>";
              document.getElementById(divName).appendChild(newdiv);

              counter++;
         }
    }


    function removeDiv(divId) {

       $("#"+divId).remove();
       limit++;

    }