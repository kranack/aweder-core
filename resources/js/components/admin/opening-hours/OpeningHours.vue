<template>
  <div class="opening-time">
    <div class="opening-time__day">
      <div class="opening-time__status">
        <input id="monday-status"
               type="checkbox"
               name="is_open"
               checked="checked"
               class="hidden"
        />
        <label
          class="opening-time__checkbox"
          for="monday-status"
        >
          <span class="icon">
            <Tick class="stroke-cloud-burst" />
          </span>
        </label>
      </div>
      <p>Monday</p>
    </div>
    <div class="opening-time__times">
      <div class="opening-time__group">
        <div class="field">
          <flat-pickr
            ref="datePicker"
            v-model="time"
            :config="config"
          />
        </div>
        <span class="separator separator--small" />
        <div class="field">
          <flat-pickr
            ref="datePicker"
            v-model="time"
            :config="config"
          />
        </div>
      </div>
      <div
        v-if="isVisible === true"
        class="opening-time__group"
      >
        <div class="field">
          <flat-pickr
            ref="datePicker"
            v-model="time"
            :config="config"
          />
        </div>
        <span class="separator separator--small" />
        <div class="field">
          <flat-pickr
            ref="datePicker"
            v-model="time"
            :config="config"
          />
        </div>
      </div>
    </div>
    <span
      class="opening-time__add"
      @click="showTableTime()"
    >
      <span class="icon">
        <Add class="fill-carnation" />
      </span>
      Add extra hours
    </span>
  </div>
</template>

<script>
import Tick from '@/js/components/svgs/Tick';
import Add from '@/js/components/svgs/Add';
import flatPickr from 'vue-flatpickr-component';
import openingHoursApi from '@/js/api/opening-hours/opening-hours';

export default {
  name: 'OpeningHours',
  components: {
    Tick,
    Add,
    flatPickr,
  },
  props: {
    merchant: {
      type: Object,
      required: true,
    },
  },
  data() {
    return {
      isVisible: false,
      time: null,
      config: {
        altInput: true,
        altFormat: 'H:i',
        noCalendar: true,
        dateFormat: 'H:i',
        enableTime: true,
        time_24hr: true,
        minuteIncrement: '15',
        defaultDate: '12:00',
      },
    };
  },
  mounted() {
    openingHoursApi.get();
  },
  methods: {
    showTableTime() {
      this.isVisible = true;
    },
  },
};
</script>
