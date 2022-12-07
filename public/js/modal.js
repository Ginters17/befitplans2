// Delete exercise modal
$(document).on("click", ".open-delete-modal", function () {
    // Take exercise object
    var exercise = $(this).data("id");

    // Set delete modal title
    modal_delete_title.innerText =
        "Are you sure you want to delete " + exercise["name"] + "?";

    // Set delete modal href
    $("a.delete-modal-href").attr(
        "href",
        exercise["workout_id"] + "/exercise/" + exercise["id"] + "/delete"
    );
});

// Edit exercise modal
$(document).on("click", ".open-edit-modal", function () {
    var exercise = $(this).data("id");

    modal_edit_title.innerText = "Edit exercise " + exercise["name"];
    $("input#inputExerciseName").attr("value", exercise["name"]);
    $("textarea#inputExerciseDescription").val(exercise["description"]);
    $("input#inputExerciseReps").attr("value", exercise["reps"]);
    $("input#inputExerciseSets").attr("value", exercise["sets"]);
    $("input#inputDuration").attr("value", exercise["duration"]);
    $("input#hiddenExerciseId").attr("value", exercise["id"]);
    $("input#inputExerciseVideoURL").attr("value", exercise["info_video_url"]);

    $("form.edit-modal-form").attr(
        "action",
        exercise["workout_id"] + "/exercise/" + exercise["id"] + "/update"
    );

    if (document.getElementById('inputDuration').value != "") {
        document.getElementsByClassName('duration-type-radio')[0].style.display = 'inline';
        
        if(exercise["duration_type"] == 1){
            $("input#seconds").attr("checked", "checked");
        }
        else if(exercise["duration_type"] == 2){
            $("input#minutes").attr("checked", "checked");
        }
        
    }
    else {
        document.getElementsByClassName('duration-type-radio')[0].style.display = 'none';
    }
});

// Info exercise modal
$(document).on("click", ".open-info-modal", function () {
    var exercise = $(this).data("id");

    modal_info_title.innerText = "Information about " + exercise["name"];
    if (exercise["description"] == null && exercise["info_video_url"] == null) {
        modal_info_no_description.innerText =
            "This exercise has no description";
    } else if (exercise["description"] != null) {
        modal_info_description.innerText = exercise["description"];
    }

    var info_video_id = exercise["info_video_url"].substr(exercise["info_video_url"].length - 11);
    var info_video_url = "https://www.youtube.com/embed/" + info_video_id + "?rel=0";

    if (exercise["info_video_url"] != null) {
        $(".embed-responsive").css("display", "block");
        $("iframe.embed-responsive-item").attr("src", info_video_url);
    } else {
        $(".embed-responsive").css("display", "none");
    }
});
