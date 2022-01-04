<script type="text/javascript" src="https://code.jquery.com/jquery-1.12.4.js"></script>
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
     <?= $vaccine['description'] ?>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class=""> <a href="<?=  base_url('Controller_Vaccine/') ?>"> Vaccines </a></li>
      <li class="active" ><?= $vaccine['description'] ?></li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">
      <div class="col-md-12 col-xs-12">

        <div id="messages"></div>

        <?php if($this->session->flashdata('success')): ?>
          <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <?php echo $this->session->flashdata('success'); ?>
          </div>
        <?php elseif($this->session->flashdata('error')): ?>
          <div class="alert alert-error alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <?php echo $this->session->flashdata('error'); ?>
          </div>
        <?php endif; ?>

        <?php //if(in_array('createGroup', $user_permission)): ?>
        <!--  <button class="btn btn-primary" data-toggle="modal" data-target="#addModal">Add Vaccine</button>-->
          <br /> <br />
        <?php //endif; ?>

        <div class="box">
         
          <!-- /.box-header -->
          <div class="box-body">
            <table id="vaccinesReceivedTable" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>Quantity</th>
                <th>Date Received</th>
                <th>Received By</th>
                <th>Expiration Date</th>
                <th>Action</th>
              </tr>
              </thead>

            </table>
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>
      <!-- col-md-12 -->
    </div>
    <!-- /.row -->
    

  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->




<!-- edit brand modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="editModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Edit Vaccine</h4>
      </div>

      <form role="form" action="<?php echo base_url('Controller_Vaccine/updateVaccinePerLocation') ?>" method="post" id="updateForm">

        <div class="modal-body">
          <div id="messages"></div>

          
          <div class="form-group">
            <label for="brand_name">Clinic</label>
            <input type="text" class="form-control" id="edit_clinic_name" name="edit_clinic_name" placeholder="Enter Clinic Name" autocomplete="off">
          </div>
          <div class="form-group">
            <label for="brand_name">Quantity</label>
            <input type="text" class="form-control" id="edit_quantity" name="edit_quantity" placeholder="Enter Quantity" autocomplete="off">
          </div>

          <div class="form-group">
            <label for="brand_name">Clinic Location</label>
            <input type="text" class="form-control" id="edit_clinic_location" name="edit_clinic_location" placeholder="Enter Clinic Location" autocomplete="off">
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
        <h4 class="modal-title">Remove Elements</h4>
      </div>

      <form role="form" action="<?php echo base_url('Controller_Element/remove') ?>" method="post" id="removeForm">
        <div class="modal-body">
          <p>Do you really want to remove?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-danger">Delete</button>
        </div>
      </form>


    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!--issue vaccine modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="issueVaccineModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="VaccineName"></h4>
      </div>

      <form role="form" action="" method="post" id="issueVaccineForm">
      
        <div class="modal-body">
        <div id="issue_vaccineIDContainer"></div>  
        <div id="issue_columnIDContainer"></div>
          <div class="form-group">
            <label for="brand_name">Clinic</label>
            <div id="clinicDropdownContainer"></div>
          </div>
          <div class="form-group">
            <label for="issue_quantity">Quantity</label>
            <input type="number" class="form-control"   oninput="validateNubmerInput(this.value, this.max, this.id)" id="issue_quantity" name="issue_quantity" placeholder="Enter Quantity" autocomplete="off">
          </div>  
          <div class="form-group">
            <label for="#issue_vaccine_remarks">Remarks</label>
            <input type="text" class="form-control" id="issue_vaccine_remarks" name="issue_vaccine_remarks" placeholder="Enter Remarks" autocomplete="off">
          </div>       
        </div>

        <div class="modal-footer">
          <button type="button" id="issueVaccineCloseBtn" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="button" onclick="processIssueVaccine()" class="btn btn-primary">Save changes</button>
        </div>

      </form>


    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!--dispose vaccine modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="disposeVaccineModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="DisposeVaccineName"></h4>
      </div>

      <form role="form" action="" method="post" id="disposeVaccineForm">
      
        <div class="modal-body">
        <div id="dispose_vaccineIDContainer"></div>  
        <div id="dispose_columnIDContainer"></div>
         
          <div class="form-group">
            <label for="issue_quantity">Quantity</label>
            <input type="number" class="form-control"   oninput="validateNubmerInput(this.value, this.max, this.id)" id="dispose_quantity" name="dispose_quantity" placeholder="Enter Quantity" autocomplete="off">
          </div>  
          <div class="form-group">
            <label for="#issue_vaccine_remarks">Remarks</label>
            <input type="text" class="form-control" id="dispose_vaccine_remarks" name="dispose_vaccine_remarks" placeholder="Enter Remarks" autocomplete="off">
          </div>       
        </div>

        <div class="modal-footer">
          <button type="button" id="disposeVaccineCloseBtn" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="button" onclick="processDisposeVaccine()" class="btn btn-primary">Save changes</button>
        </div>

      </form>


    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script type="text/javascript">
var manageTable;
var base_url = "<?php echo base_url(); ?>";
var vaccine_id = "<?= $this->uri->segment(3); ?> ";
$(document).ready(function() {
  console.log('vaccine id:'+vaccine_id);
  

  $("#vaccineNav").addClass('active');

  // initialize the datatable 
  manageTable = $('#vaccinesReceivedTable').DataTable({
  /*  dom: 'Bfrtip',
        buttons: [
            
                'copy', 'csv', 'excel', 'print'
        
            
        ], 
        exportOptions: {
            columns: 'th:not(:last-child)'
         },*/
    'ajax': base_url + 'Controller_Vaccine/fetch_received_vaccine/'+vaccine_id,
    'order': []
  });

  // submit the create from 
  $("#createForm").unbind('submit').on('submit', function() {
    var form = $(this);

    // remove the text-danger
    $(".text-danger").remove();

    $.ajax({
      url: form.attr('action'),
      type: form.attr('method'),
      data: form.serialize(), // /converting the form data into array and sending it to server
      dataType: 'json',
      success:function(response) {

        manageTable.ajax.reload(null, false); 

        if(response.success === true) {
          $("#messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
            '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
          '</div>');


          // hide the modal
          $("#addVaccinePerLocationCloseBtn").click();
          //$("#id").modal('hide')
          // reset the form
          $("#createForm")[0].reset();
          $("#createForm .form-group").removeClass('has-error').removeClass('has-success');

        } else {

          if(response.messages instanceof Object) {
            $.each(response.messages, function(index, value) {
              var id = $("#"+index);

              id.closest('.form-group')
              .removeClass('has-error')
              .removeClass('has-success')
              .addClass(value.length > 0 ? 'has-error' : 'has-success');
              
              id.after(value);

            });
          } else {
            $("#messages").html('<div class="alert alert-warning alert-dismissible" role="alert">'+
              '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
              '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>'+response.messages+
            '</div>');
          }
        }
      }
    }); 

    return false;
  });

});

function editFunctionNew(id){
  $.ajax({
    url: base_url+'Controller_Vaccine/fetchVaccineDataPerLocationById/'+id,
    success:function(response){
      // console.log();

    }
  })
}

// edit function
function editFunc2(id)
{ 
 
  $.ajax({
    url:  base_url+'Controller_Vaccine/fetchVaccineDataPerLocationById/'+id,
    type: 'post',
    dataType: 'json',
    success:function(response) {
    //  response = JSON.parse(response);
      console.log('xxx');
      console.log(response);
      $("#edit_clinic_name").val(response.location);
      $("#edit_quantity").val(response.quantity);
      $("#edit_clinic_location").val(response.address);

      // submit the edit from 
      $("#updateForm").unbind('submit').bind('submit', function() {
        var form = $(this);

        // remove the text-danger
        $(".text-danger").remove();

        $.ajax({
          url: form.attr('action') + '/' + id,
          type: form.attr('method'),
          data: form.serialize(), // /converting the form data into array and sending it to server
          dataType: 'json',
          success:function(response) {

            manageTable.ajax.reload(null, false); 

            if(response.success === true) {
              $("#messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
                '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
              '</div>');

              
              // hide the modal
              //hideModal2('editModal');
              $('#editVaccineCloseBtn').click();
              // reset the form 
              $("#updateForm .form-group").removeClass('has-error').removeClass('has-success');

            } else {

              if(response.messages instanceof Object) {
                $.each(response.messages, function(index, value) {
                  var id = $("#"+index);

                  id.closest('.form-group')
                  .removeClass('has-error')
                  .removeClass('has-success')
                  .addClass(value.length > 0 ? 'has-error' : 'has-success');
                  
                  id.after(value);

                });
              } else {
                $("#messages").html('<div class="alert alert-warning alert-dismissible" role="alert">'+
                  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                  '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>'+response.messages+
                '</div>');
              }
            }
          }
        }); 

        return false;
      });

    }
  }).fail(function( jqXHR, textStatus, errorThrown){
    console.log(errorThrown);
  });
}


var testModalShow = () => {
    $("#editModal").modal('show');
}

// remove functions 
function removeFunc(id)
{
  if(id) {
    $("#removeForm").on('submit', function() {

      var form = $(this);

      // remove the text-danger
      $(".text-danger").remove();

      $.ajax({
        url: form.attr('action'),
        type: form.attr('method'),
        data: { attribute_id:id }, 
        dataType: 'json',
        success:function(response) {

          manageTable.ajax.reload(null, false); 

          if(response.success === true) {
            $("#messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
              '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
              '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
            '</div>');

            // hide the modal
            $("#removeModal").modal('hide');

          } else {

            $("#messages").html('<div class="alert alert-warning alert-dismissible" role="alert">'+
              '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
              '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>'+response.messages+
            '</div>'); 
          }
        }
      }); 

      return false;
    });
  }
}



var initIssueVaccineModal = (vaccine_id, vaccine_name, max_qty, column_id) => {
  console.log(vaccine_id);
  $.ajax({
      url: base_url+'Controller_Vaccine/createDropdown/clinics',
      success: function(res){
        var parsedData = JSON.parse(res);
        $("#VaccineName").html('Issue ' +vaccine_name);
        $("#issue_quantity").attr({'max': max_qty, "placeholder": "Enter Quantity (Available : "+max_qty+")"});
        $("#clinicDropdownContainer").html(parsedData.data);
        $("#issue_vaccineIDContainer").html(`<input type='hidden' id='issue_vaccine_name' name='issue_vaccine_name' value = '`+vaccine_id+`'></input>`);
        $("#issue_columnIDContainer").html(`<input type='hidden' id='received_column_id' name='received_column_id' value = '`+column_id+`'></input>`);
      }
    })
}

var initDisposeVaccineModal = (vaccine_id, vaccine_name, max_qty, column_id) => {
  console.log(vaccine_name);
  $("#DisposeVaccineName").html('Dispose ' +vaccine_name);
  $("#dispose_quantity").attr({'max': max_qty, "placeholder": "Enter Quantity (Available : "+max_qty+")"});
  $("#dispose_vaccineIDContainer").html(`<input type='hidden' id='dispose_vaccine_name' name='dispose_vaccine_name' value = '`+vaccine_id+`'></input>`);
  $("#dispose_columnIDContainer").html(`<input type='hidden' id='received_column_id' name='received_column_id' value = '`+column_id+`'></input>`);
 
}



 

var processIssueVaccine = () => {
    console.log($("#issueVaccineForm").serialize());
    $.ajax({
      url: base_url+'Controller_Vaccine/proccessIssueVaccine',
      data: $("#issueVaccineForm").serialize(),
      type: "POST",
      dataType: 'json',
      success: function(res){
        if(res.response == 'success'){
          $("#issueVaccineCloseBtn").click();
          manageTable.ajax.reload(null, false); 
          $("#messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
              '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
              '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong> Vaccine was successfully issued!</div>');
        } else if (res.response == 'updateqtyfailed'){
          alert("Something went while updating the quantity, please call the IT Support for them to check the issue");
        } else {
          alert("Something went wrong, please refresh tha page");
        }
      }
    })
    
  }

  var processDisposeVaccine = () => {
    console.log($("#issueVaccineForm").serialize());
    $.ajax({
      url: base_url+'Controller_Vaccine/processDisposeVaccine',
      data: $("#disposeVaccineForm").serialize(),
      type: "POST",
      dataType: 'json',
      success: function(res){
        if(res.response == 'success'){
          $("#disposeVaccineCloseBtn").click();
          manageTable.ajax.reload(null, false); 
          $("#messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
              '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
              '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong> Vaccine was successfully issued!</div>');
        } else if (res.response == 'updateqtyfailed'){
          alert("Something went while updating the quantity, please call the IT Support for them to check the issue");
        } else {
          alert("Something went wrong, please refresh tha page");
        }
      }
    })
    
  }

var validateNubmerInput = (val, max, id) => {
  // if input is greater than max, then reset the value to max
    val = parseInt(val);
      max = parseInt(max);
      if(val > max){
        $("#"+id).val(max);
      } 
  }


</script>
<script type="text/javascript" src="//cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.flash.min.js"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.print.min.js"></script>
