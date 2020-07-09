export default class Upload {
  uploadEls = document.querySelectorAll('.field--upload');

  getTargetEls = () => {
    this.uploadEls.forEach((upload) => {
      const input = upload.querySelectorAll('input')[0];
      const filename = upload.querySelectorAll('.upload__label')[0];
      input.addEventListener('change', (event) => {
        this.showFileName(event, input, filename);
      });
    });
  };

  showFileName = (event, input, filename) => {
    input = event.srcElement;
    const inputFilename = input.files[0].name;
    filename.textContent = `File name: ${inputFilename}`;
  }

  init = () => {
    if (this.uploadEls !== null && this.uploadEls.length > 0) {
      this.getTargetEls();
    }
  }
}
