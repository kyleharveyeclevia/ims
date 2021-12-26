function hideModal(modal_id){
    $("#"+modal_id).removeClass("in");
    $(".modal-backdrop").remove();
    $("#"+modal_id).hide();
}

function hideModal2(modal_id){
    $("#"+modal_id).modal('hide');
}