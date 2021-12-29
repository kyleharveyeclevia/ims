<script type="text/javascript" src="https://code.jquery.com/jquery-1.12.4.js"></script>
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Manage Vaccines
     
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Vaccines</li>
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
          <button class="btn btn-primary" data-toggle="modal" data-target="#addModal">Add Vaccine</button>
          <button class="btn btn-default" data-toggle="modal" onclick="createDropdown()" data-target="#receiveModal">Receive Vaccine</button>
          <br /> <br />
        <?php //endif; ?>

        <div class="box">
         
          <!-- /.box-header -->
          <div class="box-body">
            <table id="vaccineTable" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>Vaccine</th>
                <th>Total Quantity</th>
                <th>Quantity On-Hand</th>
                <th>Quantity Issued</th>
                <th>Expiration Date </th>
                <th>Remarks</th>
                <?php //if(in_array('updateGroup', $user_permission) || in_array('deleteGroup', $user_permission)): ?>
                  <th>Action</th>
                <?php //endif; ?>
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
            <label for="brand_name">Vaccine Description</label>
            <input type="text" class="form-control" id="vaccine_name" name="vaccine_name" placeholder="Enter Vaccine Name" autocomplete="off">
          </div>
          <div class="form-group">
            <label for="brand_name">Quantity</label>
            <input type="text" class="form-control" id="vaccine_onhand" name="vaccine_onhand" placeholder="Enter Quantity On-Hand" autocomplete="off">
          </div>


          <div class="form-group">
            <label for="brand_name">Expiration Date</label>
            <input type="date" class="form-control" id="vaccine_exp_date" name="vaccine_exp_date" placeholder="Enter Expiration Date" autocomplete="off">
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
            <label for="brand_name">Quantity On-Hand</label>
            <input type="text" class="form-control" id="edit_vaccine_onhand" name="edit_vaccine_onhand" placeholder="Enter Quantity On-Hand" autocomplete="off">
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
        <h4 class="modal-title">Remove Elements</h4>
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
        <h4 class="modal-title">Receive Vaccine</h4>
      </div>

      <form role="form" action="<?php echo base_url('Controller_Vaccine/receive') ?>" method="post" id="receiveForm">

        <div class="modal-body">
          <div id="messages"></div>

          <div class="form-group">
            <label for="edit_brand_name">Vaccine Name</label>
            <div id="vaccineNameContainer"></div>
          </div>
          <div class="form-group">
            <label for="brand_name">Quantity</label>
            <input type="number" class="form-control" id="receive_vaccine_onhand" name="receive_vaccine_onhand" placeholder="Enter Quantity On-Hand" autocomplete="off">
          </div>
         
          
        </div>

        <div class="modal-footer">
          <button type="button" id="receiveVaccineCloseBtn" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" onlick ="receiveVaccine()" class="btn btn-primary">Receive Vaccine</button>
        </div>

      </form>


    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<script type="text/javascript">
var manageTable;
var base_url = "<?php echo base_url(); ?>";

$(document).ready(function() {
  
  

  $("#vaccineNav").addClass('active');

  // initialize the datatable 
  manageTable = $('#vaccineTable').DataTable({
    dom: 'Bfrtip',
    buttons: [{
        extend: 'excelHtml5',
        text: 'Download Results',
        className:'btn btn-default',
        exportOptions: {
                columns: [0, 1, 2, 3, 4]
        },
        customize: function ( xlsx ) {
          var sheet = xlsx.xl.worksheets['sheet1.xml'];
          console.log(xlsx);
          $('c[r=A1] t', sheet).text( 'Custom text' );
      } 
     }],
    
    'ajax': base_url + 'Controller_Vaccine/fetchVaccinesData',
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
          $("#addVaccineCloseBtn").click();

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



// edit function
function editFunc(id)
{ 
  
  $.ajax({
    url: 'fetchVaccineDataById/'+id,
    type: 'post',
    dataType: 'json',
    success:function(response) {

      $("#edit_vaccine_name").val(response.description);
      $("#edit_vaccine_onhand").val(response.qty_onhand);
      $("#edit_vaccine_requested").val(response.qty_requested);
      $("#edit_vaccine_issued").val(response.qty_issued);
      $("#edit_vaccine_remarks").val(response.remarks);

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
           // $("#removeModal").modal('hide');
           $('#removeVaccineCloseBtn').click();

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


var createDropdown = () => {
    $.ajax({
      url: base_url+'Controller_Vaccine/createDropdown/vaccine',
      success: function(res){
        var parsedData = JSON.parse(res);
        $("#vaccineNameContainer").html(parsedData.data);

      }
    })
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
