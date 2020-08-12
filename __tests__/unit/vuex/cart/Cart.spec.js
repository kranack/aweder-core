import { subtotal, quantity } from '@/js/store/modules/cart/getters';
import products from './mocks/products';

describe('CartModule', () => {
  it('sets the correct subtotal', async () => {
    expect(subtotal(products)).toEqual(2100);
  });

  it('sets the correct quantity', () => {
    expect(quantity(products)).toEqual(3);
  });
});
