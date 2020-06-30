<template>

</template>
<script>
import UserInformation from '@/js/components/registration/Stages/UserInformation';
import BusinessDetails from '@/js/components/registration/Stages/BusinessDetails';
import ContactNumbers from '@/js/components/registration/Stages/ContactNumbers';
import BusinessAddress from '@/js/components/registration/Stages/BusinessAddress';

export default {
  name: 'RegistrationForm',
  components: {
    UserInformation,
    BusinessAddress,
    BusinessDetails,
    ContactNumbers,
  }
}
</script>
