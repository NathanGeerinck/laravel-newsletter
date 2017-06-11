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

function deleteSubscription(element, subject) {
    swal({
        title: "Are you sure that you want to unsubscribe?",
        text: 'This cannot be undone',
        type: "warning",
        showCancelButton: true,
        cancelButtonText: 'Cancel',
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes, I'm sure!",
        closeOnConfirm: false,
        showLoaderOnConfirm: true
    }, function () {
        $(element).closest('form').submit();
    });
}