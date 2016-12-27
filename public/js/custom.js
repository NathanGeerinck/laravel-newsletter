function deleteEntity(element, subject) {
    swal({
        title: "Are you sure you want to delete '" + subject + "'?",
        text: 'This cannot be undone',
        type: "warning",
        showCancelButton: true,
        cancelButtonText: 'Cancel',
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Delete",
        closeOnConfirm: false,
        showLoaderOnConfirm: true
    }, function () {
        $(element).closest('form').submit();
    });
}