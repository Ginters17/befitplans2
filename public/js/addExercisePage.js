window.showDurationTypeRadio = function() {
  var durationInput = document.getElementById('duration-input').value;
  if (!!durationInput) {
    document.getElementsByClassName('duration-type-radio')[0].style.display = 'inline';
    document.getElementsByClassName('add-exercise-button')[0].style.marginTop = '60px';
  } else {
    document.getElementsByClassName('duration-type-radio')[0].style.display = 'none';
    document.getElementsByClassName('add-exercise-button')[0].style.marginTop = '0px';
  };
 };