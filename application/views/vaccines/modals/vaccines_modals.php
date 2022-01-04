

<!-- create brand modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="addModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Add Vaccines</h4>
      </div>

      <form role="form" action="<?php echo base_url('Controller_Vaccine/create') ?>" method="post" id="createForm">

        <div class="modal-body">

          <div class="form-group">
            <label for="brand_name">Vaccine Name</label>
            <input type="text" class="form-control" id="vaccine_name" name="vaccine_name" placeholder="Enter Vaccine Name" autocomplete="off">
          </div>
         
          <div class="form-group">
            <label for="brand_name">Vaccine Description</label>
            <input type="text" class="form-control" id="vaccine_description" name="vaccine_description" placeholder="Enter Vaccine Description" autocomplete="off">
          </div>

       

          <div class="form-group">
            <label for="brand_name">Remarks</label>
            <input type="text" class="form-control" id="vaccine_remarks" name="vaccine_remarks" placeholder="Enter Remarks" autocomplete="off">
          </div>

         
        </div>

        <div class="modal-footer">
          <button type="button" id="addVaccineCloseBtn" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>

      </form>


    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- edit brand modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="editModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Edit Vaccine</h4>
      </div>

      <form role="form" action="<?php echo base_url('Controller_Vaccine/update') ?>" method="post" id="updateForm">

        <div class="modal-body">
          <div id="messages"></div>

          <div class="form-group">
            <label for="edit_brand_name">Vaccine Name</label>
            <input type="text" class="form-control" id="edit_vaccine_name" name="edit_vaccine_name" placeholder="Enter vaccine name" autocomplete="off">
          </div>

          <div class="form-group">
            <label for="brand_name">Vaccine Description</label>
            <input type="text" class="form-control" id="edit_vaccine_description" name="edit_vaccine_description" placeholder="Enter Vaccine Description" autocomplete="off">
          </div>

          <div class="form-group">
            <label for="brand_name">Remarks</label>
            <input type="text" class="form-control" id="edit_vaccine_remarks" name="edit_vaccine_remarks" placeholder="Enter Remarks" autocomplete="off">
          </div>
          
        </div>

        <div class="modal-footer">
          <button type="button" id="editVaccineCloseBtn" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>

      </form>


    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- remove brand modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="removeModal">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Remove Vaccine</h4>
      </div>

      <form role="form" action="<?php echo base_url('Controller_Vaccine/remove') ?>" method="post" id="removeForm">
        <div class="modal-body">
          <p>Do you really want to remove?</p>
        </div>
        <div class="modal-footer">
          <button type="button" id="removeVaccineCloseBtn" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-danger">Delete</button>
        </div>
      </form>


    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<!-- receive modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="receiveModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="receiveVaccineModalTitle">Receive Vaccine</h4>
      </div>

      <form role="form" action="<?php echo base_url('Controller_Vaccine/receive') ?>" method="post" id="receiveForm">

        <div class="modal-body">
          <div id="messages"></div>
          <div id="receive_vaccineIDContainer"></div>  
          
          <div class="form-group">
            <label for="brand_name">Quantity</label>
            <input type="number" class="form-control" id="receive_vaccine_quantity" name="receive_vaccine_quantity" placeholder="Enter Quantity" autocomplete="off">
          </div>

          <div class="form-group">
            <label for="brand_name">Expiration Date</label>
            <input type="date" class="form-control" id="rec_vaccine_exp_date" name="rec_vaccine_exp_date" placeholder="Enter Expiration Date" autocomplete="off">
          </div>

          <div class="form-group">
            <label for="#receive_vaccine_remarks">Remarks</label>
            <input type="text" class="form-control" id="receive_vaccine_remarks" name="receive_vaccine_remarks" placeholder="Enter Remarks" autocomplete="off">
          </div>
         
          
        </div>

        <div class="modal-footer">
          <button type="button" id="receiveVaccineCloseBtn" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="button" onclick="receiveVaccine()" class="btn btn-primary">Receive Vaccine</button>
        </div>

      </form>


    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->



