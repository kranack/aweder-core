export default class OpeningTimes {
  timesMenu = document.getElementById('merchant-times__timetable');

  timesTrigger = document.getElementById('merchant-times__current');

  init = () => {
    if (this.timesMenu !== null && this.timesTrigger !== null) {
      this.timesTrigger.addEventListener('click', this.toggleTimetable);
    }
  };

  toggleTimetable = () => {
    this.timesMenu.classList.toggle('merchant-times__timetable--open');
    this.timesTrigger.classList.toggle('merchant-times__current--open');
  };
}
