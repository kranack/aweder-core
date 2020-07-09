import axios from 'axios';
import debounce from 'debounce';

export default class SlugChecker {
  removeExistingValidationErrors = (element) => {
    const errors = element.parentElement.querySelector('.field__error--slug');
    if (errors) {
      element.parentNode.removeChild(errors);
      element.parentElement.classList.remove('field--error');
    }
  };

  hasEnoughCharactersToLookup = (e) => e.target.value.length > 3

  init = () => {
    const element = document.getElementById('url-slug');
    if (element !== null) {
      element.addEventListener('keyup', debounce((e) => {
        this.removeExistingValidationErrors(element);

        if (!this.hasEnoughCharactersToLookup(e)) {
          return;
        }

        axios
          .get(`/validate-slug/${e.target.value}`)
          .then((response) => {
            if (response.data.exists === true) {
              element.parentElement.classList.add('field--error');
              const error = document.createElement('p');
              error.innerText = 'The slug is already taken.';
              error.classList.add('field__error');
              error.classList.add('field__error--slug');
              element.parentElement.insertBefore(error, element);
            }
          });
      }, 600));
    }
  };
}
