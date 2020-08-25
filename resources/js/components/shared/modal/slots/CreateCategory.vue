<template>
  <modal
    :is-active="isActive"
    class="modal--inventory"
    @close="close()"
  >
    <form
      class="flex flex-col"
      action="/admin/inventory/category"
      method="POST"
      enctype="multipart/form-data"
    >
      <csrf-field/>
      <header class="modal__header flex align-items-end">
        <input
          class="modal__input"
          type="text"
          name="title"
          placeholder="Category name"
        />
        <div
          class="field field--toggle margin-left-auto"
        >
          <input
            id="visibility"
            name="visibility"
            v-model="checked"
            type="checkbox"
            class="hidden toggle-input"
          />
          <label
            class="toggle"
            for="visibility"
          >
            <span class="toggle__label">Show/Hide</span>
            <span class="toggle__container">
              <span class="toggle__thumb" />
            </span>
          </label>
          <input type="hidden" id="visible" name="visible" v-bind:value="checked">
        </div>
      </header>
      <div class="field field--upload">
        <input
            id="image"
            class="upload-input"
            type="file"
            name="image"
        />
        <label
          class="upload"
          for="image"
        >
          <span class="upload__trigger">
            <span class="upload__icon">
              <upload />
            </span>
          </span>
        </label>
        <span class="upload__label upload__label--input">No file chosen</span>
      </div>
      <span class="body-medium width-full shrink-0 margin-bottom-30">
        This category will be available for&hellip;
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
            <span class="checkbox__icon checkbox__icon--image checkbox__icon--small
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
      <span class="field__note margin-bottom-20">
        Add sub categories to your menu and hit enter to add a new one.
      </span>
      <input type="hidden" name="subCategories" id="subCategories" :value="tags"/>
      <input type="hidden" name="merchant" id="merchant" :value="merchant"/>
      <div class="field field--tags">
        <input-tag
          v-model="tags"
          placeholder="Sub category name"
          validate="text"
        />
      </div>
      <div
        class="field field--buttons"
      >
        <button
          class="button button-solid--silver"
          type="reset"
        >
          <span class="button__content">Delete category</span>
        </button>
        <button
          class="button button-solid--carnation"
          type="submit"
        >
          <span class="button__content">Save category</span>
        </button>
      </div>
    </form>
  </modal>
</template>

<script>
import Modal from '@/js/components/shared/modal/Modal';
import Upload from '@/js/components/svgs/Upload';
import Delivery from '@/js/components/svgs/Delivery';
import Table from '@/js/components/svgs/Table';
import CsrfField from '@/js/components/shared/form/CsrfField';

export default {
  name: 'CreateCategory',
  components: {
    Modal,
    Upload,
    Delivery,
    Table,
    CsrfField,
  },
  props: {
    isActive: {
      type: Boolean,
      default: false,
    },
    merchant: {
      type: String,
      default: '',
    },
  },
  mounted() {
    this.checked = true;
  },
  data() {
    return {
      tags: [],
      checked: '',
    };
  },
  methods: {
    close() {
      this.$emit('close');
    },
  },
};
</script>
