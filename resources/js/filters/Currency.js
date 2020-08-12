import Vue from 'vue';
import currency from 'currency.js';

Vue.filter('currency', (value) => currency(value, {
  symbol: '£',
  fromCents: true,
}).format());
