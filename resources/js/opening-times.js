const OpeningTimes = class OpeningTimes {
  timesMenu = null;

  timesTrigger = null;

  attachClickEvent = () => {
    this.timesTrigger.addEventListener('click', this.toggleTimetable);
  };

  toggleTimetable = () => {
    this.timesMenu.classList.toggle('merchant-times__timetable--open');
    this.timesTrigger.classList.toggle('merchant-times__current--open');
  };

  init = () => {
    this.timesMenu = document.getElementById('merchant-times__timetable');
    this.timesTrigger = document.getElementById('merchant-times__current');

    if (this.timesMenu !== null && this.timesTrigger !== null) {
      this.attachClickEvent();
    }
  };
};

export default OpeningTimes;
