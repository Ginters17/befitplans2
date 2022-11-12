// Delete exercise modal
$(document).on("click", ".open-delete-modal", function () {
    // Take exercise object
    var exercise = $(this).data('id');

    // Set delete modal title
    modal_delete_title.innerText = "Are you sure you want to delete " + exercise["name"] + "?";

    // Set delete modal href
    $("a.delete-modal-href").attr("href", exercise["workout_id"]+"/exercise/"+exercise["id"]+"/delete");
});

// Edit exercise modal
$(document).on("click", ".open-edit-modal", function () {
    var exercise = $(this).data('id');
    modal_edit_title.innerText = "Edit exercise " + exercise["name"];
    $("input#inputExerciseName").attr("value", exercise["name"]);
    $("textarea#inputExerciseDescription").val(exercise["description"]);
    $("input#inputExerciseReps").attr("value", exercise["reps"]);
    $("input#inputExerciseSets").attr("value", exercise["sets"]);
    $("input#inputExerciseDuration").attr("value", exercise["duration"]);
    $("input#hiddenExerciseId").attr("value", exercise["id"]);


    $("form.edit-modal-form").attr("action", exercise["workout_id"]+"/exercise/"+exercise["id"]+"/update");
    
});

// Info exercise modal
$(document).on("click", ".open-info-modal", function () {
    var exercise = $(this).data('id');

    modal_info_title.innerText = "Information about " + exercise["name"];
    modal_info_description.innerText = exercise["description"];
});
