<html>
   <head>
      <title>Select Model</title>
      <link href="style.css" rel="stylesheet" type="text/css">
   </head>
   <body>
      <div class="pageContainer">

         <h2 class="centerText">Select Model</h2>

         <form action="Order02.php" class="formLayout">
            <div class="formGroup">
               <label>First name:</label>
               <input type="text" name="fname" class="textbox" autofocus required  
                      placeholder="First name" title="first name" maxlength="20" pattern="[A-Za-z'-]{2,20}" />
            </div>
            <div class="formGroup">
               <label> Car model:</label>
               <div class="formElements">
                  <input type="radio" name="model" required value="Mustang">Ford Mustang<br>
                  <input type="radio" name="model" required value="Subaru">Subaru WRX STI<br>
                  <input type="radio" name="model" required value="Corvette">Corvette<br>
               </div>

            </div>
            <div class="formGroup">
               <label></label>
               <button type="submit"> >> Next >> </button>

            </div>
            <div class="centerText vertGap55">
                              <button type="submit" formnovalidate>Submit without validation</button>
                              <br><br>
            <a href="?">Reload page</a>            
            </div>


      </div>

   </form>

</div>
</body>
</html>