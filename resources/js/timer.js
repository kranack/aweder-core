export default class Timer {
  elements = document.getElementsByClassName('hidden-time')

  startTimer = (totalSeconds, element) => {
    setInterval(() => {
      const minute = Math.floor((totalSeconds) / 60);
      totalSeconds++;
      if (minute >= 20) {
        element.parentElement.classList.replace('order__status--new',
          'order__status--old');
      }
      element.parentElement.querySelector('.timer').innerHTML = this.pad(minute);
    }, 1000);
  }

  calculateTime = (element) => {
    let totalSeconds = null;
    const time = element.value;
    const splitTime = time.split(':');
    if (splitTime[0] !== '00') {
      totalSeconds += Math.floor(splitTime[0] * 60);
    }
    if (splitTime[1] !== '00') {
      totalSeconds += Math.floor(splitTime[1]);
    }
    this.startTimer(totalSeconds, element);
  }

  pad = (val) => {
    const valString = `${val}`;
    if (valString.length < 2) {
      return `0${valString}`;
    }
    return valString;
  }

  init = () => {
    if (this.elements !== null && this.elements.length > 0) {
      for (const element of this.elements) {
        this.calculateTime(element);
      }
    }
  }
}
