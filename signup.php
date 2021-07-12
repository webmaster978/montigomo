 <?php
  $customer = new customer;
  $res = $customer->single_customer($_SESSION['CUSID']);

  ?>
 <h3>Votre compte</h3>
 <form class="form-horizontal span6" action="customer/controller.php?action=edit" onsubmit="return personalInfo();"
     name="personal" method="POST" enctype="multipart/form-data">
     <div class="row">
         <div class="col-lg-6">
             <div class="form-group">
                 <div class="col-md-12">
                     <label class="col-md-4 control-label" for="FNAME">Nom :</label>
                     <div class="col-md-8">
                         <input class="form-control input-sm" id="FNAME" name="FNAME" placeholder="Nom " type="text"
                             value="<?php echo $res->FNAME; ?>">
                     </div>
                 </div>
             </div>
         </div>

         <div class="col-lg-6">
             <div class="form-group">
                 <div class="col-md-12">
                     <label class="col-md-4 control-label" for="LNAME">Post-Nom :</label>

                     <div class="col-md-8">
                         <input class="form-control input-sm" id="LNAME" name="LNAME" placeholder="Post nom" type="text"
                             value="<?php echo $res->LNAME; ?>">
                     </div>
                 </div>
             </div>
         </div>


         <div class="col-lg-6">

             <div class="form-group">
                 <div class="col-md-12">
                     <label class="col-md-4 control-label" for="CITYADD">Ville :</label>

                     <div class="col-md-8">
                         <input class="form-control input-sm" id="CITYADD" name="CITYADD" placeholder="Ville"
                             type="text" value="<?php echo $res->CITYADD; ?>">
                     </div>
                 </div>
             </div>

         </div>





         <div class="col-lg-6">
             <div class="form-group">
                 <div class="col-md-12">
                     <label class="col-md-4 control-label" for="PHONE">Contact#:</label>

                     <div class="col-md-8">
                         <input class="form-control input-sm" id="PHONE" name="PHONE" placeholder="Contact" type="text"
                             value="<?php echo $res->PHONE; ?>">
                     </div>
                 </div>
             </div>
         </div>

         <div class="col-lg-6">
             <div class="form-group">
                 <div class="col-md-12">
                     <label class="col-md-4 control-label" for="CUSUNAME">Nom d'utilisateur:</label>

                     <div class="col-md-8">
                         <input class="form-control input-sm" id="CUSUNAME" name="CUSUNAME" placeholder="Username"
                             type="text" value="<?php echo $res->CUSUNAME; ?>">
                     </div>
                 </div>
             </div>
         </div>
         <div class="col-lg-6">
             <div class="form-group">
                 <div class="col-md-12">
                     <label class="col-md-4 control-label" for="GENDER">Genre:</label>

                     <div class="col-lg-8">
                         <input id="GENDER" name="GENDER" type="radio"
                             <?php echo ($res->GENDER == 'Male') ? 'CHECKED' : '';  ?> value="Male" /><b> Homme </b>
                         <input id="GENDER" name="GENDER" type="radio"
                             <?php echo ($res->GENDER == 'Female') ? 'CHECKED' : ''; ?> value="Female" /> <b> Femme
                         </b>
                     </div>
                 </div>
             </div>
         </div>

     </div>



     <div class="col-lg-6">
         <div class="form-group">
             <div class="col-md-12">
                 <label class="col-md-4" align="right" for="btn"></label>
                 <div class="col-md-8">
                     <input type="submit" name="save" value="Enregistrer" class="submit btn btn-primary btn-lg" />

                 </div>
             </div>
         </div>
     </div>
 </form>

























 </form>