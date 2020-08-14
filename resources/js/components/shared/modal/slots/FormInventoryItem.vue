<template>
  <modal
    :is-active="isActive"
    class="modal--inventory"
    @close="close()"
  >
    <form
      class="flex flex-col"
      method="post"
      :action="formAction"
    >
      <method-field :method="formMethod" />
      <csrf-field />
      <input
        type="hidden"
        name="category-id"
        :value="categoryId"
      >
      <header class="modal__header flex align-items-end">
        <input
          id="title"
          class="modal__input"
          type="text"
          name="title"
          placeholder="Inventory name"
          :value="form.title"
        >
        <div
          class="field field--toggle margin-left-auto"
        >
          <input
            id="visibility"
            type="checkbox"
            class="hidden toggle-input"
            checked
          >
          <label
            class="toggle"
            for="visibility"
          >
            <span class="toggle__label">Show/Hide</span>
            <span class="toggle__container">
              <span class="toggle__thumb" />
            </span>
          </label>
        </div>
      </header>
      <div class="field field--upload">
        <input
          id="logo"
          class="upload-input"
          type="file"
          name="logo"
        >
        <label
          class="upload"
          for="logo"
        >
          <span class="upload__trigger">
            <span class="upload__icon">
              <upload />
            </span>
          </span>
        </label>
        <span class="upload__label upload__label--input">No file chose</span>
      </div>
      <span class="body-medium width-full shrink-0 margin-bottom-30">
        This item will be available for&hellip;
      </span>
      <div class="checkboxes flex">
        <div class="field field--checkbox">
          <input
            id="take-away"
            type="checkbox"
            name="collection_types[]"
            class="hidden checkbox-input collection--type"
            value="take-away"
          >
          <label
            class="checkbox checkbox--icon checkbox--icon-small"
            for="take-away"
          >
            <span
              class="checkbox__icon checkbox__icon--image checkbox__icon--small
              icon icon--collection"
            >
              <Delivery />
            </span>
            <span class="checkbox__label checkbox__label--image checkbox__label--small">
              Take away
            </span>
          </label>
        </div>
        <div class="field field--checkbox">
          <input
            id="table"
            type="checkbox"
            name="collection_types[]"
            class="hidden checkbox-input collection--type"
            value="table"
          >
          <label
            class="checkbox checkbox--icon checkbox--icon-small"
            for="table"
          >
            <span
              class="checkbox__icon checkbox__icon--image checkbox__icon--small
              icon icon--table"
            >
              <Table />
            </span>
            <span class="checkbox__label checkbox__label--image checkbox__label--small">
              Table service
            </span>
          </label>
        </div>
      </div>
      <div class="field field--select">
        <select
          id="sub-category"
          class="select width-full"
          name="sub-category"
        >
          <option value="">
            Dummy cat 1
          </option>
          <option value="">
            Dummy cat 2
          </option>
        </select>
      </div>
      <div class="input-row flex">
        <div class="field field--small-input">
          <input
            id="amount"
            class="text-input"
            type="text"
            :name="isCreate ? 'amount' : 'price'"
            placeholder="Eat in price"
            :value="form.amount"
          >
        </div>
        <div class="field field--small-input">
          <input
            id="take-out-price"
            class="text-input"
            type="text"
            name="take-out-price"
            placeholder="Take out price"
          >
        </div>
      </div>
      <div class="field">
        <input
          id="description"
          class="text-input"
          type="text"
          name="description"
          placeholder="Item description"
          :value="form.description"
        >
      </div>
      <div class="field--buttons">
        <button
          v-if="isUpdate"
          class="button button-solid--silver"
          @click.prevent="deleteItem"
        >
          <span class="button__content">Delete item</span>
        </button>
        <button
          class="button button-solid--carnation"
          type="submit"
        >
          <span class="button__content">Save item</span>
        </button>
      </div>
    </form>
    <form
      v-if="isUpdate"
      ref="deleteForm"
      :action="`/admin/inventory/delete/${item.id}`"
    >
      <method-field method="delete" />
    </form>
  </modal>
</template>

<script>
import Modal from '@/js/components/shared/modal/Modal';
import Upload from '@/js/components/svgs/Upload';
import Delivery from '@/js/components/svgs/Delivery';
import Table from '@/js/components/svgs/Table';
import CsrfField from '@/js/components/shared/form/CsrfField';
import MethodField from '@/js/components/shared/form/MethodField';

export default {
  name: 'FormInventoryItem',
  components: {
    Modal,
    Upload,
    Delivery,
    Table,
    CsrfField,
    MethodField,
  },
  props: {
    isActive: {
      type: Boolean,
      default: false,
    },
    item: {
      type: Object,
      default: null,
    },
    categoryId: {
      type: Number,
      required: true,
    },
    formType: {
      type: String,
      required: true,
    },
  },
  data() {
    return {
      form: {
        title: '',
        amount: '',
        description: '',
      },
    };
  },
  computed: {
    formMethod() {
      return this.isCreate ? 'post' : 'put';
    },
    formAction() {
      return this.isCreate
        ? '/admin/inventory'
        : `/admin/inventory/${this.item.id}/update`;
    },
    isCreate() {
      return this.formType === 'create';
    },
    isUpdate() {
      return this.formType === 'update';
    },
  },
  mounted() {
    if (this.item) {
      this.form.title = this.item.title;
      this.form.amount = this.item.price;
      this.form.description = this.item.description;
    }
  },
  methods: {
    close() {
      this.$emit('close');
    },
    deleteItem() {
      if (confirm(`Confirm to delete ${this.item.title}.`)) {
        this.$refs.deleteForm.submit();
      }
    },
  },
};
</script>
