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

        if (exercise["duration_type"] == 1) {
            $("input#seconds").attr("checked", "checked");
        }
        else if (exercise["duration_type"] == 2) {
            $("input#minutes").attr("checked", "checked");
        }

    }
    else {
        document.getElementsByClassName('duration-type-radio')[0].style.display = 'none';
    }
});

// Info exercise modal
$(document).on("click", ".open-info-modal", function () {
    var exercise = $(this).data("id")[0];
    var activity = $(this).data("id")[1];

    modal_info_title.innerText = "Information about " + exercise["name"];
    if (exercise["description"] == null && exercise["info_video_url"] == null) {
        modal_info_no_description.innerText =
            "This exercise has no description";
    } else if (exercise["description"] != null) {
        modal_info_description.innerText = exercise["description"];
    }


    // Strava data
    if (activity != null) {
        var distanceInKm = activity["distance"] / 1000
        var distanceInKmShort = Math.trunc(distanceInKm * 100) / 100;

        var name = activity["name"];
        var date = activity["start_date_local_short"];
        var distance = distanceInKmShort;
        var moving_time = secondsToHms(activity["moving_time"]);
        var pace = activity["avg_pace"];
        var total_elevation_gain = activity["total_elevation_gain"];
        var elapsed_time = secondsToHms(activity["elapsed_time"]);


        $(".strava-activity-data").css("display", "block");
        $('td#name').html(name);
        $('td#date').html(date);
        $('td#distance').html(distance + " km");
        $('td#moving_time').html(moving_time);
        $('td#avg_pace').html(pace + "/km");
        $('td#total_elevation_gain').html(total_elevation_gain + " m");
        $('td#elapsed_time').html(elapsed_time);
        $("a.view-activity-link").attr("href", "https://www.strava.com/activities/" + exercise["activity_id"]);
    }
    else {
        $(".strava-activity-data").css("display", "none");
    }

    // Video
    if (exercise["info_video_url"] == null) {
        $(".embed-responsive").css("display", "none");
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

// Add Strava activity to exercise modal
$(document).on("click", ".open-add-strava-modal", function () {
    var exercise = $(this).data("id");

    $("form.add-strava-modal-form").attr(
        "action",
        exercise["workout_id"] + "/exercise/" + exercise["id"] + "/add-strava-activity"
    );

    var activity_id = ($('.activity-dropdown').find(":selected").val());
    $("a.view-activity-link").attr("href", "https://www.strava.com/activities/" + activity_id);
    $("input#hiddenActivityId").attr("value", activity_id);

    $('.activity-dropdown').change(function () {
        var activity_id = ($('.activity-dropdown').find(":selected").val());
        $("a.view-activity-link").attr("href", "https://www.strava.com/activities/" + activity_id);
        $("input#hiddenActivityId").attr("value", activity_id);
    });

    $("input#hiddenExerciseId").attr("value", exercise["id"]);

});

// Remove Strava activity from exercise modal
$(document).on("click", ".open-remove-activity-modal", function () {
    // Take exercise object
    var exercise = $(this).data("id");

    // Set delete modal href
    $("a.remove-activity-href").attr(
        "href",
        exercise["workout_id"] + "/exercise/" + exercise["id"] + "/remove-strava-activity"
    );
});

function secondsToHms(d) {
    d = Number(d);
    var h = Math.floor(d / 3600);
    var m = Math.floor(d % 3600 / 60);
    var s = Math.floor(d % 3600 % 60);

    var hDisplay = h > 0 ? h + (h == 1 ? " hr, " : " hrs, ") : "";
    var mDisplay = m > 0 ? m + (m == 1 ? " min, " : " mins, ") : "";
    var sDisplay = s > 0 ? s + " s" : "";
    return hDisplay + mDisplay + sDisplay;
}