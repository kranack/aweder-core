const AdminMenu = class AdminMenu {
  adminMenu = null;

  adminTrigger = null;

  attachClickEvent = () => {
    this.adminTrigger.addEventListener('click', this.toggleMenu);
  };

  toggleMenu = () => {
    this.adminMenu.classList.toggle('admin-nav--open');
    this.adminTrigger.classList.toggle('admin__greeting--open');
  };

  init = () => {
    this.adminMenu = document.getElementById('admin-nav');
    this.adminTrigger = document.getElementById('admin__greeting');

    if (this.adminMenu !== null && this.adminTrigger !== null) {
      this.attachClickEvent();
    }
  };
};

export default AdminMenu;
