<?php
if (!isset($_SESSION['USERID'])) {
  redirect(web_root . "index.php");
}

// $autonum = New Autonumber();
// $result = $autonum->single_autonumber(4);

?>
<form class="form-horizontal span6" action="controller.php?action=add" method="POST" enctype="multipart/form-data">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Ajouter nouveau produit</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>

    <div class="form-group">
        <div class="col-md-8">
            <label class="col-md-4 control-label" for="OWNERNAME">nom:</label>

            <div class="col-md-8">
                <input class="form-control input-sm" id="OWNERNAME" name="OWNERNAME" placeholder="nom du produit"
                    type="text" value="">
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="col-md-8">
            <label class="col-md-4 control-label" for="OWNERPHONE">numero:</label>

            <div class="col-md-8">
                <input class="form-control input-sm" id="OWNERPHONE" name="OWNERPHONE" placeholder="numero"
                    type="number" value="">
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="col-md-8">
            <label class="col-md-4 control-label" for="PRODESC">Description:</label>

            <div class="col-md-8">
                <textarea class="form-control input-sm" id="PRODESC" name="PRODESC" cols="1" rows="3"></textarea>
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="col-md-8">
            <label class="col-md-4 control-label" for="CATEGORY">Categorie:</label>

            <div class="col-md-8">
                <select class="form-control input-sm" name="CATEGORY" id="CATEGORY">
                    <option value="None">Selectectionner une categorie</option>
                    <?php
          //Statement
          $mydb->setQuery("SELECT * FROM `tblcategory` ORDER BY CATEGORIES ASC");
          $cur = $mydb->loadResultList();

          foreach ($cur as $result) {
            echo  '<option value=' . $result->CATEGID . ' >' . $result->CATEGORIES . '</option>';
          }
          ?>

                </select>
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="col-md-8">
            <label class="col-md-4 control-label" for="ORIGINALPRICE">Prix original:</label>

            <div class="col-md-3">
                <input class="form-control input-sm" id="ORIGINALPRICE" name="ORIGINALPRICE"
                    placeholder="Prix originale" type="number" value="" step="any">
            </div>
            <label class="col-md-2 control-label" for="PROPRICE">Prix:</label>

            <div class="col-md-3">
                <input class="form-control input-sm" id="PROPRICE" step="any" name="PROPRICE" placeholder="$ Prix "
                    type="number" value="">
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="col-md-8">
            <label class="col-md-4 control-label" for="PROQTY">Quantite:</label>

            <div class="col-md-8">
                <input class="form-control input-sm" id="PROQTY" name="PROQTY" placeholder="Quantity" type="number"
                    value="">
            </div>

        </div>
    </div>


    <div class="form-group">
        <div class="col-md-8">
            <label class="col-md-4" align="right" for="image">Telrcharger une image:</label>

            <div class="col-md-8">
                <input type="file" name="image" value="" id="image" />
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="col-md-8">
            <label class="col-md-4 control-label" for="idno"></label>

            <div class="col-md-8">
                <button class="btn  btn-primary btn-sm" name="save" type="submit"><span class="fa fa-save fw-fa"></span>
                    Enregistrer</button>
            </div>
        </div>
    </div>


    <div class="form-group">
        <div class="rows">
            <div class="col-md-6">
                <label class="col-md-6 control-label" for="otherperson"></label>

                <div class="col-md-6">

                </div>
            </div>

            <div class="col-md-6" align="right">


            </div>

        </div>
    </div>

</form>