import Vue from 'vue';
import currency from 'currency.js';

Vue.filter('currency', (value) => {
  return currency(value, {
    symbol: '£',
    fromCents: true,
  }).format();
});
