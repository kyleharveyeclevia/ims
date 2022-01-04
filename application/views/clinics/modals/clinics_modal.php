

<!-- create brand modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="addModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Add Clinic</h4>
      </div>

      <form role="form" action="<?php echo base_url('Controller_Clinics/create') ?>" method="post" id="createForm">

        <div class="modal-body">

          <div class="form-group">
            <label for="brand_name">Clinic Name</label>
            <input type="text" class="form-control" id="clinic_name" name="clinic_name" placeholder="Enter clinic name" autocomplete="off">
          </div>

          <div class="form-group">
            <label for="brand_name">Clinic Address</label>
            <input type="text" class="form-control" id="clinic_address" name="clinic_address" placeholder="Enter clinic address" autocomplete="off">
          </div>

        </div>

        <div class="modal-footer">
          <button type="button" id="addClinicCloseBtn" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>

      </form>


    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- edit clinic modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="editModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Edit Element</h4>
      </div>

      <form role="form" action="<?php echo base_url('Controller_Clinics/update') ?>" method="post" id="updateForm">

        <div class="modal-body">
          <div id="messages"></div>

          <div class="form-group">
            <label for="brand_name">Clinic Name</label>
            <input type="text" class="form-control" id="edit_clinic_name" name="edit_clinic_name" placeholder="Enter clinic name" autocomplete="off">
          </div>

          <div class="form-group">
            <label for="brand_name">Clinic Address</label>
            <input type="text" class="form-control" id="edit_clinic_address" name="edit_clinic_address" placeholder="Enter clinic address" autocomplete="off">
          </div>

        </div>

        <div class="modal-footer">
          <button type="button" id="updateClinicCloseBtn" class="btn btn-default" data-dismiss="modal">Close</button>
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
        <h4 class="modal-title">Remove Clinic</h4>
      </div>

      <form role="form" action="<?php echo base_url('Controller_Clinics/remove') ?>" method="post" id="removeForm">
        <div class="modal-body">
          <p>Do you really want to remove?</p>
        </div>
        <div class="modal-footer">
          <button type="button" id="removeClinicCloseBtn" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-danger">Delete</button>
        </div>
      </form>


    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->