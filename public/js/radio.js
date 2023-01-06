window.showDurationTypeRadio = function () {
  var durationInput = document.getElementById('inputDuration').value;
  if (durationInput) {
    document.getElementsByClassName('duration-type-radio')[0].style.display = 'inline';
    document.getElementsByClassName('submit-btn')[0].style.marginTop = '60px';
  } else {
    document.getElementsByClassName('duration-type-radio')[0].style.display = 'none';
    document.getElementsByClassName('submit-btn')[0].style.marginTop = '24px';
  };
};